<?php

namespace App\Http\Controllers;
use App\Apikey;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Type\Integer;

use DateTimeInterface;
use Ramsey\Uuid\Builder\UuidBuilderInterface;
use Ramsey\Uuid\Codec\CodecInterface;
use Ramsey\Uuid\Converter\NumberConverterInterface;
use Ramsey\Uuid\Converter\TimeConverterInterface;
use Ramsey\Uuid\Generator\DceSecurityGeneratorInterface;
use Ramsey\Uuid\Generator\DefaultTimeGenerator;
use Ramsey\Uuid\Generator\NameGeneratorInterface;
use Ramsey\Uuid\Generator\RandomGeneratorInterface;
use Ramsey\Uuid\Generator\TimeGeneratorInterface;
use Ramsey\Uuid\Lazy\LazyUuidFromString;
use Ramsey\Uuid\Provider\NodeProviderInterface;
use Ramsey\Uuid\Provider\Time\FixedTimeProvider;
use Ramsey\Uuid\Type\Hexadecimal;
use Ramsey\Uuid\Type\Integer as IntegerObject;
use Ramsey\Uuid\Type\Time;
use Ramsey\Uuid\Validator\ValidatorInterface;use function bin2hex;
use function hex2bin;
use function pack;
use function str_pad;
use function strtolower;
use function substr;
use function substr_replace;
use function unpack;
#https://kruithof.dev/uuid/uuidgen
// //https://www.rapidtables.com/convert/number/hex-to-decimal.html
        //https://rpbouman.blogspot.com/2014/06/mysql-extracting-timstamp-and-mac.html?m=0
        /* $timeBasedUuid     = Uuid::uuid1();
     * $namespaceMd5Uuid  = Uuid::uuid3(Uuid::NAMESPACE_URL, 'http://php.net/');
     * $randomUuid        = Uuid::uuid4();
     * $namespaceSha1Uuid = Uuid::uuid5(Uuid::NAMESPACE_URL, 'http://php.net/');
     * */
class ّApiKeyController extends Controller
{
    public function __invoke()
    {

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function createApikeyv4(Request $request){
        if(! $user =AuthController::getAuthenticatedUser()){
            return response()->json(['msg'=>'user not found']);
         }
        $apikey=new Apikey();
        $apikey->user_id=$user->user_id;
        $apikey->name=$request->input('name');
        $apikey->type='user-v4';

        $apikey->key=Uuid::uuid4();
        $apikey->revoke=false;
        $apikey->id=Uuid::uuid4();
        $apikey->save();

    }
    public function createApikeyv3(Request $request){
        if(! $user =AuthController::getAuthenticatedUser()){
            return response()->json(['msg'=>'user not found']);
         }
         //$uuid = (string) uuid_generate_md5($ns->toString(), $name);

         $x=Uuid::uuid3(Uuid::NAMESPACE_URL,'o');
        // $st=Uuid::NAMESPACE_URL;
         //$bytes=md5('6ba7b811-9dad-11d1-80b4-00c04fd430c8'.'o');
         //$bytes = $this->nameGenerator->generate($ns, $name, $hashAlgorithm);

       // return $this->uuidFromBytesAndVersion(substr($bytes, 0, 16), $version);
   // }

         //$timeHi = (int) unpack('n*', substr($bytes, 6, 2))[1];
         //$timeHiAndVersion = pack('n*', applyVersion($timeHi, 3));
 
         //$clockSeqHi = (int) unpack('n*', substr($bytes, 8, 2))[1];
         //$clockSeqHiAndReserved = pack('n*',applyVariant($clockSeqHi));
 
         //$bytes = substr_replace($bytes, $timeHiAndVersion, 6, 2);
         //$bytes = substr_replace($bytes, $clockSeqHiAndReserved, 8, 2);

         //return $bytes;
        $apikey=new Apikey();
        $apikey->user_id=$user->user_id;
        $apikey->name=$request->input('name');
        $apikey->type='user-v3';
        $apikey->key=$x;
        $apikey->revoke=false;
        $apikey->id=Uuid::uuid4();
        $apikey->save();
        $response=[
            'uuid'=>$x,
           // 'time'=>$x->getTimestamp(),
            'int'=>$x->getInteger(),
        //'getTimeLow'=>$x->getTimeLow(),
       // 'hex'=>$x->getHex(),
];

return response()->json($response,200);

    }
    public function createApikeyv1(Request $request){
        //$date = new DateTime();
        if(! $user =AuthController::getAuthenticatedUser()){
            return response()->json(['msg'=>'user not found']);
         }
         $x=Uuid::uuid1();
        $apikey=new Apikey();
        $apikey->user_id=$user->user_id;
        $apikey->name=$request->input('name');
        $apikey->type='user-v1';
        $apikey->key=Uuid::uuid1();
        $apikey->revoke=false;
        $apikey->id=Uuid::uuid4();
        $apikey->save();
        $response=[
            'uuid'=>$x,
            'time'=>$x->getTimestamp(),
            'int'=>$x->getInteger(),
        'getTimeLow'=>$x->getTimeLow(),
        'hex'=>$x->getHex(),
       
];
          
        return response()->json($response,200);
 
    }

    public  function applyVariant(int $clockSeq)
    {
        $clockSeq = $clockSeq & 0x3fff;
        $clockSeq |= 0x8000;

        return $clockSeq;
    }

   
    public  function applyVersion(int $timeHi, int $version)
    {
        $timeHi = $timeHi & 0x0fff;
        $timeHi |= $version << 12;

        return $timeHi;
    }
}
