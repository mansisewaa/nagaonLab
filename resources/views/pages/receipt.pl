 <div class="container-fluid">

                                                                <div class="float-right">
                                                                    <div class="mb-3">{!! DNS1D::getBarcodeHTML($data->receipt_no, 'CODABAR') !!}</div>
                                                                </div>

                                                                <div class="float-right">
                                                                   <div>
                                                                        Date: {{$data->created_at->format('d/m/Y')}}
                                                                   </div>
                                                                   <div>
                                                                        Reffered By:{{$data->refer}}
                                                                   </div>
                                                                   <div>
                                                                        Center:{{$data->center}}
                                                                   </div>

                                                                </div>

                                                                <div>
                                                                   Name:  {{$data->title}} {{$data->fname}} {{$data->lname}}
                                                                </div>
                                                                <div>
                                                                    Gender/Age:  {{$data->gender}}/{{$data->years}}
                                                                </div>
                                                                <div>
                                                                    Mobile: {{$data->mobile}}
                                                                </div>
                                                                <div>

                                                                </div>
                                                            </div>



{{-- <!-- Modal --> --}}
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header">
                        <h2 class="modal-title"> Enter Patient Details </h2>
                        <div>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                    <div class="modal-body">

                        <div class="container-fluid">
                            <form action="{{ route('patient-details-view') }}" method="POST">
                                @csrf
                                {{ method_field('PUT') }}
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        {{-- <label>Title</label> --}}
                                        <select class="form-control" name="title">
                                            <option value="ns"> Select Title</option>
                                            <option value="Miss">Miss</option>
                                            <option value="Master">Master</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Mr">Mr</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-dark">First Name</label>
                                        <input type="text" class="form-control" name="fname">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="text-dark">Last Name</label>
                                        <input type="text" class="form-control" name="lname">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label class="text-dark">Age</label>
                                        <input type="text" class="form-control" placeholder="Years" name="years">
                                        {{-- <div class="input-group-text">@</div> --}}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" placeholder="Months" name="months">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" placeholder="Days" name="days">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="text-dark">Mobile Number</label>
                                        <input type="number" class="form-control" name="mobile">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="text-dark">Email</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label class="text-dark" class="text-dark">Address</label>
                                        <input type="text" class="form-control" name="address">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="text-dark">City</label>
                                        <input type="text" class="form-control" name="city">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="text-dark">State</label>
                                        <input type="text" class="form-control" name="state">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-sm-9">
                                        <label class="text-dark">Gender: </label>
                                        <div class="form-check-inline">
                                            <label class="radio-inline">
                                                <input type="radio" name="gender" style="margin: .4rem" margin: .4rem; value="M">Male</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="radio-inline">
                                                <input type="radio" name="gender" style="margin: .4rem" value="F">Female</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="radio-inline">
                                                <input type="radio" name="gender" style="margin: .4rem" value="O">Others</label>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="sub-title" style="margin-top:20px">-Case Details-</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label class="text-dark">Referred By</label>
                                        <select class="form-control" name="refer">
                                            <option>-Select-</option>
                                            @foreach ($refer as $key => $values)
                                                <option value="{{ $values }}">{{ $values }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <a href="{{ url('/referrer') }}" class="btn btn-outline-success btn-sm">Add new</a>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="text-dark">Collection Center</label>
                                        <select class="form-control" name="center">
                                            <option>Select Item</option>
                                            @foreach ($center as $key => $values)
                                                <option value="{{ $values }}">{{ $values }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <a href="{{ url('masters/coll_center') }}" class="btn btn-outline-success btn-sm">Add new</a>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="text-dark">Collection Agent</label>
                                        <select class="form-control" name="agent">
                                            <option>Select Item</option>
                                            @foreach ($agents as $key => $values)
                                                <option value="{{ $values }}">{{ $values }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <a href="{{ url('masters/collection-agents') }}" class="btn btn-outline-success btn-sm">Add new</a>
                                    </div>
                                </div>

                                <h3 class="sub-title" style="margin-top:20px">-Payment-</h3>
                                <div class="container">
                                    <ol>
                                        <table class="table" id="core-services">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th style="width:20%">Service</th>
                                                    <th style="width:20%">Test</th>
                                                    <th style="width:10%">Price</th>
                                                    <th style="width:15%">Discount</th>
                                                    <th style="width:15%">Total</th>
                                                    <th>Action</th>
                                                </tr>
                                                </head>
                                            <tbody>
                                                <tr>
                                                    <td id="sl" class="sl">
                                                        <li></li>
                                                    </td>
                                                    <td style="width:20%">
                                                        {{-- <input type="text" class="form-control" name="service[]" id="service"> --}}
                                                        <select class="form-control" id="investigation" name="investigation[]">
                                                            <option>Select Service</option>
                                                            @foreach ($investigation as $key => $values)
                                                                <option value="{{ $values }}">{{ $values }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td style="width:20%">
                                                        <select class="form-control testname" name="investigation_name[]" id="testname"
                                                            onChange="ChangePrice(this)">
                                                            <option>Select Test</option>
                                                            @foreach ($investigation_name as $key => $values)
                                                                <option data-price="{{ $key }}" value="{{ $values }}">{{ $values }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td style="width:10%">
                                                        <input type="number" step="0.01" name="price[]" id="price" class="form-control input-sm text-right price"
                                                            placeholder="Price" oninput="calculatePrice(this)">
                                                    </td>

                                                    <td style="width:15%">
                                                        <input type="number" step="0.01" name="discount[]" id="discount" class="form-control input-sm text-right"
                                                            placeholder="Discount%" oninput="calculatePrice(this)">
                                                    </td>
                                                    <td style="width:15%">
                                                        <input type="number" step="0.01" name="total[]" id="ta" class="form-control input-sm text-right"
                                                            placeholder="Total">
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-sm btn-danger" type="button" onclick="removeMe(this)">
                                                            {{-- <i class="fa fa-trash"></i> --}} X
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="text-right" colspan="5">Total</td>
                                                    <td class="text-right"><input type="number" name="ttamount" id="tta"
                                                            class="form-control input-sm text-right" placeholder="Total Amount" oninput="calculateBalance()"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" colspan="5">Advance Paid</td>
                                                    <td class="text-right"><input type="number" name="advance" id="adv"
                                                            class="form-control input-sm text-right" placeholder="Paid" oninput="calculateBalance()"></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" colspan="5">Balance</td>
                                                    <td class="text-right"><input type="number" name="balance" id="balance"
                                                            class="form-control input-sm text-right" placeholder="Balance">
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div>
                                            <button class="btn btn-outline-primary btn-sm" type="button" onClick="AddNewRow(this)"><i
                                                    class="fa fa-plus-sign"></i> Add New</button>
                                        </div>
                                        {{-- <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label class="text-dark"> Mode of Payment: </label>
                                                <select class="form-control">
                                                    <option value="ns">-Select-</option>
                                                    <option value="CASH">CASH</option>
                                                    <option value="CARD">CARD</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                    </ol>
                                </div>

                                <div class="button d-flex justify-content-between">
                                    <button type="" class="btn btn-info btn-sm">Create Case</button>
                                    <button type="submit" class="btn btn-primary btn-sm offset-8">Submit</button>
                                </div>
                            </form>
                        </div>


                    </div>
                    {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"></button>
                    </div> --}}
                </div>

            </div>
        </div>
