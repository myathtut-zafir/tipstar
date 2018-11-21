<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Leagues;
use App\Http\Requests\CreateLeaguesRequest;
use App\Http\Requests\UpdateLeaguesRequest;
use Illuminate\Http\Request;



class LeaguesController extends Controller {

	/**
	 * Display a listing of leagues
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $leagues = Leagues::all();

		return view('admin.leagues.index', compact('leagues'));
	}

	/**
	 * Show the form for creating a new leagues
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.leagues.create');
	}

	/**
	 * Store a newly created leagues in storage.
	 *
     * @param CreateLeaguesRequest|Request $request
	 */
	public function store(CreateLeaguesRequest $request)
	{
	    
		Leagues::create($request->all());

		return redirect()->route(config('quickadmin.route').'.leagues.index');
	}

	/**
	 * Show the form for editing the specified leagues.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$leagues = Leagues::find($id);
	    
	    
		return view('admin.leagues.edit', compact('leagues'));
	}

	/**
	 * Update the specified leagues in storage.
     * @param UpdateLeaguesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateLeaguesRequest $request)
	{
		$leagues = Leagues::findOrFail($id);

        

		$leagues->update($request->all());

		return redirect()->route(config('quickadmin.route').'.leagues.index');
	}

	/**
	 * Remove the specified leagues from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Leagues::destroy($id);

		return redirect()->route(config('quickadmin.route').'.leagues.index');
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
            Leagues::destroy($toDelete);
        } else {
            Leagues::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.leagues.index');
    }

}
