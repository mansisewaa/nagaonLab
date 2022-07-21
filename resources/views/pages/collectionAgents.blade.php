@extends('layouts.app', ['activePage' => 'notifications', 'titlePage' => __('Notifications')])
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

	input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	input[type=number] {
		-moz-appearance: textfield;
	}

	.button {
		float: right;
		margin-left: -50%;
		margin-top: 2em;
	}

	.main-panel>.content {
		margin-top: 30px !important;
		padding: 30px 15px;
		min-height: calc(100vh - 123px);
	}

	.error {
		color: red;
		font-size: 15px;
	}

</style>
@section('content')
	<div class="content">
		<div class="container-fluid col-md-12 col-lg-12">
			<div class="card col-sm-12">
				<div class="card-header card-header-primary d-flex justify-content-between">
					<h3 class="card-title">Collection Agents</h3>
					<a href="" class="btn btn-info btn-sm button" data-toggle="modal" data-target="#myModal">Add Agent</a>
				</div>
				<div class="card-body">
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
					<div class="table-responsive">
						<table class="table table-hover">
							<thead class="text-primary">
								<th>SL</th>
								<th>Name</th>
								<th>Mobile Number</th>
								<th>Address</th>
								<th>Action</th>
							</thead>
							<tbody>

								@foreach ($data as $key => $datas)
									<tr>
										<td> </td>
										<td>{{ $datas->agentname }}</td>
										<td>{{ $datas->mobile }}</td>
										<td>{{ $datas->address }}</td>

										<td style="display:flex;">
											<a href="{{ url('masters/edit-coll-agents/' . $datas->id) }}" class="btn btn-outline-success btn-sm" data-toggle="modal"
												style="margin-right:.6rem;" data-target="#editagents{{ $datas->id }}">Edit</a>
											{{-- edit modal --}}
											<div class="modal fade" id="editagents{{ $datas->id }}" role="dialog">
												<div class="modal-dialog modal-sm-10">
													<!-- Modal content-->
													<div class="modal-content">

														<div class="modal-header">
															<h2 class="modal-title">Edit Agent</h2>
															<div>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
														</div>
														<div class="modal-body">

															<div class="container-fluid">
																<form action="{{ url('masters/update-coll-agents/' . $datas->id) }}" method="POST">
																	{{ csrf_field() }}
																	{{ method_field('PUT') }}

																	<div class="form-row">
																		<div class="form-group col-md-12">
																			<label>Collection Center</label>
																			<select type="select" class="form-control" name="center_id">
																				<option>-Select-</option>
																				@foreach ($center as $key => $value)
																					<option value="{{ $key }}"{{ $datas->center_id = $key  ? 'selected' : ''}}>{{ $value }}
																					</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																	<div class="form-row">
																		<div class="form-group col-md-12">
																			<label>Edit Agents Name</label>
																			<input type="text" class="form-control" name="agentname" value="{{ $datas->agentname }}">
																		</div>
																	</div>
																	<div class="form-row">
																		<div class="form-group col-md-12">
																			<label> Edit Mobile</label>
																			<input type="text" class="form-control" name="mobile" value="{{ $datas->mobile }}">
																		</div>
																	</div>
																	<div class="form-row">
																		<div class="form-group col-md-12">
																			<label>Edit Address</label>
																			<input type="text" class="form-control" name="address" value="{{ $datas->address }}">
																		</div>
																	</div>
																	<div class="col-md-6 offset-4">
																		<button type="submit" class="btn btn-primary btn-sm" style="margin-top:20px">Update</button>
																	</div>
																</form>
															</div>

														</div>

													</div>
												</div>
											</div>

											<form action="{{ url('masters/collection-Agents/' . $datas->id) }}" method="post">
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
	</div>

	{{-- MODAL --}}

	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog modal-sm-10">
			<!-- Modal content-->
			<div class="modal-content">

				<div class="modal-header">
					<h2 class="modal-title">Add Agent</h2>
					<div>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
				</div>
				<div class="modal-body">

					<div class="container-fluid">
						<form action="{{ route('collectionAgents-add') }}" method="POST">
							@csrf
							{{ method_field('PUT') }}

							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Collection Center</label>
									<select type="select" class="form-control" name="center_id">
										<option>-Select-</option>
										@foreach ($center as $key => $value)
											<option value="{{ $key }}">{{ $value }}
											</option>
										@endforeach
									</select>
									@error('center_id')
										<div class="error">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Name of the Agents</label>
									<input type="text" class="form-control" name="agentname">
									@error('agentname')
										<div class="error">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Mobile</label>
									<input type="text" class="form-control" name="mobile">
									@error('agentname')
										<div class="error">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Address</label>
									<input type="text" class="form-control" name="address">
									@error('address')
										<div class="error">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="col-md-6 offset-4">
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


	</div>
@endsection
