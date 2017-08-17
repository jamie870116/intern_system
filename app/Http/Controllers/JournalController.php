<?php

namespace App\Http\Controllers;

use App\Services\JournalServices;
use App\Stu_course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTAuth;
use Log;
use Validator;

use App\Stu_course as Stu_courseEloquent;
use App\User as UserEloquent;
use App\Course as CourseEloquent;
use App\Journal as JournalEloquent;


class JournalController extends Controller
{
    protected $JournalServices;

    public function __construct(JournalServices $JournalServices)
    {
        $this->middleware('student');
        $this->JournalServices = $JournalServices;
    }

    //該學生實習列表
    public function studentGetInternList()
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $stu_course = Stu_courseEloquent::where('sid', $user->id)->get();
        $intern_list = array();
        foreach ($stu_course as $stu_cour) {
            $journalCom = UserEloquent::where('account', $stu_cour->c_account)->first();
            $course=Stu_course::find($stu_cour->SCid)->courses()->first();
            $now = Carbon::now();
            Log::error($course);
            if($now < $course->courseEnd){
               $passDeadLine=false;
            }else{
                $passDeadLine=true;
            }
            $list = array('SCid'=>$stu_cour->SCid,'com_name'=> $journalCom->u_name, 'courseName'=>$course->courseName,'passDeadLine'=>$passDeadLine);

            $intern_list[] = $list;

        }
        return response()->json($intern_list, 200, [], JSON_UNESCAPED_UNICODE);
    }

    //該學生週誌列表
    public function studentGetJournalList(Request $request)
    {
        $re = $request->all();
        $journal=JournalEloquent::where('SCid',$re['SCid'])->get();
        $course=Stu_course::find($re['SCid'])->courses()->first();
        $now = Carbon::now();
        if($now < $course->courseEnd){
            $passDeadLine=false;
        }else{
            $passDeadLine=true;
        }
        if(!$journal){
            return response()->json(array('找不到週誌列表'), 400, [], JSON_UNESCAPED_UNICODE);
        }else {
            foreach ($journal as $j){
                $j->journalStart=Carbon::parse($j->journalStart)->format('Y/m/d');
                $j->journalEnd=Carbon::parse($j->journalEnd)->format('Y/m/d');
                $j->passDeadLine=$passDeadLine;
            }
            return response()->json($journal, 200, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //在學生輸入週誌之前的顯示
    public function defaultJournalBeforeInput(Request $request)
    {
        $re = $request->all();
        $journal=JournalEloquent::where('journalID',$re['journalID'])->first();
        $course=Stu_course::find($journal->SCid)->courses()->first();
        $now = Carbon::now();
        if($now < $course->courseEnd){
            $passDeadLine=false;
        }else{
            $passDeadLine=true;
        }
        if(!$journal){
            return response()->json(array('找不到週誌列表'), 400, [], JSON_UNESCAPED_UNICODE);
        }else {

            $journal->journalStart=Carbon::parse($journal->journalStart)->format('Y/m/d');
            $journal->journalEnd=Carbon::parse($journal->journalEnd)->format('Y/m/d');
            $journal->passDeadLine=$passDeadLine;

            return response()->json($journal, 200, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //學生輸入週誌內容
    public function studentEditJournal(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'journalDetail_1' => 'required',
            'journalID' => 'required',
            'journalDetail_2' => 'required',
            'journalStart' => 'required|date',
            'journalEnd' => 'required|date',
            'journalInstructor' => 'required'
        ), array(
            'journalDetail_1.required' => '請輸入重要事件紀錄與觀察',
            'journalID.required' => '請輸入週誌ID',
            'journalDetail_2.required' => '請選擇觀察心得與個人看法',
            'journalStart.required' => '請選擇日誌開始日期',
            'journalEnd.required' => '請選擇日誌結束日期',
            'journalInstructor.required' => '請選擇企業指導員姓名',
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
            $responses = $this->JournalServices->studentEditJournal_ser($re);
            if ($responses == '週誌輸入成功') {
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
}
