<div class="choose_service">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="d-block" for="service"><strong>Choose a Service <span class="mandatory">*</span></strong></label>
				<div class="select_error">
					<select name="service" id="service" class="form-control" style="width: 100%; height: 100% !important;">
						<option value="">Choose a Service</option>
						@foreach($services as $service)
							<option value="{{ $service->id }}">{{ $service->title }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<script>
				$(document).ready(function() {	
				    $('#service').select2({ height: '100%' });
					$('#service').change(function() {
                        var service = $("#service").val();  
                        var service_title = getServiceTitle(service);
                        $(".service_icon i").css('color', '#5c9e30');
                        $(".service_name").text(service_title);
                        $(".service_name").css('color', '#5c9e30');

                        // if(service == 1 || service == 2) {
                        // 	$(".cost_estimation_yes").removeClass('d-none');
                        // 	$(".cost_estimation_no").addClass('d-none');
                        // } else {
                        // 	$(".cost_estimation_yes").addClass('d-none');
                        // }
                    });
				});
			</script>
		</div>
	</div>
</div>