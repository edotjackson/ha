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

class BusinessRoutePutTest extends TestCase
{
    use DatabaseTransactions;
    private $business;

    public function setUp() : void
    {
        parent::setUp();

        //Seed the database with days, cities and work types
        //Values that do not fall within these lists are rejected by the server validation rules        
        $this->seed('DaySeeder');
        $this->seed('CitySeeder');
        $this->seed('WorkSeeder');

        //create the json object for the business
        $this->business = 
        [
            'businessName' => 'EDJ Enterprises',
            'businessHours' => 
            [
                [
                    'dayOfWeek' => 'Monday',
                    'open' => '9',
                    'close' => '17'
                ],
                [
                    'dayOfWeek' => 'Wednesday',
                    'open' => '8',
                    'close' => '16'
                ],
                [
                    'dayOfWeek' => 'Friday',
                    'open' => '7',
                    'close' => '17'
                ]
            ],
            'businessAddress' => 
            [
                'addressLine1' => '1600 Pennsylvania Ave.',
                'addressLine2' => 'NW',
                'city' => 'Washington',
                'stateAbbr' => 'DC',
                'postal' => "20006"       
            ],
            'operatingCities' => 
            [
                "Denver", 
                "Lakewood", 
                "Thornton", 
                "Golden", 
                "Arvada", 
                "Centennial", 
                "Parker"
            ],
            'workTypes' => 
            [
                "Maid Service", 
                "House Cleaning", 
                "Moving Services"
            ],
            'reviews' => 
            [
                [
                    'ratingScore' => 5,
                    'customerComment' => 'Use them weekly to clean our home. Do a great job every time'
                ],            
                [
                    'ratingScore'=> 4,
                    'customerComment' => 'Helped us move homes, very timely'
                ],        
                [
                    'ratingScore' => 3,
                    'customerComment' => 'On time, did a good job'
                ]       
            ]
        ];
    }
    /**
     * Test putting a new business into the database using the API.
     *
     * @return void
     */
    public function testPutInDbTest()
    {        
        $response = $this->json('PUT', 'api/businesses', $this->business);
        $this->assertEquals(200, $response->getStatusCode());
         $b = Business::first();
        
        $this->assertEquals($b->businessName, 'EDJ Enterprises');
        $this->assertEquals($b->businessAddress->addressLine1, '1600 Pennsylvania Ave.');
        $this->assertEquals($b->businessAddress->addressLine2, 'NW');
        $this->assertEquals($b->businessAddress->city, 'Washington');
        $this->assertEquals($b->businessAddress->stateAbbr, 'DC');
        $this->assertEquals($b->businessAddress->postal, '20006');
        $this->assertEquals($b->rating, 4);
        $this->assertEquals($b->businessHours[1]->dayOfWeek, 'Wednesday');
        $this->assertEquals($b->businessHours[1]->open, 8);
        $this->assertEquals($b->businessHours[1]->close, 16);
        $this->assertEquals($b->operatingCities[3], 'Golden');
        $this->assertEquals($b->WorkTypes[2], 'Moving Services');
    }

}
