<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index(Request $request) {

        $user = $request->user();

        $query = Category;
        

        if (!$user->is_admin) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        return CategoryResource::collection($query->get());
    }
}
