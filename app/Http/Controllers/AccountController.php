<?php

namespace App\Http\Controllers;

use App\Services\AccountServices;
use App\User;
use Illuminate\Http\Request;
use Validator;

class AccountController extends Controller
{
    protected $AccountServices;

    public function __construct(AccountServices $AccountServices)
    {
        $this->middleware('admin',['except'=>'searchReviewedCompanyByKeyword']);
        $this->AccountServices = $AccountServices;
    }

    //取得所有使用者資料
    public function getAllUserList(){
        $users=User::GetAll()->where('started','<>',3)->get();
        if($users)
        return response()->json(['usersList'=>$users], 200, [], JSON_UNESCAPED_UNICODE);
        else
            return response()->json(['找不到所有使用者資料'], 400, [], JSON_UNESCAPED_UNICODE);
    }

    //搜尋使用者資料
    public function searchAllUserByKeyword(Request $request){
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'keyword' => 'required',
            'u_status' => 'required|integer',
            'able' => 'required|integer',
        ), array(
            'keyword.required' => '請輸入關鍵字',
            'u_status.required' => '請輸入欲搜尋之角色',//0，學生 1，老師 2，企業 3，全部
            'able.required' => '請輸入欲搜尋之角色',//0，學生 1，老師 2，企業 3，全部
            'integer' => '請輸入int',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $keyword = '%' . $re['keyword'] . '%';
            $responses=$this->AccountServices->searchAllUserByKeyword_ser($keyword,$re['u_status'],$re['able']);
            if ($responses == '找不到') {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //取得所有學生資料
    public function getAllStudentList(){
        $students=User::where('u_status',0)->where('started','<>',3)->get();
        if($students)
            return response()->json(['studentsList'=>$students], 200, [], JSON_UNESCAPED_UNICODE);
        else
            return response()->json(['找不到所有學生資料'], 400, [], JSON_UNESCAPED_UNICODE);
    }


    //取得所有老師資料
    public function getAllTeacherList(){
        $teachers=User::where('u_status',1)->where('started','<>',3)->get();
        if($teachers)
            return response()->json(['teachersList'=>$teachers], 200, [], JSON_UNESCAPED_UNICODE);
        else
            return response()->json(['找不到所有老師資料'], 400, [], JSON_UNESCAPED_UNICODE);
    }


    //取得所有廠商資料
    public function getAllCompanyList(){
        $companies=User::where('u_status',2)->where('started','<>',3)->get();
        if($companies)
            return response()->json(['companiesList'=>$companies], 200, [], JSON_UNESCAPED_UNICODE);
        else
            return response()->json(['找不到所有廠商資料'], 400, [], JSON_UNESCAPED_UNICODE);
    }

    //取得已審核的廠商資料
    public function getReviewedCompanyList(){
        $companies=User::where('u_status',2)->where('started',1)->get();
        if($companies)
            return response()->json(['companiesList'=>$companies], 200, [], JSON_UNESCAPED_UNICODE);
        else
            return response()->json(['找不到所有廠商資料'], 400, [], JSON_UNESCAPED_UNICODE);
    }

    //取得已通過驗證未審核的廠商資料
    public function getNoReviewedCompanyList(){
        $companies=User::where('u_status',2)->where('started',2)->get();
        if($companies)
            return response()->json(['companiesList'=>$companies], 200, [], JSON_UNESCAPED_UNICODE);
        else
            return response()->json(['找不到已通過驗證未審核的廠商資料'], 400, [], JSON_UNESCAPED_UNICODE);
    }

    //搜尋廠商名稱(全部)
    public function searchAllCompanyByKeyword(Request $request){
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'keyword' => 'required'
        ), array(
            'keyword.required' => '請輸入關鍵字'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $keyword = '%' . $re['keyword'] . '%';
            $responses=$this->AccountServices->searchAllCompanyByKeyword_ser($keyword);
            if ($responses == '找不到') {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //搜尋廠商名稱(已審核)
    public function searchReviewedCompanyByKeyword(Request $request){
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'keyword' => 'required'
        ), array(
            'keyword.required' => '請輸入關鍵字'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $keyword = '%' . $re['keyword'] . '%';
            $responses=$this->AccountServices->searchReviewedCompanyByKeyword_ser($keyword);
            if ($responses == '找不到') {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //搜尋廠商名稱(未審核)
    public function searchNoReviewedCompanyByKeyword(Request $request){
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'keyword' => 'required'
        ), array(
            'keyword.required' => '請輸入關鍵字'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $keyword = '%' . $re['keyword'] . '%';
            $responses=$this->AccountServices->searchNoReviewedCompanyByKeyword_ser($keyword);
            if ($responses == '找不到') {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //取得某學生履歷
    public function adminGetStudentResumeById(Request $request){
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'id' => 'required'
        ), array(
            'id.required' => '請輸入id'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses=$this->AccountServices->adminGetStudentResumeById_ser($re['id']);
            if ($responses == '此id不是學生'||$responses == 'Id不存在') {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //取得某廠商基本資料
    public function adminGetCompanyDetailsById(Request $request){
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'id' => 'required'
        ), array(
            'id.required' => '請輸入id'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses=$this->AccountServices->adminGetCompanyDetailsByAccount_ser($re['id']);
            if ($responses == 'Id不正確') {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
    //系辦審核廠商
    public function adminReviewCompanyById(Request $request){
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'id' => 'required|integer',
            'result' => 'required|integer',
        ), array(
            'id.required' => '請輸入id',
            'result.required' => '請輸入審核結果',//0，未通過 1，通過
            'integer' => '請輸入integer',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses=$this->AccountServices->adminReviewCompanyById_ser($re);
            if ($responses == '審核通過成功'||$responses == '審核不通過成功') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
    //系辦停用帳號
    public function adminDisableUserById(Request $request){
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'id' => 'required|integer',
        ), array(
            'id.required' => '請輸入id',
            'integer' => '請輸入integer',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses=$this->AccountServices->adminDisableUserById_ser($re['id']);
            if ($responses == '停用成功') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //取得停用中的帳號
    public function getDisabledUsersList(){
        $companies=User::where('started',3)->get();
        if($companies)
            return response()->json($companies, 200, [], JSON_UNESCAPED_UNICODE);
        else
            return response()->json(['找不到停用中的帳號'], 400, [], JSON_UNESCAPED_UNICODE);
    }

    //系辦重新啟用用帳號
    public function adminReEnableUserById(Request $request){
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'id' => 'required|integer',
        ), array(
            'id.required' => '請輸入id',
            'integer' => '請輸入integer',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses=$this->AccountServices->adminReEnableUserById_ser($re['id']);
            if ($responses == '重新啟用成功') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
}
