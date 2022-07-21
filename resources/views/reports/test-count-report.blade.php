@extends('layouts.app', ['activePage' => 'patientdetails', 'titlePage' => __('Patient Details')])

<style>
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

	.btn .material-icons,
	.btn:not(.btn-just-icon):not(.btn-fab) .fa {
		position: relative;
		display: inline-block;
		top: 9px !important;
		margin-top: -1em;
		margin-bottom: -1em;
		font-size: 1.1rem;
		vertical-align: middle;
	}

	.btn.btn-sm,
	.btn-group-sm>.btn,
	.btn-group-sm .btn {
		padding: none !important;
		font-size: 0.688rem;
		line-height: 1.5;
		border-radius: 0.2rem;
	}

	.modal-dialog {
		max-width: 715px !important;
		margin: 1.75rem auto;
	}

</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />

@section('content')
	<div class="content">
		<div class="container-fluid col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header ">
					<h3 class="card-title text-block"><i class="fa fa-filter" aria-hidden="true"></i> Filter</h3>

				</div>
				<div class="card-body">

					<form method="get" autocomplete="off" action=" ">
						<div class="row">
							<div class="form-row" style="padding-left:40px;">
                                <div class="col-sm-3">
								<div class="form-group input-group-sm">
									<label class="control-label text-dark" style="font-size:1rem;">From </label><br>
									<input type="date"  class="form-control" name="from_date" id="from_date" >

								</div>
							</div>
							<div class="col-sm-3" >
								<div class="form-group input-group-sm">
									<label class="control-label text-dark" style="font-size:1rem;">To </label><br>
									<input type="date"  class="form-control" name="to_date" id="to_date" >
								</div>
							</div>

                            <div class="col-sm-3">
								<div class="input-group-sm">
									<label class="control-label text-dark" style="font-size:1rem;">Test</label><br>
									<select name="test_name" class="form-control">
                                        <option value="">-All-</option>
                                        @foreach($tests as $key => $values)
                                            <option value="{{$values}}">{{$values}}</option>
                                        @endforeach
                                    </select>

								</div>
							</div>

							<div classs="col-sm-3" style="padding-top:20px;">
								<div class="form-group input-group-sm">
									<button type="submit" class="btn btn-success btn-sm" name="search"> <i class="fa fa-filter"
											aria-hidden="true"></i> Search</button>
									<a href="{{route('test-count-report')}}" class="btn btn-warning btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i>Reset </a>
								</div>
							</div>
                            </div>
						</div>
					</form>

				</div>

			</div>

		</div>
        <div class="container-fluid col-md-12 col-lg-12">
			<div class="card col-sm-12">
				<div class="card-header">
					<h3 class="card-title">Test Count Report </h3>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<th>SL</th>
								<th>Investigation Name</th>
								<th>No of Test</th>
								<th>From</th>
								<th>To</th>

							</thead>
							<tbody>
                                @forelse ($records as $record )

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$record->inv_name}}</td>
                                        <td>
                                         @php
                                             $e = App\Helper\CommonHelper::getTestCount($record->created_at,request('to_date'),$record->inv_name)
                                         @endphp
                                            {{$e}}


                                        </td>
                                        <td>{{ $f }}</td>
                                        <td>{{ $t }}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center" style="color:red;">No data found</td>
                                    </tr>
                                @endforelse

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection



@push('js')

	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"
	 integrity="sha512-fzff82+8pzHnwA1mQ0dzz9/E0B+ZRizq08yZfya66INZBz86qKTCt9MLU0NCNIgaMJCgeyhujhasnFUsYMsi0Q=="
	 crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/fontawesome.min.js"
	 integrity="sha512-vF2g7ozd8M2AA8re3eCrfJT2vvrOmIbW9JhodInQHN5Xjg6ec6nJpMJQcwuXm+aOhQze+CrM2rFQLftMtQA+bA=="
	 crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#test_name').select2();
        });
</script>

@endpush
