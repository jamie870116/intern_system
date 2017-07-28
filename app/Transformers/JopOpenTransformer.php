<?php

namespace App\Transformers;

use App\User;
use Carbon\Carbon;
use LukeVear\LaravelTransformer\AbstractTransformer;

class JopOpenTransformer extends AbstractTransformer
{
    /**
     * Transform the supplied data.
     *
     * @param User $model
     * @return array
     */
    public function run($model)
    {
        return [
            'jtypes' => $model->jtypes,//1，正職 2，工讀 3，暑期實習 4，學期實習
            'jduties' => $model->jduties,
            'jdetails' => $model->jdetails,
            'jcontact_name' => $model->jcontact_name,
            'jcontact_phone' => $model->jcontact_phone,
            'jcontact_email' => $model->jcontact_email,
            'jsalary_up' => $model->jsalary_up,
            'jsalary_low' =>$model->jsalary_low,
            'jaddress' => $model->jaddress,
            'jdeadline' => Carbon::parse($model->jdeadline)->format('Y/m/d'),
            'jNOP' => $model->jNOP,
        ];
    }
}