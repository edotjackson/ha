<?php
//New Code .edj
namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;

class Inside implements Rule
{
    public $list;
    public $suffix;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($list = null, $suffix = null)
    {
        $this->list = $list;
        $this->suffix = $suffix;
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
        return is_string($value) && $this->list->contains(ucwords(strtolower($value)));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Must be within the list of available ' . $this->suffix;
    }
}