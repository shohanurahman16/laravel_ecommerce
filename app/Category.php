<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $fillable=[
        'name',
        'description',
        'image',
        'parent_id'
    ];

    public function parent()  {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function products()  {
        return $this->hasMany('App\Product');
    }
}
