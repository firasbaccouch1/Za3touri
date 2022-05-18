<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Users\Countries;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function index(){
       $countries =  Countries::ApiSelection()->get();
        $api = [
            'countries' => $countries,
        ];
        return Api_response('success',200,$api);
    }
}
