<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScoresResource;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return ScoresResource
     */
    public function index(Request $request)
    {
        //get start date url parameter
        $start_date = $this->getStartDate($request);
        //get end date url parameter
        $end_date = $this->getEndDate($request);
        //get limit url parameter
        $limit = $this->getLimit($request);

        //get all users
        $users = User::all();
        //sort users by total engagement score
        $users = $users->sortByDesc(function ($user) use($start_date, $end_date){
            return $user->getEngagementScore($start_date, $end_date);
        });
        //limit response number
        if($limit){
            $users = $users->take($limit);
        }
        //Create JSON response of parsed data
        return new ScoresResource($users);
    }

    private function getStartDate(Request $request){
        $start_date = $request->get('start_date');
        if($start_date){
            //parse start date parameter
            $start_date = Carbon::parse($start_date);
        }
        return $start_date;
    }

    private function getEndDate(Request $request){
        $end_date = $request->get('end_date');
        if($end_date){
            //parse end date parameter and
            $end_date = Carbon::parse($end_date);
        }
        return $end_date;
    }

    private function getLimit(Request $request){
        $limit = $request->get('limit');
        if($limit){
            //parse end date parameter and
            $limit = $request->get('limit');
        }
        return $limit;
    }
}
