<?php

namespace App;
use Illuminate\Http\Request;
use App\Http\controllers\AuthController;
use App\User;
use App\Video;
use Ramsey\Uuid\Uuid;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['name', 'description','subscribers'];
    protected $primaryKey = 'channel_id';
    public $incrementing = false;

    public function users(){
        return $this->belongsTo('App\User','channel_id','channel_id');
    }
    public function videos(){
        return $this->hasMany('App\Video','channel_id','channel_id');
    }
    


    public static function create(Request $request){
        
$name=$request->input('name');
$description=$request->input('description');

$channel=new Channel();
$channel->name=$name;
$channel->description=$description;
$channel->subscribers=0;
$channel->channel_id=Uuid::uuid1()->toString();
$channel->user_id=AuthController::getAuthenticatedUser()->user_id;
$channel->save();
return $channel;

   }
}
