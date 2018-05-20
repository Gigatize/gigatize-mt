<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;

class Comment extends \Actuallymab\LaravelComment\Models\Comment
{
    use UsesTenantConnection;
}