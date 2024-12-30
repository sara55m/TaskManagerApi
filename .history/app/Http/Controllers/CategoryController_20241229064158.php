<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request){
        $category=$request->validate([
            'name'=>'required|string|min:3',
        ]);
        $task=Category::create($category);
        return response()->json($category);
    }

    public function show($category){
        $category=Category::findOrFail($category);
        if($category){
            return response()->json($category,201);
        }else{
            return response()->json('not found',404);
        }
    }

    public function getTaskCategories($id){
        $category=Category::findOrFail($id);
        return response()->json($category->tasks,201);
    }
}
