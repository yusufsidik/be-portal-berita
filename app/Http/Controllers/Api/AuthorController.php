<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Gate;

use App\Http\Resources\AuthorResource;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::select(['id','name','bio','avatar'])->paginate();
        return AuthorResource::collection($authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:128',
            'bio' => 'required|string|max:255',
            'avatar' => 'required|string|max:255'
        ]);

        $author = Author::create($validated);

        return new AuthorResource($author); 
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
        $validated = $request->validate([
            'name' => 'required|string|max:128',
            'bio' => 'required|string|max:255',
            'avatar' => 'required|string|max:255'
        ]);

        $author->update($validated);

        return new AuthorResource($author); 
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
