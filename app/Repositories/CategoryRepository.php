<?php

namespace App\Repositories;


use App\Category;
use Optimus\Genie\Repository;

class CategoryRepository extends Repository
{
    protected function getModel()
    {
        return new Category;
    }

    public function update(array $data, $category)
    {
        return $category;
    }
}