<?php
//New Code .edj
namespace App\Http\Controllers;

use Validator;
use GuzzleHttp\Client;
use Illuminate\Http\Request;


use App\Address;
use App\Business;
use App\BusinessHour;
use App\Day;
use App\OperatingCity;
use App\City;
use App\WorkType;
use App\Work;
use App\Review;

use App\Rules\GreaterThan;
use App\Rules\LessThan;
use App\Rules\Inside;

class BusinessController extends Controller
{
    // ******************************* API Methods ********************************

    public function addBusiness(Request $request)
    {

      //check Business json validity
        $rules =
        [
            // expected fields
            'businessName' => 'required|string',
            'businessHours' => 'required|array',
            'businessHours.*.dayOfWeek' => ['required_with:businessHours',new Inside(Day::select('*')->pluck('name'), 'days')],
            'businessHours.*.open' => ['required_with:businessHours','numeric','integer',new LessThan('businessHours.*.close', true, 0, 12), 'between:0,24'],
            'businessHours.*.close' => ['required_with:businessHours','numeric', 'integer',new GreaterThan('businessHours.*.open', true, 12, 0), 'between:0,24'],
            'businessAddress.addressLine1' => 'required|string|max:128',
            'businessAddress.addressLine2' => 'string|max:1024',
            'businessAddress.city' => 'required|string|max:64',
            'businessAddress.stateAbbr' => 'required|string|max:2',
            'businessAddress.postal' => 'required|string|max:10',
            'operatingCities' => 'required|array|min:1',
            'operatingCities.*' =>[new Inside(City::select('*')->pluck('name'), 'cities')],
            'workTypes' => 'required|array|min:1',
            'workTypes.*' =>[new Inside(Work::select('*')->pluck('name'), 'work types')],
            'reviews' => 'array|min:1',
            'reviews.*.ratingScore' => 'required_with:reviews|between:0,5.00',
            'reviews.*.customerComment' => 'required_with:reviews|max:2048',
        ];

        $validator =  Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // *** ERROR, validation rules failed ***
            return response() -> json($validator->errors(), 400);
        }

        
        // Dispatch job to add new Business and supporting information
        // This is done synchronously for now, might move to async if its slow  
        
        echo "Adding New Business \n";
        $address = new Address();
        $address->addressLine1 = $request->businessAddress['addressLine1'];
        $address->addressLine2 = $request->businessAddress['addressLine2'];
        $address->city = $request->businessAddress['city'];
        $address->stateAbbr = $request->businessAddress['stateAbbr'];
        $address->postal = $request->businessAddress['postal'];
        $address->save();

        $business = new Business();   
        $business->businessName = $request->businessName;
        $business->address_id = $address->id;
        $business->save();

        foreach($request->businessHours as $hour)
        {
            $businessHour = new BusinessHour();
            $businessHour->openTime = $hour['open'];
            $businessHour->closeTime = $hour['close'];
            $day = Day::where('name', $hour['dayOfWeek'])->first();
            $businessHour->day_id = Day::where('name', $hour['dayOfWeek'])->first()->id;
            $businessHour->business_id = $business->id;
            $businessHour->save();
        }
        
        foreach($request->operatingCities as $city)
        {
          $operatingCity = new OperatingCity();
          //The expectation here is that 
          $operatingCity->city_id = City::where('name', $city)->first()->id;
          $operatingCity->business_id = $business->id;
          $operatingCity->save();
        }

        foreach($request->workTypes as $type)
        {
          $workType = new WorkType();
          $workType->work_id = Work::where('name', $type)->first()->id;
          $workType->business_id = $business->id;
          $workType->save();
        }

        foreach($request->reviews as $rev)
        {
            $review = new Review();
            $review->ratingScore = $rev['ratingScore'];
            $review->customerComment = $rev['customerComment'];
            $review->business_id = $business->id;
            $review->save();
        }
        
