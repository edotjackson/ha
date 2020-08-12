<?php
//New Code .edj


namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Address;
use App\Business;
use App\BusinessHour;
use App\City;
use App\Day;
use App\OperatingCity;
use App\Review;
use App\Work;
use App\WorkType;

class DBModelTest extends TestCase
{
    
    use RefreshDatabase; //Ensure that we have a clean database to test with
    
    
    private $businessId;

    public function setUp() : void
    {
        parent::setUp();
        //populate the database
        $day = new Day();
        $day->name = 'Testday';
        $dayId = $day->save();

        $huntsville = new City();
        $huntsville->name = 'Huntsville';
        $huntsville->lat = 34.7304;
        $huntsville->lon = 86.5861;
        $huntsvilleId = $huntsville->save();

        $work = new Work();
        $work->name = 'Software Engineering';
        $workId = $work->save();

        $address = new Address();
        $address->addressLine1 = '1600 Pennsylvania Ave.';
        $address->addressLine2 = 'NW';
        $address->city = 'Washington';
        $address->stateAbbr = 'DC';
        $address->postal = '20006';
        $addressId = $address->save();

        $business = new Business();
        $business->businessName = 'EDJ Enterprises';
        $business->address_id = $addressId;
        $this->businessId = $business->save();

        $businessHour = new BusinessHour();
        $businessHour->business_id = $this->businessId;
        $businessHour->day_id = $dayId;
        $businessHour->openTime = 8;
        $businessHour->closeTime = 18;
        $businessHour->save();

        $operatingCity = new OperatingCity();
        $operatingCity->city_id = $huntsvilleId;
        $operatingCity->business_id = $this->businessId;
        $operatingCity->save();

        $workType = new WorkType();
        $workType->work_id = $workId;
        $workType->business_id = $this->businessId;
        $workType->save();

        $review1 = new Review();
        $review1->ratingScore = 4;
        $review1->customerComment = "Rating of 4";
        $review1->business_id = $this->businessId;
        $review1->save();

        $review2 = new Review();
        $review2->ratingScore = 5;
        $review2->customerComment = "Rating of 5";
        $review2->business_id = $this->businessId;
        $review2->save();

    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDbModelTest()
    {
        $business = Business::find($this->businessId);
        
        $this->assertEquals($business->businessName, 'EDJ Enterprises');
        $this->assertEquals($business->businessAddress->addressLine1, '1600 Pennsylvania Ave.');
        $this->assertEquals($business->businessAddress->addressLine2, 'NW');
        $this->assertEquals($business->businessAddress->city, 'Washington');
        $this->assertEquals($business->businessAddress->stateAbbr, 'DC');
        $this->assertEquals($business->businessAddress->postal, '20006');
        $this->assertEquals($business->rating, 4.5);
        $this->assertEquals($business->businessHours[0]->dayOfWeek, 'Testday');
        $this->assertEquals($business->businessHours[0]->open, 8);
        $this->assertEquals($business->businessHours[0]->close, 18);
        $this->assertEquals($business->operatingCities[0], 'Huntsville');
        $this->assertEquals($business->WorkTypes[0], 'Software Engineering');
    }
}
