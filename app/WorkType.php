<?php
//New Code .edj


namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkType extends Model
{
    protected $hidden = ['id'];
    protected $table = 'workTypes';
    public $timestamps = false;

    public function business()
    {
      return $this->belongsTo(Business::class);
    }
}