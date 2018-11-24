<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Tipsters;
use App\Http\Requests\CreateTipstersRequest;
use App\Http\Requests\UpdateTipstersRequest;
use Illuminate\Http\Request;



class TipstersController extends Controller {

	/**
	 * Display a listing of tipsters
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $tipsters = Tipsters::all();

		return view('admin.tipsters.index', compact('tipsters'));
	}

	/**
	 * Show the form for creating a new tipsters
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.tipsters.create');
	}

	/**
	 * Store a newly created tipsters in storage.
	 *
     * @param CreateTipstersRequest|Request $request
	 */
	public function store(CreateTipstersRequest $request)
	{
	    
		Tipsters::create($request->all());

		return redirect()->route(config('quickadmin.route').'.tipsters.index');
	}

	/**
	 * Show the form for editing the specified tipsters.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$tipsters = Tipsters::find($id);
	    
	    
		return view('admin.tipsters.edit', compact('tipsters'));
	}

	/**
	 * Update the specified tipsters in storage.
     * @param UpdateTipstersRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateTipstersRequest $request)
	{
		$tipsters = Tipsters::findOrFail($id);

        

		$tipsters->update($request->all());

		return redirect()->route(config('quickadmin.route').'.tipsters.index');
	}

	/**
	 * Remove the specified tipsters from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Tipsters::destroy($id);

		return redirect()->route(config('quickadmin.route').'.tipsters.index');
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
            Tipsters::destroy($toDelete);
        } else {
            Tipsters::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.tipsters.index');
    }

}
