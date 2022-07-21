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

	a .material-icons {
		vertical-align: middle !important;
	}
</style>

@section('content')

	<div>
		<div class="hide-print float-right" style="padding-bottom:11px;">
			<button class="btn btn-primary btn-sm" onclick="window.print()">Print</button>
		</div>
		<table class="table" style="width:100%;">
			<tr>
				<td style="text-align:center;" colspan="7">
					<h5>INVOICE</h5>
				</td>

			</tr>
			<tr>
				<td style="text-align:center;" colspan="7">
					<h5>HEALTH CARE LABORATORY<br />
						Opposite Apex Bank Ltd.<br />
						M.G Road Dihing
					</h5>
				</td>
			</tr>
			<td style="text-align:left;" colspan="7">
				Phone No:
			</td>
			</tr>
			<tr>
				<td colspan="3" width="50%">
					DATE :<br />
					Invoice No : <strong></strong><br />

				</td>

				<td style="text-align:left;" colspan="4">
					Name : <br /><br />
					Beneficiary No :
					<!-- Address:<br /><br /> -->

				</td>
			</tr>
			<tr>
				<td>SL</td>
				<td colspan="2">Particulars</td>

				<td class="text-center">HSN/ SAC</td>

				<td class="text-center">Quantity</td>

				<td class="text-center">Rate</td>

				<td class="text-center"> Amount </td>
			</tr>


			<tr>
				<td></td>
				<td colspan="2"></td>

				<td></td>

				<td class="text-right"></td>

				<td class="text-right"></td>

				<td class="text-right"></td>
			</tr>

			<tr>
				<td colspan="3" rowspan="7" valign="top">
					Rupees (in words) :
				</td>
				<td colspan="3">Total: </td>
				<td class="text-right"></td>
			</tr>
			<tr>
				<td colspan="3">Total Discount: </td>
				<td class="text-right"></td>
			</tr>
			<tr>
				<td colspan="3">Total Amount before Tax: </td>
				<td class="text-right"></td>
			</tr>
			<tr>
				<td colspan="3"> Add CGST: </td>
				<td class="text-right"></td>
			</tr>
			<tr>
				<td colspan="3"> Add SGST: </td>
				<td class="text-right"></td>
			</tr>
			<tr>
				<td colspan="3"> Total: </td>
				<td class="text-right"></td>
			</tr>
			<tr>
				<td colspan="3">Less subsidy: </td>
				<td class="text-right"></td>
			</tr>
			<tr>
				<td colspan="3" valign="bottom" rowspan="4">
					<br /><br />
					Goods once sold will not be taken back.
				</td>
				<td colspan="3"> Total: </td>
				<td class="text-right"></td>
			</tr>
			<tr>
				<td colspan="3"> Less GST:</td>
				<td class="text-right"></td>
			</tr>
			<tr>
				<td colspan="3">Net Amount:</td>
				<td class="text-right"></td>
			<tr>
				<td colspan="4" style="text-align:center; height:100px;">
					For, Assam Apex Weaveers & Artisans Co-pertaive Federation Ltd.
				</td>
			</tr>
		</table>
	</div>

@endsection
