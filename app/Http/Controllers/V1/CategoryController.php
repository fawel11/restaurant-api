<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;

    }

    public function index(Request $request)
    {
        Log::info($request);
        $categoryId = $request->categoryId ?? null;
        $paginate = $request->paginate;
        $category = $this->category
            ->with('children', 'items')
            ->whereParentId($categoryId)
            ->paginate($paginate);

        return CategoryResource::collection($category);
    }

    public function store(CategoryRequest $request)
    {
        //$validatedData = $request->validated();

        $category = Category::create($request->all());
        return response()->json(['message' => 'Category added successfully!'], 201);
    }
}
