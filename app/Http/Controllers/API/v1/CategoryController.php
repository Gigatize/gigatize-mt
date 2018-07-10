<?php

namespace App\Http\Controllers\API\v1;

use App\Category;
use App\Http\Requests\CreateCategoryFormRequest;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use App\Traits\EloquentBuilderTrait;
use Illuminate\Http\Request;
use Optimus\Bruno\LaravelController;

class CategoryController extends LaravelController
{
    use EloquentBuilderTrait;

    private $categoryService;

    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    /**
     * Create a listing of the resource in storage.
     *
     * @param  CreateCategoryFormRequest $request
     * @return CategoryResource
     */
    public function store(CreateCategoryFormRequest $request)
    {
        $response = $this->categoryService->create($request);

        if($response->success) {
            // Create JSON response of parsed data
            return new CategoryResource($response->object);
        }else{
            return response()->json(['message'=>$response->msg,'error'=>$response->error],$response->error);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return CategoriesResource
     */
    public function index()
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->categoryService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'categories');

        // Create JSON response of parsed data
        return new CategoriesResource($parsedData['categories']);
    }

    /**
     * Display the specified resource.
     *
     * @param  Category $category
     * @return CategoryResource
     */
    public function show(Category $category)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->categoryService->getById($category->id, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'category');

        // Create JSON response of parsed data
        return new CategoryResource($parsedData['category']);
    }
}
