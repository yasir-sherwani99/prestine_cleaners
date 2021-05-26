@extends('layouts.admin')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/forms/selects/select2.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/plugins/forms/validation/form-validation.css') }}">
@endsection

@section('content')

<div class="content-header row">
  	<div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
      	<h3 class="content-header-title mb-0 d-inline-block">Edit Invoice</h3>
      	<div class="row breadcrumbs-top d-inline-block">
        	<div class="breadcrumb-wrapper col-12">
          		<ol class="breadcrumb">
            		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            		<li class="breadcrumb-item"><a href="#">Invoices</a></li>
            		<li class="breadcrumb-item active">Edit Invoice</li>
          		</ol>
        	</div>
      	</div>
    </div>
</div>

@if (count($errors) > 0)
  	<div class="row">
      	<div class="col-md-12">
          	<div class="alert alert-danger alert-dismissible">
              	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              	<b><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Alert!</b>
              	<ul>
              	@foreach ($errors->all() as $error)
                  	<li>{{ $error }}</li>
              	@endforeach
              	</ul>
          	</div>
      	</div>
  	</div>
  	<script>

    	$(document).ready(function(){
        	setTimeout(function(){ toastr.error('You must fill in all of the required fields!', 'Vista Network Says', {"hideDuration": 500, positionClass: 'toast-top-right'}); }, 2000);
    	});

  	</script>
@endif

@if(session()->has('success'))
<div class="alert alert-icon-left alert-arrow-left alert-success alert-dismissible mb-2" role="alert">
    <span class="alert-icon"><i class="la la-thumbs-o-up text-bold-600"></i></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      	<span aria-hidden="true">&times;</span>
    </button>
    <strong>Well done!</strong> <span class="text-bold-600">{{ session()->get('success') }}</span>
</div>
<script>

    $(document).ready(function(){
        setTimeout(function(){ toastr.success("{{ session()->get('success') }}", 'Prestine System Says', {"hideDuration": 500, positionClass: 'toast-top-right'}); }, 2000);
    });

</script>
@endif

