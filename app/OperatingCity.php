<?php
//New Code .edj


namespace App;

use Illuminate\Database\Eloquent\Model;

class OperatingCity extends Model
{
    protected $hidden = ['id', 'business_id'];
    protected $table = 'operatingCities';
    public $timestamps = false;

    public function city()
    {
      return $this->belongsTo(City::class);
    }

    public function business()
    {
      return $this->belongsTo(Business::class);
    }
}