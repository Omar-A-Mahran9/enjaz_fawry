<?php

use Illuminate\Database\Seeder;
use App\CommonQuestion;


class CommonQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $commonQuestion = new CommonQuestion;
        $commonQuestion->question = 'سؤال واحد تست';
        $commonQuestion->answer = 'اجابة السؤال الاول اجابة السؤال الاول اجابة السؤال الاول اجابة السؤال الاول اجابة السؤال الاول اجابة السؤال الاول';
        $commonQuestion->sorting_number = 1;
        $commonQuestion->status = 1;
        $commonQuestion->save();

        $commonQuestion2 = new CommonQuestion;
        $commonQuestion2->question = 'سؤال اثنين تست';
        $commonQuestion2->answer = 'اجابة السؤال اثنين اجابة السؤال اثنين اجابة السؤال اثنين اجابة السؤال اثنين اجابة السؤال اثنين اجابة السؤال اثنين';
        $commonQuestion2->sorting_number = 2;
        $commonQuestion2->status = 1;
        $commonQuestion2->save();


        $commonQuestion3 = new CommonQuestion;
        $commonQuestion3->question = 'سؤال ثلاثة تست';
        $commonQuestion3->answer = 'اجابة السؤال ثلاثة اجابة السؤال ثلاثة اجابة السؤال ثلاثة اجابة السؤال ثلاثة اجابة السؤال ثلاثة اجابة السؤال ثلاثة';
        $commonQuestion3->sorting_number = 3;
        $commonQuestion3->status = 1;
        $commonQuestion3->save();
        
        
    
    }
}
