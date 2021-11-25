<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\User;
use App\File;
use Symfony\Component\HttpFoundation\Response;
use Ramsey\Uuid\Uuid;
//https://en.wikipedia.org/wiki/Magic_number_(programming)
// public/storage to storage/app/public
//fZ5FoxCjpr3DiBkrIiZrKtcp9jbQXBQSR3TH9Xtk
//P8sAJu4FzBRqb8esB4o58IWXLouEnV9M4ic0ayXA
//use OneOffTech\TusUpload\Tus;

//use Badcow\DNS\Rdata\Factory;
//use Badcow\DNS\ResourceRecord;
//use Badcow\DNS\Zone;
//use Illuminate\Support\Facades\DB;
//use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Storage;

class FController extends Controller
{
    

    public function __invoke()
    {

    }
    
public function index(){
    //return view('uploadfile');
}

//blacklist execution file tye
public function logouploadv1(Request $request){
    if(! $user =AuthController::getAuthenticatedUser()){
        return response()->json(['msg'=>'user not found']);
    }
    $file = $request->file('logo');
    $orig= $file->getClientOriginalName();
    $origexten=$file->getClientOriginalExtension();
    $realpath=$file->getRealPath();
    $size=$file->getsize();
    $mimetype=$file->getMimeType();
    $extension=$file->extension();
      //$/i
      if(preg_match('^.*\.(php|php1|php2|php3|php4|php5|php6|php7|phtml|html)$',$origexten)){
        $response=[
            'msg'=>'error file type, too bad guy'];

             return response()->json($response,422);
    }
  
}

//check file extention
public function logouploadv2(Request $request){
    //.jpg.php
    if(! $user =AuthController::getAuthenticatedUser()){
        return response()->json(['msg'=>'user not found']);
    }

    $file = $request->file('logo');
    $orig= $file->getClientOriginalName();
    $origexten=$file->getClientOriginalExtension();
    $realpath=$file->getRealPath();
    $size=$file->getsize();
    $mimetype=$file->getMimeType();
    $extension=$file->extension();

    $except=array('png','gif','jpg');
    $imp=implode('|'.$except);
    if(preg_match('^.*\('.$imp.')',$file)){
        $response=[
            'msg'=>'error file type, oh bad guy'];

             return response()->json($response,422);

    }
}
//file extention prevent double extension
public function logouploadv3(Request $request){
    if(! $user =AuthController::getAuthenticatedUser()){
        return response()->json(['msg'=>'user not found']);
    }
    $file = $request->file('logo');
    $orig= $file->getClientOriginalName();
    $origexten=$file->getClientOriginalExtension();
    $realpath=$file->getRealPath();
    $size=$file->getsize();
    $mimetype=$file->getMimeType();
    $extension=$file->extension();
      //$/i
      $except=array('png','jpg');
    $imp=implode('|'.$except);
        if(preg_match('^.*\(jpg|png)$\i',$origexten)){
        $response=[
            'msg'=>'error file type,  very bad guy'];

             return response()->json($response,422);

    }
}
    //check mime tye
public function logouploadv4(Request $request){
    if(! $user =AuthController::getAuthenticatedUser()){
        return response()->json(['msg'=>'user not found']);
    }
    $file = $request->file('logo');
    $orig= $file->getClientOriginalName();
    $origexten=$file->getClientOriginalExtension();
    $realpath=$file->getRealPath();
    $size=$file->getsize();
    $mimetype=$file->getMimeType();
    $extension=$file->extension();  
    if (!in_array($mimeType, $image_mime_type)) {
        $response=[
            'msg'=>'error mime type'];

             return response()->json($response,422);

    }

}

//check mime tye and file extention
public function logouploadv5(Request $request){

   $image_mime_type=[ 'image/png','image/jpeg'];
    if(! $user =AuthController::getAuthenticatedUser()){
        return response()->json(['msg'=>'user not found']);
    }
    $file = $request->file('logo');
    $orig= $file->getClientOriginalName();
    $origexten=$file->getClientOriginalExtension();
    $realpath=$file->getRealPath();
    $size=$file->getsize();
    $mimetype=$file->getMimeType();
    $extension=$file->extension(); 
    if(preg_match('^.*\(jpg|png)$\i',$origexten)){
        $response=[
            'msg'=>'error file type'];

             return response()->json($response,422);

    }
    if (!in_array($mimeType, $image_mime_type)) {
        $response=[
            'msg'=>'error mime type'];

             return response()->json($response,422);

    }

}
    //upload svg images which are just xml data
    public function logouploadv6(Request $request){
        if(! $user =AuthController::getAuthenticatedUser()){
            return response()->json(['msg'=>'user not found']);
        }
        $file = $request->file('logo');
        $orig= $file->getClientOriginalName();
        $origexten=$file->getClientOriginalExtension();
        $realpath=$file->getRealPath();
        $size=$file->getsize();
        $mimetype=$file->getMimeType();
        $extension=$file->extension();
          //$/i
          $except=array('png','jpg');
        $imp=implode('|'.$except);
            if(preg_match('^.*\(jpg|png)$\i',$origexten)){
            $response=[
                'msg'=>'improper file type'];
    
                 return response()->json($response,422);
    
        }
} 
//Image Tragic Attack SSRF and RCE, facebook
public function logouploadv7(Request $request){

   //$videoextensions = ['.mp4','.mp3', '.avi', '.m4v', '.3gp', '.m4a'];
   // $imageextensions = ['.png', '.gif','.jpeg', '.tiff', '.psd', '.pdf','.ai'];
  //$video_mime_type=['video/mp4', 'video/avi', 'video/x-m4v', 'video/3gpp'];
    //$image_mime_type=[ 'image/png','image/jpeg'];
    if(! $user =AuthController::getAuthenticatedUser()){
        return response()->json(['msg'=>'user not found']);
    }
    $file = $request->file('logo');
    $orig= $file->getClientOriginalName();
    $origexten=$file->getClientOriginalExtension();
    $realpath=$file->getRealPath();
    $size=$file->getsize();
    $mimetype=$file->getMimeType();
    $extension=$file->extension();
      //$/i
      $except=array('png','jpg');
    $imp=implode('|'.$except);
        if(preg_match('^.*\(jpg|png)$\i',$origexten)){
        $response=[
            'msg'=>'improper file type'];

             return response()->json($response,422);

    }
} 
//cross domain Content Hijacking
public function logouploadv8(Request $request){
    if(! $user =AuthController::getAuthenticatedUser()){
        return response()->json(['msg'=>'user not found']);
    }
    $file = $request->file('logo');
    $orig= $file->getClientOriginalName();
    $origexten=$file->getClientOriginalExtension();
    $realpath=$file->getRealPath();
    $size=$file->getsize();
    $mimetype=$file->getMimeType();
    $extension=$file->extension();
      //$/i
      $except=array('png','jpg');
    $imp=implode('|'.$except);
        if(preg_match('^.*\(jpg|png)$\i',$origexten)){
        $response=[
            'msg'=>'improper file type'];

             return response()->json($response,422);

    }
} 


// video upload ffmeg ssrf
public function traileruploadv1(Request $request){

   //$videoextensions = ['.mp4','.mp3', '.avi', '.m4v', '.3gp', '.m4a'];
   //$imageextensions = ['.png', '.gif','.jpeg', '.tiff', '.psd', '.pdf','.ai'];
 $video_mime_type=['video/mp4', 'video/avi', 'video/x-m4v', 'video/3gpp'];
   //$image_mime_type=[ 'image/png','image/jpeg'];
   // if(! $user =AuthController::getAuthenticatedUser()){
     //   return response()->json(['msg'=>'user not found']);
    //}
    $file = $request->file('trailer');
    $orig= $file->getClientOriginalName();
    $origexten=$file->getClientOriginalExtension();
    $realpath=$file->getRealPath();
    $size=$file->getsize();
    $mimetype=$file->getMimeType();
    $extension=$file->extension();
        if(!preg_match('^.*\(mp4|mp3|avi|m4v|3gp|m4a)$\i',$origexten)){
        $response=[
            'msg'=>'error file type'];

             return response()->json($response,422);
    }
    if (!in_array($mimeType, $video_mime_type)) {
        $response=[
            'msg'=>'error mime type'];

             return response()->json($response,422);
    }
   // $ffmpeg = FFMpeg\FFMpeg::create();
    $path= $file->storeAs('/public/videos', $file);

    //$video = $ffmpeg->open($path);
    //$video->filters()->resize(new FFMpeg\Coordinate\Dimension(320, 240))->synchronize();

    $response=[
    
        'msg'=>' video file saved',
        'path'=>$path
    ];

         return response()->json($response,200);

}

}