<?php
//New Code .edj


namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
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

class BusinessRouteGetTest extends TestCase
{
    use DatabaseTransactions;
    private $business1;
    private $business2;

    private $filterOpenMonday;
    private $filterOpenTuesdayBy6;
    private $filterOpenUntil7pm; 
    private $filterHouseCleaning;
    private $filteReviewMinimumOf3;
    private $filterSortNameAsc;
    private $filterSortReviewDesc;
    private $filterNameContainsZ;

    public function setUp() : void
    {
        parent::setUp();

        //Seed the database with days, cities and work types
        //Values that do not fall within these lists are rejected by the server validation rules        
        $this->seed('DaySeeder');
        $this->seed('CitySeeder');
        $this->seed('WorkSeeder');

        //create the json object for the businesses
        $this->business1 = 
        [
            'businessName' => 'A Company',
            'rating' => 5,
            'businessHours' => 
            [
                [
                    'dayOfWeek' => 'Monday',
                    'open' => '9',
                    'close' => '17'
                ],
                [
                    'dayOfWeek' => 'Tuesday',
                    'open' => '6',
                    'close' => '19'
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
                "Denver"
            ],
            'workTypes' => 
            [
                "Maid Service"
            ],
            'reviews' => 
            [
                [
                    'ratingScore' => 2,
                    'customerComment' => 'Rating of 2'
                ]      
            ]
        ];

        $this->business2 = 
        [
            'businessName' => 'Z Company',
            'businessHours' => 
            [
                [
                    'dayOfWeek' => 'Tuesday',
                    'open' => '7',
                    'close' => '19'
                ],
                [
                    'dayOfWeek' => 'Wednesday',
                    'open' => '6',
                    'close' => '19'
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
                "Golden"
            ],
            'workTypes' => 
            [
                "House Cleaning"
            ],
            'reviews' => 
            [
                [
                    'ratingScore' => 5,
                    'customerComment' => 'Rating of 5'
                ]      
            ]
        ];

        $this->filterOpenMonday = 
        [
            'business_days_open' =>  [
              'Monday'
            ]
        ];
        $this->filterOpenTuesdayBy6 = 
        [
            'business_days_open' => [
                "Tuesday"
            ],
            'open_from' =>  6
        ];
        $this->filterOpenOnWednesday = 
        [
            'business_days_open' => [
                "Wednesday"
            ]
        ];
        $this->filterHouseCleaning = 
        [
            'jobs' =>  [
              'House Cleaning'
            ]
        ];
        
        $this->filteReviewMinimumOf3 = 
        [
            'review_rating' =>  3
        ];

        $this->filterNameContainsZ = 
        [
            'name_contains' => 'Z'
        ];
        
        $this->filterSortNameAsc = 
        [
            'sort_type' =>  0,
            'sort_method' =>  0
        ];

        $this->filterSortReviewDesc = 
        [
            'sort_type' =>  1,
            'sort_method' =>  1
        ];
    }
    /**
     * Test putting a new business into the database using the API.
     *
     * @return void
     */
    public function testPutInDbTest()
    {    
        echo "Adding A and Z businesses through API";    
        $response = $this->json('PUT', 'api/businesses', $this->business1); 
        $this->assertEquals(200, $response->getStatusCode());   

        $response = $this->json('PUT', 'api/businesses', $this->business2);
        $this->assertEquals(200, $response->getStatusCode());        
        
        echo "Filter: open on Monday";  
        $response = $this->json('POST', 'api/businesses', $this->filterOpenMonday);
        $response->assertJsonFragment(['businessName' => 'A Company']);
        $response->assertJsonMissing(['businessName' => 'Z Company']);

        echo "Filter: open on Tuesday by 6am";  
        $response = $this->json('POST', 'api/businesses', $this->filterOpenTuesdayBy6);
        $response->assertJsonFragment(['businessName' => 'A Company']);
        $response->assertJsonMissing(['businessName' => 'Z Company']);

        echo "Filter: open on Wednesday";  
        $response = $this->json('POST', 'api/businesses', $this->filterOpenOnWednesday);
        $response->assertJsonFragment(['businessName' => 'Z Company']);
        $response->assertJsonMissing(['businessName' => 'A Company']);
        
        echo "Filter: performs house  cleaning";  
        $response = $this->json('POST', 'api/businesses', $this->filterHouseCleaning);
        $response->assertJsonFragment(['businessName' => 'Z Company']);
        $response->assertJsonMissing(['businessName' => 'A Company']);
        
        echo "Filter: minimum review of 3";  
        $response = $this->json('POST', 'api/businesses', $this->filteReviewMinimumOf3);
        $response->assertJsonFragment(['businessName' => 'Z Company']);
        $response->assertJsonMissing(['businessName' => 'A Company']);
        
        echo "Filter: business name contains 'Z'";  
        $response = $this->json('POST', 'api/businesses', $this->filterNameContainsZ);
        $response->assertJsonFragment(['businessName' => 'Z Company']);
        $response->assertJsonMissing(['businessName' => 'A Company']);
        
        echo "Filter: sort business name ascending";  
        $response = $this->json('POST', 'api/businesses', $this->filterSortNameAsc);
        $this->assertEquals(head($response->decodeResponseJson())['businessName'], 'A Company');
        
        echo "Filter: review rating descending";  
        $response = $this->json('POST', 'api/businesses', $this->filterSortReviewDesc);
        $this->assertEquals(head($response->decodeResponseJson())['businessName'], 'Z Company');
    }

}
