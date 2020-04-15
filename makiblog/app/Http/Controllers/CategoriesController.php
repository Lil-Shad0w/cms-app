<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Categories\UpdateCategoriesRequest;

use App\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("categories.index")->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|unique:categories',
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect('/categories')->with('success', 'Category Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.create')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriesRequest $request, Category $category)
    {
        $category->name = $request->name;

        $category->save();

        return redirect(route('categories.index'))->with('success', 'Uspesno ste uredili kategoriju');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        if($category->posts->count() > 0){
            return redirect(route('categories.index'))->with('error', 'Ne mozete obrisati kategoriju jer postoji ' . $category->posts->count() . ' post sa ovom kategorijom');
        }
        $category->delete();

        return redirect(route('categories.index'))->with('success', 'Uspesno ste obrisali kategoriju '.$category->id);
    }
}
