<?php

namespace App\Repositories;


use App\Skill;
use Optimus\Genie\Repository;

class SkillRepository extends Repository
{
    protected function getModel()
    {
        return new Skill;
    }

    public function update(array $data, $skill)
    {
        return $skill;
    }
}