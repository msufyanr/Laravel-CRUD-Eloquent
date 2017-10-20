<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nerd;
use Illuminate\Support\Facades\Redirect;
use Session;



class NerdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        //
        $nerds = Nerd::all();

        // load the view and pass the nerds
        return view('Nerds.index')
            ->with('nerds', $nerds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Nerds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = array(
            'name'       => 'required',
            'email_address'      => 'required|email',
            'nerd_level' => 'required|numeric'
        );
        $validator = validator($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('nerds/create')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            // store
            $nerd = new Nerd;
            $nerd->name       = $request->get('name');
            $nerd->email_address      = $request->get('email_address');
            $nerd->nerd_level = $request->get('nerd_level');
            $nerd->save();
}
            // redirect
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to('nerds');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $nerd = Nerd::find($id);

        // show the view and pass the nerd to it
        return view('nerds.show')
            ->with('nerd', $nerd);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $nerd = Nerd::find($id);

        // show the edit form and pass the nerd
        return view('nerds.edit')
            ->with('nerd', $nerd);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = array(
            'name'       => 'required',
            'email_address'      => 'required|email',
            'nerd_level' => 'required|numeric'
        );
        $validator = validator($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('nerds/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            // store
            $nerd = Nerd::find($id);
            $nerd->name       = $request->get('name');
            $nerd->email_address      = $request->get('email_address');
            $nerd->nerd_level = $request->get('nerd_level');
            $nerd->save();

            // redirect
            Session::flash('message', 'Successfully updated nerd!');
            return Redirect::to('nerds');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $nerd = Nerd::find($id);
        $nerd->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return Redirect::to('nerds');
    }
}
