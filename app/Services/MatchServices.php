<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/7/19
 * Time: 下午 03:44
 */

namespace App\Services;

use App\Interviews;
use App\Job_opening;
use App\Jobs\sendInterviewNoticeMail;
use App\Match as MatchEloquent;
use App\MatchLog as MatchLogEloquent;
use App\Stu_basic as stuBasicEloquent;
use App\User;
use Carbon\Carbon;
use JWTAuth;
use Log;

class MatchServices
{
    public function studentSubmitResume_ser($re)
    {

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $m=MatchEloquent::where('sid',$user->id)->where('joid',$re['joid'])->first();
        if(!$m){
            $resume=stuBasicEloquent::where('sid',$user->id)->first();
            if($resume->eduSystem!=null){
                $match = new MatchEloquent();
                $match->joid=$re['joid'];

                $com=Job_opening::where('joid',$re['joid'])->first();
                $com->jResume_num+=1;
                $com->save();
                $match->c_account=$com->c_account;
                $match->sid=$user->id;
                $match->save();
                $log = new MatchLogEloquent();//給企業信件->學生的履歷
                $log->mstatus = 1;
                $log->mid = $match->mid;
                $log->mailDeadline = Carbon::now()->addDays(30);
                $log->save();

                if (MatchEloquent::count() != 0 && MatchLogEloquent::count() != 0) {
                    return '學生送出媒合資料成功';
                } else {
                    return '學生送出媒合資料失敗';
                }
            }else{
                return '去填履歷再來吧';
            }

        }else{
            return '已經投過履歷囉';
        }

    }

    public function companyRejectResume_ser($re)
    {
        $match = MatchEloquent::where('mid', $re['mid'])->first();
        if ($match) {
            if ($match->mstatus == 1) {
                $match->mfailedreason = $re['mfailedreason'];
                $match->mstatus = 2;
                $match->save();
                $log = new MatchLogEloquent();//給學生信件->none
                $log->mstatus = 2;
                $log->mid = $re['mid'];
                $log->save();
                if (MatchEloquent::count() != 0 && MatchLogEloquent::count() != 0) {
                    return '廠商拒絕媒合成功';
                } else {
                    return '廠商拒絕媒合失敗';
                }
            } else {
                return '流程錯誤';
            }

        } else {
            return '查無此媒合資料';
        }
    }

    public function companyAcceptResume_ser($re)
    {
        $match = MatchEloquent::where('mid', $re['mid'])->first();
        if ($re['mstatus'] == 1) {
            $status = 3;
        } else {
            $status = 6;
        }
        if ($match) {
            if ($match->mstatus == 1) {
                $match->mstatus = $status;
                $match->save();
                $log = new MatchLogEloquent();//給學生信件->是否接受面試
                $log->mstatus = $status;
                $log->mid = $re['mid'];
                $log->save();
                if (MatchEloquent::count() != 0 && $status == 6 && MatchLogEloquent::count() != 0) {
                    return '廠商直接錄取成功';
                } elseif (MatchEloquent::count() != 0 && $status == 3 && MatchLogEloquent::count() != 0) {
                    return '廠商接受面試成功';
                } else {
                    return '廠商接受面試失敗';
                }
            } else {
                return '流程錯誤';
            }

        } else {
            return '查無此媒合資料';
        }
    }

//
    public function companySendInterviewNotice_ser($re)
    {
        $match = MatchEloquent::where('mid', $re['mid'])->first();
        $user = User::where('id', $match->sid)->first();
        if ($match) {
            if ($match->mstatus == 3) {
                $interview = new Interviews($re);
                $interview->save();
                if (Interviews::count() != 0) {
                    $data = ['mail' => $user->mail, 'interview' => $interview];
                    dispatch(new sendInterviewNoticeMail($data));
                    return '成功';
                } else {
                    return '失敗';
                }
            } else {
                return '流程錯誤';
            }

        } else {
            return '查無此媒合資料';
        }
    }

