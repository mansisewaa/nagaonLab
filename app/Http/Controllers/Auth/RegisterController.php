<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Ledger;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Permission;
use App\Models\WalletMaster;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        //      'lab_name' => ['required','string', 'max:255'],
        //     'lab_address' => ['required','string', 'max:255'],
        //    'phone' => ['required','string', 'min:10'],
        //     'lab_email' => ['required','string', 'email', 'max:255', 'unique:users'],
        //      'center' => ['required','string', 'max:255'],
        //     'type' => ['required','string', 'max:255'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'lab_name' => $data['lab_name'],
            'lab_address' => $data['lab_address'],
            'phone' => $data['phone'],
            'lab_email' => $data['lab_email'],
            'center' => $data['center'],
            'type' => $data['lab_type'],
            'edit_permission' =>'0' ,
            'delete_permission' =>'0' ,
            'update_status' => '0',
            'coll_center'=>'1',
            'coll_agents'=>'1',
            'investigations' => '1',
            'referrer' => '1',
        ]);

        // if($user->type == 'CC'){

        //  try {
        //         WalletMaster::create([
        //             'center_id' => $user->id,
        //             'wallet_amount' => '0',
        //         ]);
        //         Ledger::create([
        //             'coll_center_id' => $user->id,
        //             'ledger_type' => 'OB',//opening balance
        //             'transaction_id' => $user->id,
        //         ]);

        //  } catch (\Throwable $th) {
        //     //throw $th;
        //     dd($th);
        //  }
        // }
        return $user;
    }
}
