<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index()
    {
        $this->authorize('viewAny', Category::class);

        return CategoryResource::collection(Category::all());
    }

    // EDIT
    public function update(CategoryRequest $request, Category $category)
    {
        $this->authorize('update', $category);

        $category->update($request->validated());

        return new CategoryResource($category);
    }

}
