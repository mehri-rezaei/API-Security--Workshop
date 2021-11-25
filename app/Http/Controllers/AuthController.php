<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use App\Http\Resources\UserResource;


class AuthController extends Controller
{
    public function __invoke(){}
   
    public function register(Request $request){
           
     $this->validate($request,[
                'email'=>'required|email|unique:users',
                'password'=>'required',
                'phone'=>'required|numeric|unique:users'
               ]);
        $user=User::create($request);
        
            return response()->json(['user created'=>$user,201]);

    }


    public function login(Request $request){

       $this->validate($request,[
        'email'=>'required|email',
        'password'=>'required'
       ]);

$credentials=$request->only('email','password');
try {
if(!$token=JWTAuth::attempt($credentials)){
    return response()->json(['msg'=>'invalid credentials',401]);
}
}
catch(JWTException $e){
 return response()->json(['msg'=>' could not create token',500]);
}

return $this->respondWithToken($token);

    }



    public static function getAuthenticatedUser()
            {
                    try {

                            if (! $user = JWTAuth::parseToken()->authenticate()) {
                                    return response()->json(['user_not_found'], 404);
                            }

                    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                            return response()->json(['token_expired'], $e->getStatusCode());

                    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                            return response()->json(['token_invalid'], $e->getStatusCode());

                    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                            return response()->json(['token_absent'], $e->getStatusCode());

                    }

                    return $user;
            }

    public function getuser(Request $request){
        if(! $user =AuthController::getAuthenticatedUser()){
                return response()->json(['msg'=>'user not found']);
             }
        
             return UserResource::collection($user->get());

            // return response()->json($response,200);  

    }

    protected function respondWithToken($token)
    {
      return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        //'expires_in' => auth()->factory()->getTTL() * 60
      ]);
    }

    public function logout(){
            return response()->json(['msg'=>'log out']);
    }
    public function testphone(Request $request){

        $phone=$request->input('phone');
        if(!$phone){
                return response()->json(['msg'=>'phone  not found']);      
        }
        if(! $user =AuthController::getAuthenticatedUser()){
                return response()->json(['msg'=>'user not found']);
             }
             $user1 = DB::table('users')->where('phone',$phone)->first();
if(!$user1){
        $response=[
                'msg'=>'user not found '
             ];
             return response()->json($response,404);    
}
             if($user1!==$user){
          
        $response=[
                   'msg'=>'not found user '.$user1->user_id
                ];
                return response()->json($response,404);
    }
}
public function user(Request $request){

        $user_id=$request->input('user_id');
        $user1 = DB::table('users')->where('user_id',$user_id)->first();
        
          
        $response=[
                   'msg'=>' user found',
                   'user'=>$user1
                ];
                return response()->json($response,200);
   
}

}
