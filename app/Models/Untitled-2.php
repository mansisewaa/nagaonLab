   $patientdetails = PatientDetails::create([

            // dd($receipt_no),
            'receipt_no' =>$receipt_no,
            'title' =>  $request->input('title'),
            'fname' =>  $request->input('fname'),
            'lname' =>  $request->input('lname'),
            'years' =>  $request->input('years'),
            'months' =>  $request->input('months'),
            'days' =>  $request->input('days'),
            'mobile' =>  $request->input('mobile'),
            'email' =>  $request->input('email'),
            'address' =>  $request->input('address'),
            'city' =>  $request->input('city'),
            'state' =>  $request->input('state'),
            'gender' =>  $request->input('gender'),
            'refer' =>  $request->input('refer'),
            'center' =>  $request->input('center'),
            'agent' =>  $request->input('agent'),
            'mode' =>  $request->input('mode'),


        ]);

        $investigation_name = $request->input('investigation_name');
        foreach ($investigation_name as $key => $patient_details)
        {
            $tests = Test::create([
                'patient_details_id' => $patientdetails->id,
                'investigation'      => $request->input('investigation'),
                'investigation_name' => $request->input('investigation_name'),
                'price'              => $request->input('price'),
                'discount'           => $request->input('discount'),
                'advance'            => $request->input('advance'),
                'balance'            => $request->input('balance'),
                'total'              => $request->input('total'),

            ]);

        }


            $test_transactions = TestTransaction::create([
                'test_id' => $tests->id,
                'investigation_name' => $request->input('investigation_name'),
                'price'              => $request->input('price'),
                'discount'           => $request->input('discount'),
                'advance'            => $request->input('advance'),
                'balance'            => $request->input('balance'),
                'total'              => $request->input('total'),

            ]);




        $patientdetails->tests()->save($tests);
