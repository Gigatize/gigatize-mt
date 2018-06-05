<?php

namespace App\Repositories;


use App\User;
use App\Skill;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Optimus\Genie\Repository;

class UserRepository extends Repository
{
    protected function getModel()
    {
        return new User;
    }

    public function create(array $data)
    {
        return $user;
    }

    public function update(array $data, $user)
    {
        return $user;
    }

    public function filterOwner(Builder $query, $method, $clauseOperator, $value)
    {
        // if clauseOperator is idential to false,
        //     we are using a specific SQL method in its place (e.g. `in`, `between`)
        if ($clauseOperator === false) {
            call_user_func([$query, $method], 'users.first_name', $value);
        } else {
            call_user_func([$query, $method], 'users.first_name', $clauseOperator, $value);
        }
    }

    public function filterSkills(Builder $query, $method, $clauseOperator, $value)
    {
        // if clauseOperator is idential to false,
        //     we are using a specific SQL method in its place (e.g. `in`, `between`)
        if ($clauseOperator === false) {
            call_user_func([$query, $method], 'skills.name', $value);
        } else {
            call_user_func([$query, $method], 'skills.name', $clauseOperator, $value);
        }
    }
}