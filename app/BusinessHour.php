<?php
//New Code .edj


namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessHour extends Model
{
    protected $hidden = ['id', 'business_id', 'day_id','openTime','closeTime'];
    protected $table = 'businessHours';
    protected $appends = ['dayOfWeek','open','close'];
    public $timestamps = false;

    public function business()
    {
      return $this->belongsTo(Business::class);
    }

    public function day()
    {
      return $this->belongsTo(Day::class);
    }

    public function getOpenAttribute()
    {
      return $this->attributes['openTime'] ;
    }

    public function getCloseAttribute()
    {
      return $this->attributes['closeTime'];
    }

    public function getDayOfWeekAttribute()
    {
      return Day::find($this->attributes['day_id'])->name;
    }




}
