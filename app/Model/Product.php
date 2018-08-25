<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name','price','category_id','ingredients','deleted'
    ];

    public  $rules =  [
        'name'     => 'required|min:3|max:45',
        'ingredients' => 'required|min:10|max:500',
        'price' =>'required'
    ];
}
