<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlNavigation;
use App\Models\BlCategory;

class NavigationController extends Controller
{
    public function ShowNavigation()
    {
       
        return view('navigation.manage-navigation');

    }


    public function ShowNavCategory($navkey)
    {
       
        return view('navigation.manage-nav-categories', compact('navkey'));

    }

    public function apiNavigations()
    {
       
        $navi = BlNavigation::with('categories')
        ->select('id', 'bln_key as navKey', 'bln_name as navName', 'bln_slug as navSlug')
        ->orderBy('id', 'asc')
        ->get();
        
        $response = [
            'success'=>true,
            'navigations'=> $navi,
        ];

        return response()->json($response, 200);

    }

    // public function apiNavigations()
    // {
       
    //     $navi = BlNavigation::with(['categories' => function($query)  {
    //         $query->where('blc_active','true')
    //         ->select('blc_key as catId', 'blc_name as catName', 'blc_slug as catSlug', 'blcnav_id');
    //     }])
    //     ->select('id', 'bln_key as navKey', 'bln_name as navName', 'bln_slug as navSlug')
    //     ->orderBy('id', 'asc')
    //     ->get()->toArray();
        
    //     $response = [
    //         'success'=>true,
    //         'navigations'=> $navi,
    //     ];

    //     return response()->json($response, 200);

    // }
}
