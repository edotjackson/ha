<?php
//New Code .edj
namespace App\Http\Controllers;


class ApiController extends Controller
{
    // ******************************* API Methods ********************************

    public function showApi($version)
    {
        return view('api_'. strtoupper($version));
    }

}