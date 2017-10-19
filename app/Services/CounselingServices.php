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
            return $CR;
        }else{
            $sc=Stu_course::where('SCid',$SCid)->first();
            $stu=User::where('id',$sc->sid)->first();
            $com=Com_basic::where('c_account',$sc->c_account)->first();
            $cr=['stuName'=>$stu->u_name,'$comAddress'=>$com->caddress];
            return $cr;
        }
    }

    public function createCounselingResultBySCid_ser($request){

        $re=$request->all();
        $CR= new Counseling_result();
        if ($request->file('counselingPic')) {
            if ($request->hasFile('counselingPic')) {
                foreach ($request->file('counselingPic') as $file){
                    $extension = $file->getClientOriginalExtension();
                    $file_name = strval(time()) . str_random(5) . '_cr.' . $extension;
                    $path = $file->storeAs(
                        'public/CounselingResult/', $file_name
                    );
                    //<img src='storage/CounselingResult/1501257619SWUxK.png' >
                    $CR->counselingPic .= $file_name.',';
                }
            } else {
                return "附檔上傳失敗";
            }
        }
        $CR->SCid=$re['SCid'];
        $CR->counselingAddress=$re['counselingAddress'];
        $CR->counselingDate=$re['counselingDate'];
        $CR->cTeacherName=$re['cTeacherName'];
        $CR->counselingContent=$re['counselingContent'];
        if(isset($re['counselingPicContent'])){
            $CR->counselingPic .= $re['counselingPicContent'].',';
        }

        $CR->save();
        return '新增業師輔導成果表成功';
    }

    public function editCounselingResultBySCid($request){

        $re=$request->all();
        $CR=Counseling_result::where('SCid',$re['SCid'])->first();
        if($CR){
            if ($request->file('counselingPic')) {
                if ($request->hasFile('counselingPic')) {
                    if ($CR->anFile!=null) {
                        $files=explode(",",$CR->counselingPic);
                        foreach ($files as $f){
                            if($f!=null){
                                $file_path = 'public/CounselingResult/' . $f;
                                $l_file = Storage::exists('public/CounselingResult/' . $f);

//                                Log::error($f);

                                if ($l_file) {
                                    Storage::delete($file_path);
                                } else {
                                    return 'failed';
                                }
                            }
                        }
                    }
                    $CR->counselingPic="";
                    $CR->save();
                    foreach ($request->file('counselingPic') as $file){
                        $extension = $file->getClientOriginalExtension();
                        $file_name = strval(time()) . str_random(5) . '_cr.' . $extension;
                        $path = $file->storeAs(
                            'public/CounselingResult/', $file_name
                        );
                        //<img src='storage/user-upload/1501257619SWUxK.png' >
                        $CR->counselingPic .= $file_name.',';
                    }
                } else {
                    return "附檔上傳失敗";
                }
            }
            $CR->counselingAddress=$re['counselingAddress'];
            $CR->counselingDate=$re['counselingDate'];
            $CR->cTeacherName=$re['cTeacherName'];
            $CR->counselingContent=$re['counselingContent'];
            if(isset($re['counselingPicContent'])){
                $CR->counselingPic .= $re['counselingPicContent'].',';
            }
            $CR->save();

            return '修改業師輔導成果表成功';
        }else{
            return '找不到業師輔導成果表';
        }
    }

}