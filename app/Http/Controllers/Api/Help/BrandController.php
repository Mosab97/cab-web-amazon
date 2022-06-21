<?php

namespace App\Http\Controllers\Api\Help;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Help\{BrandResource , CarModelResource};
use App\Models\{Brand , CarModel};

class BrandController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->get();
        return BrandResource::collection($brands)->additional(['status' => 'success','message'=>'']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$brand_id)
    {
        $brand = Brand::findOrFail($brand_id);
        $car_models = $brand->carModels;
        return CarModelResource::collection($car_models)->additional(['status' => 'success','message'=>'']);
    }


}
