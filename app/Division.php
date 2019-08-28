<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    //

    public $fillable=[
        'name',
        'priority'
    ];

    public function districts()  {
        return $this->hasMany(District::class);
    }
}
