<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Trait\CartTrait;
use Illuminate\Http\Request;

class HeaderComponentController extends Controller
{
    public function index(){
        try {
            $category = Category::Active()->select('name_en as name','slug','icon')->get();
            $Api = [
                'Category' => $category,
            ];
            return   Api_response('',200,$Api);
        } catch (\Throwable $th) {
            return   Api_response('',200,$th);
        }
    }
}
