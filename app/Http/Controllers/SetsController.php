<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Set;
use App\Authorization;

class SetsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(){
        return redirect('/category');
    }

    public function show($id){
        $set = Set::find($id);
        if($set->hidden == 0){
            return view('sets.show')->with('set', $set);
        }
        else if(!Auth::guest() && $set->hidden == 1 && Auth::user()->role_id == 10){
            return view('sets.show')->with('set', $set);
        }
        else if(!Auth::guest() && $set->hidden == 2 && $set->user_id == Auth::user()->id){
            return view('sets.show')->with('set', $set);
        }
        else return redirect()->back()->with('error', 'Zestaw nie istnieje');
    }

    public function create(Request $request){
        $id = $request->input('current_id');
        if(isset($_POST['priv'])){
            $hidden = $request->input('phidden');
        }
        else $hidden = $request->input('hidden');
        return view('sets.create')->with('id', $id)->with('hidden',$hidden);
    }

    public function store(Request $request){
        $this->validate($request, [
            'word1.*' => 'required',
            'word2.*' => 'required',
            'name' => 'required',
            'subcategory_id' => 'required',
            'lang' => 'required',
            'hidden' => 'required',
        ]);

        $set = new Set;
        $elems = count($request->input(['word1']));
        $array = array();
        if($request->input('lang') == 1){
            $words1 = $request->input(['word1']);
            $words2 = $request->input(['word2']);
        }
        else{
            $words1 = $request->input(['word2']);
            $words2 = $request->input(['word1']);
        }
        for($i = 0; $i < $elems; $i++){
            $array[] = strtolower($words1[$i]);
            $array[] = strtolower($words2[$i]);
        }
        $setted = implode(";",$array);
        $set->name = $request->input('name');
        $set->hidden = $request->input('hidden');
        $set->subcategory_id = $request->input('subcategory_id');
        $set->set = $setted;
        $set->user_id = Auth::user()->id;
        $set->language1_id = 1;
        $set->language2_id = 2;   
        $set->save();
        
        return redirect()->action('SubcategoriesController@show', ['id' => $request->input('subcategory_id')])->with('success', 'Dodano zestaw');
    }

    public function edit($id){
        $set = Set::find($id);
        if(!is_null($set)){
            if(!Auth::guest() && $set->hidden == 2 && $set->user_id == Auth::user()->id){
                return view('sets.edit')->with('set', $set);
            }
            $auth = Authorization::where([['user_id','=', Auth::user()->id],['subcategory_id','=',$set->subcategory_id]])->get();
            if(Auth::guest() || Auth::user()->role_id != 10){
                if((Auth::user()->role_id != 3) || (count($auth) == 0)){
                    if((Auth::user()->role_id != 2) || (Auth::user()->id != $set->user_id) || (count($auth) == 0)){
                        return redirect()->action('SubcategoriesController@show', ['id' => $set->subcategory_id])->with('error', 'Nie masz uprawnień do przeglądania tej strony');
                    }
                }
            }
            return view('sets.edit')->with('set', $set);    
        }
        return redirect('/category')->with('error', 'Nie można edytować nieistniejącgo zestawu');
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'word1.*' => 'required',
            'word2.*' => 'required',
            'name' => 'required',
            'lang' => 'required',
        ]);
        
        $set = Set::find($id);
        $elems = count($request->input(['word1']));
        $array = array();
        if($request->input('lang') == 1){
            $words1 = $request->input(['word1']);
            $words2 = $request->input(['word2']);
        }
        else{
            $words1 = $request->input(['word2']);
            $words2 = $request->input(['word1']);
        }
        for($i = 0; $i < $elems; $i++){
            $array[] = strtolower($words1[$i]);
            $array[] = strtolower($words2[$i]);
        }
        $setted = implode(";",$array);
        $set->name = $request->input('name');
        $set->set = $setted;
        $set->save();
        
        return redirect()->action('SubcategoriesController@show', ['id' => $set->subcategory_id])->with('success', 'Edytowano zestaw');
    }

    public function destroy($id){
        $set = Set::find($id);
        if(!is_null($set)){
            if(!Auth::guest() && $set->hidden == 2 && $set->user_id == Auth::user()->id){
                $set->delete();
                return redirect()->back()->with('success', 'Usunięto zestaw');    
            }
            $auth = Authorization::where([['user_id','=', Auth::user()->id],['subcategory_id','=',$set->subcategory_id]])->get();
            if(Auth::guest() || Auth::user()->role_id != 10){
                if((Auth::user()->role_id != 3) || (count($auth) == 0)){
                    if((Auth::user()->role_id != 2) || (Auth::user()->id != $set->user_id) || (count($auth) == 0)){
                        return redirect()->action('SubcategoriesController@show', ['id' => $set->subcategory_id])->with('error', 'Nie masz uprawnień do przeglądania tej strony');
                    }
                }
            }
            $set->delete();
            return redirect()->back()->with('success', 'Usunięto zestaw');
        }
        return redirect()->back()->with('error', 'Nie można usunąć nieistniejącego zestawu');
    }

    public function hideCategory($id, $type){
        $set = Set::find($id);
        if($type == 'hide') {
            $set->hidden = 1;
            $set->save();
            return redirect()->back()->with('success', 'Zestaw ukryty');
        }
        else {
            $set->hidden = 0;
            $set->save();
            return redirect()->back()->with('success', 'Zestaw widoczny');
        }
    }
}
