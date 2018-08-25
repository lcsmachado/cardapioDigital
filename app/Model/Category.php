<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name','deleted'
    ];

    public  $rules =  [
        'name'     => 'required|min:3|max:45'
    ];
}
