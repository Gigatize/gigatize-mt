<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Requests\CreateSkillFormRequest;
use App\Http\Resources\SkillResource;
use App\Http\Resources\SkillsResource;
use App\Services\SkillService;
use App\Skill;
use App\Traits\EloquentBuilderTrait;
use Illuminate\Http\Request;
use Optimus\Bruno\LaravelController;

class SkillController extends LaravelController
{
    use EloquentBuilderTrait;

    private $skillService;

    public function __construct(SkillService $skillService) {
        $this->skillService = $skillService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return SkillsResource
     */
    public function index()
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->skillService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'skills');

        // Create JSON response of parsed data
        return new SkillsResource($parsedData['skills']);
    }

    /**
     * Create a listing of the resource in storage.
     *
     * @param  CreateSkillFormRequest $request
     * @return SkillResource
     */
    public function store(CreateSkillFormRequest $request)
    {
        $skill = new Skill();
        $skill->name = $request->get('name');
        $skill->save();
        // Create JSON response of parsed data
        return new SkillResource($skill);
    }

    /**
     * Display the specified resource.
     *
     * @param  Skill $skill
     * @return SkillResource
     */
    public function show(Skill $skill)
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->skillService->getById($skill->id, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'skill');

        // Create JSON response of parsed data
        return new SkillResource($parsedData['skill']);
    }
}
