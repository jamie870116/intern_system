<?php

use App\Com_basic;
use App\Stu_basic;
use Illuminate\Database\Seeder;
use App\User as UserEloquent;
use App\Interviews_stu_questions as insQEloquent;
use App\Interviews_com_questions as incQEloquent;
class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//'u_name', 'email', 'password','u_status','u_tel','u_uni'
//        $stu1=UserEloquent::create([
//            'id'=>1,
//    		'u_name'=>'吳玟憲',
//    		'u_tel'=>'0980365799',
//    		'account'=>'s1410331025',
//    		'u_status'=>0,
//    		'email'=>'s1410331025@nutc.edu.tw',
//    		'password'=>bcrypt('testtest'),
//            'started'=>1
//    		]);
//        $stu1b=Stu_basic::create([
//            'sid'=>1,
//            'chiName'=>'吳玟憲',
//            'engName'=>null,
//            'bornedPlace'=>null,
//            'birthday'=>null,
//            'gender'=>null,
//            'address'=>null,
//            'email'=>'s1410331025@nutc.edu.tw',
//            'contact'=>null,
//            'ES'=>0,
//            'ER'=>0,
//            'EW'=>0,
//            'TOEIC'=>0,
//            'TOEFL'=>0,
//            'autobiography'=>null,
//            'Oname'=>null,
//            'OS'=>0,
//            'OR'=>0,
//            'OW'=>0,
//            'graduateYear'=>null,
//            'graduatedSchool'=>null,
//            'department'=>null,
//            'section'=>null,
//            'profilePic'=>null,
//            'licenceFile'=>null,
//            'eTypes'=>0
//    		]);
//        $stu2=UserEloquent::create([
//            'id'=>2,
//    		'u_name'=>'張若翔',
//    		'u_tel'=>'0972012889',
//    		'account'=>'s1410331033',
//    		'u_status'=>0,
//    		'email'=>'s1410331033@nutc.edu.tw',
//    		'password'=>bcrypt('testtest'),
//            'started'=>1
//    		]);
//        $stu2b=Stu_basic::create([
//            'sid'=>2,
//            'chiName'=>'張若翔',
//            'engName'=>null,
//            'bornedPlace'=>null,
//            'birthday'=>null,
//            'gender'=>null,
//            'address'=>null,
//            'email'=>'s1410331033@nutc.edu.tw',
//            'contact'=>null,
//            'ES'=>0,
//            'ER'=>0,
//            'EW'=>0,
//            'TOEIC'=>0,
//            'TOEFL'=>0,
//            'autobiography'=>null,
//            'Oname'=>null,
//            'OS'=>0,
//            'OR'=>0,
//            'OW'=>0,
//            'graduateYear'=>null,
//            'graduatedSchool'=>null,
//            'department'=>null,
//            'section'=>null,
//            'profilePic'=>null,
//            'licenceFile'=>null,
//            'eTypes'=>0
//        ]);
//        $stu3=UserEloquent::create([
//            'id'=>3,
//    		'u_name'=>'陳復陞',
//    		'u_tel'=>'0972012889',
//    		'account'=>'s1410331037',
//    		'u_status'=>0,
//    		'email'=>'s1410331037@nutc.edu.tw',
//    		'password'=>bcrypt('testtest'),
//            'started'=>1
//    		]);
//        $stu3b=Stu_basic::create([
//            'sid'=>3,
//            'chiName'=>'陳復陞',
//            'engName'=>null,
//            'bornedPlace'=>null,
//            'birthday'=>null,
//            'gender'=>null,
//            'address'=>null,
//            'email'=>'s1410331037@nutc.edu.tw',
//            'contact'=>null,
//            'ES'=>0,
//            'ER'=>0,
//            'EW'=>0,
//            'TOEIC'=>0,
//            'TOEFL'=>0,
//            'autobiography'=>null,
//            'Oname'=>null,
//            'OS'=>0,
//            'OR'=>0,
//            'OW'=>0,
//            'graduateYear'=>null,
//            'graduatedSchool'=>null,
//            'department'=>null,
//            'section'=>null,
//            'profilePic'=>null,
//            'licenceFile'=>null,
//            'eTypes'=>0
//        ]);
//        $stu4=UserEloquent::create([
//            'id'=>4,
//    		'u_name'=>'林俊豪',
//    		'u_tel'=>'0972012889',
//    		'account'=>'s1110234016',
//    		'u_status'=>0,
//    		'email'=>'s1110234016@nutc.edu.tw',
//    		'password'=>bcrypt('testtest'),
//            'started'=>1
//    		]);
//        $stu4b=Stu_basic::create([
//            'sid'=>4,
//            'chiName'=>'林俊豪',
//            'engName'=>null,
//            'bornedPlace'=>null,
//            'birthday'=>null,
//            'gender'=>null,
//            'address'=>null,
//            'email'=>'s1110234016@nutc.edu.tw',
//            'contact'=>null,
//            'ES'=>0,
//            'ER'=>0,
//            'EW'=>0,
//            'TOEIC'=>0,
//            'TOEFL'=>0,
//            'autobiography'=>null,
//            'Oname'=>null,
//            'OS'=>0,
//            'OR'=>0,
//            'OW'=>0,
//            'graduateYear'=>null,
//            'graduatedSchool'=>null,
//            'department'=>null,
//            'section'=>null,
//            'profilePic'=>null,
//            'licenceFile'=>null,
//            'eTypes'=>0
//        ]);
//         $stu5=UserEloquent::create([
//             'id'=>5,
//    		'u_name'=>'黃立翔',
//    		'u_tel'=>'0972012889',
//    		'account'=>'s1310534025',
//    		'u_status'=>0,
//    		'email'=>'s1310534025@nutc.edu.tw',
//    		'password'=>bcrypt('testtest'),
//            'started'=>1
//    		]);
//        $stu5b=Stu_basic::create([
//            'sid'=>5,
//            'chiName'=>'黃立翔',
//            'engName'=>null,
//            'bornedPlace'=>null,
//            'birthday'=>null,
//            'gender'=>null,
//            'address'=>null,
//            'email'=>'s1310534025@nutc.edu.tw',
//            'contact'=>null,
//            'ES'=>0,
//            'ER'=>0,
//            'EW'=>0,
//            'TOEIC'=>0,
//            'TOEFL'=>0,
//            'autobiography'=>null,
//            'Oname'=>null,
//            'OS'=>0,
//            'OR'=>0,
//            'OW'=>0,
//            'graduateYear'=>null,
//            'graduatedSchool'=>null,
//            'department'=>null,
//            'section'=>null,
//            'profilePic'=>null,
//            'licenceFile'=>null,
//            'eTypes'=>0
//        ]);
//        $stu6=UserEloquent::create([
//            'id'=>6,
//    		'u_name'=>'林惠新',
//    		'u_tel'=>'0972012889',
//    		'account'=>'s1310534004',
//    		'u_status'=>0,
//    		'email'=>'s1310534004@nutc.edu.tw',
//    		'password'=>bcrypt('testtest'),
//            'started'=>1
//    		]);
//        $stu6b=Stu_basic::create([
//            'sid'=>6,
//            'chiName'=>'林惠新',
//            'engName'=>null,
//            'bornedPlace'=>null,
//            'birthday'=>null,
//            'gender'=>null,
//            'address'=>null,
//            'email'=>'s1310534004@nutc.edu.tw',
//            'contact'=>null,
//            'ES'=>0,
//            'ER'=>0,
//            'EW'=>0,
//            'TOEIC'=>0,
//            'TOEFL'=>0,
//            'autobiography'=>null,
//            'Oname'=>null,
//            'OS'=>0,
//            'OR'=>0,
//            'OW'=>0,
//            'graduateYear'=>null,
//            'graduatedSchool'=>null,
//            'department'=>null,
//            'section'=>null,
//            'profilePic'=>null,
//            'licenceFile'=>null,
//            'eTypes'=>0
//        ]);
//         $stu7=UserEloquent::create([
//             'id'=>7,
//    		'u_name'=>'張家銓',
//    		'u_tel'=>'0972012889',
//    		'account'=>'s1310534021',
//    		'u_status'=>0,
//    		'email'=>'s1310534021@nutc.edu.tw',
//    		'password'=>bcrypt('testtest'),
//            'started'=>1
//    		]);
//        $stu7b=Stu_basic::create([
//            'sid'=>7,
//            'chiName'=>'張家銓',
//            'engName'=>null,
//            'bornedPlace'=>null,
//            'birthday'=>null,
//            'gender'=>null,
//            'address'=>null,
//            'email'=>'s1310534021@nutc.edu.tw',
//            'contact'=>null,
//            'ES'=>0,
//            'ER'=>0,
//            'EW'=>0,
//            'TOEIC'=>0,
//            'TOEFL'=>0,
//            'autobiography'=>null,
//            'Oname'=>null,
//            'OS'=>0,
//            'OR'=>0,
//            'OW'=>0,
//            'graduateYear'=>null,
//            'graduatedSchool'=>null,
//            'department'=>null,
//            'section'=>null,
//            'profilePic'=>null,
//            'licenceFile'=>null,
//            'eTypes'=>0
//        ]);
//        $stu8=UserEloquent::create([
//            'id'=>8,
//    		'u_name'=>'林姿伸',
//    		'u_tel'=>'0972012889',
//    		'account'=>'s1310531005',
//    		'u_status'=>0,
//    		'email'=>'s1310531005@nutc.edu.tw',
//    		'password'=>bcrypt('testtest'),
//            'started'=>1
//    		]);
//        $stu8b=Stu_basic::create([
//            'sid'=>8,
//            'chiName'=>'林姿伸',
//            'engName'=>null,
//            'bornedPlace'=>null,
//            'birthday'=>null,
//            'gender'=>null,
//            'address'=>null,
//            'email'=>'s1310531005@nutc.edu.tw',
//            'contact'=>null,
//            'ES'=>0,
//            'ER'=>0,
//            'EW'=>0,
//            'TOEIC'=>0,
//            'TOEFL'=>0,
//            'autobiography'=>null,
//            'Oname'=>null,
//            'OS'=>0,
//            'OR'=>0,
//            'OW'=>0,
//            'graduateYear'=>null,
//            'graduatedSchool'=>null,
//            'department'=>null,
//            'section'=>null,
//            'profilePic'=>null,
//            'licenceFile'=>null,
//            'eTypes'=>0
//        ]);
//         $stu9=UserEloquent::create([
//             'id'=>9,
//    		'u_name'=>'施怡如',
//    		'u_tel'=>'0972012889',
//    		'account'=>'s1310531009',
//    		'u_status'=>0,
//    		'email'=>'s1310531009@nutc.edu.tw',
//    		'password'=>bcrypt('testtest'),
//            'started'=>1
//    		]);
//        $stu9b=Stu_basic::create([
//            'sid'=>9,
//            'chiName'=>'施怡如',
//            'engName'=>null,
//            'bornedPlace'=>null,
//            'birthday'=>null,
//            'gender'=>null,
//            'address'=>null,
//            'email'=>'s1310531009@nutc.edu.tw',
//            'contact'=>null,
//            'ES'=>0,
//            'ER'=>0,
//            'EW'=>0,
//            'TOEIC'=>0,
//            'TOEFL'=>0,
//            'autobiography'=>null,
//            'Oname'=>null,
//            'OS'=>0,
//            'OR'=>0,
//            'OW'=>0,
//            'graduateYear'=>null,
//            'graduatedSchool'=>null,
//            'department'=>null,
//            'section'=>null,
//            'profilePic'=>null,
//            'licenceFile'=>null,
//            'eTypes'=>0
//        ]);
//        $stu10=UserEloquent::create([
//    		'u_name'=>'王敬夫',
//    		'u_tel'=>'0972012889',
//    		'account'=>'s1110234014',
//    		'u_status'=>0,
//    		'email'=>'s1110234014@nutc.edu.tw',
//    		'password'=>bcrypt('testtest'),
//            'started'=>1
//    		]);
//        $stu10b=Stu_basic::create([
//            'sid'=>10,
//            'chiName'=>'王敬夫',
//            'engName'=>null,
//            'bornedPlace'=>null,
//            'birthday'=>null,
//            'gender'=>null,
//            'address'=>null,
//            'email'=>'s1110234014@nutc.edu.tw',
//            'contact'=>null,
//            'ES'=>0,
//            'ER'=>0,
//            'EW'=>0,
//            'TOEIC'=>0,
//            'TOEFL'=>0,
//            'autobiography'=>null,
//            'Oname'=>null,
//            'OS'=>0,
//            'OR'=>0,
//            'OW'=>0,
//            'graduateYear'=>null,
//            'graduatedSchool'=>null,
//            'department'=>null,
//            'section'=>null,
//            'profilePic'=>null,
//            'licenceFile'=>null,
//            'eTypes'=>0
//        ]);
//         $stu11=UserEloquent::create([
//             'id'=>11,
//    		'u_name'=>'許歆荷',
//    		'u_tel'=>'0972012889',
//    		'account'=>'s1110234006',
//    		'u_status'=>0,
//    		'email'=>'s1110234006@nutc.edu.tw',
//    		'password'=>bcrypt('testtest'),
//            'started'=>1
//    		]);
//        $stu11b=Stu_basic::create([
//            'sid'=>11,
//            'chiName'=>'許歆荷',
//            'engName'=>null,
//            'bornedPlace'=>null,
//            'birthday'=>null,
//            'gender'=>null,
//            'address'=>null,
//            'email'=>'s1110234006@nutc.edu.tw',
//            'contact'=>null,
//            'ES'=>0,
//            'ER'=>0,
//            'EW'=>0,
//            'TOEIC'=>0,
//            'TOEFL'=>0,
//            'autobiography'=>null,
//            'Oname'=>null,
//            'OS'=>0,
//            'OR'=>0,
//            'OW'=>0,
//            'graduateYear'=>null,
//            'graduatedSchool'=>null,
//            'department'=>null,
//            'section'=>null,
//            'profilePic'=>null,
//            'licenceFile'=>null,
//            'eTypes'=>0
//        ]);
//        $stu12=UserEloquent::create([
//            'id'=>12,
//    		'u_name'=>'張哲嘉',
//    		'u_tel'=>'0972012889',
//    		'account'=>'s1410331034',
//    		'u_status'=>0,
//    		'email'=>'s1410331034@nutc.edu.tw',
//    		'password'=>bcrypt('testtest'),
//            'started'=>1
//    		]);
//        $stu12b=Stu_basic::create([
//            'sid'=>12,
//            'chiName'=>'張哲嘉',
//            'engName'=>null,
//            'bornedPlace'=>null,
//            'birthday'=>null,
//            'gender'=>null,
//            'address'=>null,
//            'email'=>'s1410331034@nutc.edu.tw',
//            'contact'=>null,
//            'ES'=>0,
//            'ER'=>0,
//            'EW'=>0,
//            'TOEIC'=>0,
//            'TOEFL'=>0,
//            'autobiography'=>null,
//            'Oname'=>null,
//            'OS'=>0,
//            'OR'=>0,
//            'OW'=>0,
//            'graduateYear'=>null,
//            'graduatedSchool'=>null,
//            'department'=>null,
//            'section'=>null,
//            'profilePic'=>null,
//            'licenceFile'=>null,
//            'eTypes'=>0
//        ]);
//         $stu13=UserEloquent::create([
//             'id'=>13,
//    		'u_name'=>'王宏霖',
//    		'u_tel'=>'0972012889',
//    		'account'=>'s1410331020',
//    		'u_status'=>0,
//    		'email'=>'s1410331020@nutc.edu.tw',
//    		'password'=>bcrypt('testtest'),
//            'started'=>1
//    		]);
//        $stu13b=Stu_basic::create([
//            'sid'=>13,
//            'chiName'=>'王宏霖',
//            'engName'=>null,
//            'bornedPlace'=>null,
//            'birthday'=>null,
//            'gender'=>null,
//            'address'=>null,
//            'email'=>'s1410331020@nutc.edu.tw',
//            'contact'=>null,
//            'ES'=>0,
//            'ER'=>0,
//            'EW'=>0,
//            'TOEIC'=>0,
//            'TOEFL'=>0,
//            'autobiography'=>null,
//            'Oname'=>null,
//            'OS'=>0,
//            'OR'=>0,
//            'OW'=>0,
//            'graduateYear'=>null,
//            'graduatedSchool'=>null,
//            'department'=>null,
//            'section'=>null,
//            'profilePic'=>null,
//            'licenceFile'=>null,
//            'eTypes'=>0
//        ]);
//        $stu14=UserEloquent::create([
//            'id'=>14,
//    		'u_name'=>'王俊淵',
//    		'u_tel'=>'0972012889',
//    		'account'=>'s1410331021',
//    		'u_status'=>0,
//    		'email'=>'s1410331021@nutc.edu.tw',
//    		'password'=>bcrypt('testtest'),
//            'started'=>1
//    		]);
//        $stu14b=Stu_basic::create([
//            'sid'=>14,
//            'chiName'=>'王俊淵',
//            'engName'=>null,
//            'bornedPlace'=>null,
//            'birthday'=>null,
//            'gender'=>null,
//            'address'=>null,
//            'email'=>'s1410331021@nutc.edu.tw',
//            'contact'=>null,
//            'ES'=>0,
//            'ER'=>0,
//            'EW'=>0,
//            'TOEIC'=>0,
//            'TOEFL'=>0,
//            'autobiography'=>null,
//            'Oname'=>null,
//            'OS'=>0,
//            'OR'=>0,
//            'OW'=>0,
//            'graduateYear'=>null,
//            'graduatedSchool'=>null,
//            'department'=>null,
//            'section'=>null,
//            'profilePic'=>null,
//            'licenceFile'=>null,
//            'eTypes'=>0
//        ]);
//
//
//
//        $admin=UserEloquent::create([
//            'u_name'=>'系辦',
//            'u_tel'=>'0422115588',
//            'account'=>'admin123',
//            'u_status'=>3,
//            'email'=>'admin@mail.com',
//            'password'=>bcrypt('testtest'),
//            'started'=>1
//        ]);
//
//        $sq1=insQEloquent::create([
//            'insQuestion'=>'您感覺實習員對實習機構給予的實習訓練與輔導，是否落實而滿意?',
//            'insQuestionVer'=>1,
//            'insAnswerType'=>0,
//        ]);
//        $sq2=insQEloquent::create([
//            'insQuestion'=>'與實習員訪談後，感受到其對實習工作的滿意度如何?',
//            'insQuestionVer'=>1,
//            'insAnswerType'=>0,
//        ]);
//        $sq3=insQEloquent::create([
//            'insQuestion'=>'實習員談到工作時，其積極參與的程度如何?',
//            'insQuestionVer'=>1,
//            'insAnswerType'=>0,
//        ]);
//        $sq4=insQEloquent::create([
//            'insQuestion'=>'實習員與您的交談、溝通及互動情形?',
//            'insQuestionVer'=>1,
//            'insAnswerType'=>0,
//        ]);
//        $sq5=insQEloquent::create([
//            'insQuestion'=>'實習員對於實習機構給予的輔導瞭解程度如何?',
//            'insQuestionVer'=>1,
//            'insAnswerType'=>0,
//        ]);
//        $sq6=insQEloquent::create([
//            'insQuestion'=>'實習員對於工作量是否合理?',
//            'insQuestionVer'=>1,
//            'insAnswerType'=>0,
//        ]);
//        $sq7=insQEloquent::create([
//            'insQuestion'=>'實習員對於工作中與主管、同事相處情形?',
//            'insQuestionVer'=>1,
//            'insAnswerType'=>0,
//        ]);
//        $sq8=insQEloquent::create([
//            'insQuestion'=>'實習員對企業實習，是否滿意?',
//            'insQuestionVer'=>1,
//            'insAnswerType'=>1,
//        ]);
//
////
//        $cq1=incQEloquent::create([
//            'insCQuestion'=>'您感覺實習機構提供實習員實習環境，是否滿意?',
//            'insCQuestionVer'=>1,
//            'insCAnswerType'=>0,
//        ]);
//        $cq2=incQEloquent::create([
//            'insCQuestion'=>'您感覺實習機構對於實習員訓練與輔導，是否落實?',
//            'insCQuestionVer'=>1,
//            'insCAnswerType'=>0,
//        ]);
//        $cq3=incQEloquent::create([
//            'insCQuestion'=>'當您請實習機構協助推動實習事宜時，其配合程度?',
//            'insCQuestionVer'=>1,
//            'insCAnswerType'=>0,
//        ]);
//        $cq4=incQEloquent::create([
//            'insCQuestion'=>'當您與實習機構承辦人員的交談、溝通及互動，其態度如何?',
//            'insCQuestionVer'=>1,
//            'insCAnswerType'=>0,
//        ]);
//        $cq5=incQEloquent::create([
//            'insCQuestion'=>'實習機構未來是否會優先綠用本系畢業生，您感覺其意願程度?',
//            'insCQuestionVer'=>1,
//            'insCAnswerType'=>0,
//        ]);
//        $cq6=incQEloquent::create([
//            'insCQuestion'=>'實習機構提供之工作內容與簽約內容、所學是否符合?',
//            'insCQuestionVer'=>1,
//            'insCAnswerType'=>0,
//        ]);
//        $cq7=incQEloquent::create([
//            'insCQuestion'=>'實習機構是否安排值錢與在職訓練?',
//            'insCQuestionVer'=>1,
//            'insCAnswerType'=>0,
//        ]);
//        $cq8=incQEloquent::create([
//            'insCQuestion'=>'實習機構是否有工作不當之分配?',
//            'insCQuestionVer'=>1,
//            'insCAnswerType'=>0,
//        ]);
//
//
//        $com1=UserEloquent::create([
//    		'u_name'=>'工業技術研究院',
//    		'u_tel'=>'22112022',
//    		'account'=>'2750963',
//    		'u_status'=>2,
//    		'email'=>'mail@gmail.com',
//    		'password'=>bcrypt('testtest'),
//            'started'=>1
//    		]);
//        $com1b=Com_basic::create([
//    		'c_name'=>'工業技術研究院',
//    		'cfax'=>'22112022',
//    		'c_account'=>'2750963',
//    		'caddress'=>'新竹縣竹東鎮頭重里中興路4段195號',
//    		'ctypes'=>'Information',
//            'cdeleteReason'=>null,
//            'cintroduction'=>'',
//            'cempolyee_num'=>00,
//            'profilePic'=>null,
//    		]);
        $com2=UserEloquent::create([
    		'u_name'=>'宏碁雲端技術服務股份有限公司',
    		'u_tel'=>'22112022',
    		'account'=>'43162200',
    		'u_status'=>2,
    		'email'=>'mail2@gmail.com',
    		'password'=>bcrypt('testtest'),
            'started'=>1
    		]);
        $com2b=Com_basic::create([
    		'c_name'=>'宏碁雲端技術服務股份有限公司',
    		'cfax'=>'22112022',
    		'c_account'=>'43162200',
    		'caddress'=>'新竹縣竹東鎮頭重里中興路4段195號',
    		'ctypes'=>'Information',
            'cdeleteReason'=>null,
            'cintroduction'=>'',
            'cempolyee_num'=>00,
            'profilePic'=>null,
    		]);
        $com3=UserEloquent::create([
    		'u_name'=>'長安工程行',
    		'u_tel'=>'22112022',
    		'account'=>'99513636',
    		'u_status'=>2,
    		'email'=>'mail3@gmail.com',
    		'password'=>bcrypt('testtest'),
            'started'=>1
    		]);
        $com3b=Com_basic::create([
    		'c_name'=>'長安工程行',
    		'cfax'=>'22112022',
    		'c_account'=>'99513636',
    		'caddress'=>'臺南縣後壁鄉頂長村58號',
    		'ctypes'=>'Information',
            'cdeleteReason'=>null,
            'cintroduction'=>'',
            'cempolyee_num'=>00,
            'profilePic'=>null,
    		]);
        $com4=UserEloquent::create([
    		'u_name'=>'國興資訊',
    		'u_tel'=>'22112022',
    		'account'=>'52875138',
    		'u_status'=>2,
    		'email'=>'mail4@gmail.com',
    		'password'=>bcrypt('testtest'),
            'started'=>1
    		]);
        $com4b=Com_basic::create([
    		'c_name'=>'國興資訊',
    		'cfax'=>'22112022',
    		'c_account'=>'52875138',
    		'caddress'=>'台中市西區梅川西路一段23號',
    		'ctypes'=>'Information',
            'cdeleteReason'=>null,
            'cintroduction'=>'',
            'cempolyee_num'=>00,
            'profilePic'=>null,
    		]);
        $com5=UserEloquent::create([
    		'u_name'=>'創科資訊股份有限公司',
    		'u_tel'=>'22112022',
    		'account'=>'54891351',
    		'u_status'=>2,
    		'email'=>'mail5@gmail.com',
    		'password'=>bcrypt('testtest'),
            'started'=>1
    		]);
        $com5b=Com_basic::create([
    		'c_name'=>'創科資訊股份有限公司',
    		'cfax'=>'22112022',
    		'c_account'=>'54891351',
    		'caddress'=>'臺中市西區臺灣大道二段2號16F-1',
    		'ctypes'=>'Information',
            'cdeleteReason'=>null,
            'cintroduction'=>'',
            'cempolyee_num'=>00,
            'profilePic'=>null,
    		]);
        $com6=UserEloquent::create([
    		'u_name'=>'博科資訊',
    		'u_tel'=>'22112022',
    		'account'=>'80231876',
    		'u_status'=>2,
    		'email'=>'mail6@gmail.com',
    		'password'=>bcrypt('testtest'),
            'started'=>1
    		]);
        $com6b=Com_basic::create([
    		'c_name'=>'博科資訊',
    		'cfax'=>'22112022',
    		'c_account'=>'80231876',
    		'caddress'=>'臺中市 北屯區 松勇里 松明街68號1樓',
    		'ctypes'=>'Information',
            'cdeleteReason'=>null,
            'cintroduction'=>'本公司創始於1993年,以研發設計商用軟體及輔導客戶電腦化之商業活動為主.',
            'cempolyee_num'=>00,
            'profilePic'=>null,
    		]);
        $com7=UserEloquent::create([
    		'u_name'=>'遠景科技',
    		'u_tel'=>'22112022',
    		'account'=>'54239825',
    		'u_status'=>2,
    		'email'=>'mail7@gmail.com',
    		'password'=>bcrypt('testtest'),
            'started'=>1
    		]);
        $com7b=Com_basic::create([
    		'c_name'=>'遠景科技',
    		'cfax'=>'22112022',
    		'c_account'=>'54239825',
    		'caddress'=>'台中市北屯區文心路四段955號15樓之五',
    		'ctypes'=>'Information',
            'cdeleteReason'=>null,
            'cintroduction'=>'透過美國、亞太、歐洲、中東及非洲區的辦公室， 遠景科技協助世界頂尖的製造商快速地建構專屬的解決方案，並開創其物聯網商機；產業包括消費、商業及工業應用。遠景提供企業級、
            巨量資料分析的物聯網平台，以供應原始設備製造商減低客製化設備的建構風險與障礙，同時開創高經濟價值。',
            'cempolyee_num'=>00,
            'profilePic'=>null,
    		]);
        $com8=UserEloquent::create([
    		'u_name'=>'馥華生活股份有限公司',
    		'u_tel'=>'22112022',
    		'account'=>'24584004',
    		'u_status'=>2,
    		'email'=>'mail8@gmail.com',
    		'password'=>bcrypt('testtest'),
            'started'=>1
    		]);
        $com8b=Com_basic::create([
    		'c_name'=>'馥華生活股份有限公司',
    		'cfax'=>'22112022',
    		'c_account'=>'24584004',
    		'caddress'=>'台中市北屯區文心路三段447號13樓-1',
    		'ctypes'=>'Information',
            'cdeleteReason'=>null,
            'cintroduction'=>'電子商務網路購物平台',
            'cempolyee_num'=>00,
            'profilePic'=>null,
    		]);


       }
}
