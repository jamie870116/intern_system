<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match as MatchEloquent;

class TrackController extends Controller
{
    //所有廠商中：廠商尚未處理履歷(1)、廠商已拒絕人數(2+8)、正在面試流程(3+4)、學生拒絕媒合(5+10)、
    //公司已錄取等待回復(6+7)、等待系辦加入課程(9)、已完成媒合等待實習開始(11)
    public function adminGetAllMatchStatus(){
        $match=MatchEloquent::all();
        $unprocessed = 0;
        $companyRefuse = 0;
        $onInterview = 0;
        $studentRefuse = 0;
        $studentUnreply = 0;
        $AdminAddCourse = 0;
        $done = 0;
        foreach ($match as $m){
            if($m->mstatus==1){
                $unprocessed++;
            }elseif ($m->mstatus==2 || $m->mstatus==8){
                $companyRefuse++;
            }elseif ($m->mstatus==3 || $m->mstatus==4){
                $onInterview++;
            }elseif ($m->mstatus==5 || $m->mstatus==10){
                $studentRefuse++;
            }elseif ($m->mstatus==6 || $m->mstatus==7){
                $studentUnreply++;
            }elseif ($m->mstatus==9){
                $AdminAddCourse++;
            }elseif ($m->mstatus==11){
                $done++;
            }
        }
        $response=array($unprocessed,$companyRefuse,$onInterview,$studentRefuse,$studentUnreply,$AdminAddCourse,$done);
        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }

    //特定廠商：廠商尚未處理履歷(1)、廠商已拒絕人數(2+8)、正在面試流程(3+4)、學生拒絕媒合(5+10)、
    //公司已錄取等待回復(6+7)、等待系辦加入課程(9)、已完成媒合等待實習開始(11)

    public function adminGetMatchStatusByC_account(Request $request){
        $re = $request->all();
        $match=MatchEloquent::where('c_account',$re['c_account'])->get();
        $unprocessed = 0;
        $companyRefuse = 0;
        $onInterview = 0;
        $studentRefuse = 0;
        $studentUnreply = 0;
        $AdminAddCourse = 0;
        $done = 0;
        foreach ($match as $m){
            if($m->mstatus==1){
                $unprocessed++;
            }elseif ($m->mstatus==2 || $m->mstatus==8){
                $companyRefuse++;
            }elseif ($m->mstatus==3 || $m->mstatus==4){
                $onInterview++;
            }elseif ($m->mstatus==5 || $m->mstatus==10){
                $studentRefuse++;
            }elseif ($m->mstatus==6 || $m->mstatus==7){
                $studentUnreply++;
            }elseif ($m->mstatus==9){
                $AdminAddCourse++;
            }elseif ($m->mstatus==11){
                $done++;
            }
        }
        $response=array($unprocessed,$companyRefuse,$onInterview,$studentRefuse,$studentUnreply,$AdminAddCourse,$done);
        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
