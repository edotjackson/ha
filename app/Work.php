<?php
//New Code .edj


namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $hidden = ['id'];
    protected $table = 'work';
    public $timestamps = false;

    public function workTypes()
    {
      return $this->hasMany(WorkType::class);
    }
}