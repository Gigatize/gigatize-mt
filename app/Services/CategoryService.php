<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;

class CategoryService {

    private $auth;

    private $dispatcher;

    private $categoryRepository;

    public function __construct(Dispatcher $dispatcher, CategoryRepository $categoryRepository) {
        $this->dispatcher = $dispatcher;
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll($options = [])
    {
        return $this->categoryRepository->get($options);
    }

    public function getById($id, $options){
        return $this->categoryRepository->getById($id, $options);
    }
}