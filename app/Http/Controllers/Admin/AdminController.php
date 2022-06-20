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

        $questions=$request->items;
        $question_count=count($questions);

        for ($x = 0; $x <$question_count ; $x++) {

            $question=new Question;
            $question->text=$questions[$x]["question"];
            $question->survey_id=$survey->id;
            $question->question_type = $questions[$x]["type"];

            $question->save();

            $options=$questions[$x]["options"];
            $option_count=count($options);

            for ($i = 0; $i <$option_count ; $i++) {
                $myoption=new Option;
                $myoption->value=$options[$i];
                $myoption->question_id=$question->id;
                $myoption->save();

            }
        }

        return response()->json([
            "status" => "Success",
            "survey" => $survey,
            "question" => $question,
            "options"=> $myoption
        ], 200);
    }
}