<div class="content-body">
	<section>
		<form class="form" method="POST" action="{{ route('admin.invoices.update', ['id' => $invoice->id]) }}" novalidate>
			@csrf
			@method('PUT')
			<input type="hidden" name="booking_id" value="{{ isset($invoice->booking_id) ? $invoice->booking_id : '' }}">
			<div class="row">
				<div class="col-12 col-md-12">
					<div class="card">
						<div class="card-header">
			          		<h4 class="card-title">General Info</h4>
			        	</div>
			        	<div class="card-body">
					        <div id="invoice-title" class="row">
					            <div class="col-md-6 col-12 text-center text-md-left">
					            	<div class="form-group">
				                		<label for="title">Title</label>
					                    <input type="text" class="form-control" name="title" id="title" value="{{ $invoice->title }}" required data-validation-required-message="This field is required">
					                    <div class="help-block font-small-3 text-left"></div>
					                </div>
					                <div class="form-group">
				                		<label for="payment_method">Payment Method</label>
					                    <input type="text" class="form-control" name="payment_method" id="payment_method" value="{{ $invoice->payment_terms }}" required data-validation-required-message="This field is required">
					                    <div class="help-block font-small-3 text-left"></div>
					                </div>
					            </div>
					        </div>
					        <div id="invoice-date" class="row">
					        	<div class="col-md-3 col-12 text-center text-md-left">
					        		<div class="form-group">
						                <label class="label-control" for="invoice_issue_date">Issue Date</label>
						                <input type="date" name="invoice_issue_date" id="invoice_issue_date" class="form-control" value="{{ $invoice->invoice_date }}" required data-validation-required-message="This field is required">
						                <div class="help-block font-small-3 text-left"></div>
				
						            </div>
					        	</div>
					        	<div class="col-md-3 col-12 text-center text-md-left">
					        		<div class="form-group">
						                <label class="label-control" for="invoice_due_date">Due Date</label>
						                <input type="date" name="invoice_due_date" id="invoice_due_date" class="form-control" value="{{ $invoice->due_date }}" required data-validation-required-message="This field is required">
						                <div class="help-block font-small-3 text-left"></div>
						            </div>
					        	</div>
					        </div>
					    </div>
					</div>
					<div class="card">
						<div class="card-header">
			          		<h4 class="card-title">Customer Info</h4>
			        	</div>
						<div class="card-body">
							<div id="customer-info" class="row">
								<div class="col-md-6 col-12 text-center text-md-left">
									<div class="form-group">
						                <label for="customer_id">Customer</label>
				                		<select class="select2 form-control" id="customer_id" name="customer_id" style="width: 100% !important;" required data-validation-required-message="This field is required">
			                				<optgroup label="Customers">
			                					<option value="{{ $invoice->user->id }}">{{ $invoice->user->name }}</option>
			                					@foreach($users as $user)
			                          				<option value="{{ $user->id }}">{{ $user->name }}</option>
			          							@endforeach
					                        </optgroup>    
					                    </select>
							            <div class="help-block font-small-3 text-left"></div>
					        		</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header">
			          		<h4 class="card-title">Description</h4>
			        	</div>
						<div class="card-body">
							<div id="invoice-items-details">
	              				<div class="row">
	              					<div class="col-md-12 col-12">
		                				<div class="table-responsive repeater-default">
		                  					<table class="table" id="itemTable">
						                    	<thead>
						                      		<tr>
						                        		<th class="pl-0" style="width: 50%;">Item & Description</th>
						                        		<th class="text-left" style="width: 15%;">Quantity</th>
						                        		<th class="text-left" style="width: 15%;">Price</th>
						                        		<th class="text-left" style="width: 15%;">Amount</th>
						                        		<th class="text-center" style="width: 5%;"></th>
						                      		</tr>
						                    	</thead>
						                    	<tbody data-repeater-list="data">
						                    		@foreach($invoice->invoice_items as $key => $item)
						                      		<tr data-repeater-item class="itemrow item_row_{{ $item->id }}">
						                      			<input type="hidden" name="invoice_item_id" value="{{ $item->id }}">
								                        <td class="px-0">
								                        	<div class="form-group">
								                          		<input type="text" name="item_description" class="form-control" placeholder="Description of service" required maxlength="200" data-validation-required-message="This field is required" value="{{ $item->item_description }}">
								                          		<div class="help-block font-small-3 text-left"></div>
								                          	</div>
								                        </td>
						                        		<td class="text-right pr-0">
						                        			<div class="form-group">
						                        				<input type="number" name="item_qty" class="form-control qty" placeholder="Quantity" min="1" required data-validation-required-message="Required" value="{{ $item->quantity }}">
						                        				<div class="help-block font-small-3 text-left"></div>
						                        			</div>
						                        		</td>
						                        		<td class="text-right pr-0">
						                        			<div class="form-group">
							                        			<div class="position-relative has-icon-left">
							                        				<input id="rate" name="item_rate" class="form-control rate" type="number" min="1" required data-validation-required-message="Required" value="{{ $item->rate }}">
							                        				<div class="form-control-position">
							                        					<i class="la la-gbp"></i>
							                        				</div>
							                        			</div>
							                        			<div class="help-block font-small-3 text-left"></div>
							                        		</div>
						                        		</td>
						                        		<td class="text-right pr-0">
						                        			<div class="position-relative has-icon-left">
						                        				<input class="form-control total_sum" name="item_total" type="text" value="{{ $item->amount }}" readonly>
						                        				<div class="form-control-position">
						                        					<i class="la la-gbp"></i>
						                        				</div>
						                        			</div>
						                        		</td>
						                        		<td class="text-right">
						                        			<button type="button" name="delete_item_btn" id="delete_btn" class="delete_btn btn btn-danger" onClick="deleteItem({{ $item->id }})"> <i class="ft-x"></i></button>
						                        			<!-- data-repeater-delete -->
						                        		</td>
						                      		</tr>
						                      		@endforeach
			                    				</tbody>
			                    				<tfoot>
			                    					<tr>
			                    						<td colspan="5" class="pl-0">
			                    							<button data-repeater-create class="btn btn-primary" type="button">
							                            		<i class="ft-plus"></i> New Item
							                          		</button>
							                          	</td>
			                    					</tr>
			                    				</tfoot>
		                  					</table>
										</div>
									</div>	
		                		</div>
		                		<div class="row mt-5 justify-content-end">
		                			<div class="col-md-5 col-12">
			                  			<p class="lead">Total Due</p>
						                <div class="table-responsive">
						                    <table class="table">
						                      	<tbody>
							                        <tr>
							                          	<td class="w-50 pl-0">Sub Total</td>
							                          	<td class="text-right w-50">
							                          		&pound; <span id="subtotal">{{ $invoice->sub_total }}</span>
							                          		<input type="hidden" name="sub_total" id="invoice_subtotal" value="{{ $invoice->sub_total }}">
							                          	</td>
							                        </tr>
							                        <tr>
							                          	<td class="w-50 pl-0 align-middle">TAX</td>
							                          	<td class="text-right">
											                <div class="position-relative has-icon-left">
						                        				<input class="form-control tax text-right" name="tax" id="tax" type="number" min="0" value="{{ $invoice->tax }}">
						                        				<div class="form-control-position">
						                        					<i class="la la-gbp"></i>
						                        				</div>
						                        			</div>	
							                          	</td>
							                        </tr>
							                        <tr>
							                          	<td class="w-50 pl-0 align-middle">Discount</td>
							                          	<td class="text-right">
							                          		<div class="position-relative has-icon-left">
						                        				<input class="form-control discount text-right" name="discount" id="discount" type="number" value="{{ $invoice->discount }}" min="0">
						                        				<div class="form-control-position">
						                        					<i class="la la-gbp"></i>
						                        				</div>
						                        			</div>
											                	
							                          	</td>
							                        </tr>
							                        <tr>
							                          	<td class="w-50 pl-0 align-middle lead">Total</td>
							                          	<td class="text-right lead"> 
							                          		&pound; <span id="grand_total">{{ $invoice->total }}</span>
							                          		<input type="hidden" name="grand_total" id="invoice_grandtotal" value="{{ $invoice->total }}">
							                          	</td>
							                        </tr>
						                      	</tbody>
						                    </table>
						                </div>
				                	</div>
		                		</div>
		                	</div>
	              		</div>
	              	</div>
	              	<div class="card">
						<div class="card-header">
			          		<h4 class="card-title">Additional Info</h4>
			        	</div>
						<div class="card-body">
							<div id="additional-info">
		              			<div class="row">
				                	<div class="col-md-12 col-12 text-center text-md-left">
				    					<div class="form-group">
				                			<label for="notes">Notes</label>
					                    	<textarea class="form-control" name="notes" id="notes" placeholder="Any relevant information not already covered">{{ $invoice->additional_notes }}</textarea>
					                	</div>
				                	</div>
				                </div>
				                <div class="row">
				                	<div class="col-md-9 col-12 text-center text-md-left">
				    					<div class="form-group">
				                			<label for="legal_terms">Legal Terms</label>
					                    	<p>Please note: Any payment made after its due date there will be 8% late payment fee charges will be applicable on daily basis.</p>
					                	</div>
				                	</div>
				                	<div class="col-md-3 col-12 text-center">
										<button type="submit" name="submit" class="btn btn-info btn-min-width btn-lg">Update Invoice</button>
									</div>
				                </div> 
				            </div>
				        </div>
				    </div>
				</div>
			</div>
		</form>	
  	</section> 
