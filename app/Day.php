<?php
//New Code .edj


namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $hidden = ['id'];
    protected $table = 'days';
    public $timestamps = false;

    public function businessHours()
    {
      return $this->hasMany(BusinessHour::class);
    }
}