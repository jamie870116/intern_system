<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Services\AnnouncementServices;
use Illuminate\Http\Request;
use Storage;
use Validator;

class AnnouncementController extends Controller
{
    protected $AnnouncementServices;

    public function __construct(AnnouncementServices $AnnouncementServices)
    {
        $this->middleware('admin', ['only' => 'createAnnouncement','editAnnouncement','deleteAnnouncement']);
        $this->AnnouncementServices = $AnnouncementServices;
    }

    //新增公告
    public function createAnnouncement(Request $request)
    {

        $objValidator = Validator::make($request->all(), array(
            'anTittle' => 'required',
            'anContent' => 'required',
            'anFile' => 'nullable',
        ), array(
            'anTittle.required' => '請輸入公告標題',
            'anContent.required' => '請輸入公告內容',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->AnnouncementServices->createAnnouncement_ser($request);
            if ($responses == '發布公告成功') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
    //修改公告
    public function editAnnouncement(Request $request)
    {

        $objValidator = Validator::make($request->all(), array(
            'anTittle' => 'required',
            'anId' => 'required|integer',
            'anContent' => 'required',
            'anFile' => 'nullable',
        ), array(
            'anTittle.required' => '請輸入公告標題',
            'anId.required' => '請輸入anId',
            'anContent.required' => '請輸入公告內容',
            'integer' => '請輸入integer',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->AnnouncementServices->editAnnouncement_ser($request);
            if ($responses == '修改公告成功') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //刪除公告
    public function deleteAnnouncement(Request $request)
    {
        $objValidator = Validator::make($request->all(), array(
            'anId' => 'required|integer',
        ), array(
            'anId.required' => '請輸入anId',
            'integer' => '請輸入integer',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->AnnouncementServices->deleteAnnouncement_ser($request);
            if ($responses == '刪除公告成功') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //取得公告
    public function getAnnouncement(){
        $announcement=Announcement::OrderByUpdated_DESC()->paginate(6);
        if($announcement){
            return response()->json($announcement, 200, [], JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json(['取得失敗'], 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //關鍵字搜尋公告
    public function getAnnouncementByKeywords(Request $request){

        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'keyword' => 'required',
        ), array(
            'keyword.required' => '請輸入anId',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $keyword = '%' . $re['keyword'] . '%';
            $announcement=Announcement::where('anTittle', 'like', $keyword)->orWhere('anContent', 'like', $keyword)->OrderByUpdated_DESC()->paginate(6);
            if($announcement){
                return response()->json($announcement, 200, [], JSON_UNESCAPED_UNICODE);
            }else{
                return response()->json(['取得失敗'], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //下載公告附檔
    public function downloadAnnouncementFileByFileName(Request $request){

        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'fileName' => 'required',
        ), array(
            'fileName.required' => '請輸入檔名',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        }else{
            $path = storage_path().'/'.'app/'.'public/announcement/'.$re['fileName'];
//        $file_path = 'public/user-upload/licences/example.docx';
            $l_file=Storage::exists($path);

            if(file_exists($path)){
//                $files = Storage::files('public/user-upload/licences');
                return response()->download($path);
            }else{
                return response()->json(array('下載失敗'), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
}
