<?php

namespace App\Services;


use App\Job_opening as job_opEloquent;
use App\Jobs\sendResultmail;
use App\Jobs\sendResultmail_faild;
use App\User as userEloquent;
use Carbon\Carbon;
use JWTAuth;
use Log;

class JobopeningServices
{

    public function createJobOpening_ser($re)
    {
        $jobOpen = new job_opEloquent();
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $jobOpen->c_account = $user->account;
        $jobOpen->jtypes = $re['jtypes'];
        $jobOpen->jduties = $re['jduties'];
        $jobOpen->jdetails = $re['jdetails'];
        $jobOpen->jsalary_up = $re['jsalary_up'];
        $jobOpen->jsalary_low = $re['jsalary_low'];
        $jobOpen->jaddress = $re['jaddress'];
        $jobOpen->jdeadline = $re['jdeadline'];
        $jobOpen->jNOP = $re['jNOP'];
        $jobOpen->jcontact_name = $re['jcontact_name'];
        $jobOpen->jcontact_phone = $re['jcontact_phone'];
        $jobOpen->jcontact_email = $re['jcontact_email'];
//        $jobOpen->jdeadline =Carbon::parse($re['jdeadline'])->format('Y/m/d');
        $jobOpen->save();
        if (job_opEloquent::count() != 0) {
            return '新增職缺資料成功';
        } else {
            return '新增職缺資料失敗';
        }
    }

    public function editJobOpening_ser($re)
    {
        $jobOpen = job_opEloquent::where('joid', $re['joid'])->first();
        $jobOpen->jtypes = $re['jtypes'];
        $jobOpen->jduties = $re['jduties'];
        $jobOpen->jdetails = $re['jdetails'];
        $jobOpen->jsalary_up = $re['jsalary_up'];
        $jobOpen->jsalary_low = $re['jsalary_low'];
        $jobOpen->jaddress = $re['jaddress'];
        $jobOpen->jdeadline = $re['jdeadline'];
        $jobOpen->jNOP = $re['jNOP'];
        $jobOpen->jcontact_name = $re['jcontact_name'];
        $jobOpen->jcontact_phone = $re['jcontact_phone'];
        $jobOpen->jcontact_email = $re['jcontact_email'];
        $jobOpen->save();

        if (job_opEloquent::count() != 0) {
            return '修改職缺資料成功';
        } else {
            return '修改職缺資料失敗';
        }
    }

    public function deleteJobOpeningByAdmin_ser($re)
    {
        $jobOpen = job_opEloquent::where('joid', $re['joid'])->first();
        $jobOpen->jdelete_reason = $re['jdelete_reason'];

        $jobOpen->delete();

        if (job_opEloquent::count() != 0) {
            return '職缺已刪除';
        } else {
            return '職缺刪除失敗';
        }
    }

    public function deleteJobOpeningByCom_ser($re)
    {
        $jobOpen = job_opEloquent::where('joid', $re['joid'])->first();

        $jobOpen->delete();

        if (job_opEloquent::count() != 0) {
            return '職缺已刪除';
        } else {
            return '職缺刪除失敗';
        }
    }

    public function reviewJobOpening_ser($re)
    {
        $jobOpen = job_opEloquent::where('joid', $re['joid'])->first();
        $jobOpen->jstatus = $re['jstatus'];
        $jobOpen->save();

        $company = userEloquent::where('account', $jobOpen->c_account)->first();
        $mail = $company->email;
        $joid = $re['joid'];
        $data = ['mail' => $mail, 'contents' => $joid];
        if (job_opEloquent::count() != 0) {
            if ($re['jstatus'] == 1) {
                dispatch(new sendResultmail($data));
                return '職缺審核通過';
            } else {
                dispatch(new sendResultmail_faild($data));
                return '職缺審核未通過';
            }
        } else {
            return '職缺未審核';
        }
    }

