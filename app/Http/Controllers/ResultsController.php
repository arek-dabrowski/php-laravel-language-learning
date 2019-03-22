<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Result;

class ResultsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $results = Result::where('user_id', '=', Auth::user()->id)->groupBy('set_id')->get();
        return view('results.index')->with('results',$results);
    }

    public function show($id){
        $results = Result::where([['user_id', '=', Auth::user()->id],['set_id','=',$id]])->orderBy('created_at', 'desc')->take(10)->get();
        if(count($results) == 0) return redirect('/results')->with('error','Nie wykonywałeś testu z tego zestawu');
        else return view('results.show')->with('results',$results);
    }

    public function store(Request $request){
        $this->validate($request, [
            'set_id' => 'required',
            'percentage' => 'required'
        ]);
        $result = new Result;
        $result->set_id = $request->input('set_id');
        $result->user_id = Auth::user()->id;
        $result->result = $request->input('percentage');
        $result->save();

        return redirect()->action('SetsController@show', ['id' => $request->input('set_id')])->with('success', 'Zapisano wynik');
    }
}