<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function getAllTasks(){
        $AllTasks=Task::all();
        return response()->json($AllTasks,200);
    }

    public function index(){
        $tasks=Auth::user()->tasks;
        return response()->json($tasks);
    }
    public function store(StoreTaskRequest $request){
        //validation using form request
        //get the current authenticated user id
        $user_id=Auth::user()->id;
        //get the validated data from form request
        $validatedData=$request->validated();
        //add user _id to the validated form request data
        $validatedData['user_id']=$user_id;
        //create new task
        $task=Task::create($validatedData);
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
        //get the task to update
        $task=Task::findOrFail($task);
        //get the id of the currently authenticated user
        $user_id=Auth::user()->id;
        //get the task user_id
        $task_user_id=$task->user_id;
        //get the validated data from form request
        $validatedData=$request->validated();
        //only the user who created/added the task can edit it
        if($task_user_id===$user_id){
            $task->update($validatedData);
            return response()->json($task,200);
        }else{
            return response()->json('Unauthorized');
        }
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

    public function getTasksByPriority(){
        //get tasks ordered by their priority from high to low
        $tasks=Auth::user()->tasks()->orderByRaw("field(priority,'high','medium','low')")->get();
        return response()->json($tasks);
    }

    public function addToFavorites($id){
        Task::findOrFail($id);
        $user=Auth::user()->favorites()->syncWithoutDetaching($id);
        return response()->json('task added to favorites',200);
    }

    public function removeFromFavorites($id){
        Task::findOrFail($id);
        $user=Auth::user()->favorites()->detach($id);
        return response()->json('task removed from favorites',200);
    }

    public function getFavoriteTasks(){
        //$favorites=Auth::user()->favorites;
        return response()->json('hello',200);
    }
}
