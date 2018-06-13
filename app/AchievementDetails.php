<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Gstt\Achievements\Model\AchievementDetails as Details;

class AchievementDetails extends Details
{
    use UsesTenantConnection;
}
