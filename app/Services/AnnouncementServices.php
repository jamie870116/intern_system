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
    public function createAnnouncement_ser($request){

        $re = $request->all();

        $announcement=new Announcement();
        if ($request->file('anFile')) {
            if ($request->hasFile('anFile')) {
               foreach ($request->file('anFile') as $file){
                   $extension = $file->getClientOriginalExtension();
                   $file_name = strval(time()) . str_random(5) . '_an.' . $extension;
                   $path = $file->storeAs(
                       'public/announcement/', $file_name
                   );
                   //<img src='storage/user-upload/1501257619SWUxK.png' >
                   $announcement->anFile .= $file_name.',';
               }
            } else {
                return "附檔上傳失敗";
            }
        }
        $announcement->anTittle = $re['anTittle'];
        $announcement->anContent = $re['anContent'];
        $announcement->save();
        if(Announcement::count()!=0){
            return '發布公告成功';
        }else{
            return '發布公告失敗';
        }

    }
    public function editAnnouncement_ser($request){

        $re = $request->all();

        $announcement=Announcement::where('anId',$re['anId'])->first();
        if($announcement){
            if ($request->file('anFile')) {
                if ($request->hasFile('anFile')) {
                    if ($announcement->anFile!=null) {
                        $files=explode(",",$announcement->anFile);
                        foreach ($files as $f){
                            if($f!=null){
                                $file_path = 'public/announcement/' . $f;
                                $l_file = Storage::exists('public/announcement/' . $f);

                                Log::error($f);

                                if ($l_file) {
                                    Storage::delete($file_path);
                                } else {
                                    return 'failed';
                                }
                            }
                        }
                    }
                    $announcement->anFile="";
                    $announcement->save();
                    foreach ($request->file('anFile') as $file){
                        $extension = $file->getClientOriginalExtension();
                        $file_name = strval(time()) . str_random(5) . '_an.' . $extension;
                        $path = $file->storeAs(
                            'public/announcement/', $file_name
                        );
                        //<img src='storage/user-upload/1501257619SWUxK.png' >
                        $announcement->anFile .= $file_name.',';
                    }
                } else {
                    return "附檔上傳失敗";
                }
            }
            $announcement->anTittle = $re['anTittle'];
            $announcement->anContent = $re['anContent'];
            $announcement->save();
            if(Announcement::count()!=0){
                return '修改公告成功';
            }else{
                return '修改公告失敗';
            }
        }else{
            return '查無此公告';
        }
    }

    public function deleteAnnouncement_ser($request){
        $re = $request->all();

        $announcement=Announcement::where('anId',$re['anId'])->first();
        if($announcement){
            if ($announcement->anFile != null) {
                $files=explode(",",$announcement->anFile);
                foreach ($files as $f){
                    if($f!=null){
                        $file_path = 'public/announcement/' . $f;
                        $l_file = Storage::exists('public/announcement/' . $f);

                        Log::error($f);

                        if ($l_file) {
                            Storage::delete($file_path);
                        } else {
                            return 'failed';
                        }
                    }
                }
            }
            $announcement->delete();
            return '刪除公告成功';
        }else{
            return '查無此公告';
        }
    }
}