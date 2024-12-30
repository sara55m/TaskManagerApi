<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    public function index(){
        $tasks=Task::all();
        return response()->json($tasks);
    }
    public function store(StoreTaskRequest $request){
        //$validated=$request->validated();
        //validation using form request
        $task=Task::create($request->validated());
        return response()->json($task);
    }

    public function show($task){
        $task=Task::findOrFail($task);
        if($task){
            return response()->json($task->title,201);
        }else{
            return response()->json('not found',404);
        }
    }

    public function update(UpdateTaskRequest $request,$task){
        $task=Task::findOrFail($task);
        $task->update($request->validated());
        return response()->json($task,200);
    }

    public function destroy(Request $request,$task){
        $task=Task::findOrFail($task);
        $task->delete();
        return response()->json($task->title.' '.'deleted successfully',204);
    }

    public function getUser($id){
        $task=Task::findOrFail($id);
        return response()->json($task->user,201);
    }

    public function addCategoriesToTask(Request $request,$id){
        $task=Task::findOrFail($id);
        $task->categories()->attach($request->category_id);

        return response()->json($task->categories,201);
    }

    public function getTaskCategories($id){
        $task=Task::findOrFail($id);
        return response()->json($task->categories,201);
    }
}
