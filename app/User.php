<?php

namespace App;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Ramsey\Uuid\Uuid;
use App\Observers\HashIdObserver;


class User extends Authenticatable implements JWTSubject
{

    use Notifiable;
    public $incrementing = false;
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
 
   
  
    protected $fillable = [
        'name', 'email', 'password','phone','twofactor','creditcard','balance'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    

    public function videos(){
        return $this->hasMany('App\Video','user_id', 'user_id');
    }
    public function profile(){
        return $this->hasOne('App\Profile','user_id', 'user_id');
    }
    public function channels(){
        return $this->hasMany('App\Channel','user_id', 'user_id');
    }

    public static function create(Request $request){
        
        $name=$request->input('name');
        $email=$request->input('email');

        $password=$request->input('password');

        $phone=$request->input('phone');
        

$user=new User();
$user->name=$name;
$user->email=$email;
$user->phone=$phone;
$user->password=bcrypt($password);
$user->user_id=Uuid::uuid4()->toString();
$user->twofactor=false;
$user->balance=0;
$user->save();
return $user;
}

public function getJWTIdentifier()
        {
            return $this->getKey();
        }
        public function getJWTCustomClaims()
        {
            return [];
        }
        
}
