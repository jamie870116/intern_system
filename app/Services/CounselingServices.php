<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 2017/10/15
 * Time: 下午 09:19
 */

namespace App\Services;


use App\Com_basic;
use App\Counseling_result;
use App\Stu_course;
use App\User;
use Storage;

class CounselingServices
{

    public function getCounselingResultBySCid_ser($SCid){

        $CR=Counseling_result::where('SCid',$SCid)->first();
        if($CR){
            $sc=Stu_course::where('SCid',$SCid)->first();
            $stu=User::where('id',$sc->sid)->first();
            $com=Com_basic::where('c_account',$sc->c_account)->first();
            $CR->stuName=$stu->u_name;
            $CR->comAddress=$com->caddress;
            return $CR;
        }else{
            $sc=Stu_course::where('SCid',$SCid)->first();
            $stu=User::where('id',$sc->sid)->first();
            $com=Com_basic::where('c_account',$sc->c_account)->first();
            $cr=['stuName'=>$stu->u_name,'comAddress'=>$com->caddress];
            return $cr;
        }
    }

    public function createCounselingResultBySCid_ser($request){

        $re=$request->all();
        $CRs=Counseling_result::where('SCid',$re['SCid'])->first();
        if(!$CRs){
            $ff='';
            if(isset( $re['counselingText'])&&isset( $re['counselingPic']))
                return '請擇一填寫';
            $CR= new Counseling_result();
            $CR->SCid=$re['SCid'];
            $CR->counselingAddress=$re['counselingAddress'];
            $CR->counselingDate=$re['counselingDate'];
            $CR->cTeacherName=$re['cTeacherName'];
            $CR->counselingContent=$re['counselingContent'];
            if(isset( $re['counselingPic']))
                foreach ($re['counselingPic'] as $f){
                    if($f!=null){
                        $ff .= $f.',';
                    }
                }
            $CR->counselingPic=$ff;
            if(isset( $re['counselingText']))
                $CR->counselingPic=$re['counselingText'];


            $CR->save();
            return '新增業師輔導成果表成功';
        }else{
            return '已有業師輔導成果表資料';
        }

    }

    public function createCounselingResultPic_ser($request){

            $fn=array();
            if ($request->file('counselingPic')) {
                if ($request->hasFile('counselingPic')) {
                    foreach ($request->file('counselingPic') as $file){
                        $extension = $file->getClientOriginalExtension();
                        $file_name = strval(time()) . str_random(5) . '_cr.' . $extension;
                        $path = $file->storeAs(
                            'public/user-upload/CounselingResult/', $file_name
                        );
                        $fn[]='/CounselingResult/'. $file_name;
                        //<img src='storage/CounselingResult/1501257619SWUxK.png' >
                    }
                } else {
                    return "附檔上傳失敗";
                }
            }

            return $fn;
    }

    public function editCounselingResultBySCid_ser($request){

        $re=$request->all();
        $CR=Counseling_result::where('SCid',$re['SCid'])->first();
        if($CR){
            $ff='';
            if(isset( $re['counselingText'])&& isset( $re['counselingPic'])){
                if((($re['counselingText']!="") && ($re['counselingPic']!=""))||(($re['counselingText']=="") && ($re['counselingPic'][0]==null))){
                    return '請擇一填寫';
                }else{
                    $CR->counselingAddress=$re['counselingAddress'];
                    $CR->counselingDate=$re['counselingDate'];
                    $CR->cTeacherName=$re['cTeacherName'];
                    $CR->counselingContent=$re['counselingContent'];
                    $CR->counselingPic = $ff;
                    if(isset( $re['counselingPic']))
                        foreach ($re['counselingPic'] as $f){
                            if($f!=null){
                                $ff .= $f.',';
                            }
                        }
                    $CR->counselingPic=$ff;
                    if(isset( $re['counselingText']))
                        $CR->counselingPic=$re['counselingText'];
                    $CR->save();

                    return '修改業師輔導成果表成功';
                }
            }elseif( isset( $re['counselingPic'])){
                $CR->counselingAddress=$re['counselingAddress'];
                $CR->counselingDate=$re['counselingDate'];
                $CR->cTeacherName=$re['cTeacherName'];
                $CR->counselingContent=$re['counselingContent'];
                $CR->counselingPic = $ff;
                if(isset( $re['counselingPic']))
                    foreach ($re['counselingPic'] as $f){
                        if($f!=null){
                            $ff .= $f.',';
                        }
                    }
                $CR->counselingPic=$ff;
                if(isset( $re['counselingText']))
                    $CR->counselingPic=$re['counselingText'];
                $CR->save();

                return '修改業師輔導成果表成功';
            }else{
                $CR->counselingAddress=$re['counselingAddress'];
                $CR->counselingDate=$re['counselingDate'];
                $CR->cTeacherName=$re['cTeacherName'];
                $CR->counselingContent=$re['counselingContent'];
                $CR->counselingPic = $ff;
                if(isset( $re['counselingPic']))
                    foreach ($re['counselingPic'] as $f){
                        if($f!=null){
                            $ff .= $f.',';
                        }
                    }
                $CR->counselingPic=$ff;
                if(isset( $re['counselingText']))
                    $CR->counselingPic=$re['counselingText'];
                $CR->save();

                return '修改業師輔導成果表成功';
            }

//            return $re['counselingPic'][0];
        }else{
            return '找不到業師輔導成果表';
        }
    }

}