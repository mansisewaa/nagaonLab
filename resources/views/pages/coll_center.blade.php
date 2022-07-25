@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

<style>
	/* generate serial no */
	body {
		counter-reset: Serial;
		/* Set the Serial counter to 0 */
	}

	table {
		border-collapse: separate;
	}

	tr td:first-child:before {
		counter-increment: Serial;
		/* Increment the Serial counter */
		content: counter(Serial);
		/* Display the counter */
	}

	.main-panel>.content {
		margin-top: 30px !important;
		padding: 30px 15px;
		min-height: calc(100vh - 123px);
	}

	.button {
		float: right;
		margin-left: -50%;
		margin-top: 2em;
	}

	.error {
		color: red;
		font-size: 15px;
	}

	.alert-success {
		color: #fff;
		background-color: #83a584;
		border-color: #83a884;
	}
</style>

@section('content')
<div class="content">

	{{-- table --}}
	<div class="container-fluid  col-md-12 col-lg-12">
		<div class="card">
			<div class="card-header card-header-primary d-flex justify-content-between">
				<h3 class="card-title">Collection Centers</h3>
				<a href="" class="btn btn-info btn-sm button" data-toggle="modal" data-target="#myModal">Add Center</a>
			</div>

			<div class="card-body">
				@if (session('status'))
				<div class="row">
					<div class="col-sm-12">
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<i class="material-icons">close</i>
							</button>
							<span>{{ session('status') }}</span>
						</div>
					</div>
				</div>
				@endif
				<div class="table-responsive ">
					<table class="table table-hover ">
						<thead class="text-primary">
							<th>SL</th>
							<th>Code</th>
							<th>Name</th>
							<th>Address</th>
							<th>Mobile</th>
							<th>Email</th>
							<th>Action</th>

						</thead>
						<tbody>
							@foreach ($collection as $key => $collect)
							<tr>
								<td> </td>
								<td>{{ $collect->code }}</td>
								<td>{{ $collect->name }}</td>
								<td>{{ $collect->address }},{{ $collect->city }}</td>
								<td>{{ $collect->mobile }}</td>
								<td>{{ $collect->email }}</td>
								<td style="display: flex;">
									<a href="{{ url('masters/edit-coll-center/' . $collect->id) }}"
										class="btn btn-outline-success btn-sm" style="margin-right:.6rem;"
										data-toggle="modal" data-target="#editmodal{{ $collect->id }}"
										data-id="{{ $collect->id }}">Edit</a>
									{{-- Edit Modal --}}
									<div class="modal fade" id="editmodal{{ $collect->id }}" role="dialog">
										<div class="modal-dialog modal-lg">

											<!-- Modal content-->
											<div class="modal-content">

												<div class="modal-header">
													<h2 class="modal-title">Edit Collection Center</h2>
													<div>
														<button type="button" class="close"
															data-dismiss="modal">&times;</button>
													</div>
												</div>
												<div class="modal-body">
													<form
														action="{{ url('masters/updated-coll-center/' . $collect->id) }}"
														method="POST">
														{{ csrf_field() }}
														{{ method_field('PUT') }}

														<div class="container-fluid" style="padding:inherit;">
															<div class="form-row">
																<div class="form-group col-md-6">
																	<label> Edit Code</label>
																	<input type="text" class="form-control" name="code"
																		value="{{ $collect->code }}">
																</div>
																<div class="form-group col-md-6">
																	<label for="inputPassword4">Edit Name</label>
																	<input type="text" class="form-control" name="name"
																		value="{{ $collect->name }}">
																</div>
															</div>
															<div class="form-group">
																<label> Edit Address</label>
																<input type="text" class="form-control" name="address"
																	value="{{ $collect->address }}">
															</div>

															<div class="form-row">
																<div class="form-group col-md-6">
																	<label>Edit City</label>
																	<input type="text" class="form-control" name="city"
																		value="{{ $collect->city }}">
																</div>
																<div class="form-group col-md-4">
																	<label> Edit State</label>
																	<input type="text" class="form-control" name="state"
																		value="{{ $collect->state }}">
																</div>
																<div class="form-group col-md-2">
																	<label> Edit Zip</label>
																	<input type="text" class="form-control" name="zip"
																		value="{{ $collect->zip }}">
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col-md-6">
																	<label>Edit Mobile</label>
																	<input type="text" class="form-control"
																		name="mobile" value="{{ $collect->mobile }}">
																</div>
																<div class="form-group col-md-6">
																	<label>Edit Email</label>
																	<input type="text" class="form-control" name="email"
																		value="{{ $collect->email }}">
																</div>


															</div>
															<div class="col-md-6 offset-5">
																<button type="submit" class="btn btn-primary btn-sm"
																	style="margin-top:20px">Update</button>
															</div>

														</div>
													</form>

												</div>
												{{-- <div class="modal-footer">
													<button type="button" class="btn btn-default"
														data-dismiss="modal"></button>
												</div> --}}
											</div>

										</div>
									</div>

									<form action="{{ url('masters/coll_center/' . $collect->id) }}" method="post">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-outline-danger btn-sm"
											onclick="return confirm('Are you sure ?')">Delete</button>

									</form>
								</td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- </div> --}}

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">

			<div class="modal-header">
				<h2 class="modal-title">Add Collection Center</h2>
				<div>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
			</div>
			<div class="modal-body">

				<div class="container-fluid" style="padding:inherit;">
					<form action="{{ url('masters/coll_center') }}" method="post">

						{{ csrf_field() }}
						{{ method_field('PUT') }}

						<div class="form-row">
							<div class="form-group col-md-6">
								<label> Enter Code</label>
								<input type="text" class="form-control" name="code">
								@error('code')
								<div class="error">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group col-md-6">
								<label for="inputPassword4">Enter Name</label>
								<input type="text" class="form-control" name="name">
								@error('name')
								<div class="error">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<label> Enter Address</label>
							<input type="text" class="form-control" name="address">
							@error('address')
							<div class="error">{{ $message }}</div>
							@enderror
						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label>City</label>
								<input type="text" class="form-control" name="city">
								@error('city')
								<div class="error">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group col-md-4">
								<label>State</label>
								<input type="text" class="form-control" name="state">
								@error('state')
								<div class="error">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group col-md-2">
								<label>Zip</label>
								<input type="text" class="form-control" name="zip">
								@error('zip')
								<div class="error">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label> Enter Mobile</label>
								<input type="text" class="form-control" name="mobile">
								@error('mobile')
								<div class="error">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group col-md-6">
								<label>Enter Email</label>
								<input type="text" class="form-control" name="email">
								@error('email')
								<div class="error">{{ $message }}</div>
								@enderror
							</div>


						</div>
						<div class="col-md-6 offset-5">
							<button type="submit" class="btn btn-primary btn-sm" style="margin-top:20px">Submit</button>
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
@endsection
