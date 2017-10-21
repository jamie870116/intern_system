<?php

namespace App\Http\Controllers;

use App\Course;
use App\Job_opening;
use App\Match as MatchEloquent;
use App\Stu_basic;
use App\User as UserEloquent;
use App\Stu_course as StuCourseEloquent;

use App\Services\CourseServices;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class CourseController extends Controller
{
    protected $CourseServices;

    public function __construct(CourseServices $CourseServices)
    {
        $this->middleware('admin');
        $this->CourseServices = $CourseServices;
    }

    //系辦新增課程
    public function adminCreateCourse(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'courseName' => 'required',
            'courseJournal' => 'required|integer',
            'courseDetail' => 'nullable',
            'courseStart' => 'required|date',
            'courseEnd' => 'required|date',
            'courseSchoolSystem' => 'required|integer'

        ), array(
            'courseName.required' => '請輸入課程名稱',
            'courseJournal.required' => '請輸入該課程所需填寫的週誌數量',
            'courseStart.required' => '請輸入該課程開始日期',
            'courseEnd.required' => '請輸入該課程結束日期',
            'courseSchoolSystem.required' => '請輸入該課程之學制',
            'integer' => '請輸入數字',
            'date' => '請輸入日期',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->CourseServices->adminCreateCourse_ser($re);
            $r=array($responses);
            if ($responses != '新增課程資料成功') {
                return response()->json($r, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($r, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }


    //系辦修改課程內容
    public function adminEditCourseByCourseID(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'courseId'=>'required|integer',
            'courseName' => 'required',
            'courseJournal' => 'required|integer',
            'courseDetail' => 'nullable',
            'courseStart' => 'required|date',
            'courseEnd' => 'required|date',
            'courseSchoolSystem' => 'required|integer'

        ), array(
            'courseId.required'=>'請輸入課程編號',
            'courseName.required' => '請輸入課程名稱',
            'courseJournal.required' => '請輸入該課程所需填寫的週誌數量',
            'courseStart.required' => '請輸入該課程開始日期',
            'courseEnd.required' => '請輸入該課程結束日期',
            'courseSchoolSystem.required' => '請輸入該課程之學制',
            'integer' => '請輸入數字',
            'date' => '請輸入日期',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->CourseServices->adminEditCourseByCourseID_ser($re);
            $r=array($responses);
            if ($responses == '修改課程資料成功') {
                return response()->json($r, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($r, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //系辦刪除課程
    public function adminDeleteCourse(Request $request){
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'courseId' => 'required',
        ), array(
            'courseId.required' => '請輸入課程編號',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->CourseServices->adminDeleteCourse_ser($re);
            $r=array($responses);
            if ($responses == '刪除課程資料成功') {
                return response()->json($r, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($r, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //系辦以學生姓名或學號取得已成功的媒合資料
    public function adminGetSuccessMatchByStudent(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'student' => 'required',
            'courseId' => 'required|integer',
        ), array(
            'student.required' => '請輸入學生姓名或學號',
            'courseId.required' => '請輸入課程編號',
            'integer' => '請輸入int',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $keyword = '%' . $re['student'] . '%';
            $stu=User::where('account','like', $keyword)->orWhere('u_name','like', $keyword)->get();
            $course=Course::where('courseId',$re['courseId'])->first();
            if ($stu) {
                $student=array();
                $schoolSystem=$course->courseSchoolSystem;
                foreach ($stu as $s){
                    $match = MatchEloquent::where('mstatus', 9)->where('sid',$s->id)->get();
                    if($match && $course){
                        $passOneYear=Carbon::now()->subYear();
                        $passTwoYear=Carbon::now()->subYear(2);
                        foreach ($match as $m){
                            $stuB=Stu_basic::where('sid',$s->id)->first();
                            if($schoolSystem==$stuB->eTypes){
                                $dt = Carbon::parse($m->updated_at);
                                $m->stu_name=$s->u_name;
                                $m->stu_num=$s->account;
                                $m->eTypes=$stuB->eTypes;
                            $m->com_name=User::where('account',$m->c_account)->first()->u_name;
                            $m->com_num=$m->c_account;
                            if($dt->lte($passTwoYear) && $dt->gt($passOneYear)){
                                $m->years=2; //一年以上，兩年內
                            }elseif ($dt->lte($passOneYear)){
                                $m->years=1; //一年內
                            }else{
                                $m->years=3; //兩年以上
                            }
                            $student[]=$m;
                            }

                        }

                    }
                }
//
                return response()->json(['SuccessMatchList'=>$student], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                $r=array('取得資料失敗');
                return response()->json($r, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }

    }

    //系辦取得全部已成功的媒合資料
    public function adminGetSuccessMatch(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'courseId' => 'required|integer',
        ), array(
            'courseId.required' => '請輸入課程編號',
            'integer' => '請輸入int',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $course=Course::where('courseId',$re['courseId'])->first();
            $match = MatchEloquent::where('mstatus', 9)->SortByUpdates_DESC()->get();
            if ($match && $course) {
                $successMatch=array();
                $schoolSystem=$course->courseSchoolSystem;
                foreach ($match as $m){
                    $stuB=Stu_basic::where('sid',$m->sid)->first();
                    if($stuB->eTypes==$schoolSystem){
                        $stu=User::where('id',$m->sid)->first();
                        $m->stu_name=$stu->u_name;
                        $m->stu_num=$stuB->eTypes;
                        $m->com_name=User::where('account',$m->c_account)->first()->u_name;
                        $m->com_num=$m->c_account;
                        $successMatch[]=$m;
                    }

                }
                return response()->json(['SuccessMatchList'=>$successMatch], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array('取得資料失敗'), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }

    }

    //系辦依照課程取得符合學制且已成功的媒合資料
    public function adminGetSuccessMatchByCourseId(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'courseId' => 'required|integer',
        ), array(
            'courseId.required' => '請輸入課程編號',
            'integer' => '請輸入int',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $course=Course::where('courseId',$re['courseId'])->first();
            $match = MatchEloquent::where('mstatus', 9)->SortByUpdates_DESC()->get();
            if ($match && $course) {
                $successMatch=array();
                $schoolSystem=$course->courseSchoolSystem;
                foreach ($match as $m){
                    $stuB=Stu_basic::where('sid',$m->sid)->first();
                    if($stuB->eTypes==$schoolSystem){
                        $stu=User::where('id',$m->sid)->first();
                        $m->stu_name=$stu->u_name;
                        $m->stu_num=$stuB->eTypes;
                        $m->com_name=User::where('account',$m->c_account)->first()->u_name;
                        $m->com_num=$m->c_account;
                        $successMatch[]=$m;
                    }

                }
                return response()->json(['SuccessMatchList'=>$successMatch], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array('取得資料失敗'), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }

    }


    //系辦取得時限內課程資料
    public function adminGetCourse()
    {
        $course = Course::GetAvailableCourse()->get();
        if ($course) {
            return response()->json(['courseList'=>$course], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            $r=array('取得資料失敗');
            return response()->json($r, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //系辦取得全部課程資料
    public function adminGetAllCourse()
    {
        $course = Course::all();
        if ($course) {
            return response()->json(['courseList'=>$course], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            $r=array('取得資料失敗');
            return response()->json($r, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //系辦取得所有老師資訊
    public function adminGetTeacherData()
    {
        $user = UserEloquent::where('u_status', 1)->get();
        if ($user) {
            return response()->json(['teacherList'=>$user], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            $r=array('取得資料失敗');
            return response()->json($r, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //系辦將學生加入課程並給予實習老師
    public function adminAddStudentToCourse(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'mid' => 'required',//,隔開
            'tid' => 'required',
            'courseId' => 'required',
            'firstDay' => 'required|date',

        ), array(
            'mid.required' => '請輸入媒合ID',
            'tid.required' => '請回傳老師ID',
            'courseId.required' => '請回傳課程ID',
            'firstDay.required' => '請輸入開始實習的日期',
            'integer' => 'int格式錯誤',
            'date' => '請輸入日期格式',
        ));
            if ($objValidator->fails()) {
                $errors = $objValidator->errors();
                $error = array();
                foreach ($errors->all() as $message) {
                    $error[] = $message;
                }
                return response()->json($error, 400);//422
            } else {
            $responses = $this->CourseServices->adminAddStudentToCourse_ser($re);
            $c = count($responses);
            $i=0;
            foreach ($responses as $r){
                if($r=='加入成功')
                    $i++;
            }
            if ($i==$c) {
                return response()->json('成功', 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //取得某課程中的學生
    public function adminGetStudentByCourseId(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'courseId' => 'required|integer',
        ), array(
            'courseId.required' => '請輸入課程ID',
            'integer' => 'int格式錯誤',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $stu_c=StuCourseEloquent::where('courseId',$re['courseId'])->get();
            foreach ($stu_c as $s){
                $stu=Stu_basic::where('sid',$s->sid)->first();
                $st=User::where('id',$s->sid)->first();
                $com=User::where('account',$s->c_account)->first();
                $s->stuName=$stu->chiName;
                $s->stuNum=$st->account;
                $s->profilePic=$stu->profilePic;
                $s->comName=$com->u_name;
            }

           if($stu_c){
               return response()->json($stu_c, 200, [], JSON_UNESCAPED_UNICODE);
           }else{
               return response()->json( array('取得失敗'), 400, [], JSON_UNESCAPED_UNICODE);
           }
        }
    }

    //系辦將學生從課程中刪除
    public function adminDeleteStudentFromCourse(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|integer',
        ), array(
            'SCid.required' => '請輸入SCId',
            'integer' => 'int格式錯誤',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->CourseServices->adminDeleteStudentFromCourse_ser($re['SCid']);
            $r=array($responses);
            if ($responses == '刪除課程資料成功') {
                return response()->json($r, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($r, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
}
