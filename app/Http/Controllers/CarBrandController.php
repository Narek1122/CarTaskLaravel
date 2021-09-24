<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\CarBrand;

class CarBrandController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['getCarBrands','getCarBrandsAndModels']]);
    }


    public function addCarBrand(Request $request){
        $validator = Validator::make($request->all(), [
            'brand' => 'required|string|unique:car_brands',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $brand = CarBrand::create(
            $validator->validated()

        );

        return response()->json([
            'message' => 'Car brand added successfully',
            'brand' => $brand
        ], 201);
    }

    public function getCarBrands(){
        return response()->json([
            'brands' => CarBrand::get()
        ],200);
    }

    public function getCarBrandsAndModels(){
        $brands = CarBrand::with('models')->get();
        return response()->json([
            'data' => $brands
        ],200);
    }
}
