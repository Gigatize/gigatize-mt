<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Gstt\Achievements\Model\AchievementProgress as Progress;

class AchievementProgress extends Progress
{
    use UsesTenantConnection;
}
