<?php

namespace App\Http\Controllers;

use App\Models\answer;
use App\Models\question;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show(){
        $questions = question::all();
        $answers = answer::all();
        return view('welcom',[
            'questions' => $questions,
            'answers' => $answers,
        ]);
    }
    public function update(Request $request){
        $answer = answer::find($request->id);
        $answer->vote = $answer->vote + 1;
        $answer->save();

        $answers = answer::all()->where("idQuestion", "=", $answer->idQuestion);
        
        return $answers;
    }
}
