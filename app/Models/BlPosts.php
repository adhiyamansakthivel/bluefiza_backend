<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlCategory;
use App\Models\BlSubCategory;

class BlPosts extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $guarded = ['id', 'blp_key'];

    protected $hidden = [
        'id', 
        'blpcat_id', 
        'blpusr_id',
        'blpscat_id'
    ];


    public function category()
    {
        return $this->belongsTo(BlCategory::class, 'blpcat_id', 'id')
        ->join('bl_navigations','bl_navigations.id', 'blcnav_id')
        ->where('blc_active','1')
        ->select('bl_categories.id','bl_categories.blc_key as catId', 
        'bl_categories.blc_name as catName', 'bl_categories.blc_slug as catSlug', 
        'bl_categories.blc_color as catColor', 'bl_navigations.bln_name as navName', 'bl_navigations.bln_color as navColor' );
    }

    public function subCategory()
    {
        return $this->belongsTo(BlSubCategory::class, 'blpscat_id', 'id')
       
        ->where('blcs_active','1')
        ->select('id','blcs_key as scatId', 'blcs_name as scatName', 'blcs_slug as scatSlug');
    }
}