    public function sortByTime_DESC($re)
    {

        $keyword = '%' . $re['keyword'] . '%';
        $jtypes = $re['jtypes'];
        $jsalary_lows = $re['jsalary_lows'];


        if ($re['keyword'] != null) {
            if ($jsalary_lows != null) {
                $jobOp = job_opEloquent::GetAll()->where('jsalary_low', '>=', $jsalary_lows)->ByTypes($jtypes);
                $jobOp = $jobOp->where('jduties', 'like', $keyword)->orWhere('jdetails', 'like', $keyword)->SortByUpdates_DESC()->paginate(12);
                if ($jobOp) {

                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            } else {
                $jobOp = job_opEloquent::GetAll()->ByTypes($jtypes);
                $jobOp = $jobOp->where('jduties', 'like', $keyword)->orWhere('jdetails', 'like', $keyword)->SortByUpdates_DESC()->paginate(12);
                if ($jobOp) {
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            }
        } else {
            if ($jsalary_lows != null) {
                $jobOp = job_opEloquent::GetAll()->where('jsalary_low', '>=', $jsalary_lows)->ByTypes($jtypes)->SortByUpdates_DESC()->paginate(12);
                if ($jobOp) {
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            } else {
                $jobOp = job_opEloquent::GetAll()->ByTypes($jtypes)->SortByUpdates_DESC()->paginate(12);
                if ($jobOp) {
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            }
        }
    }

    public function sortByTime_ASC($re)
    {

        $keyword = '%' . $re['keyword'] . '%';
        $jtypes = $re['jtypes'];
        $jsalary_lows = $re['jsalary_lows'];


        if ($re['keyword'] != null) {
            if ($jsalary_lows != null) {
                $jobOp = job_opEloquent::GetAll()->where('jsalary_low', '>=', $jsalary_lows)->ByTypes($jtypes);
                $jobOp = $jobOp->where('jduties', 'like', $keyword)->orWhere('jdetails', 'like', $keyword)->SortByUpdates_ASC()->paginate(12);
                if ($jobOp) {
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            } else {
                $jobOp = job_opEloquent::GetAll()->ByTypes($jtypes);
                $jobOp = $jobOp->where('jduties', 'like', $keyword)->orWhere('jdetails', 'like', $keyword)->SortByUpdates_ASC()->paginate(12);
                if ($jobOp) {
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            }
        } else {
            if ($jsalary_lows != null) {
                $jobOp = job_opEloquent::GetAll()->where('jsalary_low', '>=', $jsalary_lows)->ByTypes($jtypes)->SortByUpdates_ASC()->paginate(12);
                if ($jobOp) {
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            } else {
                $jobOp = job_opEloquent::GetAll()->ByTypes($jtypes)->SortByUpdates_ASC()->paginate(12);
                if ($jobOp) {
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            }
        }
    }

    public function sortBySalary_DESC($re)
    {

        $keyword = '%' . $re['keyword'] . '%';
        $jtypes = $re['jtypes'];
        $jsalary_lows = $re['jsalary_lows'];


        if ($re['keyword'] != null) {
            if ($jsalary_lows != null) {
                $jobOp = job_opEloquent::GetAll()->where('jsalary_low', '>=', $jsalary_lows)->ByTypes($jtypes);
                $jobOp = $jobOp->where('jduties', 'like', $keyword)->orWhere('jdetails', 'like', $keyword)->SortBySalary_DESC()->paginate(6);
                if ($jobOp) {
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            } else {
                $jobOp = job_opEloquent::GetAll()->ByTypes($jtypes);
                $jobOp = $jobOp->where('jduties', 'like', $keyword)->orWhere('jdetails', 'like', $keyword)->SortBySalary_DESC()->paginate(6);
                if ($jobOp) {
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            }
        } else {
            if ($jsalary_lows != null) {
                $jobOp = job_opEloquent::GetAll()->where('jsalary_low', '>=', $jsalary_lows)->ByTypes($jtypes)->SortBySalary_DESC()->paginate(6);
                if ($jobOp) {
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            } else {
                $jobOp = job_opEloquent::GetAll()->ByTypes($jtypes)->SortBySalary_DESC()->paginate(6);
                if ($jobOp) {
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            }
        }
    }

    public function sortBySalary_ASC($re)
    {

        $keyword = '%' . $re['keyword'] . '%';
        $jtypes = $re['jtypes'];
        $jsalary_lows = $re['jsalary_lows'];


        if ($re['keyword'] != null) {
            if ($jsalary_lows != null) {
                $jobOp = job_opEloquent::GetAll()->where('jsalary_low', '>=', $jsalary_lows)->ByTypes($jtypes);
                $jobOp = $jobOp->where('jduties', 'like', $keyword)->orWhere('jdetails', 'like', $keyword)->SortBySalary_ASC()->paginate(6);
                if ($jobOp) {
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            } else {
                $jobOp = job_opEloquent::GetAll()->ByTypes($jtypes);
                $jobOp = $jobOp->where('jduties', 'like', $keyword)->orWhere('jdetails', 'like', $keyword)->SortBySalary_ASC()->paginate(6);
                if ($jobOp) {
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            }
        } else {
            if ($jsalary_lows != null) {
                $jobOp = job_opEloquent::GetAll()->where('jsalary_low', '>=', $jsalary_lows)->ByTypes($jtypes)->SortBySalary_ASC()->paginate(6);
                if ($jobOp) {
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            } else {
                $jobOp = job_opEloquent::GetAll()->ByTypes($jtypes)->SortBySalary_ASC()->paginate(6);
                if ($jobOp) {
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            }
        }
    }
}