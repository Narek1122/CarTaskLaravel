<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\TaskImages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class TaskImagesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['getImage']]);
    }

    public function addTaskImage($id,Request $request){
        $AuthId = Auth::user()->id;
        $path = public_path('taskImages') .'/' . $AuthId . '/' . $id ;
        File::makeDirectory($path, $mode = 0777, true, true);
        $generated_new_name = md5(microtime()) . '.' . $request->file->getClientOriginalExtension();
        $request->file->move($path, $generated_new_name);
        $path2 = $AuthId . '/' . $id . '/' . $generated_new_name;
        $dat = [
            'task_id' => $id,
            'picture' => $path2
        ];
        $created = TaskImages::create($dat);
        return response()->json([
            'status' => 200,
            'data' => $created
        ]);

    }

    public function getImage($img,$img2,$img3){
        $hostname = env("APP_URL");
        $path = $hostname . '/taskImages/' . $img .'/' .$img2 . '/' . $img3;
        return redirect($path);
    }

    public function deletesTaskImage($img,$img2,$img3){
        if(Auth::user()->id == $img){
            $path1 = $img . '/' . $img2 . '/' . $img3;
            $path2 = public_path('taskImages/' . $path1);
            File::delete($path2);
            TaskImages::where('picture',$img . '/' . $img2 . '/' . $img3)->delete();

            return response()->json([
                'message' => 'Image deleted successfully'
            ],200);

        }else{
            return response()->json([
                'message' => 'You can not delete this image'
            ],400);
        }

    }
}
