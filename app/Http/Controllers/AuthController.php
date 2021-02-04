<?php

namespace App\Http\Controllers;

use App\Com_basic;
use App\Jobs\resetPasswordMail;
use App\Stu_basic;
use App\Teacher_profile_pic;
use Carbon\Carbon;
use Cookie;
use Illuminate\Http\Request;
use App\User as UserEloquent;
use App\Com_basic as comEloquent;
use App\Services\registerService;
use App\Stu_basic as stuBasicEloquent;

//use Jenssegers\Agent\Facades\Agent;
use JWTAuth;
use Mail;
use Tymon\JWTAuth\Exceptions\JWTException;
use Jenssegers\Agent\Agent;
use Validator;
use Log;


class AuthController extends Controller
{

    protected $registerService;

    public function __construct(registerService $registerService)
    {
        $this->registerService = $registerService;
        $this->middleware('guest', ['except' => ['getLogout', 'findUserDetailsByToken','userResetPassword']]);
        $this->middleware('jwt', ['only' => ['findUserDetailsByToken', 'getLogout','userResetPassword']]);
    }

    public function postLogin(Request $request)
    {

        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $user_data = $request->only(['account', 'password']);
        $account = $request->only(['account']);
        $password = $request->only(['password']);
        $error = array();

        $ex_time = Carbon::now()->addHour(5)->timestamp;
        $auth = UserEloquent::where('account', $account)->first();
        if ($account['account'] == "" && $password['password'] == "") {

            $error[] = '請輸入帳號';
            $error[] = '請輸入密碼';
            return response()->json($error, 400, $headers, JSON_UNESCAPED_UNICODE);
        } else if ($password['password'] == "") {
            $error[] = '請輸入密碼';
            return response()->json($error, 400, $headers, JSON_UNESCAPED_UNICODE);
        } else if ($account['account'] == "") {
            $error[] = '請輸入帳號';
            return response()->json($error, 400, $headers, JSON_UNESCAPED_UNICODE);
        }
        if ($auth) {
            if (password_verify($password['password'], $auth->password)) {
                if ($auth->started == 1) {//登入成功
                    $agent = new Agent();
                    if ($agent->isDesktop()) {

                        $token = JWTAuth::attempt($user_data, ['exp' => $ex_time]);
                    } else {
                        $token = JWTAuth::attempt($user_data);
                    }
                    try {
                        if (!$token) {
                            return response()->json(['error' => 'invalid_credentials'], 401);
                        }
                    } catch (JWTException $e) {
                        return response()->json(['error' => 'could_not_create_token'], 500);
                    }
                    $cookie_token = 'Bearer ' . $token;
                    return response()->json($token)->cookie('authorization', $cookie_token, 200);
                } elseif ($auth->started == 0) {
                    $error[] = '帳號未開通';
                    return response()->json($error, 400, $headers, JSON_UNESCAPED_UNICODE);
                } elseif ($auth->started == 2) {
                    $error[] = '帳號待系辦審核';
                    return response()->json($error, 400, $headers, JSON_UNESCAPED_UNICODE);
                } else {
                    $error[] = '帳號遭停用中';
                    return response()->json($error, 400, $headers, JSON_UNESCAPED_UNICODE);
                }
            } else {
                $error[] = '密碼錯誤';
                return response()->json($error, 400, $headers, JSON_UNESCAPED_UNICODE);
            }
        } else {
            $error[] = '帳號不存在';
            return response()->json($error, 400, $headers, JSON_UNESCAPED_UNICODE);
        }

    }

    public function getLogout()
    {
        $token = JWTAuth::getToken();
        if ($token) {
            JWTAuth::invalidate($token);
            return response()->json(['已登出'], 200);
        } else {
            return response()->json(['已登出'], 200);
        }

//        $newToken	=	JWTAuth::parseToken()->refresh();
//        return	response()->json(['token'	=>	$newToken]);

    }

