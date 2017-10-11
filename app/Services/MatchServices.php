<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/7/19
 * Time: 下午 03:44
 */

namespace App\Services;

use App\Com_basic;
use App\Interviews;
use App\Job_opening;
use App\Jobs\sendInterviewNoticeMail;
use App\Match as MatchEloquent;
use App\MatchLog as MatchLogEloquent;
use App\Station_Letter;
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
        $m = MatchEloquent::where('sid', $user->id)->where('joid', $re['joid'])->first();
        if (($m)&&($m->mstatus==2)||(!$m)) {
            $resume = stuBasicEloquent::where('sid', $user->id)->first();
            if ($resume->autobiography != null) {
                if($m){
                    if($m->mstatus==2){
                        $m->delete();
                    }
                }
                $match = new MatchEloquent();
                $match->joid = $re['joid'];

                $com = Job_opening::where('joid', $re['joid'])->first();
                $match->c_account = $com->c_account;
                $match->jduties = $com->jduties;
                $match->jdetails = $com->jdetails;
                $match->sid = $user->id;
                $match->save();
                $log = new MatchLogEloquent();//給企業信件->學生的履歷
                $log->mstatus = 1;
                $log->mid = $match->mid;
                $log->save();
                $st_letter = new Station_Letter();
                $st_letter->lStatus = 1;
                $st_letter->lRecipient = $com->c_account;
                $st_letter->lRecipientName = $com->c_name;
                $st_letter->lTitle = '學生 '.$user->u_name.'對您投出履歷';
                $st_letter->lContent = $user->u_name . '對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看';
                $st_letter->lNotes = $match->mid;
                $st_letter->save();
                return '學生送出媒合資料成功';
            } else {
                return '去填履歷再來吧';
            }

        } else {
            return '已經投過履歷囉';
        }

    }

    public function companyRejectResume_ser($re)
    {
        $token = JWTAuth::getToken();
        $com = JWTAuth::toUser($token);
        $match = MatchEloquent::where('mid', $re['mid'])->first();
        if ($match) {
            if ($match->mstatus == 1) {
                if (isset($re['mfailedreason'])){
                    $match->mfailedreason = $re['mfailedreason'];
                    $res=$re['mfailedreason'];
                }else{
                    $res='未填寫';
                }
                $match->mstatus = 2;
                $match->save();
                $log = new MatchLogEloquent();//給學生信件->none
                $log->mstatus = 2;
                $log->mid = $re['mid'];
                $log->save();

                $st_letter = new Station_Letter();
                $st_letter->lStatus = 2;
                $user = User::where('id', $match->sid)->first();
                $st_letter->lRecipient = $user->account;
                $st_letter->lRecipientName = $user->u_name;
                $st_letter->lTitle = $com->u_name.'履歷投遞結果';
                $comb=Com_basic::where('c_account',$com->account)->first();
                $st_letter->lContent = '您的履歷未被接受，故不需接受面試\n
                                        未被錄取原因: '.$res.'\n
                                        '.$com->u_name.'聯絡資訊如下:\n
                                        電話:'.$com->u_tel.'\n
                                        E-mail:'.$com->email.'\n
                                        住址:'.$comb->caddress.'\n';
                $st_letter->lNotes = '';
                $st_letter->save();
                return '廠商拒絕媒合成功';
            } else {
                return '流程錯誤';
            }

        } else {
            return '查無此媒合資料';
        }
    }

    public function companyAcceptResume_ser($re)
    {
        $token = JWTAuth::getToken();
        $com = JWTAuth::toUser($token);
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
                if ($status == 6) {
                    $st_letter = new Station_Letter();
                    $st_letter->lStatus = $status;//6
                    $user = User::where('id', $match->sid)->first();
                    $st_letter->lRecipient = $user->account;
                    $st_letter->lRecipientName = $user->u_name;
                    $st_letter->lTitle = $com->u_name.'履歷投遞結果';
                    $st_letter->lContent = '您已被'.$com->u_name.'直接錄取\n
                                            請點選下列按鈕回覆該企業是否到職\n';
                    $st_letter->lNotes = $re['mid'];
                    $st_letter->save();
                    return '廠商直接錄取成功';
                } elseif ($status == 3) {

                        $user = User::where('id', $match->sid)->first();
                        $interview = new Interviews($re);
                        $interview->save();
                        $dt = Carbon::parse($re['intime']);
                        $st_letter = new Station_Letter();
                        $st_letter->lStatus = $status;
                        $st_letter->lRecipient = $user->account;
                        $st_letter->lRecipientName = $user->u_name;
                        $st_letter->lTitle = $com->u_name.'邀請您前來面試';
                        $st_letter->lContent = '您的履歷已被接受，'.$com->u_name.'邀請您參加面試\n
                                        面試資訊如下:\n
                                        公司名稱:'.$com->u_name.'\n
                                        面試日期:'.$dt->format('Y-m-d') .'\n
                                        面試時間:'.$dt->format('h:i:s').'\n
                                        面試地點:'.$re['inaddress'].'\n
                                        聯絡人姓名:'.$re['jcontact_name'].'\n
                                        聯絡人電話:'.$re['jcontact_phone'].'\n
                                        聯絡人信箱:'.$re['jcontact_email'].'\n
                                        注意事項:'.$re['innotice'].'\n
                                        請點選下列按鈕回覆該企業是否接受面試\n';
                        $st_letter->lNotes =$re['mid'];
                        $st_letter->save();
                        $data = ['mail' => $user->mail, 'interview' => $interview];
                        dispatch(new sendInterviewNoticeMail($data));
                        return '廠商接受面試成功';
//                    $st_letter = new Station_Letter();
//                    $st_letter->lStatus = $status;//3
//                    $user = User::where('id', $match->sid)->first();
//                    $st_letter->lRecipient = $user->account;
//                    $st_letter->lRecipientName = $user->u_name;
//                    $st_letter->lTitle = $com->u_name.'履歷投遞結果';
//                    $st_letter->lContent = '您的履歷已被接受，'.$com->u_name.'邀請您參加面試\n
//                                            請點選下列按鈕回覆該企業是否接受面試\n';
//                    $st_letter->lNotes = '';
//                    $st_letter->save();

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
        $token = JWTAuth::getToken();
        $com = JWTAuth::toUser($token);
        $match = MatchEloquent::where('mid', $re['mid'])->first();
        $user = User::where('id', $match->sid)->first();
        if ($match) {
            if ($match->mstatus == 3) {
                $interview = new Interviews($re);
                $interview->save();
                $dt = Carbon::parse($re['intime']);
                $st_letter = new Station_Letter();
                $st_letter->lStatus = 12;//面試通知信
                $st_letter->lRecipient = $user->account;
                $st_letter->lRecipientName = $user->u_name;
                $st_letter->lTitle = $com->u_name.'邀請您前來面試';
                $st_letter->lContent = '您的履歷已被接受，'.$com->u_name.'邀請您參加面試\n
                                        面試資訊如下:\n
                                        公司名稱:'.$com->u_name.'\n
                                        面試日期:'.$dt->format('Y-m-d') .'\n
                                        面試時間:'.$dt->format('h:i:s').'\n
                                        面試地點:'.$re['inadress'].'\n
                                        聯絡人姓名:'.$re['jcontact_name'].'\n
                                        聯絡人電話:'.$re['jcontact_phone'].'\n
                                        聯絡人信箱:'.$re['jcontact_email'].'\n
                                        注意事項:'.$re['innotice'].'\n
                                        請點選下列按鈕回覆該企業是否接受面試\n';
                $st_letter->lNotes = $interview;
                $st_letter->save();
                $data = ['mail' => $user->mail, 'interview' => $interview];
                dispatch(new sendInterviewNoticeMail($data));
                return '成功';
            } else {
                return '流程錯誤';
            }

        } else {
            return '查無此媒合資料';
        }
    }

    public function studentAcceptInterview_ser($re)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
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

                $interview=Interviews::where('mid',$re['mid'])->first();
                $dt = Carbon::parse($interview->intime);
                if ($status == 4) {
                    $st_letter = new Station_Letter();
                    $st_letter->lStatus = $status;
                    $st_letter->lRecipient = $match->c_account;
                    $com=User::where('account', $match->c_account)->first();
                    $st_letter->lRecipientName = $com->u_name;
                    $st_letter->lTitle =$user->u_name. '面試意願結果';
                    $st_letter->lNotes =$match->mid;

                    $st_letter->lContent = $user->u_name.'願意接受面試\n
                                        面試資訊如下:\n
                                        公司名稱:'.$com->u_name.'\n
                                        面試日期:'.$dt->format('Y-m-d') .'\n
                                        面試時間:'.$dt->format('h:i:s').'\n
                                        面試地點:'.$interview->inadress.'\n
                                        聯絡人姓名:'.$interview->jcontact_name.'\n
                                        聯絡人電話:'.$interview->jcontact_phone.'\n
                                        聯絡人信箱:'.$interview->jcontact_email.'\n
                                        注意事項:'.$interview->innotice.'\n
                                        面試完畢後請點選下列按鈕回覆該學生是否通過面試\n';
                    $st_letter->save();
                    return '接受面試成功';
                } elseif ($status == 5) {
                    $st_letter = new Station_Letter();
                    $st_letter->lStatus = $status;
                    $st_letter->lRecipient = $match->c_account;
                    $st_letter->lRecipientName = User::where('account', $match->c_account)->first()->u_name;
                    $st_letter->lTitle = $user->u_name.'面試意願結果';
                    $st_letter->lContent = $user->u_name.'不願意接受面試\n';
                    $st_letter->lNotes =$match->mid;
                    $st_letter->save();
                    return '拒絕面試成功';
                } else {
                    return '接受面試失敗';
                }
            } else {
                return $match->mstatus;
            }

        } else {
            return '查無此媒合資料';
        }
    }

