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