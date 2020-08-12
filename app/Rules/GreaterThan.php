<?php
//New Code .edj
namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;

class GreaterThan implements Rule
{
    public $minValue;
    public $equalTo;
    public $offsetLeft;
    public $offsetRight;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($min = null, $equalTo = false, $offsetLeft = 0, $offsetRight = 0)
    {
        $this->minValue = $min;
        $this->equalTo = $equalTo;
        $this->offsetLeft = $offsetLeft;
        $this->offsetRight = $offsetRight;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $parse = explode('.', $attribute);
        $parse[2] = explode('.', $this->minValue)[2];
        $val = request()->input(implode('.', $parse));
        if(!is_numeric($val) || !is_numeric($value))
        {
            return false;
        }
        return $this->equalTo ?  
        ($value + $this->offsetLeft) >= ($val + $this->offsetRight) : 
        ($value + $this->offsetLeft) > ($val + $this->offsetRight) ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Must be greater than '. ($this->equalTo ? 'or equal to ' : '') . $this->minValue;
    }
}