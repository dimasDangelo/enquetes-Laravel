<?php

namespace App\Http\Controllers;

use App\Models\answer;
use App\Models\question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnquetesController extends Controller
{
    public function show(){
        $questions = question::all()->where('idUser', '=', Auth::user()->id);
        $answers = answer::all();
        return view('dashboard',[
            'questions' => $questions,
            'answers' => $answers,
        ]);
    }
    public function create(Request $request){
        $questions = new question();
        $questions->question = $request->question;
        $questions->idUser = Auth::user()->id;
        $questions->save();

        foreach($request->answers as $answer){
            $ansInsert[] = [
                "answer" => $answer,
                "idQuestion" => $questions->id,
            ];
        }
        answer::insert($ansInsert);

        $request->session()->flash('alert-success', 'Enquete criada com sucesso!');
        return redirect()->route('dashboard');
    }
    public function delete(Request $request){
        $question = question::find($request->id);
        $question->delete();
        $request->session()->flash('alert-danger', 'Enquete Excluída com sucesso!');
        return redirect()->route('dashboard');
    }
    public function update(Request $request){
        $question = question::find($request->id);
        $question->question = $request->question;
        $question->save();
        answer::where("idQuestion", "=", $request->id)->delete();
        foreach($request->answers as $answer){
            $ansInsert[] = [
                "answer" => $answer,
                "idQuestion" => $request->id,
            ];
        }
        answer::insert($ansInsert);
        $request->session()->flash('alert-warning', 'Enquete Editada com sucesso!');
        return redirect()->route('dashboard');
        // return $answers;
    }

}
