<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use Illuminate\Validation\ValidationException;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::with(['news'])->get();
        return BannerResource::collection($banners);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $validate = $request->validate([
              'news_id' => 'required|integer|exists:news,id']
            );
    
            $banner = Banner::create($validate);
    
            return new BannerResource($banner);

        } catch (ValidationException $exc) {
            return response()->json([
                'message' => "Validation failed.",
                'errors'=> $exc->errors()
            ], 422);
        } catch(\Exception $exc){
            return response()->json([
                'message' => "Server Error."
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return response()->json("Success delete Banner", 200);
    }
}
