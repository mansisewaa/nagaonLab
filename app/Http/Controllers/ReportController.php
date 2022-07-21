<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestTransaction;
use App\Models\Investigation;
use App\Models\PatientDetails;



class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $search = PatientDetails::query()
            ->when(request('from_date'), function ($query) {
                $query->where('created_at', request("from_date"));
            })

            ->when(request('to_date'), function ($query) {
                $query->where('created_at', '=', request('to_date'));
            })
            ->exists();

        $records = collect();
        if (request('from_date') && request('to_date')) {

            if (auth()->user()->type == 'M') {
                $records = PatientDetails::query()
                    ->select('patient_details.*')
                    // ->select('fname','lname','total','id','price','balance','discount','advance',\DB::raw('sum(balance) as collections'))
                    ->whereBetween('created_at', [request('from_date'), request('to_date')])
                    ->get();
            } else {
                $records = PatientDetails::query()
                    ->select('patient_details.*')
                    // ->select('fname','lname','total','id','price','balance','discount','advance',\DB::raw('sum(balance) as collections'))
                    ->whereBetween('created_at', [request('from_date'), request('to_date')])
                    ->where('created_by', auth()->user()->id)
                    ->get();
            }
        } else {
            return view('reports.collection-report', compact('search', 'records'));
        }
        return view('reports.collection-report', compact('search', 'records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchTestCount()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewTestCount()
    {
        $tests = Investigation::pluck('investname', 'id');

        $search = TestTransaction::query()
            ->when(request('from_date'), function ($query) {
                $query->where('created_at', request("from_date"));
            })

            ->when(request('to_date'), function ($query) {
                $query->where('created_at', '=', request('to_date'));
            })
            ->when(request('test_name'), function ($query) {
                $query->where('inv_name', '=', request('test_name'));
            })
            ->exists();
        $records = collect();

        if (request('from_date') && request('to_date')) {

            $from =  request('from_date');
            $f = date('d-m-Y', strtotime($from));

            $to = request('to_date');
            $t = date('d-m-Y', strtotime($to));
            if(auth()->user()->type == 'M' ){

                $records = TestTransaction::query()
                ->select('inv_name', 'created_at', 'id')
                ->whereBetween('created_at', [request('from_date'), request('to_date')])
                ->when(request('test_name'), function ($query) {
                    $query->where('inv_name', '=', request('test_name'));
                })
                // ->join('patient_details', 'patient_details.id', '=', 'test_transactions.patient_id')
                // ->where('patient_details.created_by', '=', auth()->user()->id)
                ->groupBy('inv_name')->get();
            }else{
                $records = TestTransaction::query()
                    ->select('test_transactions.inv_name', 'test_transactions.created_at', 'test_transactions.id')
                    ->whereBetween('test_transactions.created_at', [request('from_date'), request('to_date')])
                    ->when(request('test_transactions.test_name'), function ($query) {
                        $query->where('inv_name', '=', request('test_name'));
                    })
                    ->join('patient_details', 'patient_details.id', '=', 'test_transactions.patient_id')
                    ->where('patient_details.created_by', '=', auth()->user()->id)
                    ->groupBy('inv_name')->get();
            }
             $recordsCount = $records->count();
        } else {
            return view('reports.test-count-report', compact('tests', 'records'));
        }
        return view('reports.test-count-report', compact('search', 'tests', 'records', 'recordsCount', 'f', 't'));
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
