<?php
namespace App\Services;



use App\Reviews;
use App\Stu_course;
use App\User;

class ReviewsServices
{
    public function createReview_ser($re){
        $review=Reviews::create($re);
        $review->save();

        if(Reviews::count()!=0){
            return '新增心得成功';
        }else{
            return '新增心得失敗';
        }
    }

    public function editReview_ser($re){
        $review=Reviews::where('reId',$re['reId'])->first();
        if($review){
            $review->reContent=$re['reContent'];
            $review->save();

            if(Reviews::count()!=0){
                return '新增心得成功';
            }else{
                return '新增心得失敗';
            }
        }else{
            return '找不到此心得';
        }
    }

    public function getReviewByReId_ser($reId){
        $review=Reviews::where('reId',$reId)->first();
        if($review){
            $SCid=$review->SCid;
            $sc=Stu_course::where('SCid',$SCid)->first();
            $stu=User::where('id',$sc->sid)->first();
            $review->stu_name=$stu->u_name;
                return $review;
        }else{
            return '找不到此心得';
        }
    }
    //
    public function getReviewBySCid_ser($SCid){
        $review=Stu_course::find($SCid)->reviews()->first();
        if($review){
            $sc=Stu_course::where('SCid',$SCid)->first();
            $stu=User::where('id',$sc->sid)->first();
            $review->stu_name=$stu->u_name;
            return $review;
        }else{
            return '找不到此心得';
        }
    }
}