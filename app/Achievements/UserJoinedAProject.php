<?php

namespace App\Achievements;

use App\Achievement;

class UserJoinedAProject extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "First Project Joined";

    /*
     * A small description for the achievement
     */
    public $description = "Congratulations on joining your first project!";

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 1;
}
