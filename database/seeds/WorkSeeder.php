<?php
//New Code .edj


use Illuminate\Database\Seeder;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('work')->insert(['name' => 'Maid Service']);
      DB::table('work')->insert(['name' => 'House Cleaning']);
      DB::table('work')->insert(['name' => 'Moving Services']);
      DB::table('work')->insert(['name' => 'Packing']);
      DB::table('work')->insert(['name' => 'Plumbing']);
      DB::table('work')->insert(['name' => 'Demo']);
      DB::table('work')->insert(['name' => 'Roofing']);
      DB::table('work')->insert(['name' => 'Drywall']);
    }
}