    public function register(Request $request)
    {
        $error = array();
        $length = 10;
        $key = $this->registerService->randomkeys($length);
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $re = $request->all();
        $status = $re['u_status'];
        $account = $re['account'];
        $u_tel = $re['u_tel'];
        $u_name = $re['u_name'];
        $password = $re['password'];

        $conf_pass = $re['conf_pass'];

        $objValidator = Validator::make($request->all(), array(
            'u_name' => 'required',
            'u_tel' => 'required',
            'account' => 'required|unique:users',
            'password' => 'required|max:20|min:6',
            'conf_pass' => 'required',
            'email' => 'email|required|unique:users',
            'u_status' => 'required'
        ), array(
            'u_name.required' => '請輸入姓名',
            'u_status.required' => '請選擇要註冊的身分',
            'u_tel.required' => '請輸入電話',
            'account.required' => '請輸入帳號',
            'password.required' => '請輸入密碼',
            'conf_pass.required' => '請再次輸入密碼',
            'email.required' => '請輸入信箱',
            'max' => '字數請介於6~20位元',
            'min' => '字數請介於6~20位元',
            'account.unique' => '帳號已存在',
            'email.unique' => '信箱已重複',
            'email' => '信箱格式錯誤'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();

            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else if ($conf_pass != $password) {
            $error[] = '兩次密碼不一致';
            return response()->json($error, 400, $headers, JSON_UNESCAPED_UNICODE);
        } else if ($status == 0) { //學生
//            $email = $account . '@nutc.edu.tw';
            $email = $re['email'];
            userEloquent::create([
                'u_name' => $u_name,
                'email' => $email,
                'u_status' => $status,
                'u_tel' => $u_tel,
                'account' => $account,
                'password' => bcrypt($password),
                'check_code' => $key
            ]);
            $m = $this->registerService->sendmail($email, $key,$u_name,$account);
            Log::error($m);
            return response()->json(['去收驗證信s'], 200, $headers, JSON_UNESCAPED_UNICODE);
        } else if ($status == 1) {//teacher
//            $email = $account . '@nutc.edu.tw';
            $email = $re['email'];
            userEloquent::create([
                'u_name' => $u_name,
                'email' => $email,
                'u_status' => $status,
                'u_tel' => $u_tel,
                'account' => $account,
                'password' => bcrypt($password),
                'check_code' => $key
            ]);
            $this->registerService->sendmail($email, $key,$u_name,$account);
            return response()->json(['去收驗證信t'], 200, $headers, JSON_UNESCAPED_UNICODE);
        } else if ($status == 2) {//company
            $email = $re['email'];
            userEloquent::create([
                'u_name' => $u_name,
                'email' => $email,
                'u_status' => $status,
                'u_tel' => $u_tel,
                'account' => $account,
                'password' => bcrypt($password),
                'check_code' => $key
            ]);
            $this->registerService->sendmail($email, $key,$u_name,$account);
            return response()->json(['去收驗證信c'], 200, $headers, JSON_UNESCAPED_UNICODE);
        }

    }

    public function resendVerificationLetter(Request $request){
        $re=$request->all();
        $objValidator = Validator::make($request->all(), array(
            'account' => 'required',
        ), array(
            'account.required' => '請輸入帳號',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $user=userEloquent::where('account',$re['account'])->first();
            if($user){
                if($user->started==0){
                    $data = ['mail'=>$user->email, 'code'=>$user->check_code,'userName'=>$user->u_name,'account'=>$user->account];
//        dispatch(new SendEmail($data));

                    Mail::send('mail.VerificationLetter', $data, function($message) use($data)
                    {
                        $message->to($data['mail'], $data['code'])->subject('會員驗證信');
                    });

                    return response()->json(['去收驗證信'], 200,[] , JSON_UNESCAPED_UNICODE);
                }else{
                    return response()->json(['帳號已啟用'], 200,[] , JSON_UNESCAPED_UNICODE);
                }

            }else{
                return response()->json(['沒有此使用者'], 400,[] , JSON_UNESCAPED_UNICODE);
            }

        }
    }

    public function check_code(Request $request)
    {
        $objValidator = Validator::make($request->all(), array(
            'code' => 'required',
        ), array(
            'code.required' => '請輸入驗證碼',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        }else{
            $c_code = $request['code'];
            $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
            $user = userEloquent::where('check_code', $c_code)->first();
            if ($user) {
                if ($user->started == 0) {
                    $user->started = 1;
                    $user->save();
                    if ($user->u_status == 0) {
                        $stu_basic = new stuBasicEloquent();
                        $stu_basic->sid = $user->id;
                        $stu_basic->chiName = $user->u_name;
                        $stu_basic->contact = $user->u_tel;
                        $stu_basic->email = $user->email;
                        $stu_basic->save();
                    } elseif ($user->u_status == 2) {
                        $user->started = 2;//等待系辦審核
                        $user->save();
                        $com = new comEloquent();
                        $com->c_account = $user->account;
                        $com->c_name = $user->u_name;
                        $com->save();
                    }
                    return response()->json(["帳號開通囉"], 200, $headers, JSON_UNESCAPED_UNICODE);
                } else {
                    return response()->json(["帳號已開通"], 200, $headers, JSON_UNESCAPED_UNICODE);
                }
            } else {
                return response()->json(["用戶不存在"], 400, $headers, JSON_UNESCAPED_UNICODE);
            }
        }

    }

    public function findUserDetailsByToken()
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if ($user) {
            if($user->u_status==0){
                $stu_basic=Stu_basic::where('sid',$user->id)->first();
                if($stu_basic){
                    $user->profilePic=$stu_basic->profilePic;
                }else{
                    $user->profilePic=null;
                }
            }elseif($user->u_status==2){
                $com_basic=Com_basic::where('c_account',$user->account)->first();
                $user->profilePic=$com_basic->profilePic;
            }elseif ($user->u_status==1){
                $teaPic = Teacher_profile_pic::where('tid', $user->id)->first();
                if($teaPic)
                $user->profilePic=$teaPic->profilePic;
            }
            $ex_time = Carbon::now()->addHour(5)->timestamp;
            return response()->json($user, 200)->cookie('token', $token, $ex_time);
        } else {
            return response()->json(['使用者不存在'], 400);
        }

    }

    //忘記密碼
    public function forgetPassword(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'account' => 'required'
        ), array(
            'account.required' => '請輸入帳號'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $user = UserEloquent::where('account', $re['account'])->first();
            if ($user) {
                $key="";
                $pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                for($i=0;$i<15;$i++){
                    $key .= $pattern{rand(0,35)};
                }
                $user->check_code=$key;
                $user->save();
                $data = ['mail' => $user->email, 'auth_code' => $key,'time'=>Carbon::now(),'userName'=>$user->u_name];
//                dispatch(new resetPasswordMail($data));
                Mail::send('mail.ResetPassword', $data, function($message) use($data)
                {
                    $message->to($data['mail'], $data['auth_code'])->subject('密碼重置信件');
                });
                return response()->json(['去信箱收信吧'], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(['查無此帳號'], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //重設密碼
    public function resetPassword(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'token' => 'required',
            'password' => 'required|max:20|min:6',
            'conf_pass' => 'required'
        ), array(
            'password.required' => '請輸入密碼',
            'conf_pass.required' => '請再次輸入密碼',
            'max' => '字數請介於6~20位元',
            'min' => '字數請介於6~20位元',
            'token.required' => '請輸入驗證碼'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else if ($re['password'] != $re['conf_pass']) {
            return response()->json(['兩次密碼不一致'], 400, [], JSON_UNESCAPED_UNICODE);
        } else {
            $user = UserEloquent::where('check_code', $re['token'])->first();
            if ($user) {
                $user->password = bcrypt($re['password']);
                $user->save();
                if (UserEloquent::count() != 0)
                    return response()->json(['密碼重設成功'], 200, [], JSON_UNESCAPED_UNICODE);
                else
                    return response()->json(['密碼重設失敗'], 400, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(['查無此帳號'], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

//重設密碼
    public function userResetPassword(Request $request)
    {
        $re = $request->all();
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $objValidator = Validator::make($request->all(), array(
            'oldPassword' => 'required',
            'newPassword' => 'required|max:20|min:6',
            'conf_pass' => 'required'
        ), array(
            'newPassword.required' => '請輸入新密碼',
            'conf_pass.required' => '請再次輸入密碼',
            'oldPassword.required' => '請輸入舊密碼',
            'max' => '字數請介於6~20位元',
            'min' => '字數請介於6~20位元',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else if ($re['newPassword'] != $re['conf_pass']) {
            return response()->json(['兩次密碼不一致'], 400, [], JSON_UNESCAPED_UNICODE);
        } else {
            if (password_verify($re['oldPassword'], $user->password)) {
                $user->password = bcrypt($re['newPassword']);
                $user->save();
                if (UserEloquent::count() != 0)
                    return response()->json(['密碼重設成功'], 200, [], JSON_UNESCAPED_UNICODE);
                else
                    return response()->json(['密碼重設失敗'], 400, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(['原本密碼錯誤'], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

}
