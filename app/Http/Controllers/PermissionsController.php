<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        //dd($users);
        return view('pages.add-permissions', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $permissions1 = User::find($id);

        return view('pages.add-permissions', compact('permissions1'));
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
       $permissions = User::find($id);
            $permissions->coll_agents = $request->input('coll_agents');
            $permissions->coll_center = $request->input('coll_center');
            $permissions->investigations = $request->input('investigations');
            $permissions->referrer = $request->input('referrer');

            $permissions->edit_permission = $request->input('edit_permission');
            $permissions->delete_permission = $request->input('delete_permission');
            $permissions->update_status = $request->input('update_status');

            $permissions->save();

        return redirect()->back()->with('status', 'Permissions Updated Successfully');

        // dd('here');
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
