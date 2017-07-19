<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/7/19
 * Time: 下午 03:44
 */

namespace App\Services;
use App\Match as MatchEloquent;

class MatchServices
{
    public function resumeSubmitted_ser($re){
        $match= new MatchEloquent($re);
        $match->save();
        if (MatchEloquent::count() != 0) {
            return '新增媒合資料成功';
        } else {
            return '新增媒合資料失敗';
        }
    }

    public function refuseResume_ser($re){
        $match=MatchEloquent::where('mid',$re['mid'])->first();
        if($match){
            if($match->mstatus==1){
                $match->mfailedreason=$re['mfailedreason'];
                $match->mstatus=2;
                $match->save();
                if (MatchEloquent::count() != 0) {
                    return '拒絕媒合成功';
                } else {
                    return '拒絕媒合失敗';
                }
            }else{
                return '流程錯誤';
            }

        }else{
            return '查無此媒合資料';
        }
    }

    public function acceptResume_ser($re){
        $match=MatchEloquent::where('mid',$re['mid'])->first();
        if($re['mstatus']==1){
            $status=3;
        }else{
            $status=6;
        }
        if($match){
            if($match->mstatus==1){
                $match->mstatus=$status;
                $match->save();
                if (MatchEloquent::count() != 0) {
                    return '接受媒合成功，進行接下來的流程去吧';
                } else {
                    return '接受媒合失敗';
                }
            }else{
                return '流程錯誤';
            }

        }else{
            return '查無此媒合資料';
        }
    }

}