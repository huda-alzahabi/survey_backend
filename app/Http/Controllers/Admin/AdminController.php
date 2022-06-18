<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;
use App\Models\Option;

class AdminController extends Controller
{
    public function addSurvey(Request $request){
        $survey = new Survey;
        $survey->title = $request->title;
        $survey->save();

        $question_count=$request->question_count;

        for ($x = 0; $x <$question_count ; $x++) {

            $questions=$request->questions;
            $question_arr=explode(',',$questions);
            $question=new Question;
            $question->text=$question_arr[$x];
            $question->survey_id=$survey->id;
            $question->question_type = $request->question_type;
            $question->save();

        }

        $option_count=$request->option_count;

        for ($x = 0; $x <$option_count ; $x++) {

            $options=$request->options;
            $option_arr=explode(',',$options);
            $myoption=new Option;
            $myoption->value=$option_arr[$x];
            $myoption->question_id=$question->id;
            $myoption->save();
        }

        return response()->json([
            "status" => "Success",
            "survey" => $survey,
            "question" => $question,
            "options"=> $myoption
        ], 200);
    }
}