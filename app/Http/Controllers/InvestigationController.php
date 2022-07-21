<?php

namespace App\Http\Controllers;

use App\Models\Investigation;
use Illuminate\Http\Request;

class InvestigationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->type == 'M'){
            $data = Investigation::all();
        }else{
            $data = Investigation::where('created_by', auth()->user()->id)->get();
        }

        // $data = Investigation::get();
        return view('pages/investigations', compact('data'));

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
            'core'    => 'required',
            'investname'    => 'required',
            'code'    => 'required',
            'price'    => 'required',
        ]);

        $data          = new Investigation;
        $data->core    = $request->input('core');
        $data->investname  = $request->input('investname');
        $data->code = $request->input('code');
        $data->price    = $request->input('price');
        $data->created_by = auth()->user()->id;


        $data->save();
        return redirect()->back()->with('status', 'Investigations  Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function show(Investigation $investigation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $data = Investigation::find($id);
        return view('pages/investigations', compact('data'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'core'       => 'required',
            'investname' => 'required',
            'code'       => 'required',
            'price'      => 'required',
        ]);

        $data             = Investigation::find($id);
        $data->core       = $request->input('core');
        $data->investname = $request->input('investname');
        $data->code       = $request->input('code');
        $data->price      = $request->input('price');


        $data->save();
        return redirect()->back()->with('status', 'Investigations Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = Investigation::find($id);
        $data->delete();

        return redirect()->route('investigation');
        return back()->withStatus(__('Succesfully Deleted'));



    }
}
