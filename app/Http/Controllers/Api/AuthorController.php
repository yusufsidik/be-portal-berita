<?php

namespace App\Http\Controllers\Api;

use App\Models\Author;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cache;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Cache::remember('authors', 3600, function(){
            return Author::select(['id','name','bio','avatar'])->paginate();
        });

        return AuthorResource::collection($authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:128',
                'bio' => 'required|string|max:255',
                'avatar' => 'required|image|string|max:255'
            ]);

            $author = Author::create($validated);

            return new AuthorResource($author); 

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
    public function show(Author $author)
    {
        return new AuthorResource($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {

        try {

            $validated = $request->validate([
                'name' => 'required|string|max:128',
                'bio' => 'required|string|max:255',
                'avatar' => 'required|image|string|max:255'
            ]);

            $author->update($validated);

            return new AuthorResource($author); 

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
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return response()->json("Success delete author", 200);
    }
}
