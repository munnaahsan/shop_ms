<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:100',
            'remarks' => 'required'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $this->slugify($request->name),
            'remarks' => $request->remarks,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|min:5|max:100',
            'status' => 'required'
        ]);

        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->slug = slugify($request->name);
        $category->status = $request->status;;
        if ($category->save()) {
            $success = true;
        }else{
            $success = false;
        }

        return response()->json(['success', $success], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    public function slugify($text)
    {
        //replace non latter or digits by
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        //translate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        //trim
        $text = trim($text, '-');

        //remove duplicate
        $text = preg_replace('~-+~', '-', $text);

        //lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;


    }
}
