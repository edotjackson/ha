<?php
//New Code .edj


use Illuminate\Database\Seeder;

use App\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('cities')->insert([
          'name' => 'Arvada',
          'lat' => 39.818294,
          'lon' => -105.132772,
        ]);
        DB::table('cities')->insert([
          'name' => 'Centennial',
          'lat' => 39.591281,
          'lon' => -104.850741,
        ]);
        DB::table('cities')->insert([
          'name' => 'Commerce City',
          'lat' => 39.819307,
          'lon' => -104.916390,
        ]);
        DB::table('cities')->insert([
          'name' => 'Denver',
          'lat' => 39.731526,
          'lon' => -104.964996,
        ]);
        DB::table('cities')->insert([
          'name' => 'Golden',
          'lat' => 39.744641,
          'lon' => -105.217016,
        ]);
        DB::table('cities')->insert([
          'name' => 'Henderson',
          'lat' => 39.920282,
          'lon' => -104.866677,
        ]);
        DB::table('cities')->insert([
          'name' => 'Lakewood',
          'lat' => 39.698269,
          'lon' => -105.112848,
        ]);
        DB::table('cities')->insert([
          'name' => 'Northglenn',
          'lat' => 39.896017,
          'lon' => -104.985162,
        ]);
        DB::table('cities')->insert([
          'name' => 'Parker',
          'lat' => 39.515161,
          'lon' => -104.778440,
        ]);
        DB::table('cities')->insert([
          'name' => 'Thornton',
          'lat' => 39.913798,
          'lon' => -104.944653,
        ]);

        // Add 100 more random cities
        factory(App\City::class, 100)->create();
    }
}
