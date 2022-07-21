<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\SoftDeletes;

class PatientDetails extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table    = 'patient_details';
    protected $fillable = [
       'receipt_no','ref_previous_id','title', 'fname', 'lname', 'years', 'months', 'days', 'mobile', 'email', 'address',
        'city', 'state', 'gender', 'refer', 'center', 'agent','mode' ,'status','price','discount_type','discountRs','discount','total','advance','balance','tdiscount','created_by','date_of_advance',
    ];
    public function tests()
    {
        return $this->hasMany(Test::class);
    }
    public function transactions()
    {
        return $this->hasMany(TestTransaction::class);
    }
}
