<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::select(['title','slug'])->paginate();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => ['required','string','max:50'] ,
                'slug' => ['required', 'string','unique:categories,slug']
            ]);

            $category = Category::create($validated);

            return new CategoryResource($category);
        
        } catch (ValidationException $exc) {
            
            return response()->json([
                'message' => "Validation failed",
                'errors' => $exc->errors()
            ], 422);
        
        } catch(\Exception $exc ){
            
            return response()->json([
                'message' => "Server Error",
            ], 500);
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $validated = $request->validated();

            $category->update($validated);
            return new CategoryResource($category);

        } catch (ValidationException $exc) {
            return response()->json([
                'message' => "Validation Failed.",
                'errors' => $exc->errors()
            ], 422);
        } catch (\Exception){
            return response()->json([
                'message' => "Server Error."
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json('Success delete category', 200);
    }
}
