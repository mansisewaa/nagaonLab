@extends('layouts.app', ['activePage' => 'patientdetails', 'titlePage' => __('Recharge Wallet')])

@section('content')
	<div class="content">
		<div class="container-fluid">
			<div class="card card-sm">
				<div class="card-header card-header-primary">
					<h3 class="card-title">Recharge Wallet</h3>
				</div>
				<hr>
				<div class="card-body" style="margin-left:20px;">
					<form action="{{ route('order_id_generate')}}" method="POST">
						@csrf
						<div class="row">
							<div class="col-sm-4">
								<label for="" style="color:black"> Enter Amount</label>
								<input type="number" name="amount" id="amount" class="form-control">
							</div>
							<div style="padding-top:30px; margin-left:2rem;">
								<button type="submit" class="btn btn-info btn-sm" onclick="confirmAlert()">Recharge</button>
							</div>

						</div>

					</form>
				</div>
			</div>
		</div>

	</div>
@endsection
@push('js')
	<script>
	 function confirmAlert() {
	  var amount = document.getElementById('amount').value;
	  if (amount == '') {
	   alert('Please Enter Amount');
	   return false;
	  } else {
	   // var r = confirm("Are you sure you want to recharge wallet ?");
	   var r = confirm('Are you sure you want to recharge your wallet of ' + amount + ' Rs.');
	   if (r == true) {
	    return true;
	   } else {
	    return false;
	   }
	  }
	 }
	</script>
@endpush
