<?php

namespace App\Repositories;


use App\Comment;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Optimus\Genie\Repository;

class CommentRepository extends Repository
{
    protected function getModel()
    {
        return new Comment;
    }

    public function update(array $data, $comment)
    {
        $comment->comment = $data['comment'];
        $comment->save();
        return $comment;
    }
}