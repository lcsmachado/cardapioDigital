<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $fillable = [
        'name', 'email', 'password', 'deleted', 'status', 'secret_question', 'secret_answer',2
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rules() {return[
        'name'     => 'required|min:3|max:100',
        'email' => 'required|email|unique:admins,email,'. $this->id.',id',
        'password' => 'required|min:6|confirmed',
        'secret_question' =>'required',
        'secret_answer'   =>'required|min:6|max:30'
    ];}
    public function rulesReset() {return[
        'password' => 'required|min:6|confirmed',
    ];}
}
