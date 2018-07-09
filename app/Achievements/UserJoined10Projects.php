<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserJoined10Projects extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "10 Projects Joined";

    /*
     * A small description for the achievement
     */
    public $description = "Congratulations on joining 10 projects!";

    /*
    * The amount of "points" this user need to obtain in order to complete this achievement
    */
    public $points = 10;
}
