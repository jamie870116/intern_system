<?php

use Illuminate\Database\Seeder;
use App\Interviews_stu_questions as insQEloquent;
use App\Interviews_com_questions as incQEloquent;

class qustionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sq1=insQEloquent::create([
            'insQuestion'=>'您感覺實習員對實習機構給予的實習訓練與輔導，是否落實而滿意?',
            'insQuestionVer'=>1,
        ]);
        $sq2=insQEloquent::create([
            'insQuestion'=>'與實習員訪談後，感受到其對實習工作的滿意度如何?',
            'insQuestionVer'=>1,
        ]);
        $sq3=insQEloquent::create([
            'insQuestion'=>'實習員談到工作時，其積極參與的程度如何?',
            'insQuestionVer'=>1,
        ]);
        $sq4=insQEloquent::create([
            'insQuestion'=>'實習員與您的交談、溝通及互動情形?',
            'insQuestionVer'=>1,
        ]);
        $sq5=insQEloquent::create([
            'insQuestion'=>'實習員對於實習機構給予的輔導瞭解程度如何?',
            'insQuestionVer'=>1,
        ]);
        $sq6=insQEloquent::create([
            'insQuestion'=>'實習員對於工作量是否合理?',
            'insQuestionVer'=>1,
        ]);
        $sq7=insQEloquent::create([
            'insQuestion'=>'實習員對於工作中與主管、同事相處情形?',
            'insQuestionVer'=>1,
        ]);
        $sq8=insQEloquent::create([
            'insQuestion'=>'實習員對企業實習，是否滿意?',
            'insQuestionVer'=>1,
        ]);

//
        $cq1=incQEloquent::create([
            'insCQuestion'=>'您感覺實習機構提供實習員實習環境，是否滿意?',
            'insCQuestionVer'=>1,
        ]);
        $cq2=incQEloquent::create([
            'insCQuestion'=>'您感覺實習機構對於實習員訓練與輔導，是否落實?',
            'insCQuestionVer'=>1,
        ]);
        $cq3=incQEloquent::create([
            'insCQuestion'=>'當您請實習機構協助推動實習事宜時，其配合程度?',
            'insCQuestionVer'=>1,
        ]);
        $cq4=incQEloquent::create([
            'insCQuestion'=>'當您與實習機構承辦人員的交談、溝通及互動，其態度如何?',
            'insCQuestionVer'=>1,
        ]);
        $cq5=incQEloquent::create([
            'insCQuestion'=>'實習機構未來是否會優先綠用本系畢業生，您感覺其意願程度?',
            'insCQuestionVer'=>1,
        ]);
        $cq6=incQEloquent::create([
            'insCQuestion'=>'實習機構提供之工作內容與簽約內容、所學是否符合?',
            'insCQuestionVer'=>1,
        ]);
        $cq7=incQEloquent::create([
            'insCQuestion'=>'實習機構是否安排值錢與在職訓練?',
            'insCQuestionVer'=>1,
        ]);
        $cq8=incQEloquent::create([
            'insCQuestion'=>'實習機構是否有工作不當之分配?',
            'insCQuestionVer'=>1,
        ]);
    }
}
