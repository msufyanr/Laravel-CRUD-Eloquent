<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\masterutility;
use App\detailutility;
use Illuminate\Support\Facades\Redirect;
use Session;

class MasterDetailController extends Controller
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
        $masterdetail = MasterUtility::with('detailutilities')->get();
        // load the view and pass the Master/Details
           return view('MasterDetail.index')
               ->with('masterdetails', $masterdetail);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('MasterDetail.create');
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
            'name'       => 'required|unique:master_utilities',
            'utility_sub_name'      => 'required'
        );
        $validator = validator($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('master/create')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            // store
            
            $master = new MasterUtility;
            $master->utility_ID = $request->get('utility_ID');
            $master->name       = $request->get('name');
            $master->save();
            $getmaster = MasterUtility::select('id')->where('name',$master->name)->get();
            $sub_name = explode("\r\n", $request->get('utility_sub_name'));
            
            foreach ($sub_name as $key => $value) {
                # code...
                $detail = new DetailUtility;
                $detail->utility_sub_name = $value;
                $detail->utility_master_id = $getmaster[0]->id;
                $detail->save();
            }   
        }
        Session::flash('message', 'Successfully created Master/Details!');
            return Redirect::to('master');
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
        $getmaster = MasterUtility::where('utility_ID',$id)->first();
        $detailvalues = MasterUtility::find($getmaster->id)->detailutilities;
        foreach ($detailvalues as $key => $value) {
            # code...
            $tempvalues[] = $value->utility_sub_name;
        }
        $master = array('utility_ID' => $getmaster->utility_ID, 'name' => $getmaster->name, 'sub_name' => $tempvalues);
        // show the view and pass the nerd to it
        return view('MasterDetail.show')
            ->with('masters', $master);
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
        $getmaster = MasterUtility::where('utility_ID',$id)->first();
        $detailvalues = MasterUtility::find($getmaster->id)->detailutilities;
        $tempvalues="";
        foreach ($detailvalues as $key => $value) {
            # code...
            $tempvalues .= (string) $value->utility_sub_name . "\r\n";
        }
        $master = array('utility_ID' => $getmaster->utility_ID, 'name' => $getmaster->name, 'sub_name' => $tempvalues);
        //dd($master);
        // show the edit form and pass the nerd
        return view('MasterDetail.edit')
            ->with('masters', $master);
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
            'utility_ID'       => 'required',
            'name'      => 'required',
            'sub_name' => 'required'
        );
        $validator = validator($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('master/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            // store
            $getoldmaster = MasterUtility::where('utility_ID',$id)->first();
            //dd($getoldmaster);
            $getoldmaster->name       = $request->get('name');
            $getoldmaster->utility_ID      = $request->get('utility_ID');
            //$nerd->nerd_level = $request->get('nerd_level');
            //$getoldmaster->save();
            //dd($request);
            $sub_name = explode("\r\n", $request->get('sub_name'));
            $detail_id = $getoldmaster->id;
            $getdetail = DetailUtility::where('utility_master_id',$detail_id)->get();
            $tempCheck = $getdetail->count();
            foreach ($getdetail as $key => $value) {
                # code...
                dd($sub_name);
                if ($tempCheck != 0) {
                    # code...
                    $value->utility_sub_name = $sub_name[$tempCheck-1];
                    $value->save();

                }

            }
            //dd($getdetail);
            // redirect
            Session::flash('message', 'Successfully updated Master/Details!');
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
    }
}
