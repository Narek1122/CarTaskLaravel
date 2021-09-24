<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\CarModel;

class CarModelController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }


    public function addCarModel(Request $request){
        $validator = Validator::make($request->all(), [
            'model' => 'required|string',
            'brand_id' => 'required'
        ]);


        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $brand = CarModel::create(
            $validator->validated()

        );

        return response()->json([
            'message' => 'Car model added successfully',
            'brand' => $brand
        ], 201);
    }


}
