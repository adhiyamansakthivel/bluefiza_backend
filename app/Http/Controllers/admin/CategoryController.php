<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlPosts;
use App\Models\BlCategory;

class CategoryController extends Controller
{
    public function ShowCategory()
    {
       
        return view('category.manage-category');

    }

    public function apiCate()
    {
        $bCate = BlCategory::join('bl_navigations','bl_navigations.id', 'blcnav_id')
        ->with(['posts' => function($query)  {
            $query->join('bl_categories', 'bl_categories.id', 'blpcat_id')
            ->where('blp_active','true')
            ->select('bl_posts.id','bl_posts.blp_key as postId', 'bl_posts.blp_image as images', 'bl_posts.blp_title as title', 'bl_posts.blp_slug as slug', 'bl_posts.blp_desc as content', 
            'bl_posts.blp_metatitle as mtitle', 'bl_posts.blp_metadesc as mdesc', 'bl_posts.blp_keywords as mkeyword', 'bl_posts.created_at as posted','bl_posts.blpcat_id',
            'bl_categories.blc_name as catName', 'bl_categories.blc_slug as catSlug', 'bl_categories.blc_key as catId','bl_categories.blc_color as catColor'
            )->orderBy('bl_posts.id');
        }])       
        ->where('blc_active','true')
        ->select('bl_categories.id','blc_key as catId', 'blc_name as catName', 'blc_slug as catSlug','blc_color as catColor' ,'bl_navigations.bln_key as navKey', 
        'bl_navigations.bln_name as navName','bl_navigations.bln_color as navColor')
        ->get();

        

        $response = [
            'success'=>true,
            'categories'=> $bCate,
        ];

        return response()->json($response, 200);

    }

    public function apiCateSlug($catkey)
    {
        $categ = BlCategory::join('bl_navigations','bl_navigations.id', 'blcnav_id')
        ->where('blc_slug', $catkey)
        ->select('bl_categories.id','blc_key as catId', 'blc_name as catName', 'blc_slug as catSlug','blc_color as catColor' ,'bl_navigations.bln_key as navKey', 
        'bl_navigations.bln_name as navName','bl_navigations.bln_color as navColor')
        ->firstOrFail();
        
        $bCate =BlPosts::where('blpcat_id', $categ->id) 
        ->with('category')
        ->where('blp_active', '1')
        ->select('id','blp_key as postId', 'blp_image as images', 'blp_title as title', 'blp_slug as slug', 'blp_desc as content', 
            'blp_metatitle as mtitle', 'blp_metadesc as mdesc', 'blp_keywords as mkeyword', 'created_at as posted','blpcat_id', 'created_at as date')
        ->orderBy('id', 'desc')
        ->get();
        

        $response = [
            'success'=>true,
            'category'=>$categ,
            'posts'=> $bCate
        ];

        return response()->json($response, 200);

    }



}
