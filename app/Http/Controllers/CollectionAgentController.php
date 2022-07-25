<?php

namespace App\Http\Controllers;

use App\Models\CollectionAgent;
use App\Models\CollectionCenter;
use Illuminate\Http\Request;

class CollectionAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('pages.collectionAgents');
        $center = CollectionCenter::where('created_by',auth()->user()->id)->pluck('name', 'id');
        // return view('pages.collectionAgents', compact('data'));
        if(auth()->user()->type == 'M'){
            $data = CollectionAgent::all();
        }
        else{
            $data = CollectionAgent::where('created_by', auth()->user()->id)->get();
        }

        return view('pages.collectionAgents', compact('data','center'));



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
            'center_id'       => 'required',
            'agentname' => 'required',
            'mobile'       => 'required',
            'address'      => 'required',
        ]);

        $data             = new CollectionAgent();
        $data->center_id       = $request->input('center_id');
        $data->agentname = $request->input('agentname');
        $data->mobile       = $request->input('mobile');
        $data->address      = $request->input('address');
        $data->created_by   = auth()->user()->id;

        $data->save();

        return redirect()->back()->with('status', 'Agents Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = CollectionAgent::find($id);
        return view('pages/collectionAgents', compact('data'));


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
        $request->validate([
            'center_id' => 'required',
            'agentname' => 'required',
            'mobile'    => 'required',
            'address'   => 'required',
        ]);

        $data            = CollectionAgent::find($id);
        $data->center_id = $request->input('center_id');
        $data->agentname = $request->input('agentname');
        $data->mobile    = $request->input('mobile');
        $data->address   = $request->input('address');

        $data->save();
        return redirect()->back()->with('status', 'Agents Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = CollectionAgent::find($id);
        $data->delete();

        // return redirect()->route('collectionAgents');
        return redirect()->back()->with('status', 'Agents Deleted Successfully');



    }


}
