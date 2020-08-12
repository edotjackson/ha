<?php
//New Code .edj


namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $hidden = ['id', 'business_id'];
    protected $table = 'reviews';
    public $timestamps = false;

    public function business()
    {
      return $this->belongsTo(Business::class);
    }
}