    public function studentAcceptInterview_ser($re)
    {
        $match = MatchEloquent::where('mid', $re['mid'])->first();
        if ($re['mstatus'] == 1) {
            $status = 4;
        } else {
            $status = 5;
        }
        if ($match) {
            if ($match->mstatus == 3) {
                $match->mstatus = $status;
                $match->save();
                $log = new MatchLogEloquent();//給企業信件->none
                $log->mstatus = $status;
                $log->mid = $re['mid'];
                $log->save();
                if (MatchEloquent::count() != 0 && $status == 4 && MatchLogEloquent::count() != 0) {
                    return '接受面試成功';
                } elseif (MatchEloquent::count() != 0 && $status == 5 && MatchLogEloquent::count() != 0) {
                    return '拒絕面試成功';
                } else {
                    return '接受面試失敗';
                }
            } else {
                return '流程錯誤';
            }

        } else {
            return '查無此媒合資料';
        }
    }

//companyFailedInterview_ser
    public function companyFailedInterview_ser($re)
    {
        $match = MatchEloquent::where('mid', $re['mid'])->first();
        if ($match) {
            if ($match->mstatus == 4) {
                $match->mfailedreason = $re['mfailedreason'];
                $match->mstatus = 8;
                $match->save();
                $log = new MatchLogEloquent();//給學生信件->none
                $log->mstatus = 8;
                $log->mid = $re['mid'];
                $log->save();
                $user = User::where('id', $match->sid)->first();
                $data = ['mail' => $user->mail, 'mfailedreason' => $re['mfailedreason']];
                dispatch(new sendInterviewNoticeMail($data));
                if (MatchEloquent::count() != 0 && MatchLogEloquent::count() != 0) {
                    return '廠商通知學生未綠取成功';
                } else {
                    return '廠商通知學生未綠取失敗';
                }
            } else {
                return '流程錯誤';
            }

        } else {
            return '查無此媒合資料';
        }
    }

    //
    public function companyPassInterview_ser($re)
    {
        $match = MatchEloquent::where('mid', $re['mid'])->first();
        if ($match) {
            if ($match->mstatus == 4) {
                $match->mstatus = 7;
                $match->save();
                $log = new MatchLogEloquent();//給學生信件->選擇是否接受該份工作
                $log->mstatus = 7;
                $log->mid = $re['mid'];
                $log->save();
                if (MatchEloquent::count() != 0 && MatchLogEloquent::count() != 0) {
                    return '廠商通知學生綠取成功';
                } else {
                    return '廠商通知學生綠取失敗';
                }
            } else {
                return '流程錯誤';
            }

        } else {
            return '查無此媒合資料';
        }
    }

    //
    public function studentAcceptJob_ser($re)
    {
        $match = MatchEloquent::where('mid', $re['mid'])->first();
        if ($re['mstatus'] == 1) {
            $status = 9;
        } else {
            $status = 10;
        }
        if ($match) {
            if ($match->mstatus == 7) {
                $match->mstatus = $status;
                $match->save();
                $log = new MatchLogEloquent();//給企業信件->none
                $log->mstatus = $status;
                $log->mid = $re['mid'];
                $log->save();
                if (MatchEloquent::count() != 0 && $status == 9 && MatchLogEloquent::count() != 0) {
                    return '接受工作成功';
                } elseif (MatchEloquent::count() != 0 && $status == 10 && MatchLogEloquent::count() != 0) {
                    return '拒絕工作成功';
                } else {
                    return '接受面試失敗';
                }
            } else {
                return '流程錯誤';
            }

        } else {
            return '查無此媒合資料';
        }
    }

    //
    public function adminFillInTeacher_ser($re)
    {
        $match = MatchEloquent::where('mid', $re['mid'])->first();

        if ($match) {
            if ($match->mstatus == 9) {
                $match->mstatus = 11;
                $match->tid = $re['id'];
                $jobOp = Job_opening::where('joid', $match->joid)->first();
                $jobOp->jNOP -= 1;
                $jobOp->save();
                $match->save();
                $log = new MatchLogEloquent();//給企業信件->none
                $log->mstatus = 11;
                $log->mid = $re['mid'];
                $log->save();
                if (MatchEloquent::count() != 0 && MatchLogEloquent::count() != 0) {
                    return '選擇實習老師成功';
                } else {
                    return '選擇實習老師失敗';
                }
            } else {
                return '流程錯誤';
            }

        } else {
            return '查無此媒合資料';
        }
    }
}