//companyFailedInterview_ser
    public function companyFailedInterview_ser($re)
    {
        $token = JWTAuth::getToken();
        $com = JWTAuth::toUser($token);
        $match = MatchEloquent::where('mid', $re['mid'])->first();
        if ($match) {
            if ($match->mstatus == 4) {
                if (isset($re['mfailedreason']))
                    $match->mfailedreason = $re['mfailedreason'];
                $match->mstatus = 8;
                $match->save();
                $log = new MatchLogEloquent();//給學生信件->none
                $log->mstatus = 8;
                $log->mid = $re['mid'];
                $log->save();
                $user = User::where('id', $match->sid)->first();

                if (isset($re['mfailedreason']))
                    $data = ['mail' => $user->mail, 'mfailedreason' => $re['mfailedreason']];
                else
                    $data = ['mail' => $user->mail, 'mfailedreason' => $re['mfailedreason']];
                dispatch(new sendInterviewNoticeMail($data));

                $st_letter = new Station_Letter();
                $st_letter->lStatus = 8;
                $st_letter->lRecipient = $user->account;
                $st_letter->lRecipientName = $user->u_name;
                $st_letter->lTitle = $com->u_name.'面試結果';
                $comb=Com_basic::where('c_account',$com->account)->first();
                $st_letter->lContent = '您未通過面試，未被'.$com->u_name.'錄取\n
                                        '.$com->u_name.'聯絡資訊如下:\n
                                        姓名:'.$user->u_name.'\n
                                        電話:'.$com->u_tel.'\n
                                        E-mail:'.$com->email.'\n
                                        住址:'.$comb->caddress.'\n';
                $st_letter->lNotes = $match->mid;
                $st_letter->save();

                return '廠商通知學生未綠取成功';
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
        $token = JWTAuth::getToken();
        $com = JWTAuth::toUser($token);
        $match = MatchEloquent::where('mid', $re['mid'])->first();
        if ($match) {
            if ($match->mstatus == 4) {
                $match->mstatus = 7;
                $match->save();
                $log = new MatchLogEloquent();//給學生信件->選擇是否接受該份工作
                $log->mstatus = 7;
                $log->mid = $re['mid'];
                $log->save();

                $user = User::where('id', $match->sid)->first();
                $st_letter = new Station_Letter();
                $st_letter->lStatus = 7;
                $st_letter->lRecipient = $user->account;
                $st_letter->lRecipientName = $user->u_name;
                $st_letter->lTitle =  $com->u_name.'面試結果';
                $st_letter->lContent = '您已通過面試，被'.$com->u_name.'錄取\n
                                        請點選下列按鈕回覆該企業是否到職\n';
                $st_letter->lNotes =$match->mid;
                $st_letter->save();
                return '廠商通知學生綠取成功';
            } else {
                return '流程錯誤';
            }

        } else {
            return '查無此媒合資料';
        }
    }

    public function companyResponseInterview_ser($re){
        $token = JWTAuth::getToken();
        $com = JWTAuth::toUser($token);
        $match = MatchEloquent::where('mid', $re['mid'])->first();
        if($re['mstatus']==1){
            $status=7; //pass
        }else{
            $status=8; //failed
        }
        if($match){
            if ($match->mstatus == 4) {
                if($status==7){
                    $match->mstatus = $status;
                    $match->save();
                    $log = new MatchLogEloquent();//給學生信件->選擇是否接受該份工作
                    $log->mstatus = 7;
                    $log->mid = $re['mid'];
                    $log->save();

                    $user = User::where('id', $match->sid)->first();
                    $st_letter = new Station_Letter();
                    $st_letter->lStatus = 7;
                    $st_letter->lRecipient = $user->account;
                    $st_letter->lRecipientName = $user->u_name;
                    $st_letter->lTitle =  $com->u_name.'面試結果';
                    $st_letter->lContent = '您已通過面試，被'.$com->u_name.'錄取\n
                                        請點選下列按鈕回覆該企業是否到職\n';
                    $st_letter->lNotes =$match->mid;
                    $st_letter->save();
                    return '廠商通知學生面試結果';
                }else{
                    if (isset($re['mfailedreason']))
                        $match->mfailedreason = $re['mfailedreason'];
                    $match->mstatus = 8;
                    $match->save();
                    $log = new MatchLogEloquent();//給學生信件->none
                    $log->mstatus = 8;
                    $log->mid = $re['mid'];
                    $log->save();
                    $user = User::where('id', $match->sid)->first();

                    if (isset($re['mfailedreason']))
                        $data = ['mail' => $user->mail, 'mfailedreason' => $re['mfailedreason']];
                    else
                        $data = ['mail' => $user->mail, 'mfailedreason' => $re['mfailedreason']];
                    dispatch(new sendInterviewNoticeMail($data));

                    $st_letter = new Station_Letter();
                    $st_letter->lStatus = 8;
                    $st_letter->lRecipient = $user->account;
                    $st_letter->lRecipientName = $user->u_name;
                    $st_letter->lTitle = $com->u_name.'面試結果';
                    $comb=Com_basic::where('c_account',$com->account)->first();
                    $st_letter->lContent = '您未通過面試，未被'.$com->u_name.'錄取\n
                                        '.$com->u_name.'聯絡資訊如下:\n
                                        姓名:'.$user->u_name.'\n
                                        電話:'.$com->u_tel.'\n
                                        E-mail:'.$com->email.'\n
                                        住址:'.$comb->caddress.'\n';
                    $st_letter->lNotes = $match->mid;
                    $st_letter->save();

                    return '廠商通知學生面試結果';
                }

            } else {
                return '流程錯誤';
            }
        }else{
            return '查無此媒合資料';
        }
    }

    //
    public function studentAcceptJob_ser($re)
    {
        $token = JWTAuth::getToken();
        $stu = JWTAuth::toUser($token);
        $match = MatchEloquent::where('mid', $re['mid'])->first();
        if ($re['mstatus'] == 1) {
            $status = 9;
        } else {
            $status = 10;
        }
        if ($match) {
            if ($match->mstatus == 7 || $match->mstatus == 6) {
                $match->mstatus = $status;
                $match->save();
                $log = new MatchLogEloquent();//給企業信件->none
                $log->mstatus = $status;
                $log->mid = $re['mid'];
                $log->save();


                if ($status == 9) {
                    $st_letter = new Station_Letter();
                    $st_letter->lStatus = $status;
                    $st_letter->lRecipient = $match->c_account;
                    $st_letter->lRecipientName = User::where('account', $match->c_account)->first()->u_name;
                    $st_letter->lTitle = $stu->u_name.'到職意願結果';
                    $st_letter->lContent = $stu->u_name.'已接受您的到職邀請\n';
                    $st_letter->lNotes =$match->mid;
                    $st_letter->save();
                    return '接受工作成功';
                } elseif ($status == 10) {
                    $st_letter = new Station_Letter();
                    $st_letter->lStatus = $status;
                    $st_letter->lRecipient = $match->c_account;
                    $st_letter->lRecipientName = User::where('account', $match->c_account)->first()->u_name;
                    $st_letter->lTitle = $stu->u_name.'到職意願結果';
                    $st_letter->lContent = $stu->u_name.'已拒絕您的到職邀請\n';
                    $st_letter->lNotes = $match->mid;
                    $st_letter->save();
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
//    public function adminFillInTeacher_ser($re)
//    {
//        $match = MatchEloquent::where('mid', $re['mid'])->first();
//
//        if ($match) {
//            if ($match->mstatus == 9) {
//                $match->mstatus = 11;
//                $match->tid = $re['id'];
//                $jobOp = Job_opening::where('joid', $match->joid)->first();
//                $jobOp->jNOP -= 1;
//                $jobOp->save();
//                $match->save();
//                $log = new MatchLogEloquent();//給企業信件->none
//                $log->mstatus = 11;
//                $log->mid = $re['mid'];
//                $log->save();
//                if (MatchEloquent::count() != 0 && MatchLogEloquent::count() != 0) {
//                    return '選擇實習老師成功';
//                } else {
//                    return '選擇實習老師失敗';
//                }
//            } else {
//                return '流程錯誤';
//            }
//
//        } else {
//            return '查無此媒合資料';
//        }
//    }
}