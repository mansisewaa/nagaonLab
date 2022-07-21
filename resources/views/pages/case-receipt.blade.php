<style>
	@media print {
		@page {
			margin: 0;
			padding-top:10px;
		}

		.hide-print {
			display: none;
			padding-bottom: 20px;
		}
	}

	table,
	th,
	td {
		border: 1px solid rgb(211, 213, 215) !important;
		border-collapse: collapse;
	}

	table td {
		padding: 10px;

	}

	.text-center {
		text-align: center;
	}

</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />

<?php
    $barcode = $receipt->first()->receipt_no;
    // dd($barcode);

    $d = date('d-m-Y', strtotime($receipt->first()->created_at));
    // dd($d);
?>

<div style="padding-left: 60px;padding-right:50px; padding-bottom: 80px; padding-top:10px;">
	<div class="hide-print" style="padding-bottom:11px; float: right;">
		<button type="button" class="btn btn-primary btn-sm" onclick="window.print()">Print</button>
	</div>
	<table class="table table-sm" style="width:100%;">
		<tr>
			<td style="text-align:center;" colspan="7">
				<h2>{{ $receipt->first()->lab_name }}</h2>
				<h3>{{ $receipt->first()->lab_address }}</h3>
				<strong>Phone no: {{ $receipt->first()->phone }}</strong>

			</td>
		</tr>
		<tr>
			<td style="text-align:left;" colspan="7">
				<div class="mb-1" style="float:right;">{!! DNS1D::getBarcodeHTML($barcode, 'C128') !!}
                Receipt No: {{ $receipt->first()->receipt_no }}</div>
			</td>
		</tr>
		<tr>
			<td colspan="3" width="50%">

				Name : <strong>{{ $receipt->first()->title }} {{ $receipt->first()->fname }}
					{{ $receipt->first()->lname }}</strong><br />
				Age/Sex : <strong>{{ $receipt->first()->years }}/{{ $receipt->first()->gender }}</strong><br />
				Mobile : <strong>{{ $receipt->first()->mobile }}</strong>

			</td>

			<td style="text-align:right;" colspan="4">
				Reffered By : <strong>{{ $receipt->first()->refer }}</strong> <br />
				Date :<strong>{{ $d }}</strong> <br />
				Received By : <strong>{{ $receipt->first()->name }}</strong><br />
				Center : <strong>{{ $receipt->first()->center }}</strong><br />
				<!-- Address:<br /><br /> -->

			</td>
		</tr>
		<tr>
			<td style="text-align:center;" colspan="7">
				<strong>Case Details</strong>
			</td>
		</tr>
		<tr>
			<td colspan="3">Lab Investigations</td>

			<td style="text-align:right;" colspan="4">Fee</td>

		</tr>
		@foreach ($receipt as $values)
			<tr>
				<td colspan="3">
					<strong>{{ $values->inv_name }}</strong><br />
				</td>

				<td style="text-align:right;" colspan="4">
					<strong>{{ $values->inv_price }}</strong><br />
				</td>

			</tr>
		@endforeach
		<tr>
			<td style="text-align:center;" colspan="7">
				<strong>Payment Details</strong>
			</td>
		</tr>

		<tr>
			<td colspan="3">Total Fees: </td>
			<td style="text-align:right;" colspan="4"><strong>{{ $receipt->first()->price }} </strong></td>
		</tr>
		<tr>
			<td colspan="3"> Discount: </td>
			<td style="text-align:right;" colspan="4"><strong>{{ $receipt->first()->tdiscount }} </strong></td>
		</tr>


		<tr>
			<td colspan="3"> Amount Paid:</td>
			<td style="text-align:right;" colspan="4"><strong>{{ $receipt->first()->advance }} </strong></td>
		</tr>
		<tr>
			<td colspan="3">Balance:</td>
			<td style="text-align:right;" colspan="4"><strong>{{ $receipt->first()->balance }} </strong></td>
		</tr>
		<tr>
			<td colspan="7" style="text-align:center;">
				<strong>Thank You</strong>
			</td>
		</tr>
	</table>

</div>