        return response() -> json($business, 200);
    }

    public function searchBusinesses(Request $request)
    {

            //check Business json validity
            $rules =
            [
                // expected fields
                'name_contains' => 'nullable|string',
                'business_days_open' => 'array|min:1',
                'business_days_open.*' => 'string|iin:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
                'open_from' => 'integer|between:0,24|<=:open_to',
                'open_to' => 'integer|between:0,24|>=:open_from',
                'jobs' => 'array|min:1',
                'location' => 'integer|required_with:radius|between:00000,99999',
                'radius' => 'integer|between:0,1000',
                'review_rating' => 'numeric|between:0,5',
                'sort_type' => 'integer|between:0,1',
                'sort_method' => 'integer|between:0,1',
            ];
    
            $validator =  Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                // *** ERROR, validation rules failed ***
                return response() -> json($validator->errors(), 400);
            }

        $sortType = 0; //Business Name
        $sortMethod = 0; //Ascending
        if($request->has('sort_type'))
        {
            $sortType = $request->sort_type;
        }
        if($request->has('sort_method'))
        {
            $sortMethod = $request->sort_method;
        }
        
        if($sortType == 0)
        {
          $businesses = Business::orderBy('businessName', $sortMethod == 0 ? 'ASC' : 'DESC')->get();
        }
        else
        {
          $businesses = Business::select('*')->get();
          $businesses = $businesses->sort(function ($a, $b) use($sortMethod) {
            $left = Review::where('business_id',$a->id)->avg('ratingScore');
            $right = Review::where('business_id',$b->id)->avg('ratingScore');
            if ($left == $right) {
                return 0;
            }
            else if($sortMethod == 0)
            {
              return ($left < $right) ? -1 : 1;
            }
            else
            {
              return ($left < $right) ? 1 : -1;
            }
           
        });
        }


        if($request->has('name_contains') && is_string($request->name_contains))
        {
          
          $businesses = $businesses->filter(function($business) use($request)
          {
            $pos = stripos($business->businessName, $request->name_contains);
            return $pos !== false;
          })->values();
        } 
        
        $days = null;
        if($request->has('business_days_open'))
        {
          $days = $request->business_days_open;
          foreach($days as $day)
          {
            $businesses = $this->filterByDay($businesses, $day);
          }
        }

        if($request->has('open_from'))
        {
          if($days === null)
          {
            $days = array();
            array_push($days,date('l'));
            $businesses = $this->filterByDay($businesses, date('l'));
          }

          foreach($days as $day)
          {
            $businesses = $businesses->filter(function($business) use($request, $day)
            {
              return $business->hoursOpen($day)[0] <= $request->open_from;
            })->values();
          }
          
        }

        if($request->has('open_to'))
        {
          if($days === null)
          {
            $days = array($days,date('l'));
            $businesses = $this->filterByDay($businesses, date('l'));
          }

          foreach($days as $day)
          {
            $businesses = $businesses->filter(function($business) use($request, $day)
            {
              return $business->hoursOpen($day)[1] >= $request->open_to;
            })->values();
          }        
        }

        if($request->has('jobs'))
        {
          $jobs = $request->jobs;
          foreach($jobs as $job)
          {
            $businesses = $businesses->filter(function($business) use($job)
            {
              return in_array($job,$business->getWorkTypesAttribute());
            })->values();
          }
        }

        if($request->has('location'))
        {
          //Zip code API os a free service that is limited to 50 hits/hour for the first three months and 10/hour thereafter
          $apikey = "baxKDeocFkMnAMVPQm2ema3WI0KM3vRUYhwLefMnohcfAKEZesBoW8x67y3dkD4S";
          $url = 'https://www.zipcodeapi.com/rest/' . $apikey . '/info.json/' . $request->location . '/degrees';
          $client = new Client;
          try
          {
          $response = json_decode($client->get($url)->getBody());
          
          $radius = $request->has('radius')? $request->radius : 25;
          $searchLocation = array($response->lat, $response->lng);

          $businesses = $businesses->filter(function($business) use($radius, $searchLocation)
            {
              $i = 0;
              $break = false;
              $cities = $business->getOperatingCities();
              while($i < count($cities) && !$break)
              {
                $break = $this->distanceBetween($cities[$i]->lat, $cities[$i]->lon,
                $searchLocation[0], $searchLocation[1]) < $radius + 2; 
                // 2 mile buffer for earth curvature variation
                $i++;
              }
              return $break;
            })->values();         
          }
          catch(ClientException $e)
          {
            echo "Zipcode API limit reached";
            //Nothing to do here
            //This exception occurs if my FREE Zip code -> location API access limit has been reached
          }
        }

          if($request->has('review_rating'))
        {
          $businesses = $businesses->filter(function($business) use($request)
            {
              return Review::where('business_id',$business->id)->avg('ratingScore') >= $request->review_rating;
            })->values();
        }

        //Return the list of businesses
        return response($businesses, 200);
    }

    public function isBusinessOpen($business, $day)
    {
      return in_array($day,$business->daysOpen());
    }

    public function filterByDay($businesses, $day)
    {
      return $businesses->filter(function($business) use($day)
          {
            return $this->isBusinessOpen($business, $day);
          })->values();
    }

    public function distanceBetween($lat1, $lon1, $lat2, $lon2)
    {
      //distance between tow points on earth in miles
      $earthRadius = 3959; // miles
      return acos(
        sin(deg2rad($lat1))*sin(deg2rad($lat2)) + 
        cos(deg2rad($lat1))*cos(deg2rad($lat2)) * 
        cos(deg2rad(abs($lon1 - $lon2)))) * 
        $earthRadius;
    }
    

}
