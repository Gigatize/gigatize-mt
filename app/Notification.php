<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    use UsesTenantConnection;
}
