<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\APIResponser;
use App\MatchDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeApiController extends Controller
{
    use APIResponser;

    public function index()
    {
        $todayDate = Carbon::now()->toDateString();
        $previousDate = Carbon::now()->subDays(1)->toDateString();
//        Log::info('dd', ['data' => $todayDate]);
        $machData = MatchDate::whereBetween('match_date', [$previousDate, $todayDate])->get();

        return $this->respondCollection('success to get match', $machData);
    }

}