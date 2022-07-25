@extends('layouts.app', ['activePage' => 'patientdetails', 'titlePage' => __('Payment')])
<style>
.card {
  width: 60% !important;
    margin: auto;
}
</style>

@section('content')
	<div class="content">
		<div class="container-fluid">
			<div class="card card-sm">
				<div class="card-header card-header-primary">
					<h3 class="card-title"><strong>Payment</strong></h3>
				</div>
				<hr>
				<div class="card-body" style="margin-left:50px;">

					<div class="row" style="margin-bottom: 30px;">
						<div class="col-sm-4">
							<label for="" style="color:black; font-size:25px">Amount</label>
							<input type="text" name="amount" id="amount" class="form-control text-center" style="font-size:20px" readonly value="{{ $amount ?? null }}">
							<input type="hidden" name="order_id" id="order_id" class="form-control" value="{{ $order_id ?? 'null' }}">
							<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" class="form-control">
							<input type="hidden" name="razorpay_order_id" id="razorpay_order_id" class="form-control">
							<input type="hidden" name="razorpay_signature" id="razorpay_signature" class="form-control">
							<input type="hidden" name="payment_status" id="payment_status" class="form-control">
							<input type="hidden" name="payment_description" id="payment_description" class="form-control">
						</div>

						<div style="padding-top:40px; margin-left:2rem;">
							<button type="submit" class="btn btn-success btn-sm" id="rzp-button1">Pay Now</button>
						</div>

					</div>

				</div>
			</div>
		</div>

	</div>
@endsection
@push('js')
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
	<script>
	 var amount = document.getElementById('amount').value;
	 var options = {
	  "key": "rzp_test_SNC6wCBRBavUwS", // Enter the Key ID generated from the Dashboard
	  "amount": parseInt(amount * 100),
	  "currency": "INR",
	  "name": "Nagaon Pathology Labratory",
	  "description": "Test Transaction",
	  "order_id": document.getElementById('order_id').value,
	  "handler": function(response) {
	   $("#razorpay_payment_id").val(response.razorpay_payment_id);
	   $("#razorpay_order_id").val(response.razorpay_order_id);
	   $("#razorpay_signature").val(response.razorpay_signature);
	   var payment_status = 'S';
	   var payment_des = 'Payment Successful';
	   $("#payment_status").val(payment_status);
	   $("#payment_description").val(payment_des);
	   alert("Payment Successful");

	   $.ajax({
	    type: 'post',
	    url: '{{ route('store-payment') }}',
	    data: {
	     'order_id': $("#order_id").val(),
	     'razorpay_payment_id': $("#razorpay_payment_id").val(),
	     'razorpay_order_id': $("#razorpay_order_id").val(),
	     'razorpay_signature': $("#razorpay_signature").val(),
	     'amount': $("#amount").val(),
	     'payment_status': $("#payment_status").val(),
	     'payment_description': $("#payment_description").val(),
	     '_token': '{{ csrf_token() }}'
	    },

	    success: function(data) {
	     window.location.href = '{{ route('recharge-wallet') }}';
	    }

	   });
	  },
	  "theme": {
	   "color": "#3399cc"
	  }
	 };
	 var rzp1 = new Razorpay(options);
	 rzp1.on('payment.failed', function(response) {
	  $("#razorpay_payment_id").val(response.error.metadata.payment_id);
	  $("#razorpay_order_id").val(response.error.metadata.order_id);
	  var payment_status = 'F';
	  $("#payment_status").val(payment_status);
	  $("#payment_description").val(response.error.description);
	  alert("Payment Failed");

	  $.ajax({
	   type: 'post',
	   url: '{{ route('store-payment') }}',
	   data: {
	    'order_id': $("#order_id").val(),
	    'razorpay_payment_id': $("#razorpay_payment_id").val(),
	    'razorpay_order_id': $("#razorpay_order_id").val(),
	    'razorpay_signature': $("#razorpay_signature").val(),
	    'amount': $("#amount").val(),
	    'payment_status': $("#payment_status").val(),
	    'payment_description': $("#payment_description").val(),
	    '_token': "{{ csrf_token() }}"
	   },

	   success: function(data) {
	    window.location.href = '{{ route('recharge-wallet') }}';
	   }

	  });
	 });
	 document.getElementById('rzp-button1').onclick = function(e) {
	  rzp1.open();
	  e.preventDefault();
	 }
	</script>
@endpush