</div>

@endsection

@section('script')
	<script src="{{ asset('admin-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"
  type="text/javascript"></script>
  	<script src="{{ asset('admin-assets/js/scripts/forms/validation/form-validation.js') }}"
  type="text/javascript"></script>
	<script src="{{ asset('admin-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('admin-assets/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>
	<script src="{{ asset('admin-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"
  type="text/javascript"></script>
  	<script src="{{ asset('admin-assets/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
  	<script>
  	
		$('table').on('mouseup keyup', 'input[type=number]', () => calculateTotals());

		function calculateSubtotal(tr) 
		{
		  	const $row = $(tr);
		  	const inputs = $row.find('input');
		  	console.log(inputs);
		  	const subtotal = inputs[2].value * inputs[3].value;

		  	$row.find('.total_sum').val(formatAsCurrency(subtotal));

		  	return subtotal;
		}

		function calculateTotals() 
		{
		  	const tax = $("#tax").val() == '' ? 0 : $("#tax").val();
		  	const discount = $("#discount").val() == '' ? 0 : $("#discount").val();
		  	const subtotals = $('.itemrow').map((idx, val) => calculateSubtotal(val)).get();
		  	const total = subtotals.reduce((a, v) => a + Number(v), 0);
		  	
		  	$('#subtotal').text(formatAsCurrency(total));
		  	$('#invoice_subtotal').val(formatAsCurrency(total));

		  	const grand_total = parseFloat(total) + parseFloat(tax) - parseFloat(discount);
		  	$('#grand_total').text(formatAsCurrency(grand_total));
		  	$('#invoice_grandtotal').val(formatAsCurrency(grand_total));
		}

		function formatAsCurrency(amount) {
		  	return `${Number(amount).toFixed(2)}`;
		}

		function deleteItem(item_id) 
		{
          	if(confirm('Are you sure you want to delete this item?'))
			{ 
				$.ajax({
	            	type: "GET",
	              	url: "/admin_panel/invoice_item/" + item_id + "/delete",
	              	success: function (response) {
	              		if(response.status == 'success'){
	              			$('#subtotal').text(formatAsCurrency(response.sub_total));
	              			$('#invoice_subtotal').val(formatAsCurrency(response.sub_total));
	                  		
	                  		$('#grand_total').text(formatAsCurrency(response.total));
		  					$('#invoice_grandtotal').val(formatAsCurrency(response.total));
	                  	
	                  		$('.item_row_' + item_id).remove();
	                  		alert("Item deleted successfully.");
	                  	} else {
	                  		alert("Unable to delete this item.");
	                  	}
	              	},
	              	error: function (result) {
	                  	alert("Something went wrong, please try again.");
	              	}
	          	});
				return true;
			}else{
				return false;
			}
      	}
  		
  	</script>
@endsection