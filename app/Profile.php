<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $primaryKey = 'profile_id';

    public function user(){
        $this->belongTo('App\User');
    }   
}
