<?php
//New Code .edj


namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $hidden = ['id'];
    protected $table = 'cities';
    public $timestamps = false;

    public function operatingCities()
    {
      return $this->hasMany(OperatingCity::class);
    }
}