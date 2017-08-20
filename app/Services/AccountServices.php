<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 2017/8/19
 * Time: 下午 03:02
 */

namespace App\Services;


use App\Jobs\SendAccountDisabledMail;
use App\Jobs\sendResultmail;
use App\Jobs\sendResultmail_faild;
use App\User;
use App\Stu_basic as stuBasicEloquent;
use App\Stu_jExp as stuJExpEloquent;

use App\Stu_works as stuWorksEloquent;
use App\Stu_ability as stuAbilityEloquent;

use Log;

class AccountServices
{
    public function adminGetStudentResumeById_ser($id)
    {
        $stu=User::where('id',$id)->first();
        if($stu){
            if($stu->u_status==0){
                $stuBas = stuBasicEloquent::where('sid', $id)->first();
                $stuJExp = stuJExpEloquent::where('sid', $id)->get();
                $stuWor = stuWorksEloquent::where('sid', $id)->get();
                $stuA=stuAbilityEloquent::where('sid', $id)->get();
                $stdRe = array('stu_basic'=>$stuBas,'stu_jobExperience'=> $stuJExp,'stu_works'=> $stuWor,'stu_ability'=>$stuA);
                return $stdRe;
            }else{
                return '此id不是學生';
            }
        }else{
            return 'Id不存在';
        }
    }
    public function adminGetCompanyDetailsByAccount_ser($id){
        $com=User::findOrFail($id)->company;
        if($com){
            return $com;
        }else{
            return 'Id不正確';
        }
    }

    public function adminReviewCompanyById_ser($re){
        $com=User::where('id',$re['id'])->first();
        if($com){
            if($com->u_status==2){
                if($com->started=='2'){
                    if($re['result']==1){
                        $com->started=1;
                        $com->save();
                        $data = ['mail'=>$com->email, 'u_name'=>$com->u_name];
                        dispatch(new sendResultmail($data));
                        return '審核通過成功';
                    }else{
                        $com->starded=3;
                        $com->save();
                        $data = ['mail'=>$com->email, 'u_name'=>$com->u_name];
                        dispatch(new sendResultmail_faild($data));
                        return '審核不通過成功';
                    }
                }elseif($com->started==1){
                    return '此id已啟用';
                }elseif($com->started==3){
                    return '此id已遭停用';
                }else{
                    return 'error';
                }
            }else{
                return '此id不是廠商';
            }

        }else{
            return 'Id不存在';
        }
    }

    public function adminDisableUserById_ser($id){
        $user=User::where('id',$id)->first();
        if($user){
            if($user->u_status!=4){
                if($user->started!=3){
                    $user->started=3;
                    $user->save();

                    $data = ['mail'=>$user->email, 'u_name'=>$user->u_name];
                    dispatch(new SendAccountDisabledMail($data));

                    return '停用成功';
                }else{
                    return '此id已遭停用';
                }
            }else{
                return '此id為最高管理者帳號不得停用';
            }

        }else{
            return 'Id不存在';
        }
    }

    public function adminReEnableUserById_ser($id){
        $user=User::where('id',$id)->first();
        if($user){
            if($user->started==3){
                $user->started=1;
                $user->save();
                return '重新啟用成功';
            }else{
                return '此id未遭停用';
            }
        }else{
            return 'Id不存在';
        }
    }

}