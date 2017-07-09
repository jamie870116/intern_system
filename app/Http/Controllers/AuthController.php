<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User as UserEloquent;

use App\Services\registerService;
use App\Stu_basic as stuBasicEloquent;

//use Jenssegers\Agent\Facades\Agent;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Jenssegers\Agent\Agent;
use Validator;
use Log;


class AuthController extends Controller
{

    protected $registerService;
    public function __construct(registerService $registerService){
        $this->registerService = $registerService;
        $this->middleware('guest',['except'=>['getLogout','findUserDetailsByToken']]);
        $this->middleware('jwt',['only'=>['findUserDetailsByToken','getLogout']]);
    }

    public function postLogin(Request $request){

        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $user_data=$request->only(['account','password']);
        $account=$request->only(['account']);
        $password=$request->only(['password']);
        $d_type=$request->only(['type']);
        $auth=UserEloquent::where('account',$account)->first();
        if($account['account']==""&&$password['password']==""){
            $msg=array('請輸入帳號','請輸入密碼');
            return response()->json($msg,400,$headers, JSON_UNESCAPED_UNICODE);
        }else if($password['password']==""){
            return response()->json('請輸入密碼',400,$headers, JSON_UNESCAPED_UNICODE);
        }else if($account['account']==""){
            return response()->json('請輸入帳號',400,$headers, JSON_UNESCAPED_UNICODE);
        }
        if($auth){
            if(password_verify($password['password'],$auth->password)){
                if($auth->started==1){//登入成功
                    //$t=reService::randomkeys(30);
                    // Auth::login($auth);
                    // $token=new TokensEloquent();
                    // $token->token=$t;
                    // $token->id=Auth::user()->id;
                    // $token->types=$d_type['type'];
                    // $token->save();
                    $agent = new Agent();
                    if($agent->isDesktop()){
                        $ex_time=Carbon::now()->addHour()->timestamp;
                        $token = JWTAuth::attempt($user_data,['exp'=>$ex_time]);
                    }else{
                        $token = JWTAuth::attempt($user_data);
                    }

                    try {
                        if (!$token) {
                            return response()->json(['error' => 'invalid_credentials'], 401);
                        }
                    } catch (JWTException $e) {
                        return response()->json(['error' => 'could_not_create_token'], 500);
                    }

                    return response()->json($token);
                }else{
                    return response()->json('帳號未開通',400,$headers, JSON_UNESCAPED_UNICODE);
                }
            }else{
                return response()->json('密碼錯誤',400,$headers, JSON_UNESCAPED_UNICODE);
            }
        }else{
            return response()->json('帳號不存在',400,$headers, JSON_UNESCAPED_UNICODE);
        }

    }

    public function getLogout(){
        $token = JWTAuth::getToken();
        if($token){
            JWTAuth::invalidate($token);
            return response()->json('已登出',200);
        }else{
            return response()->json('已登出',200);
        }

//        $newToken	=	JWTAuth::parseToken()->refresh();
//        return	response()->json(['token'	=>	$newToken]);

    }

    public function register(Request $request){

        $length=10;
        $key=$this->registerService->randomkeys($length);
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $re=$request->all();
        $status=$re['u_status'];
        $account=$re['account'];
        $u_tel=$re['u_tel'];
        $u_name=$re['u_name'];
        $password=$re['password'];

        $conf_pass=$re['conf_pass'];

        $objValidator = Validator::make($request->all(), array(
            'u_name'=>'required',
            'u_tel'=>'required',
            'account'=>'required|unique:users',
            'password' => 'required|max:20|min:6',
            'conf_pass'=>'required',
            'email'=>'email'
        ),array(
            'required'=>'此欄位不可為空白',
            'max'=>'字數請介於6~20位元',
            'min'=>'字數請介於6~20位元',
            'unique' => '帳號已存在',
            'email'=>'信箱格式錯誤'
        ));
        if($objValidator->fails()){
            return response()->json($objValidator->errors(),400);//422
        }else if($conf_pass!=$password){
            return response()->json('兩次密碼不一致',400,$headers, JSON_UNESCAPED_UNICODE);
        }else if($status==0){ //學生
            $email=$account.'@nutc.edu.tw';
            userEloquent::create([
                'u_name'=>$u_name,
                'email'=>$email,
                'u_status'=>$status,
                'u_tel'=>$u_tel,
                'account'=>$account,
                'password' => bcrypt($password),
                'check_code'=>$key
            ]);
            $m=$this->registerService->sendmail($email,$key);
            Log::error($m);
            return response()->json('去收驗證信s',200,$headers, JSON_UNESCAPED_UNICODE);
        }else if($status==1){//teacher
            $email=$account.'@nutc.edu.tw';
            userEloquent::create([
                'u_name'=>$u_name,
                'email'=>$email,
                'u_status'=>$status,
                'u_tel'=>$u_tel,
                'account'=>$account,
                'password' => bcrypt($password),
                'check_code'=>$key
            ]);
            $this->registerService->sendmail($email,$key);
            return response()->json('去收驗證信t',200,$headers, JSON_UNESCAPED_UNICODE);
        }else if($status==2){//company
            $email=$re['email'];
            userEloquent::create([
                'u_name'=>$u_name,
                'email'=>$email,
                'u_status'=>$status,
                'u_tel'=>$u_tel,
                'account'=>$account,
                'password' => bcrypt($password),
                'check_code'=>$key
            ]);
            $this->registerService->sendmail($email,$key);
            return response()->json('去收驗證信c',200,$headers, JSON_UNESCAPED_UNICODE);
        }

    }

    public function check_code(Request $request){
        $c_code=$request['code'];
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $user=userEloquent::where('check_code',$c_code)->first();
        if($user){
            if($user->started==0){
                $user->started=1;
                $user->save();
                if($user->u_status==0){
                    $stu_basic=new stuBasicEloquent();
                    $stu_basic->sid=$user->id;
                    $stu_basic->chiName=$user->u_name;
                    $stu_basic->contact=$user->u_tel;
                    $stu_basic->email=$user->email;
                    $stu_basic->save();
                }
                return response()->json("帳號開通囉",200,$headers, JSON_UNESCAPED_UNICODE);
            }else{
                return response()->json("帳號已開通",200,$headers, JSON_UNESCAPED_UNICODE);
            }
        }else{
            return response()->json("用戶不存在",400,$headers, JSON_UNESCAPED_UNICODE);
        }

    }

    public function findUserDetailsByToken()
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if ($user) {
            return response()->json($user, 200);
        } else {
            return response()->json('使用者不存在', 400);
        }

    }

}
