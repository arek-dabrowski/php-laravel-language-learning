<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Set;

class LearnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['mode', 'result']]);
    }

    public function mode(Request $request){
        $id = $request->input('current_id');
        $lang = $request->input('lang');
        $set = Set::find($id);
        if($set->hidden == 0 || (!Auth::guest() && $set->hidden == 1 && Auth::user()->role_id == 10) || (!Auth::guest() && $set->hidden == 2 && $set->user_id == Auth::user()->id)){
            if(isset($_POST['learn1'])){
                return view('sets.learn.learn')->with('set', $set)->with('lang',$lang)->with('test',0);
            }
            else if(isset($_POST['learnm'])){
                return view('sets.learn.multiple')->with('set', $set)->with('lang',$lang)->with('test',0);
            }
            else if(isset($_POST['flashcards'])){
                return view('sets.learn.flashcards')->with('set', $set)->with('lang',$lang)->with('test',0);
            }
            else{
                return view('sets.learn.learn')->with('set', $set)->with('lang',$lang)->with('test',1);
            }
        }
        else return redirect()->back()->with('error', 'Zestaw nie istnieje');
    }

    public function result(Request $request){
        $set = Set::find($request->input('set_id'));
        $result = $request->input('result');
        $NoW = $request->input('NoW');
        $isTest = $request->input('isTest');
        
        return view('sets.learn.result')->with('result', $result)->with('NoW', $NoW)->with('isTest', $isTest)->with('set', $set);
    }

}