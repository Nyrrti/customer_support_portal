<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index()
    {
        $this->authorize("viewAny", Category::class);

        return CategoryResource::collection(Category::all());
    }

    // CREATE
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return new CategoryResource($category);
    }


    // EDIT
    public function update(CategoryRequest $request, Category $category)
    {
        $this->authorize("update", $category);

        $category->update($request->validated());

        return new CategoryResource($category);
    }

    // DELETE
    public function destroy(Category $category)
    {
        $this->authorize("delete", $category);

        $category->delete();

        return response()->noContent();
    }
}
