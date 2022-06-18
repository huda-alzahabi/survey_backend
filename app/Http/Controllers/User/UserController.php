<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;
use App\Models\Option;
use App\Models\Answer;

class UserController extends Controller
{
    public function getSurveyById(Request $request){

        $questions= Question::where("survey_id",$request->survey_id)->get();

        $optionsarr=array();

        foreach ($questions as $question){
            $options=Option::where("question_id",$question->id)->get();
            array_push($optionsarr,$options);
        }

        return response()->json([
            "status" => "Success",
            "questions" => $questions,
           "options" => $optionsarr
        ], 200);

    }

    public function submitAnswer(Request $request){
        $answer = new Answer;
        $answer->text = $request->answer;
        $answer->question_id=$request->question_id;
        $answer->user_id=$request->user_id;
        $answer->survey_id=$request->survey_id;
        $answer->save();

        return response()->json([
            "status" => "Success",
            "answer" => $answer
        ], 200);

    }
}