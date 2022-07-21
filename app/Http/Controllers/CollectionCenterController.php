<?php

namespace App\Http\Controllers;

use App\Models\CollectionCenter;
use Illuminate\Http\Request;

class CollectionCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->type == 'M'){
            $collection = CollectionCenter::all();
        }else{
            $collection = CollectionCenter::where('created_by', auth()->user()->id)->get();
        }

        // $collection = CollectionCenter::get();
        return view('pages.coll_center', compact('collection'));

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
            'code'    => 'required',
            'name'    => 'required',
            'address' => 'required',
            'city'    => 'required',
            'state'   => 'required',
            'zip'     => 'required',
            'mobile'  => 'required',
            'email'   => 'required',

        ]);

        $collection          = new CollectionCenter;
        $collection->code    = $request->input('code');
        $collection->name    = $request->input('name');
        $collection->address = $request->input('address');
        $collection->city    = $request->input('city');
        $collection->state   = $request->input('state');
        $collection->zip     = $request->input('zip');
        $collection->mobile  = $request->input('mobile');
        $collection->email   = $request->input('email');
        $collection->created_by = auth()->user()->id;

        $collection->save();
        return redirect()->back()->with('status', 'Collection Center Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CollectionCenter  $collectionCenter
     * @return \Illuminate\Http\Response
     */
    public function show(CollectionCenter $collectionCenter)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CollectionCenter  $collectionCenter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $collection = CollectionCenter::find($id);
    //    dd($collection);
       return view('pages.coll_center', compact('collection'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CollectionCenter  $collectionCenter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'code'    => 'required',
            'name'    => 'required',
            'address' => 'required',
            'city'    => 'required',
            'state'   => 'required',
            'zip'     => 'required',
            'mobile'  => 'required',
            'email'   => 'required',

        ]);

        $collection = CollectionCenter::find($id);
        $collection->code    = $request->input('code');
        $collection->name    = $request->input('name');
        $collection->address = $request->input('address');
        $collection->city    = $request->input('city');
        $collection->state   = $request->input('state');
        $collection->zip     = $request->input('zip');
        $collection->mobile  = $request->input('mobile');
        $collection->email   = $request->input('email');

        $collection->save();
        return redirect()->back()->with('status', 'Collection Center Updated Successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CollectionCenter  $collectionCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $collection = CollectionCenter::find($id);
        $collection->delete();

        return redirect()->route('coll_center_view');



    }
}
