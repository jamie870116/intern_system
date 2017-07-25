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
use App\MatchLog as MatchLogEloquent;
use App\User;

class MailServices
{
    public function getMailDetails_ser($re)
    {
        $ml = MatchLogEloquent::where('logid', $re)->first();
        if($ml){
            $ml->read=true;
            $ml->save();
            $mid=$ml->mid;

            $match=Match::where('mid',$mid)->first();
            if($match){
                $stu=User::where('id',$match->sid)->first();
                $com=User::where('account',$match->c_account)->first();
                $job=Job_opening::where('joid',$match->joid)->first();
                if($stu && $com && $job){
                    $response=array($stu->u_name,$com->u_name,$ml,$job);
                    return $response;
                }else{
                    return '查無此信件資料';
                }
            }else{
                return '查無此信件資料';
            }
        }else{
            return '查無此信件資料';
        }
    }

    public function mailDeleted_ser($re){
        $ml = MatchLogEloquent::where('logid', $re)->first();
        if($ml){

            $ml->delete();
            return '刪除信件成功';

        }else{
            return '查無此信件資料';
        }
    }

    public function favouriteMail_ser($re){
        $ml = MatchLogEloquent::where('logid', $re)->first();
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