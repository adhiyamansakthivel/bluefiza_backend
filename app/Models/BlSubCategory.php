<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlCategory;

class BlSubCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $hidden = [
        'id', 'blcscat_id'
    ];

    public function category()
    {
        return $this->belongsTo(BlCategory::class, 'blcscat_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany(
            BlPosts::class,
            'blpcat_id',
            'id'
        )
       ;
    }
}
