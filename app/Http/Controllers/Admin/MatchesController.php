<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Traits\APIResponser;
use App\Leagues;
use App\Match;
use App\Teams;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;


class MatchesController extends Controller
{
    use APIResponser;

    function index()
    {
        $matches = Match::all();
        return view('admin.matches.index', compact('matches'));
    }

    function create()
    {
        $leagues = Leagues::all();
        $teams = Teams::all();
        return view('admin.matches.create', compact('leagues', 'teams'));
    }

    function store(Request $request)
    {

        $league = Leagues::findOrFail($request->league);
        $match = new Match();
        $match->league = $league->name;
        $match->home = $request->home_team;
        $match->away = $request->away_team;
        $match->away = $request->away_team;
        $match->goal_over_under = $request->goal_over_under;
        $match->match_start_at = $request->match_start;
        $match->week_number = $request->week_number;
        $match->result = "";
        $match->latest_odd = $request->latest_odd;
        $match->latest_odd_created_at = Carbon::now();
        $match->save();
        return redirect()->back();

    }

    function edit($id)
    {
        $match = Match::findOrFail($id);

        return view('admin.matches.edit', compact('match'));
    }

    function update($id, Request $request)
    {

        $match = Match::findOrFail($id);

        if ($request->latest_odd != null && $request->latest_odd != "") {

            if ($match->latest_odd) {
                //insert previous odd
                $match->previous_odd = $match->latest_odd;
                $match->previous_odd_created_at = Carbon::now('Asia/Rangoon');
                //insert latest odd
                $match->latest_odd = $request->latest_odd;
                $match->latest_odd_created_at = Carbon::now('Asia/Rangoon');
                $match->update();
                return redirect('/admin/matches');
            }
        }

        return Response()->json("Latest Odd Should Not Be Null");
    }

    function teamChoose()
    {
        $leagueID = Input::get('leagueId');
        $teams = Teams::where('league_id', '=', $leagueID)->get();
        return Response()->json($teams);
    }

    function allTeam()
    {
        $teams = Teams::all();
        return Response()->json($teams);
    }

    function getAllMatches(Request $request)
    {
        $img = \Image::make(public_path('pro-blank.jpg'));

// write text
        $img->text('The quick brown fox jumps over the lazy dog.');

// write text at position
        $img->text('The quick brown fox jumps over the lazy dog.', 120, 100);

// use callback to define details
        $img->text('foo', 10, 20, function($font) {
            $font->size(24);
            $font->color('#fdf6e3');
            $font->align('center');
            $font->valign('top');
            $font->angle(45);
        });

        $img->save(public_path('pro-blank22.jpg'), 60);
        exit();
        $matches = Match::all();
        $limit = $request->limit ?? 5;
        $currentPage = $request->page ?? 1;
//        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        if ($request->league != "") {
            $matches = Match::where('league', $request->league)->paginatior($limit, ['*'], 'page', $currentPage);
        }
        if ($request->week_number != "") {
            $matches = Match::where('week_number', $request->week_number)->get();
        }
        if ($request->week_number != "" && $request->league != "") {
            $matches = Match::where('week_number', $request->week_number)->where('league', $request->league)->paginatior(1);
        }
        return $matches;

        $paginatedItems = $this->paginator($request, $matches, $limit);

        return $this->responseSucessWithPaginateCustomize($limit, $paginatedItems);
    }

    private function paginator(Request $request, $object, $perPage)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($object);
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());
        return $paginatedItems;
    }

}
