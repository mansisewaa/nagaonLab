<?php

namespace App\Http\Controllers;

use App\Models\Referrer;
use Illuminate\Http\Request;

class ReferrerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->type == 'M'){
            $ref = Referrer::all();
        }else{
            $ref = Referrer::where('created_by', auth()->user()->id)->get();
        }
        // $ref = Referrer::get();
        return view('pages/referrer', compact('ref'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctorname'  => 'required',
            'specialin'  => 'required',

        ]);

        $ref             = new Referrer;
        $ref->doctorname = $request->input('doctorname');
        $ref->specialin  = $request->input('specialin');
        $ref->created_by = auth()->user()->id;

        $ref->save();
        return redirect()->back()->with('status', 'Referrers Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Referrer  $referrer
     * @return \Illuminate\Http\Response
     */
    public function show(Referrer $referrer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Referrer  $referrer
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $ref = Referrer::find($id);
        return view('pages/referrer', compact('ref'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Referrer  $referrer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'doctorname' => 'required',
            'specialin'  => 'required',

        ]);

        $ref             = Referrer::find($id);
        $ref->doctorname = $request->input('doctorname');
        $ref->specialin  = $request->input('specialin');

        $ref->save();
        return redirect()->back()->with('status', 'Referrers Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Referrer  $referrer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ref = Referrer::find($id);
        $ref->delete();

        return redirect()->route('referrer');

    }
}
