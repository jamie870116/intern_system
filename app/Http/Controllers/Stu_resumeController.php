<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ResumeServices as ResumeServices;

use Validator;


class Stu_resumeController extends Controller
{
    protected $ResumeServices;

    public function __construct(ResumeServices $ResumeServices)
    {
        $this->middleware('student');
        $this->ResumeServices = $ResumeServices;
    }

}
