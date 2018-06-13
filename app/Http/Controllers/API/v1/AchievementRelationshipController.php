<?php
namespace App\Http\Controllers\API\v1;
use App\AchievementProgress;
use App\Http\Resources\UserResource;
use App\Traits\EloquentBuilderTrait;
use Optimus\Bruno\LaravelController;

class AchievementRelationshipController extends LaravelController
{
    use EloquentBuilderTrait;

    public function User(AchievementProgress $achievement)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $parsedData = $this->parseData($achievement->achiever, $resourceOptions, 'user');

        return new UserResource($parsedData['user']);
    }

}