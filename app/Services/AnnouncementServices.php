<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/8/21
 * Time: 上午 10:50
 */

namespace App\Services;


use App\Announcement;
use Log;
use Storage;

class AnnouncementServices
{

    public function uploadAnnouncementFile_ser($request){
        $fn=array();
        if ($request->file('anFile')) {
            if ($request->hasFile('anFile')) {
                foreach ($request->file('anFile') as $file){
                    $extension = $file->getClientOriginalExtension();
                    $file_name = strval(time()) . str_random(5) . '_an.' . $extension;
                    $path = $file->storeAs(
                        'public/announcement/', $file_name
                    );
                    $fn[]=$file_name;
                    //<img src='storage/announcement/1501257619SWUxK.png' >
                }
            } else {
                return "附檔上傳失敗";
            }
        }

        return $fn;
    }

    public function createAnnouncement_ser($request){

        $re = $request->all();

        $announcement=new Announcement();
        $ff='';
        if(isset($re['anFile'] )){
            foreach ($re['anFile'] as $f){
                if($f!=null){
                    $ff .= $f.',';
                }
            }
            $announcement->anFile=$ff;
        }

        str_replace(array("\r", "\n", "\r\n", "\n\r"), '',$re['anTittle']);
        $announcement->anTittle = $re['anTittle'];
        $announcement->anContent = $re['anContent'];
        $announcement->save();
        return '發布公告成功';

    }
    public function editAnnouncement_ser($request){

        $re = $request->all();

        $announcement=Announcement::where('anId',$re['anId'])->first();
        if($announcement){
//            if ($request->file('anFile')) {
//                if ($request->hasFile('anFile')) {
//                    if ($announcement->anFile!=null) {
//                        $files=explode(",",$announcement->anFile);
//                        foreach ($files as $f){
//                            if($f!=null){
//                                $file_path = 'public/announcement/' . $f;
//                                $l_file = Storage::exists('public/announcement/' . $f);
//
//                                Log::error($f);
//
//                                if ($l_file) {
//                                    Storage::delete($file_path);
//                                } else {
//                                    return 'failed';
//                                }
//                            }
//                        }
//                    }
//                    $announcement->anFile="";
//                    $announcement->save();
//                    foreach ($request->file('anFile') as $file){
//                        $extension = $file->getClientOriginalExtension();
//                        $file_name = strval(time()) . str_random(5) . '_an.' . $extension;
//                        $path = $file->storeAs(
//                            'public/announcement/', $file_name
//                        );
//                        //<img src='storage/user-upload/1501257619SWUxK.png' >
//                        $announcement->anFile .= $file_name.',';
//                    }
//                } else {
//                    return "附檔上傳失敗";
//                }
//            }
            str_replace(array("\r", "\n", "\r\n", "\n\r"), '',$re['anTittle']);
            $announcement->anTittle = $re['anTittle'];
            $announcement->anContent = $re['anContent'];
            $ff='';
            if(isset($re['anFile'] )){
                foreach ($re['anFile'] as $f){
                    if($f!=null){
                        $ff .= $f.',';
                    }
                }
                $announcement->anFile=$ff;
            }

            $announcement->save();
            return '修改公告成功';
        }else{
            return '查無此公告';
        }
    }

    public function deleteAnnouncement_ser($request){
        $re = $request->all();

        $announcement=Announcement::where('anId',$re['anId'])->first();
        if($announcement){
//            if ($announcement->anFile != null) {
//                $files=explode(",",$announcement->anFile);
//                foreach ($files as $f){
//                    if($f!=null){
//                        $file_path = 'public/announcement/' . $f;
//                        $l_file = Storage::exists('public/announcement/' . $f);
//
//                        Log::error($f);
//
//                        if ($l_file) {
//                            Storage::delete($file_path);
//                        } else {
//                            return 'failed';
//                        }
//                    }
//                }
//            }
            $announcement->delete();
            return '刪除公告成功';
        }else{
            return '查無此公告';
        }
    }
}