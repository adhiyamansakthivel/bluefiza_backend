<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlCategory;
use App\Models\BlSubCategory;

class BlNavigation extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $guarded = ['id', 'bln_key'];

    protected $hidden = [
        'id'
    ];

    

    protected $fillable = [
        'bln_name',
        'bln_slug',
        'bln_active'
    ];


    public function categories()
    {
        return $this->hasMany(BlCategory::class,'blcnav_id','id')
        ->where('bl_categories.blc_active','1')
        ->select('bl_categories.id','bl_categories.blc_key as catId', 
        'bl_categories.blc_name as catName', 'bl_categories.blc_slug as catSlug', 'bl_categories.blc_color as catColor',
        'blcnav_id')
       ;
    }

    
    public function category()
    {
        return $this->belongsTo(BlCategory::class, 'blpcat_id', 'id')
        ->where('blc_active','1')
        ->select('id','blc_key as catId', 'blc_name as catName', 'blc_slug as catSlug', 'blc_color as catColor');
    }
}
