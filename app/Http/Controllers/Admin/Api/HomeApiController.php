<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\APIResponser;
use App\Http\Resources\MatchDateResource;
use App\MatchDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeApiController extends Controller
{
    use APIResponser;

    public function index(Request $request)
    {

        if ($request->input('date') === null || $request->input('date') === "") {
            $todayDate = Carbon::now()->toDateString();
            $previousDate = Carbon::now()->subDays(1)->toDateString();
        } else {
            $todayDate = $request->input('date');
            $previousDate = Carbon::parse($todayDate)->subDays(1)->toDateString();
        }
        $machData = MatchDate::whereBetween('match_date', [$previousDate, $todayDate])->with('matchDetail')->get();

        return $this->respondCollection('success to get match', MatchDateResource::collection($machData));
    }

}
