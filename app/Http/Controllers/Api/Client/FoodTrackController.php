<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Resources\Client\FoodTrackResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\{WalletResource, WalletTransactionResource};
use App\Http\Requests\Api\Client\{ClientBorrowFromAppRequest};
use App\Models\{AppAd, FoodTrack, User};

class FoodTrackController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'code' => 1,
            'message' => "success",
            'errors' => [],
            'data' => FoodTrackResource::collection(FoodTrack::get())
        ]);
    }

    public function show(Request $request, FoodTrack $foodTrack)
    {
        return response()->json([
            'code' => 1,
            'message' => "success",
            'errors' => [],
            'data' => new FoodTrackResource($foodTrack)
        ]);
    }


}
