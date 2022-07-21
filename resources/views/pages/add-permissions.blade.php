@extends('layouts.app', ['activePage' => 'Permissions', 'titlePage' => __('Permissions')])

@section('content')
	<div class="content">
		<div class="container-fluid col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header card-header-primary d-flex justify-content-between">

					<h3 class="card-title">{{ __('Permissions') }}</h3>
					{{-- <a class="btn btn-primary" href="{{ route('permissions.create') }}">{{ __('Add Permission') }}</a> --}}
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
					<div class="table-responsive">
						<table class="table table-hover">
							<thead class="text-dark ">
								<th>SL</th>
								<th>User Name</th>
								<th>Permissions</th>
							</thead>
							<tbody>
								@foreach ($users as $user)
									<tr>

										<td>{{ $loop->iteration }}</td>
										<td>{{ $user->name }}</td>
										<td>
											<a href="{{ url('masters/edit-permissions/' . $user->id) }}" class="btn btn-info btn-sm"
												data-target="#editpermission{{ $user->id }}" data-toggle="modal">Edit Permissions</a>
											<div class="modal fade" id="editpermission{{ $user->id }}" role="dialog">
												<div class="modal-dialog modal-sm-10">
													<!-- Modal content-->
													<div class="modal-content">

														<div class="modal-header">
															<h2 class="modal-title">Edit Permissions</h2>
															<div>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
														</div>
														<div class="modal-body">

															<div class="container" style="margin:10px;">
																<form action="{{ url('masters/update-permissions/' . $user->id) }}" method="POST">
																	{{ csrf_field() }}
																	{{ method_field('PUT') }}
																	<h5 class="text-dark">-Master Permissions-</h5>
																	<div class="from-group">
																		<div class="col-sm-12">
																			<label class="text-dark">Add Collection Center: </label>
																			<div class="form-check-inline">
																				<label class="radio-inline">
																					<input type="radio" id="coll_center" name="coll_center" style="margin: .4rem" margin: .4rem;
																						value="0" {{ $user->coll_center == '0' ? 'checked' : '' }}>No</label>

																				<label class="radio-inline">
																					<input type="radio" name="coll_center" id="coll_center" style="margin: .4rem" value="1"
																						{{ $user->coll_center == '1' ? 'checked' : '' }}>Yes</label>
																			</div>

																		</div>
																		<div class="col-sm-12">
																			<label class="text-dark">Add Collection Agents: </label>
																			<div class="form-check-inline">
																				<label class="radio-inline">
																					<input type="radio" id="coll_agents" name="coll_agents" style="margin: .4rem" margin: .4rem;
																						value="0" {{ $user->coll_agents == '0' ? 'checked' : '' }}>No</label>

																				<label class="radio-inline">
																					<input type="radio" name="coll_agents" id="coll_agents" style="margin: .4rem" value="1"
																						{{ $user->coll_agents == '1' ? 'checked' : '' }}>Yes</label>
																			</div>

																		</div>
																		<div class="col-sm-12">
																			<label class="text-dark">Add Investigations: </label>
																			<div class="form-check-inline">
																				<label class="radio-inline">
																					<input type="radio" id="investigations" name="investigations" style="margin: .4rem" margin: .4rem;
																						value="0" {{ $user->investigations == '0' ? 'checked' : '' }}>No</label>

																				<label class="radio-inline">
																					<input type="radio" name="investigations" id="investigations" style="margin: .4rem" value="1"
																						{{ $user->investigations == '1' ? 'checked' : '' }}>Yes</label>
																			</div>

																		</div>
																		<div class="col-sm-12">
																			<label class="text-dark">Add Referrer: </label>
																			<div class="form-check-inline">
																				<label class="radio-inline">
																					<input type="radio" id="referrer" name="referrer" style="margin: .4rem" margin: .4rem; value="0"
																						{{ $user->referrer == '0' ? 'checked' : '' }}>No</label>

																				<label class="radio-inline">
																					<input type="radio" name="referrer" id="referrer" style="margin: .4rem" value="1"
																						{{ $user->referrer == '1' ? 'checked' : '' }}>Yes</label>
																			</div>

																		</div>
																	</div>
																	<br>

																	<h5 class="text-dark">-Case Details Permissions-</h5>

																	<div class="form-group">

																		<div class="col-sm-12">
																			<label class="text-dark">Edit: </label>
																			<div class="form-check-inline">
																				<label class="radio-inline">
																					<input type="radio" id="edit_permission" name="edit_permission" style="margin: .4rem" margin: .4rem;
																						value="0" {{ $user->edit_permission == '0' ? 'checked' : '' }}>No</label>

																				<label class="radio-inline">
																					<input type="radio" name="edit_permission" id="edit_permission" style="margin: .4rem" value="1"
																						{{ $user->edit_permission == '1' ? 'checked' : '' }}>Yes</label>
																			</div>

																		</div>


																		<div class="col-sm-12">
																			<label class="text-dark">Delete: </label>
																			<div class="form-check-inline">
																				<label class="radio-inline">
																					<input type="radio" id="delete_permission" name="delete_permission" style="margin: .4rem" margin:
																						.4rem; value="0" {{ $user->delete_permission == '0' ? 'checked' : '' }}>No</label>

																				<label class="radio-inline">
																					<input type="radio" name="delete_permission" id="delete_permission" style="margin: .4rem" value="1"
																						{{ $user->delete_permission == '1' ? 'checked' : '' }}>Yes</label>
																			</div>

																		</div>


																		<div class="col-sm-12">
																			<label class="text-dark">Update: </label>
																			<div class="form-check-inline">
																				<label class="radio-inline">
																					<input type="radio" id="update_status" name="update_status" style="margin: .4rem" margin: .4rem;
																						value="0" {{ $user->update_status == '0' ? 'checked' : '' }}>No</label>

																				<label class="radio-inline">
																					<input type="radio" name="update_status" id="update_status" style="margin: .4rem" value="1"
																						{{ $user->update_status == '1' ? 'checked' : '' }}>Yes</label>
																			</div>

																		</div>

																	</div>
																	<div class="col-md-6 offset-5">
																		<button type="submit" class="btn btn-primary btn-sm" style="margin-top:20px">Add</button>
																	</div>
																</form>
															</div>

														</div>

													</div>
												</div>
											</div>
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





	</div>
@endsection
