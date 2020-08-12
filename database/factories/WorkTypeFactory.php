<?php
//New Code .edj


use App\WorkType;
use App\Work;
use Faker\Generator as Faker;

$factory->define(App\WorkType::class, function (Faker $faker) {
$workTypes = Work::select('*')->get();
$workIds = WorkType::select('*')->get(['work_id'])->toArray();;
$id = $faker->numberBetween(0, $workTypes->count() - 1);
while(in_array($id, $workIds))
{
    $id = $faker->numberBetween(0, $workTypes->count() - 1);
}
    return [
        //Fake work ids
        'work_id' =>  $workTypes[$id]->id,
    ];
});
