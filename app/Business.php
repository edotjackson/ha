<?php
//New Code .edj


namespace App;

use Illuminate\Database\Eloquent\Model;

//this class represents a single business object
class Business extends Model
{
    protected $table = 'businesses';
    public $timestamps = false;
    //Sorting techincally doesn't matter in JSON, but these were hidden 
    //and appended to match the assessment json format.
    protected $hidden = ['id', 'address_id', 'hours', 'work', 'address', 'customerReviews', 'cities'];
    protected $appends = ['rating','businessHours', 'businessAddress','operatingCities', 'workTypes', 'reviews'];

    public function hours()
    {
        return $this->hasMany(BusinessHour::class);
    }

    public function address()
    {
      return $this->belongsTo(Address::class, 'address_id');
    }

    public function cities()
    {
        return $this->hasMany(OperatingCity::class);
    }

    public function work()
    {
        return $this->hasMany(WorkType::class);
    }

    public function customerReviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getBusinessAddressAttribute()
    {
      return $this->address;
    }
    public function getBusinessHoursAttribute()
    {
      return $this->hours;
    }
    public function getRatingAttribute()
    {
      return Review::where('business_id',$this->id)->avg('ratingScore');
    }
    public function getOperatingCitiesAttribute()
    {
      $cities = null;
      foreach($this->getOperatingCities() as $o)
        {
          if(null === $cities)
          {
            $cities = array($o->name);
          }
          else
          {              
            array_push($cities, $o->name);
          }
        }
       return $cities;
    }

    public function getWorkTypesAttribute()
    {
      $workTypes = null;
      foreach($this->work as $w)
        {
          if(null === $workTypes)
          {
            $workTypes = array(Work::find($w->work_id)->name);
          }
          else
          {              
            array_push($workTypes, Work::find($w->work_id)->name);
          }
        }
       return $workTypes;
    }

    public function getReviewsAttribute()
    {
      return $this->customerReviews;
    }

    public function daysOpen()
    {
      $days = array();
      foreach($this->businessHours as $hour)
      {
          array_push($days, $hour->dayOfWeek);
      }
      return $days;
    }

    public function hoursOpen($day)
    {
      $hours = array();
      foreach($this->businessHours as $hour)
      {
        if($hour->dayOfWeek === $day)
        {
          array_push($hours, $hour->open, $hour->close);
        }
      }
      return $hours;
    }

    public function getOperatingCities()
    {
      $cities = null;
      foreach($this->cities as $o)
        {
          if(null === $cities)
          {
            $cities = array(City::find($o->city_id));
          }
          else
          {              
            array_push($cities, City::find($o->city_id));
          }
        }
       return $cities;
    }

}
