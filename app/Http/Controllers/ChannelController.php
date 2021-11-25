<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;
use App\User;
use App\subscribes;
use App\Http\Requests\ChannelUpdateRequest;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use App\Http\Resources\ChannelResource;


class ChannelController extends Controller
{
    
    public function __construct(){

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $channels=Channel::all();
        $response=[
            'msg'=>'list of all channels',
            'channels'=>$channels
       ];
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
    public function store(Request $request)
    {

    $channel=Channel::create($request);
   
$response=[
    'msg'=>'channel created',
    'channel'=>$channel
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
$channel = Channel::findOrFail($id);

$response=[
            'msg'=>'channel found',
            'channels'=>$channel
        ];

        return ChannelResource::collection($channels);
               // return response()->json($response,200);
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
    public function update(Request $request,Channel $channel )
    {
        if(! $user =AuthController::getAuthenticatedUser()){
            return response()->json(['msg'=>'user not found']);
         }
     $channel->update($request->all());
       $response=[
         'msg'=>'channel updated',
         'channel'=>$channel
        ];
      
          return response()->json($response,200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function destroy(Channel $channel)
    {
        
        if(! $user =AuthController::getAuthenticatedUser()){
          return response()->json(['msg'=>'user not found']);
       }
 if (count($user->channels()->where('channel_id',$channel->channel_id)->get())!==0)
{
   $channel->delete();
     $response=[
       'msg'=>'channel found and deleted'
      ];
     }
   else {
    $response=[
      'msg'=>'channel not found ' ];
    
    }
    
        return response()->json($response,200);
    }

    
    public function subscribes(Channel $channel, Request $request){

      //$subscribe = filter_var($request->get('enabled'), FILTER_VALIDATE_BOOLEAN);

     // $subscribe = $subscribe ? 'on' : 'off';
     if(! $user =AuthController::getAuthenticatedUser()){
      return response()->json(['msg'=>'user not found']);
   }

   if(count(DB::table('subscribes')->
   where([
    ['user_id', $user->user_id],
    ['channel_id',$channel->channel_id]
])->get())!==0){
  abort(204);
}
else{

  $subscribes=new subscribes();
  $subscribes->user_id=$user->user_id;
  $subscribes->channel_id=$channel->channel_id;
$subscribes->save();
           $channel->subscribes=$channel->subscribes+1;
           $response=[
            'msg'=>' subscribed  successfully ' ];
          
          
          
              return response()->json($response,200);

}


    }

    public function unsubscribes(Channel $channel, Request $request){

    
     if(! $user =AuthController::getAuthenticatedUser()){
      return response()->json(['msg'=>'user not found']);
   }
   if(count(DB::table('subscribes')->
   where([
    ['user_id', $user->user_id],
    ['channel_id',$channel->channel_id]
])->get())==0){
  abort(204);
}
else {
  $sub=DB::table('subscribes')->
   where([
    ['user_id', $user->user_id],
    ['channel_id',$channel->channel_id]
]);
 $sub->delete();
  $channel->subscribes=$channel->subscribes-1;
  $response=[
    'msg'=>' unsubscribed successfully',
  //'sub'=>$subscribe
 ];
  
  
      return response()->json($response,200);

}

    }
}
