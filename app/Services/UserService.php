<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;

class UserService {

    private $auth;

    private $dispatcher;

    private $userRepository;

    public function __construct(Dispatcher $dispatcher, UserRepository $userRepository) {
        $this->dispatcher = $dispatcher;
        $this->userRepository = $userRepository;
    }

    public function getAll($options = [])
    {
        return $this->userRepository->get($options);
    }

    public function getById($id, $options){
        return $this->userRepository->getById($id, $options);
    }
}