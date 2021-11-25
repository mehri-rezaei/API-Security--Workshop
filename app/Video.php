<?php

namespace App;
use App\Http\controllers\AuthController;
use Illuminate\Http\Request;
use App\Channel;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['name', 'director', 'year','genre','url','trailer'];
    protected $primaryKey = 'video_id';
    public $incrementing = false;
    
    public function users(){
        return $this->belongsTo('App\User');
    }
    public function channel(){
        return $this->belongsTo('App\Channel');
    }
    public static function create(Request $request, Channel $channel){
        
        $name=$request->input('name');
        $director=$request->input('director');

        $year=$request->input('year');

        $genre=$request->input('genre');
       

$video=new Video();
$video->name=$name;
$video->director=$director;
$video->year=$year;
$video->genre=$genre;
$video->video_id=round(microtime(true) * 1000);
$video->channel_id=$channel->channel_id;
$video->user_id=AuthController::getAuthenticatedUser()->user_id;
$video->save();
return $video;

   }
}
