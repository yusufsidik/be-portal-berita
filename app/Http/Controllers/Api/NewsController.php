<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Resources\NewsResource;
use App\Http\Requests\{StoreNewsRequest, UpdateNewsRequest};
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $news = News::select(['title','slug','content','category_id','author_id'])->with(['category:id,title','author:id,name'])->get();
        $news = News::with(['category','author'])->paginate();
        return NewsResource::collection($news);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        try {

            $validated = $request->validated();

            // cek apakah ada file gambar thumbnail
            if ($request->hasFile('thumbnail')){
                $file = $request->file('thumbnail');
                $file->store('news_thumbnail','public');
                
                // create name for thumbnail
                $date = now();
                $thumbnailName = $date->format('dmY') . '-' . Str::random(22) . '.' .  $file->extension();
    
                // set thumbnail name
                $validated['thumbnail'] = $thumbnailName;
            }


            $news = News::create($validated);

            return new NewsResource($news);

        } catch (ValidationException  $exc) {
            return response()->json([
                'message' => "Validation failed",
                'errors' => $exc->errors()
            ], 422);
        } catch (\Exception $exc){
            return response()->json([
                'message' => 'Server Error'
            ], 500);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return new NewsResource($news);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $news->update($request->validated());
        return new NewsResource($news);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();
        return response()->json([
            'message' => "Success delete news"
        ]);
    }
}