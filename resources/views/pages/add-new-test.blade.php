@extends('layouts.app', ['activePage' => 'patientdetails', 'titlePage' => __('Patient Details')])

<style>
	.main-panel>.content {
		margin-top: 16px !important;
		padding: 30px 15px;
		min-height: calc(100vh - 123px);
	}

	.button {
		float: right;
		margin-left: -50%;
		margin-top: 2em;
	}

	input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	input[type=number] {
		-moz-appearance: textfield;
	}

	a .material-icons {
		vertical-align: middle !important;
	}

    .form-group {
		padding-bottom: 20px !important;
		position: relative;
		margin: 8px 0 0;

	}

	.card {
		border: 0;
		margin-bottom: 30px;
		margin-top: 30px;
		border-radius: 13px !important;
		color: #333333;
		background: #fff;
		width: 96% !important;
	}

	.error {
		color: red;
		font-size: 15px;
	}

	.m-rec {
		max-width: 680px !important;
	}

	.bmd-form-group .form-control,
	.bmd-form-group label,
	.bmd-form-group input::placeholder {
		line-height: 0.1 !important;
	}

</style>

{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
	integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
	crossorigin="anonymous" referrerpolicy="no-referrer" />

@section('content')
	<div class="content">
		<div class="card">
			<div class="card-header">
				<h2>New Case Visit</h2>
			</div>
			<div class="card-body">
				{{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif --}}
				@if (session('status'))
					<div class="row">
						<div class="col-sm-12">
							<div class="alert alert-info">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<i class="material-icons">close</i>
								</button>
								<span>{{ session('status') }}</span>
							</div>
						</div>
					</div>
				@endif

				<div class="container-fluid col-sm-12">
					<form action="{{ route('add-new-test-old-case') }}" method="POST">
						@csrf
						{{ method_field('PUT') }}



						<div class="form-row">
							<div class="form-group col-md-2">
								<input type="hidden" name="reference" value="{{ $pdetails->id }}">
								{{-- <label>Title</label> --}}
								<select class="form-control" name="title" id="title" class="text-dark">
									<option value="ns"> Select Title</option>
									<option value="Miss" {{ $pdetails->title == 'Miss' ? 'selected' : '' }}>Miss</option>
									<option value="Master" {{ $pdetails->title == 'Master' ? 'selected' : '' }}>Master</option>
									<option value="Mrs" {{ $pdetails->title == 'Mrs' ? 'selected' : '' }}>Mrs</option>
									<option value="Mr" {{ $pdetails->title == 'Mr' ? 'selected' : '' }}>Mr</option>
								</select>
							</div>
							<div class="form-group col-md-5">
								<label class="text-dark" style="font-size:1rem;">First Name</label>
								<input type="text" class="form-control text-bold" name="fname" value="{{ $pdetails->fname }}">
								@error('fname')
									<div class="error">{{ $message }}</div>
								@enderror

							</div>

							<div class="form-group col-md-5">
								<label class="text-dark" style="font-size:1rem;">Last Name</label>
								<input type="text" class="form-control" name="lname" value="{{ $pdetails->lname }}">
								@error('lname')
									<div class="error">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label class="text-dark" style="font-size:1rem;">Age</label>
								<input type="text" class="form-control" placeholder="Years" name="years" value="{{ $pdetails->years }}">
								{{-- <div class="input-group-text">@</div> --}}
							</div>
							<div class="form-group col-md-4">
								<input type="text" class="form-control" placeholder="Months" name="months" value="{{ $pdetails->months }}">
							</div>
							<div class="form-group col-md-4">
								<input type="text" class="form-control" placeholder="Days" name="days" value="{{ $pdetails->years }}">
							</div>

						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label class="text-dark" style="font-size:1rem;">Mobile Number</label>
								<input type="number" class="form-control" name="mobile" value="{{ $pdetails->mobile }}">
								@error('mobile')
									<div class="error">{{ $message }}</div>
								@enderror
							</div>

							<div class="form-group col-md-6">
								<label class="text-dark" style="font-size:1rem;">Email</label>
								<input type="email" class="form-control" name="email" value="{{ $pdetails->email }}">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-4">
								<label class="text-dark" style="font-size:1rem;">Address</label>
								<input type="text" class="form-control" name="address" value="{{ $pdetails->address }}">
								@error('address')
									<div class="error">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group col-md-4">
								<label class="text-dark" style="font-size:1rem;">City</label>
								<input type="text" class="form-control" name="city" value="{{ $pdetails->city }}">
							</div>
							<div class="form-group col-md-4">
								<label class="text-dark" style="font-size:1rem;">State</label>
								<input type="text" class="form-control" name="state" value="{{ $pdetails->state }}">
							</div>
						</div>

						<div class="form-row">
							<div class="col-sm-9">
								<label class="text-dark" style="font-size:1rem;">Gender: </label>
								<div class="form-check-inline">
									<label class="radio-inline">
										<input type="radio" id="male" name="gender" style="margin: .4rem" margin: .4rem; value="M"
											{{ $pdetails->gender == 'M' ? 'checked' : '' }}>
										Male</label>
								</div>
								<div class="form-check-inline">
									<label class="radio-inline">
										<input type="radio" name="gender" id="female" style="margin: .4rem" value="F"
											{{ $pdetails->gender == 'F' ? 'checked' : '' }}>Female</label>
								</div>

							</div>
						</div>

						<h3 class="sub-title" style="margin-top:20px">-Case Details-</h3>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label class="text-dark" style="font-size:1rem;">Referred By</label>
								<select class="form-control" name="refer" id="refer">
									<option value="Self">-Self-</option>
									@foreach ($refer as $key => $val)
										<option value="{{ $val->id }}">{{ $val->doctorname }}
										</option>
									@endforeach
								</select>

								<a href="" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#exampleModal">Add new</a>

							</div>
                        </div>
							{{-- <div class="form-group col-md-4">
								<label class="text-dark" style="font-size:1rem;">Collection Center</label>
								<select class="form-control" name="center" id="center">
									<option value="Self">Select</option>
									@foreach ($center as $key => $val)
										<option value="{{ $val->id }}">{{ $val->name }}
										</option>
									@endforeach
								</select>
								{{-- <a href="{{ url('masters/coll_center') }}" class="btn btn-outline-success btn-sm">Add new</a> --}}

								{{--<a href="" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#collcenter">Add new</a>

							</div> --}}
                            {{-- <div class="form-group col-md-4">
								@if (auth()->user()->type == 'M')
									<label class="text-dark" style="font-size:1rem;">Collection Center</label>
									<select class="form-control" name="center" id="center">
										<option value="Self">Select</option>
										@foreach ($center as $key => $val)
											<option value="{{ $val->id }}">{{ $val->name }}
											</option>
										@endforeach
									</select>


									<a href="" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#collcenter">Add new</a>

								@else
									<label class="text-dark" style="font-size:1rem;">Collection Center</label>
									<select class="form-control" name="center" id="center">
										<option value="{{ auth()->user()->id }}">{{ auth()->user()->lab_name }}</option>
									</select>
								@endif

							</div>

							<div class="form-group col-md-4">
								<label class="text-dark" style="font-size:1rem;">Collection Agent</label>
								<select class="form-control" name="agent" id="agent">
									<option value="Self">Select</option>
									@foreach ($agents as $key => $val)
										<option value="{{ $val->id}}">{{ $val->agentname }}
										</option>
									@endforeach
								</select>
								<a href="" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#collagent">Add new</a>

							</div> --}}

							<h3 class="sub-title" style="margin-top:20px">-Payment-</h3>
							<div class="container">
								<ol>
									<table class="table" id="core-services">
										<thead>
											<tr>

												<th style="font-weight:400;">Test</th>
												<th style="font-weight:400;" class="text-right">Amount</th>
												{{-- <th style="width:15%; font-weight:400;" class="text-center">Discount Type</th>
												<th style="width:15%; font-weight:400;" class="text-center">Discount</th> --}}
												{{-- <th style="width:15%; font-weight:400;" class="text-right">Total</th> --}}
											</tr>
											</head>
										<tbody>
											<tr>
												{{-- <td id="sl" class="sl"><li></li></td> --}}

												<td>
													<select class="js-example-basic-multiple" name="investigation_name[]" id="testname" multiple="multiple"
														style="width:350px;">
														{{-- @foreach ($investigation_name as $key => $values)
															<option data-price="{{ $key }}" value="{{ $values }}-{{ $key }}">
																{{ $values }}-{{ $key }}
															</option>
														@endforeach --}}
														@foreach ($investigation_name as $val)
															<option data-price="{{ $val->price }}" data-id="{{ $val->id }}"
																value="{{ $val->investname }}-{{ $val->price }}">{{ $val->investname }}-{{ $val->price }}
															</option>
														@endforeach
													</select>
													{{-- <input type="text" name="invest_id[]" id="invest_id" class="form-control input-sm text-right price"> --}}

													@error('investigation_name')
														<div class="error">{{ $message }}</div>
													@enderror
												</td>
												<td >
													<input type="number" step="0.01" name="price" id="price" class="form-control input-sm text-right price"
														placeholder="Price" oninput="calculatePrice(this)" oninput="calculatePriceinRs(this)">
												</td>

												{{--<td>
													<select name="discount_type" class="form-control" id="disc_type">
														<option value="">Select</option>
														<option value="%">%</option>
														<option value="Rs">Rs</option>
													</select>
												</td>

												<td style="width:15%;">
													<input type="hidden" step="0.01" name="discountRs" id="discountRs" class="form-control input-sm text-right"
														placeholder="Discount in Rs" oninput="calculatePriceinRs(this)">

													<input type="number" step="0.01" name="discount" id="discount"
														class="form-control input-sm text-right discount" placeholder="Discount in %"
														oninput="calculatePrice(this)">
												</td>

												<td style="width:15%;">
													<input type="number" step="0.01" name="total" id="ta" class="form-control input-sm text-right ta"
														placeholder="Total">
													<input type="hidden" step="0.01" name="tdiscount" class="from-control input-sm text-right tdiscount">
												</td>--}}
											</tr>
                                            <tr>
                                                <td class="text-right">Total</td>
                                                <td class="text-right"><input type="number" step="0.01" name="total" id="balance"
                                                        class="form-control input-sm text-right" placeholder="Total"></td>
                                                <td>
                                            </tr>
										</tbody>
										{{-- <tfoot>

											<tr>
												<td class="text-right" colspan="4">Advance Paid</td>
												<td class="text-right"><input type="number" step="0.01" name="advance" id="adv"
														class="form-control input-sm text-right" placeholder="Paid" oninput="calculateBalance()"></td>
												<td></td>
											</tr>
											<tr>
												<td class="text-right" colspan="4">Balance</td>
												<td class="text-right"><input type="number" step="0.01" name="balance" id="balance"
														class="form-control input-sm text-right" placeholder="Balance"></td>
												<td></td>
											</tr>
											<tr>
												<td class="text-right" colspan="4">Payment mode</td>
												<td>
													<select class="form-control text-right" name="mode">
														<option value="ns">Select</option>
														<option value="CASH">CASH</option>
														<option value="CARD">CARD</option>
														<option value="CARD">UPI</option>
													</select>
												</td>
												<td></td>
											</tr>
										</tfoot> --}}
									</table>

								</ol>
							</div>
							<div class="col-sm-6 offset-5">
								{{-- <button type="" class="btn btn-info btn-sm">Create Case</button> --}}
								<button type="submit" class="btn btn-primary btn-sm offset-8">Submit</button>
							</div>
					</form>

				</div>
			</div>
		</div>
	</div>


	{{-- modal for referrer --}}

	<div class="modal fade" id="exampleModal">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title">Add Referrer</h2>
					<div>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<form id="myform">
							<div class="form-row">
								<div class="form-group col-md-12">
									<label for="inputPassword4">Doctor's Name</label>
									<input type="text" class="form-control" name="doctorname" id="docname">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<label for="inputAddress">Specializations</label>
									<input type="text" class="form-control" name="specialin" id="spcl">
								</div>
							</div>
							<div class="col-md-6 offset-5">
								<button type="submit" class="btn btn-primary btn-sm" style="margin-top:20px">Submit</button>
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
	{{-- modal end --}}

	{{-- modal collcenter --}}
	<div class="modal fade" id="collcenter">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title">Add Collection Center</h2>
					<div>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
				</div>
				<div class="modal-body">
					<div class="container-fluid">

						<form id="addcenter">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label> Enter Code</label>
									<input type="text" class="form-control" name="code" id="code">
								</div>
								<div class="form-group col-md-6">
									<label for="inputPassword4">Enter Name</label>
									<input type="text" class="form-control" name="name" id="name">
								</div>
							</div>
							<div class="form-group">
								<label> Enter Address</label>
								<input type="text" class="form-control" name="address" id="address">
							</div>

							<div class="form-row">
								<div class="form-group col-md-6">
									<label>City</label>
									<input type="text" class="form-control" name="city" id="city">
								</div>
								<div class="form-group col-md-4">
									<label>State</label>
									<input type="text" class="form-control" name="state" id="state">
								</div>
								<div class="form-group col-md-2">
									<label>Zip</label>
									<input type="text" class="form-control" name="zip" id="zip">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label> Enter Mobile</label>
									<input type="text" class="form-control" name="mobile" id="mobile">
								</div>
								<div class="form-group col-md-6">
									<label>Enter Email</label>
									<input type="text" class="form-control" name="email" id="email">
								</div>
							</div>
							<div class="col-md-6 offset-4">
								<button type="submit" class="btn btn-primary btn-sm" style="margin-top:20px">Submit</button>
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
	{{-- modal end --}}

	{{-- modal for coll-agent --}}
	<div class="modal fade" id="collagent">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title">Add Collection Agent</h2>
					<div>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<form id="addagent">
							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Collection Center</label>
									<select type="select" class="form-control" name="center_id" id="center_id">
										<option>-Select-</option>
										@foreach ($center as $key => $value)
											<option value="{{ $key }}">{{ $value }}
											</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Name of the Agents</label>
									<input type="text" class="form-control" name="agentname" id="agentname">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Mobile</label>
									<input type="text" class="form-control mobile" name="mobile" id="mobile">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Address</label>
									<input type="text" class="form-control address" name="address" id="address">
								</div>
							</div>
							<div class="col-md-6 offset-4">
								<button type="submit" class="btn btn-primary btn-sm" style="margin-top:20px">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- end for coll-agent --}}

	{{-- modal for receipt --}}



@endsection



@push('js')
	<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
	 integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
	 crossorigin="anonymous" referrerpolicy="no-referrer"></script>


	<script>
	 $(function() {

	  $('#testname').on("change", function() {
	   var a = $(this).val();
	   var sum = 0;
	   var $this = $(this);
	   var list = $this.find("option:selected");
	   console.log($this.find("option:selected"));
	   $.each(list, function(index, item) {
	    var data = $(item).data();
	    console.log(data.price);
        console.log(data.id);
	    sum += parseFloat(data.price) || 0;
        id = data.id;
	   })
	   //   $("#in_price").val(data.price);
	   $("#price").val(sum);
       $("#balance").val(sum);
    //    $("#invest_id").u(id);

	  })

	 });
	</script>
	{{-- end onchange price --}}



	<script>
	  calculatePrice = function(obj) {
	   var $this = $(obj);
	   var parent = $this.parents("tr");
	   var price = parent.find("#price").val();
	   var discount = parent.find("#discount").val();
	   price = parseFloat(price);
	   discount = parseFloat(discount);

	   //   console.log("price", price, "discount", discount);
	   if (isNaN(price)) {
	    price = 0.00;
	   }
	   if (isNaN(discount)) {
	    discount = 0.00;
	   }
	   var amnt = discount / 100 * price;
	   console.log(amnt);
	   $(".tdiscount").val(amnt.toFixed(2));
	   var ta = price - amnt;
	   parent.find(".ta").val(ta.toFixed(2));
	   //calculateSum();
	  }

	 calculatePriceinRs = function(obj) {
	  var $this = $(obj);
	  var parent = $this.parents("tr");
	  var price = parent.find("#price").val();
	  var discount = parent.find("#discountRs").val();
	  price = parseFloat(price);
	  discount = parseFloat(discount);

	  console.log("price", price, "discountRs", discount);
	  if (isNaN(price)) {
	   price = 0.00;
	  }
	  if (isNaN(discount)) {
	   discount = 0.00;
	  }
	  // var amnt = discount / 100 * price;
	  // console.log(amnt);
	  var ta = price - discount;
	  $(".tdiscount").val(discount.toFixed(2));
	  parent.find(".ta").val(ta.toFixed(2));
	  //calculateSum();

	 }


	 calculateBalance = function() {

	  var adv = parseFloat($('#adv').val());
	  var ta = parseFloat($('#ta').val());
	  if (isNaN(adv)) {
	   adv = 0.00;
	  }
	  if (isNaN(ta)) {
	   ta = 0.00;
	  }
	  console.log("adv", adv, "ta", ta);
	  var balance = ta - adv;
	  console.log(balance);
	  $("#balance").val(balance.toFixed(2));
	 }
	</script>

	{{-- discount type --}}
	<script>
	 $(function() {

	  $('#disc_type').on("change", function() {
	   var type = $(this).val();
	   console.log(type);

	   if (type == '%') {
	    $('#discountRs').attr('type', 'hidden');
	    $('#discount').attr('type', 'nyumber');
	   } else {
	    $('#discount').attr('type', 'hidden');
	    $('#discountRs').attr('type', 'number');
	   }
	  })

	 });
	</script>

	{{-- Ajax to insert new referrer,center,agent --}}
	<script>
	 $("#myform").submit(function(e) {
	  e.preventDefault();

	  let doctorname = $("#docname").val();
	  let specialin = $("#spcl").val();

	  $.ajax({
	   url: "{{ route('add-patient-referrer') }}",
	   type: "PUT",
	   data: {
	    doctorname: doctorname,
	    specialin: specialin,
	    "_token": "{{ csrf_token() }}"

	   },

	   success: function(response) {
	    if (response) {
	     $("#myform")[0].reset();
	     $("#exampleModal").modal('hide');
	     loadDoctorData();
	    }
	   }
	  });

	 });
	</script>

	<script>
	 $("#addcenter").submit(function(e) {
	  e.preventDefault();

	  let code = $("#code").val();
	  let name = $("#name").val();
	  let address = $("#address").val();
	  let city = $("#city").val();
	  let state = $("#state").val();
	  let zip = $("#zip").val();
	  let mobile = $("#mobile").val();
	  let email = $("#email").val();

	  $.ajax({
	   url: "{{ route('add-patient-center') }}",
	   type: "PUT",
	   data: {
	    code: code,
	    name: name,
	    address: address,
	    city: city,
	    state: state,
	    zip: zip,
	    mobile: mobile,
	    email: email,
	    "_token": "{{ csrf_token() }}"

	   },


	   success: function(response) {
	    if (response) {
	     $("#addcenter")[0].reset();
	     $("#collcenter").modal('hide');
	     loadCenterData();
	    }
	   }
	  });

	 });
	</script>

	<script>
	 $("#addagent").submit(function(e) {
	  e.preventDefault();

	  let center_id = $("#center_id").val();
	  let agentname = $("#agentname").val();
	  let mobile = $(".mobile").val();
	  let address = $(".address").val();

	  console.log(mobile, address);

	  $.ajax({
	   url: "{{ route('add-patient-agent') }}",
	   type: "PUT",
	   data: {
	    center_id: center_id,
	    agentname: agentname,
	    mobile: mobile,
	    address: address,
	    "_token": "{{ csrf_token() }}"
	   },

	   success: function(response) {
	    if (response) {
	     $("#addagent")[0].reset();
	     $("#collagent").modal('hide');
	     loadAgentData();
	    }
	   }
	  });

	 });
	</script>


	<script>
	 loadDoctorData = function() {
	  $.ajax({
	   url: "{{ route('ajax-referrer-all') }}",
	   type: "GET",
	   data: {},

	   success: function(response) {

	    var html = "";
	    $.each(response, function(index, element) {

	     html += "<option value='" + element.id + "'>" + element.doctorname + "</option>";

	     $("#refer").html(html);
	    });
	    console.log(html);

	   }
	  });

	 };
	</script>
	<script>
	 loadCenterData = function() {
	  $.ajax({
	   url: "{{ route('ajax-center-all') }}",
	   type: "GET",
	   data: {},

	   success: function(response) {

	    var html = "";
	    $.each(response, function(index, element) {

	     html += "<option value='" + element.id + "'>" + element.name + "</option>";

	     $("#center").html(html);
	    });
	    console.log(html);

	   }
	  });

	 };
	</script>

	<script>
	 loadAgentData = function() {
	  $.ajax({
	   url: "{{ route('ajax-agent-all') }}",
	   type: "GET",
	   data: {},

	   success: function(response) {

	    var html = "";
	    $.each(response, function(index, element) {

	     html += "<option value='" + element.id + "'>" + element.agentname + "</option>";

	     $("#agent").html(html);
	    });
	    console.log(html);

	   }
	  });

	 };
	</script>

	{{-- select2 --}}

	<script>
	 // select multiple
	 $(document).ready(function() {
	  $.fn.select2.amd.require(['select2/selection/search'], function(Search) {
	   var oldRemoveChoice = Search.prototype.searchRemoveChoice;

	   Search.prototype.searchRemoveChoice = function() {
	    oldRemoveChoice.apply(this, arguments);
	    this.$search.val('');
	   };

	   $('#testname').select2({

	   });

	  });

	 });
	</script>


	<script>
	 $(document).ready(function() {
	  $('#investigation').select2();
	 });
	</script>

	{{-- gender change --}}
	<script>
	 $(function() {

	  $('#title').on("change", function() {
	   var a = $(this).val();
	   // console.log(a);

	   if (a == "Miss" || a == "Mrs") {

	    $("#female").prop("checked", true);
	    $("#male").prop("checked", false);
	   } else {
	    $("#female").prop("checked", false);
	    $("#male").prop("checked", true);
	   }

	  })

	 });
	</script>
@endpush
