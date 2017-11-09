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

        return '新增心得成功';
    }

    public function editReview_ser($re){
        $review=Reviews::where('reId',$re['reId'])->first();
        if($review){
            if($review->reRead==0){
                $review->reContent=$re['reContent'];
                $review->save();

                return '修改心得成功';
            }else{
                return '老師已查閱，不能再作修改';
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
            if($review->reRead==0)
                $review->reRead=false;
            else
                $review->reRead=true;
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
            if($review->reRead==0)
                $review->reRead=false;
            else
                $review->reRead=true;
            return $review;
        }else{
            return '找不到此心得';
        }
    }

    public function teacherAccessReviewBySCid_ser($SCid){
        $review=Reviews::where('SCid',$SCid)->first();
        if($review){
            if($review->reContent==null||$review->reContent==""){

                return '學生尚未填寫，不能查閱';
            }else{
                if($review->reRead==0){
                    $review->reRead=1;
                    $review->save();
                    return '已查閱';
                }else{

                    return '已經查閱過了，不得重複';
                }
            }

        }else{
            return '找不到此心得';
        }

    }
}