<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\User;
use App\Channel;

class VideoController extends Controller
{
    
    public function __construct(){
       // $this->middleware('jwt.auth',['only'=>['update','store','destroy'
      //  ]]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel)
    {

        if(! $user=AuthController::getAuthenticatedUser()){
            return response()->json(['msg'=>'user not found']);
        }
      // if(count($user->channels()->where('channel_id',$channel->channel_id)->get())!==0)
       //{
           $allvideos=$channel->videos()->get();
           $response=[
            'msg'=>'list of all videos belongs to this channel',
            'videos'=>$allvideos
       ];

      // }

//else 
//{
    //$response=[
      //  'msg'=>'no videos'
   //];

//}   
        return response()->json($response,200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request, Channel $channel)
    {

    $video=Video::create($request,$channel);
   
$response=[
    'msg'=>'video created',
    'video'=>$video
];
        
       return response()->json($response,200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    {
        //
$video = Video::findOrFail($id);
$response=[
            'msg'=>'video found',
            'videos'=>$video
        ];
                
                return response()->json($response,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, Video $video)
    {
        //

       /* $name=$request->input('name');
        $director=$request->input('director');

        $year=$request->input('year');

        $genre=$request->input('genre');
        $channel_id=$request->input('channel_id');

$video->name=$name;
$video->director=$director;
$video->year=$year;
$video->genre=$genre;
$video->channel_id=$channel_id;
$video->user_id=AuthController::getAuthenticatedUser()->user_id;
*/
//$video->update($request->validated());

$genre=$request->input('genre');
$year=$request->input('year');

       $name=$request->input('name');
        $director=$request->input('director');      
        //  $channel_id=$request->input('channel_id');

$video->update($request->all());
//'name'=>$name,
////'channel_id'=> $channel_id,
//'year'=>$year,
//'director'=>$director,
//'genre'=>$genre,

//]);
$response=
['msg'=>'video updated',
'video'=>$video
];

return response()->json($response,200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy($id)
    {
        //
        
        if(! $user =AuthController::getAuthenticatedUser()){
            return response()->json(['msg'=>'user not found']);
        }
 if(empty($video=$user->videos()->where('video_id',$id))){
    $response=[
        'msg'=>'video not found'
    ]; }
    else {
       
        $video->delete();
     $response=[
       'msg'=>'video deleted vv n',
       'id'=>$id
   ];
}
    
        return response()->json($response,200);
    }
    */
     public function destroy(Video $video)
    {
        
        if(! $user =AuthController::getAuthenticatedUser()){
          return response()->json(['msg'=>'user not found']);
       }
 if (count($user->videos()->where('video_id',$video->video_id)->get())!==0)
{
   $video->delete();
     $response=[
       'msg'=>'video found and deleted'
      ];
     }
   else {
    $response=[
      'msg'=>'video not found ' ];
    
    }
    
        return response()->json($response,200);
    }

}
