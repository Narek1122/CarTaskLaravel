<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use App\Models\Task;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['getTasks','getTasksBy']]);
    }

    public function addTask(Request $request){
        $validator = Validator::make($request->all(), [
            'model' => 'required|string',
            'brand' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $validated = $validator->validated();
        $validated['admin_id'] = Auth::user()->id;

        $task = Task::create( $validated);



        return response()->json([
            'message' => 'Task created successfully',
            'brand' => $task
        ], 201);
    }
    public function adminGetTasks(){
        $task = Auth::user();

        return response()->json([
            'tasks' => $task->tasks()->with('taskImages')->get()
        ],200);
    }

    public function getTasks(){

        $task = Task::with('taskImages')->get();

        return response()->json([
            'tasks' => $task
        ],200);


    }

    public function changeTaskBrandModel(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'model' => 'required|string',
            'brand' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $validated = $validator->validated();

        $task = Task::find($id)->update($validated);



        return response()->json([
            'message' => 'Task brand and model updated successfully',
        ], 201);
    }

    public function getTasksBy($name){
        $data = Task::where('brand',$name)
            ->orwhere('brand', 'like', '%'.$name.'%')
            ->orWhere('model', 'like', '%'.$name.'%')
            ->with('taskImages')->get();

        if($data->count() < 1){
            return response()->json([
                'message' => 'no data',
                'status' => 400

            ]);
        }

        return response()->json([
            'tasks' => $data,
            'status' => 200
        ]);

    }


}
