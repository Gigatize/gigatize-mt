<?php

namespace App\Http\Controllers\API\V1;

use App\Category;
use App\Http\Resources\ProjectsResource;
use App\Traits\EloquentBuilderTrait;
use Optimus\Bruno\LaravelController;

class CategoryRelationshipController extends LaravelController
{
    use EloquentBuilderTrait;

    public function Projects(Category $category)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($category->Projects, $resourceOptions, 'projects');

        return new ProjectsResource($parsedData['projects']);
    }

}
