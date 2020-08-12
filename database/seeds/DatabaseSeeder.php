<?php
//New Code .edj


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();        
        DB::disableQueryLog();

        // ********* Seed the days *********
        echo "Seeding days\n";
        $this->call(DaySeeder::class);

        // ********* Seed the cities *********
        echo "Seeding cities\n";
        $this->call(CitySeeder::class);

        // ********* Seed the work types *********
        echo "Seeding work types\n";
        $this->call(WorkSeeder::class);

        // ********* Seed the Relationships *********
        echo "Seeding businesses\n";
        $this->call(BusinessSeeder::class);

        DB::enableQueryLog();
        Model::reguard();
    }
}