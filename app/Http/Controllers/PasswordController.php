<?php

namespace App\Http\Controllers;
use Ramsey\Uuid\Uuid;
use App\ForgotPassword;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(){}

    public function forgotpassword( Request $request)
    {
        //
        $phone = request()->input('phone');

        if(count($users = DB::table('users')->where('phone',$phone)->get())!==0){

            $code=rand(10000,99999);
            $refrenceId=Uuid::uuid4();
             $forgotpass=new ForgotPassword();
             $forgotpass->code=$code;
             $forgotpass->refrenceid=$refrenceId;
             $forgotpass->save();
            $response=[
              'msg'=>'code has been sent to your phone',
              'refreneceId'=>$refrenceId,
              'code'=>$code,
              'type'=>'SMS'
             ];
             
             }

             else {
                $response=[
                    'msg'=>' invalid phone number or not found',
                   ];  
             }
             return response()->json($response,200);
        }
        
        public function verify( Request $request)
    {
        //
        $code = request()->input('code');
        $refrenceId = request()->input('refrenceId');

        if(count($users = DB::table('forgot_passwords')->where('code',$code)->where('refrenceId',$refrenceId)->get())!==0){
            $response=[
              'msg'=>'code has been verified successfully',
              'refreneceId'=>$refrenceId,
              'type'=>'SMS'
             ];
            }
            else {
                $response=[
                    'msg'=>'invalid or not found code',
                    'type'=>'SMS'
                   ]; 
            }
             return response()->json($response,200);
        }

    public function changepassword( Request $request)
    {
        $newpass = request()->input('newpass');
        $confnewpass = request()->input('confnewpass');
        $refrenceId = request()->input('refrenceId');
        $phone = request()->input('phone');


if($newpass!==$confnewpass){ 
      $response=[
    'msg'=>'not match passwords',
   ];
   return response()->json($response,200);

}
        if(count($validinfo = DB::table('forgot_passwords')->where('refrenceId',$refrenceId)->get())!==0){
            DB::table('users')->where('phone',$phone)->update(['password' => bcrypt($newpass)]);


            $response=[
              'msg'=>'password changed succesfully'
                         ];
            }
            else {
                $response=[
                    'msg'=>'you are not allowed to change password',
                   ];
            }
        
            return response()->json($response,200);
  
    }
    
}
