<?php
//New Code .edj


use Illuminate\Database\Seeder;
use App\Address;
use App\Business;
use App\Day;
use App\City;
use App\WorkType;
use App\Work;
use App\OperatingCity;
use App\BusinessHour;
use App\Review;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = Day::select('*')->get();
        $cities = City::select('*')->get();
        $faker = Faker\Factory::create();

        echo "Generating Businesses\n";
        factory(Business::class, 200)->make()->each(function($business) use($days, $cities) {
          $business->address_id = factory(Address::class)->create()->id;
          $business->save();


          //Work types
          echo "Business id: " . $business->id . " - Generating Work Types -> ";
          $workTypes = Work::select('*')->get();
          $ids = WorkType::where('business_id', $business->id)->pluck('work_id')->toArray();
          $id = 0; 
          for($i = 0; $i < rand(1, $workTypes->count() - 1); $i++)
          {
            while(in_array($id, $ids))
            {
                $id = rand(0, $workTypes->count() - 1);
            }
            array_push($ids, $id);
            $workType = new WorkType();
            $workType->business_id = $business->id;
            $workType->work_id = $workTypes[$id]->id;
            $workType->save();
          }

          
          
          //Business hours
          echo " Business hours -> ";
          for($i = rand(0,3); $i < rand(4,7); $i++)
          {
            $hour = new BusinessHour();
            $hour->business_id = $business->id;
            $hour->day_id = $days[$i]->id;
            $hour->openTime = rand(6,10);
            $hour->closeTime = rand(16,21);
            $hour->save();
          }

          //Operating cities
          echo "Cities ->";
          for($i=0; $i<rand(3,10); $i++)
          {
            $operatingCity = new OperatingCity();
            $operatingCity->business_id = $business->id;
            $operatingCity->city_id = $cities[rand($i, $cities->count()-1)]->id;
            $operatingCity->save();
          }   

          //Reviews
          echo "Reviews\n";
          factory(Review::class, rand(1, 7))->create(['business_id' => $business->id]);
  
        });
        echo "Created ".Business::count()." businesses\n";
    }
}
