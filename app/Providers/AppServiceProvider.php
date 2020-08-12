<?php
//New Code .edj
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('>=', function($attribute, $value, $params, $validator) {
            $field = $params[0];
            $data = $validator->getData();
            return !array_key_exists($field, $data) || $value >= $data[$field];
          });   
      
          Validator::replacer('>=', function($message, $attribute, $rule, $parameters) {
            return ucfirst($attribute) . ' must be greater than or equal to: '. $parameters[0] . '.';
          });

          Validator::extend('<=', function($attribute, $value, $params, $validator) {
            $field = $params[0];
            $data = $validator->getData();
            return !array_key_exists($field, $data) || $value <= $data[$field];
          });   
      
          Validator::replacer('<=', function($message, $attribute, $rule, $parameters) {
            return ucfirst($attribute) . ' must be less than or equal to: '. $parameters[0] . '.';
          });

          Validator::extend('>', function($attribute, $value, $params, $validator) {
            $field = $params[0];
            $data = $validator->getData();
            return !array_key_exists($field, $data) || $value > $data[$field];
          });   
      
          Validator::replacer('>', function($message, $attribute, $rule, $parameters) {
            return ucfirst($attribute) . ' must be grater than: '. $parameters[0] . '.';
          });
          
          Validator::extend('<', function($attribute, $value, $params, $validator) {
            $field = $params[0];
            $data = $validator->getData();
            return !array_key_exists($field, $data) || $value < $data[$field];
          });   
      
          Validator::replacer('<', function($message, $attribute, $rule, $parameters) {
            return ucfirst($attribute) . ' must be less than: '. $parameters[0] . '.';
          });

          //Case insensitive inside array of values
          Validator::extend('iin', function($attribute, $value, $params, $validator) {
            return is_string($value) && in_array(ucfirst(strtolower($value)), $params);
          }); 
          
          Validator::replacer('iin', function($message, $attribute, $rule, $parameters) {
            return 'All elements must be within the following list: ['. implode("|",$parameters) . '].';
          });
    }
}
