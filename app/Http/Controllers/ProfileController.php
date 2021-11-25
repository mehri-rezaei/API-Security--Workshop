<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
//use Badcow\DNS\Rdata\Factory;
//use Badcow\DNS\ResourceRecord;
//use Badcow\DNS\Zone;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function __invoke()
    {

    }
    

    
 public function show($id) {
  $phone = request()->input('phone');
    
$users = DB::table('users')->addSelect('phone->$_GET["phone"]');

$response=[
           'msg'=>'user info',
          'users'=>$users
        ];
        return response()->json($response,200);
 
}
   
public function getchannel(Request $request){
  if(! $user =AuthController::getAuthenticatedUser()){
    return response()->json(['msg'=>'user not found']);
}
$channels=$user->channels()->get();
$response=[
'msg'=>'all channels belongs to user ',
'channels'=>$channels
]; 
return response()->json($response,200);
}

public function getuser(Request $request){
  if(! $user =AuthController::getAuthenticatedUser()){
    return response()->json(['msg'=>'user not found']);
}

$response=[
'msg'=>'all channels belongs to user ',
'channels'=>$user
]; 
return response()->json($response,200);
}

    
public function edit(Request $request){

  if(! $user =AuthController::getAuthenticatedUser()){
          return response()->json(['msg'=>'user not found']);
       }
       $user->update($request->all());


       $response=[
          'msg'=>'user updated ' ];
        
       
        return response()->json($response,200);

}
}
