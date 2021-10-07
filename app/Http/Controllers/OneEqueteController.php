<?php

namespace App\Http\Controllers;

use App\Models\answer;
use App\Models\question;
use App\Models\User;
use Illuminate\Http\Request;

class OneEqueteController extends Controller
{
    public function show($question){
        $qt = question::find($question);
        if($qt == null){
            return "deu ruim";
        }else{
            $anwsers = answer::all()->where("idQuestion", "=", $question);
            $user = User::find($qt->idUser);

            return view('enquete', [
                "question" => $qt,
                "answers" => $anwsers,
                "user" => $user->name,
            ]);
        }
        
        
    }
}
