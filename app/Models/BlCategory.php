<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\BlNavigation;
use App\Models\BlPosts;

class BlCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $guarded = ['id', 'blcnav_id'];


    protected $hidden = [
        'id', 'blcnav_id'
    ];


    public function navigationBlog()
    {
        return $this->belongsTo(BlNavigation::class, 'blcnav_id', 'id');
    }


    public function posts()
    {
        return $this->hasMany(
            BlPosts::class,
            'blpcat_id',
            'id'
        ) ;
       
    }
}
