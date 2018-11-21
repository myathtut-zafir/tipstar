<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Teams;
use App\Http\Requests\CreateTeamsRequest;
use App\Http\Requests\UpdateTeamsRequest;
use Illuminate\Http\Request;



class TeamsController extends Controller {

	/**
	 * Display a listing of teams
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $teams = Teams::all();

		return view('admin.teams.index', compact('teams'));
	}

	/**
	 * Show the form for creating a new teams
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.teams.create');
	}

	/**
	 * Store a newly created teams in storage.
	 *
     * @param CreateTeamsRequest|Request $request
	 */
	public function store(CreateTeamsRequest $request)
	{
	    
		Teams::create($request->all());

		return redirect()->route(config('quickadmin.route').'.teams.index');
	}

	/**
	 * Show the form for editing the specified teams.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$teams = Teams::find($id);
	    
	    
		return view('admin.teams.edit', compact('teams'));
	}

	/**
	 * Update the specified teams in storage.
     * @param UpdateTeamsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateTeamsRequest $request)
	{
		$teams = Teams::findOrFail($id);

        

		$teams->update($request->all());

		return redirect()->route(config('quickadmin.route').'.teams.index');
	}

	/**
	 * Remove the specified teams from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Teams::destroy($id);

		return redirect()->route(config('quickadmin.route').'.teams.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            Teams::destroy($toDelete);
        } else {
            Teams::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.teams.index');
    }

}
