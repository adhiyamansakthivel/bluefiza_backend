<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlSubCategory;
use App\Models\BlCategory;

class SubCategoryController extends Controller
{
   

    public function ShowsubCategory()
    {
        
       
        return view('subcategory.manage-sub-category');

    }
}
