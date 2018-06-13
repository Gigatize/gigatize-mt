<?php

namespace App\Services;

use App\Repositories\SkillRepository;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;

class SkillService {

    private $auth;

    private $dispatcher;

    private $skillRepository;

    public function __construct(Dispatcher $dispatcher, SkillRepository $skillRepository) {
        $this->dispatcher = $dispatcher;
        $this->skillRepository = $skillRepository;
    }

    public function getAll($options = [])
    {
        return $this->skillRepository->get($options);
    }

    public function getById($id, $options){
        return $this->skillRepository->getById($id, $options);
    }
}