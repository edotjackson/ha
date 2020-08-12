<?php
//New Code .edj
namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $hidden = ['id'];    
    protected $table = 'addresses';
    public $timestamps = false;
}
