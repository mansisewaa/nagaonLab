<?php

namespace App\Http\Controllers;

use App\Models\CollectionAgent;
use App\Models\CollectionCenter;
use App\Models\Investigation;
use App\Models\Ledger;
use App\Models\PatientDetails;
use App\Models\Referrer;
use App\Models\Status;
use App\Models\Test;
use App\Models\TestTransaction;
use App\Models\User;
use App\Models\WalletMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon;

class PatientDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $refer              = Referrer::pluck('doctorname', 'id');
        $center             = CollectionCenter::pluck('name', 'id');
        $agents             = CollectionAgent::pluck('agentname', 'id');
        $investigation      = Investigation::pluck('core', 'id');
        $investigation_name = Investigation::pluck('investname', 'price');

        if (auth()->user()->type == 'M') {
            $patientdetails = PatientDetails::query()

                ->when(request("search"), function ($query) {
                    $query->where("fname", "LIKE", "%" . request("search") . "%")
                        ->orWhere("lname", "LIKE", "%" . request("search") . "%")
                        ->orWhere("mobile", "Like", "%" . request("search") . "%");
                })
                ->get();
        } else {
            $patientdetails = PatientDetails::query()

                ->when(request("search"), function ($query) {
                    $query->where("fname", "LIKE", "%" . request("search") . "%")
                        ->orWhere("lname", "LIKE", "%" . request("search") . "%")
                        ->orWhere("mobile", "Like", "%" . request("search") . "%");
                })
                ->where('created_by', auth()->user()->id)
                ->get();
        }

        return view('pages.patientdetails', compact('refer', 'center', 'agents', 'investigation', 'investigation_name', 'patientdetails'));
    }

    /**
     * Show the form for creating a new resource.
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function home()
    {
        if (auth()->user()->type == "CC") {
            $wallet = User::where('id', auth()->user()->id)->value('wallet_balance');
            if ($wallet == 0.00) {
                return redirect()->back()->with('error', 'Your wallet is empty. Please recharge your wallet to continue');
            } else {
                $refer  = Referrer::select('doctorname', 'id')->where('created_by', '=', auth()->user()->id)->get();
                $center = CollectionCenter::select('name', 'id')->where('created_by', '=', auth()->user()->id)->get();
                $agents = CollectionAgent::select('agentname', 'id')->where('created_by', '=', auth()->user()->id)->get();

                $investigation_name = DB::table('investigation')
                    ->select('id', 'investname', 'price')->where('deleted_at', null)
                    ->get();
                $wallet = User::where('id', auth()->user()->id)->value('wallet_balance');
            }
        }
        $refer  = Referrer::select('doctorname', 'id')->where('created_by', '=', auth()->user()->id)->get();
        $center = CollectionCenter::select('name', 'id')->where('created_by', '=', auth()->user()->id)->get();
        $agents = CollectionAgent::select('agentname', 'id')->where('created_by', '=', auth()->user()->id)->get();

        $investigation_name = DB::table('investigation')
        ->select('id', 'investname', 'price')->where('deleted_at', null)
        ->get();
        $wallet = User::where('id', auth()->user()->id)->value('wallet_balance');

        return view('pages.add-patient-details', compact('refer', 'center', 'agents', 'investigation_name','wallet'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // dd(auth()->user()->type);

        $request->validate([
            'title'              => 'required',
            'fname'              => 'required',
            'lname'              => 'required',
            'address'            => 'required',
            'mobile'             => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'investigation_name' => 'required',

        ]);
        DB::beginTransaction();
        try {

            $getreceipt = DB::table('patient_details')->select('receipt_no')->orderBy('receipt_no', 'desc')->first();

            if (is_null($getreceipt)) {
                // dd('8000');
                $receipt_no = 8000;
            } else {
                // dd('+1');
                $receipt_no = $getreceipt->receipt_no + 1;
            }
            // dd($receipt_no);
            $status     = 'Under Process';
            $currentDate = Carbon\Carbon::now();
            $currentDate->toDateTimeString();
            $cd = $currentDate->format('Y-m-d');

            $patientdetails = PatientDetails::create([
                'receipt_no'        => $receipt_no,
                'title'             => $request->input('title'),
                'fname'             => $request->input('fname'),
                'lname'             => $request->input('lname'),
                'years'             => $request->input('years'),
                'months'            => $request->input('months'),
                'days'              => $request->input('days'),
                'mobile'            => $request->input('mobile'),
                'email'             => $request->input('email'),
                'address'           => $request->input('address'),
                'city'              => $request->input('city'),
                'state'             => $request->input('state'),
                'gender'            => $request->input('gender'),
                'refer'             => $request->input('refer'),
                'center'            => $request->input('center'),
                'agent'             => $request->input('agent'),
                'mode'              => $request->input('mode'),
                'status'            => $status,
                'price'             => $request->input("price"),
                'discount_type'     => $request->input("discount_type"),
                'discountRs'        => $request->input('discountRs'),
                'discount'          => $request->input("discount"),
                'total'             => $request->input('total'),
                'advance'           => $request->input("advance"),
                'balance'           => $request->input('balance'),
                'tdiscount'         => $request->input('tdiscount'),
                'created_by'        => auth()->user()->id,
                'date_of_advance'   => $cd,
            ]);
            // dd($patientdetails);

            $investigation_name = $request->input('investigation_name');

            $test = $patientdetails->tests()->create([
                'price'         => request("price"),
                'discountRs'    => $request->input('discountRs'),
                'discount'      => request("discount"),
                'total'         => $request->input('total'),
                'advance'       => request("advance"),
                'balance'       => request('balance'),
                'tdiscount'     => request('tdiscount'),
            ]);
            // dd($test);
            foreach ($investigation_name as $value) {
                $invname = explode('-', $value, 2);
                // dd($invname);

                $test->transactions()->create([
                    "patient_id"            => $patientdetails->id,
                    "invastigation_name"    => $value,
                    "inv_name"              => $invname[0],
                    "inv_price"             => $invname[1],
                ]);
            }

            if (auth()->user()->type == "CC") {
                $ledger_data = [
                    'coll_center_id' => auth()->user()->id,
                    'transaction_id' => $patientdetails->id,
                    'ledger_type'    => 'PB', // patient bill
                    'debit'          => $request->input('total'),
                ];
                Ledger::create($ledger_data);
                $wallet = User::where('id', auth()->user()->id)->first();
                $updated_amount = $wallet->wallet_balance - $request->input('total');
                $wallet->update(['wallet_balance' => $updated_amount]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
        DB::commit();

        return redirect()->route('patientdetails')->with('status', 'Case Added Successfully');
    }

    public function addNewCase(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title'              => 'required',
            'fname'              => 'required',
            'lname'              => 'required',
            'address'            => 'required',
            'mobile'             => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'investigation_name' => 'required',

        ]);
        DB::beginTransaction();
        try {

            $getreceipt = DB::table('patient_details')->select('receipt_no')->orderBy('receipt_no', 'desc')->first();

            if (is_null($getreceipt)) {
                // dd('8000');
                $receipt_no = 8000;
            } else {
                // dd('+1');
                $receipt_no = $getreceipt->receipt_no + 1;
            }
            // $receipt_no = random_int(0000, 9999);
            $status     = 'Under Process';

            $patientdetails = PatientDetails::create([
                'receipt_no'            => $receipt_no,
                'ref_previous_id'       => request('reference'),
                'title'                 => $request->input('title'),
                'fname'                 => $request->input('fname'),
                'lname'                 => $request->input('lname'),
                'years'                 => $request->input('years'),
                'months'                => $request->input('months'),
                'days'                  => $request->input('days'),
                'mobile'                => $request->input('mobile'),
                'email'                 => $request->input('email'),
                'address'               => $request->input('address'),
                'city'                  => $request->input('city'),
                'state'                 => $request->input('state'),
                'gender'                => $request->input('gender'),
                'refer'                 => $request->input('refer'),
                'center'                => $request->input('center'),
                'agent'                 => $request->input('agent'),
                'mode'                  => $request->input('mode'),
                'status'                => $status,
                'price'                 => request("price"),
                'discount_type'         => $request->input("discount_type"),
                'discountRs'            => $request->input('discountRs'),
                'discount'              => request("discount"),
                'total'                 => request('total'),
                'advance'               => request("advance"),
                'balance'               => request('balance'),
                'tdiscount'             => request('tdiscount'),
                'created_by'            => auth()->user()->id,
            ]);

            $investigation_name = $request->input('investigation_name');

            $test = $patientdetails->tests()->create([
                'price'         => request("price"),
                'discount'      => request("discount"),
                'discountRs'    => request("discountRs"),
                'total'         => request('total'),
                'advance'       => request("advance"),
                'balance'       => request('balance'),
                'tdiscount'     => request('tdiscount'),
            ]);
            foreach ($investigation_name as $value) {
                $invname = explode('-', $value, 2);

                $test->transactions()->create([
                    "patient_id"            => $patientdetails->id,
                    "invastigation_name"    => $value,
                    "inv_name"              => $invname[0],
                    "inv_price"             => $invname[1],
                ]);
            }
            if (auth()->user()->type == "CC") {
                $ledger_data = [
                    'coll_center_id' => auth()->user()->id,
                    'transaction_id' => $patientdetails->id,
                    'ledger_type'    => 'PB', // patient bill
                    'debit'          => $request->input('total'),
                ];
                Ledger::create($ledger_data);
                $wallet = User::where('id', auth()->user()->id)->first();
                $updated_amount = $wallet->wallet_balance - $request->input('total');
                $wallet->update(['wallet_balance' => $updated_amount]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            //  dd($th);
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
        DB::commit();
        return redirect()->route('patientdetails')->with('status', 'New Case Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PatientDetails  $pateintDetails
     * @return \Illuminate\Http\Response
     */
    // public function show(PatientDetails $pateintDetails)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PatientDetails  $pateintDetails
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $patientdetails = PatientDetails::find($id);

        return view('pages.patientdetails', compact('patientdetails'));
    }

    public function edit($id)
    {

        $refer              = Referrer::pluck('doctorname', 'id');
        $center             = CollectionCenter::pluck('name', 'id');
        $agents             = CollectionAgent::pluck('agentname', 'id');
        // $investigation_name = Investigation::pluck('investname', 'price');
        $investigation_name = DB::table('investigation')
            ->select('id', 'investname', 'price')->where('deleted_at', null)
            ->get();


        $caseEdit = DB::table('patient_details')
            ->join('test_transactions', 'patient_details.id', '=', 'test_transactions.patient_id')
            ->select('patient_details.*', 'test_transactions.*')
            ->where('patient_details.id', '=', $id)
            ->get();
        //    dd($caseEdit);

        $getinv = DB::table('test_transactions')
            ->select('invastigation_name')->where('patient_id', '=', $id)->get();
        // dd($getinv);
        foreach ($getinv as $inv) {
            $invname[] = $inv->invastigation_name;
        }
        // dd($invname);

        // $investigation_name = Investigation::whereNotIn('investname', $caseEdit->investigation_name)->pluck('investname', 'price');


        return view('pages.edit-patient-details', compact('caseEdit', 'refer', 'center', 'agents', 'investigation_name', 'getinv', 'invname'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PatientDetails  $pateintDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'title'              => 'required',
            'fname'              => 'required',
            'lname'              => 'required',
            'address'            => 'required',
            'mobile'             => 'required',
            'investigation_name' => 'required',

        ]);
        DB::beginTransaction();
        try {

            $patientdetails = PatientDetails::where('id',$id)->update([

                'title'      => $request->input('title'),
                'fname'      => $request->input('fname'),
                'lname'      => $request->input('lname'),
                'years'      => $request->input('years'),
                'months'     => $request->input('months'),
                'days'       => $request->input('days'),
                'mobile'     => $request->input('mobile'),
                'email'      => $request->input('email'),
                'address'    => $request->input('address'),
                'city'       => $request->input('city'),
                'state'      => $request->input('state'),
                'gender'     => $request->input('gender'),
                'refer'      => $request->input('refer'),
                'center'     => $request->input('center'),
                'agent'      => $request->input('agent'),
                'mode'       => $request->input('mode'),
                'price'      => request("price"),
                'discount_type' => $request->input("discount_type"),
                'discountRs'    => $request->input('discountRs'),
                'discount' => request("discount"),
                'total'      => $request->input('total'),
                'advance'    => request("advance"),
                'balance'    => request('balance'),
            ]);

            $investigation_name = $request->input('investigation_name');

            $test = Test::where('patient_details_id', $id)->update([
                'price'    => request("price"),
                'discount' => request("discount"),
                'discountRs' => request("discountRs"),
                'total'    => request('total'),
                'advance'  => request("advance"),
                'balance'  => request('balance'),
            ]);
            foreach ($investigation_name as $value) {
                $invname = explode('-', $value, 2);

                $transaction = TestTransaction::where('patient_id', $id)->update([
                    'invastigation_name' => $value,
                    "inv_name"           => $invname[0],
                    "inv_price"          => $invname[1],

                ]);
            }

            // $investigation_name = $request->input('investigation_name');

            // $test = $patientdetails->tests()->update([
            //     'price'    => request("price"),
            //     'discountRs'    => $request->input('discountRs'),
            //     'discount' => request("discount"),
            //     'total'    => $request->input('total'),
            //     'advance'  => request("advance"),
            //     'balance'  => request('balance'),
            // ]);
            // foreach ($investigation_name as $value) {
            //     $invname = explode('-', $value, 2);

            //     $test->transactions()->update([
            //         "patient_id"         => $patientdetails->id,
            //         "invastigation_name" => $value,
            //         "inv_name"           => $invname[0],
            //         "inv_price"          => $invname[1],
            //     ]);
            // }
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return redirect()
                ->back()
                ->with('error', $th->getMessage());
        }
        DB::commit();

        return redirect()->route('patientdetails')->with('status', 'Case Updated Successfully', ['patientdetails' => $patientdetails]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatientDetails  $pateintDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patientdetails = PatientDetails::find($id);
        $patientdetails->delete();
        return redirect()->back()->with('status', 'Case Deleted Successfully');
    }

    public function submit(Request $request)
    {

        $details             = new Referrer();
        $details->doctorname = $request->doctorname;
        $details->specialin  = $request->specialin;
        $details->created_by = auth()->user()->id;
        $details->save();
        return response()->json($details);
    }

    public function submitcenter(Request $request)
    {
        $center          = new CollectionCenter();
        $center->code    = $request->code;
        $center->name    = $request->name;
        $center->address = $request->address;
        $center->city    = $request->city;
        $center->state   = $request->state;
        $center->zip     = $request->zip;
        $center->mobile  = $request->mobile;
        $center->email   = $request->email;
        $center->created_by = auth()->user()->id;
        $center->save();

        return response()->json($center);
    }
    public function submitagent(Request $request)
    {
        $agent            = new CollectionAgent();
        $agent->center_id = $request->center_id;
        $agent->agentname = $request->agentname;

        $agent->mobile  = $request->mobile;
        $agent->address = $request->address;
        $agent->created_by = auth()->user()->id;
        $agent->save();

        return response()->json($agent);
    }

    public function getreferrer()
    {
        return response()->json(Referrer::select('id', 'doctorname')->where('created_by', auth()->user()->id)->get());
    }
    public function getcenter()
    {
        return response()->json(CollectionCenter::select('id', 'doctorname')->where('created_by', auth()->user()->id)->get());
    }
    public function getagent()
    {
        return response()->json(CollectionAgent::select('id', 'doctorname')->where('created_by', auth()->user()->id)->get());
    }


    public function show($id)
    {
        $receipt = DB::table('patient_details')
            ->join('test_transactions', 'patient_details.id', '=', 'test_transactions.patient_id')
            ->join('users', 'users.id', '=', 'patient_details.created_by')
            ->select('patient_details.*', 'test_transactions.*', 'users.*')
            ->where('patient_details.id', '=', $id)
            ->get();
        // dd($receipt);

        return view('pages.case-receipt', compact('receipt'));
    }

    //  Status Update
    public function editstatus($id)
    {
        $details = PatientDetails::find($id);
        return view('pages.patientdetails', compact('details'));
    }

    public function UpdateStatus(Request $request, $id)
    {
        $details = PatientDetails::find($id);

        $details->status = $request->input('status');
        $details->save();

        // return response()->json($data);
        return redirect()->back();
    }

    public function addNewTest($id)
    {
        $refer  = Referrer::select('doctorname', 'id')->where('created_by', '=', auth()->user()->id)->get();
        $center = CollectionCenter::select('name', 'id')->where('created_by', '=', auth()->user()->id)->get();
        $agents = CollectionAgent::select('agentname', 'id')->where('created_by', '=', auth()->user()->id)->get();
        // $investigation      = Investigation::pluck('core', 'id');
        // $investigation_name = Investigation::pluck('investname', 'price');
        $investigation_name = DB::table('investigation')
            ->select('id', 'investname', 'price')->where('deleted_at', null)
            ->get();

        $pdetails = PatientDetails::find($id);

        return view('pages.add-new-test', compact('pdetails', 'refer', 'center', 'agents', 'investigation_name'));
    }
}
