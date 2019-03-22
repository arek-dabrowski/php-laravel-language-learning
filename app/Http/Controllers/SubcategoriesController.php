<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Subcategory;
use App\Set;
use App\Authorization;

class SubcategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(){
        return redirect('/category');
    }

    public function show($id){
        $subcategory = Subcategory::find($id);
        $sets = Set::where('subcategory_id','=',$id)->get();
        if(!Auth::guest()){
            $auth = Authorization::where([['user_id','=', Auth::user()->id],['subcategory_id','=',$id]])->get();
            $privs = Set::where([['user_id','=', Auth::user()->id],['subcategory_id','=',$id],['hidden','=',2]])->get();
        }
        else {
            $auth = Auth::guest();
            $privs = NULL;
        }
        if($subcategory->hidden == 0){
            return view('sets.index')->with('sets', $sets)->with('privs', $privs)->with(['current_id' => $id, 'auth' => $auth, 'name' => $subcategory->name]);
        }
        else if(!Auth::guest() && $subcategory->hidden == 1 && Auth::user()->role_id == 10){
            return view('sets.index')->with('sets', $sets)->with('privs', $privs)->with(['current_id' => $id, 'auth' => $auth, 'name' => $subcategory->name]);
        }
        else return redirect()->back()->with('error', 'Podkategoria nie istnieje');
        //with('current_id', $id)->with('auth', $auth);
    }

    public function create($id){
        if(Auth::user()->role_id != 10){
            return redirect()->action('CategoriesController@show', ['id' => $id])->with('error', 'Nie masz uprawnień do przeglądania tej strony');
        }
        return view('subcategories.create')->with('id', $id);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required'
        ]);
        $subcategory = new Subcategory;
        $subcategory->name = $request->input('name');
        $subcategory->description = $request->input('description');
        $subcategory->category_id = $request->input('category_id');
        $subcategory->save();

        return redirect()->action('CategoriesController@show', ['id' => $request->input('category_id')])->with('success', 'Dodano podkategorie');
    }

    public function edit($id){
        if(Auth::user()->role_id != 10){
            return redirect()->action('CategoriesController@show', ['id' => $id])->with('error', 'Nie masz uprawnień do przeglądania tej strony');
        }
        $subcategory = Subcategory::find($id);
        return view('subcategories.edit')->with('subcategory', $subcategory);
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        $subcategory = Subcategory::find($id);
        $subcategory->name = $request->input('name');
        $subcategory->description = $request->input('description');
        $subcategory->save();

        return redirect()->action('CategoriesController@show', ['id' => $id])->with('success', 'Edytowano podkategorie');
    }

    public function destroy($id){
        if(Auth::user()->role_id != 10){
            return redirect()->action('CategoriesController@show', ['id' => $id])->with('error', 'Nie masz uprawnień do przeglądania tej strony');
        }
        $subcategory = Subcategory::find($id);
        $subcategory->delete();
        return redirect()->back()->with('success', 'Usunięto podkategorie');
    }

    public function hideCategory($id, $type){
        if(Auth::user()->role_id != 10){
            return redirect()->action('CategoriesController@show', ['id' => $id])->with('error', 'Nie masz uprawnień do przeglądania tej strony');
        }
        $subcategory = Subcategory::find($id);
        if($type == 'hide') {
            $subcategory->hidden = 1;
            $subcategory->save();
            return redirect()->back()->with('success', 'Podategoria ukryta');
        }
        else {
            $subcategory->hidden = 0;
            $subcategory->save();
            return redirect()->back()->with('success', 'Podategoria widoczna');
        }
    }
}