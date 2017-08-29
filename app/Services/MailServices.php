<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/7/25
 * Time: 下午 02:01
 */

namespace App\Services;
use App\Job_opening;
use App\Match;
//use App\MatchLog as MatchLogEloquent;
use App\Station_Letter;
use App\User;
use JWTAuth;

class MailServices
{
    public function sendMail_ser($re){

        $token = JWTAuth::getToken();
        $users = JWTAuth::toUser($token);

        $mail= new Station_Letter();
        $mail->lRecipient=$re['lRecipient'];
        $mail->lTitle=$re['lTitle'];
        $mail->lContent=$re['lContent'];
        $mail->lSender=$users->account;

        $mail->save();
        return '送出信件成功';
    }

    public function replyMailById_ser($re){
        $token = JWTAuth::getToken();
        $users = JWTAuth::toUser($token);

        $oldMail=Station_Letter::where('slId',$re['slId'])->first();
        if($oldMail){
            $mail= new Station_Letter();
            $mail->lRecipient=$oldMail->lSender;
            $mail->lTitle='RE:['.$oldMail->lTitle.']';
            $mail->lContent=$re['lContent'];
            $mail->lSender=$users->account;

            $mail->save();
            return '回覆信件成功';
        }else{
            return '查無欲回覆之信件';
        }
    }

//    public function getMailDetails_ser($re)
//    {
//        $ml = MatchLogEloquent::where('logid', $re)->first();
//        if($ml){
//            $ml->read=true;
//            $ml->save();
//            $mid=$ml->mid;
//
//            $match=Match::where('mid',$mid)->first();
//            if($match){
//                $stu=User::where('id',$match->sid)->first();
//                $com=User::where('account',$match->c_account)->first();
//                $job=Job_opening::where('joid',$match->joid)->first();
//                if($stu && $com && $job){
//                    $token = JWTAuth::getToken();
//                    $users = JWTAuth::toUser($token);
//                    if($users->u_status==0){
//                        $response=array($stu->u_name,$com->u_name,$ml,$job);
//                        return $response;
//                    }else{
//                        $response=array($com->u_name,$stu->u_name,$ml,$job);
//                        return $response;
//                    }
//
//                }else{
//                    return '查無此信件資料';
//                }
//            }else{
//                return '查無此信件資料';
//            }
//        }else{
//            return '查無此信件資料';
//        }
//    }

    public function mailDeleted_ser($re){
        $ml = Station_Letter::where('slId', $re)->first();
        if($ml){

            $ml->delete();
            return '刪除信件成功';

        }else{
            return '查無此信件資料';
        }
    }

    public function mailForceDeleted_ser($re){
        $ml = Station_Letter::withTrashed()->where('slId', $re)->first();
        if($ml){

            $ml->forceDelete();
            return '永久刪除信件成功';

        }else{
            return '查無此信件資料';
        }
    }

     public function mailRestoreDeleted_ser($re){
        $ml = Station_Letter::onlyTrashed()->where('slId', $re)->first();
        if($ml){

            $ml->restore();
            return '回復刪除信件成功';

        }else{
            return '查無此信件資料';
        }
    }


    public function favouriteMail_ser($re){
        $ml = Station_Letter::where('slId', $re)->first();
        if($ml){
            if($ml->favourite==false){
                $ml->favourite=true;
                $ml->save();
                return '成功加入我的最愛';
            }else{
                $ml->favourite=false;
                $ml->save();
                return '成功取消加入我的最愛';
            }
        }else{
            return '查無此信件資料';
        }
    }
}