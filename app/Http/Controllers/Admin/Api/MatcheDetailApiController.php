<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Traits\APIResponser;
use App\Leagues;
use App\Match;
use App\Teams;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;


class MatcheDetailApiController extends Controller
{
    use APIResponser;

    function index()
    {
        $matches = Match::all();
        return view('admin.matches.index', compact('matches'));
    }
}
