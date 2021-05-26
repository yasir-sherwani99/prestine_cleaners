<div class="choose_cleaning_date mb-4">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group" id="datetimepickerDemo">
				<label for="cleaning_start_date"><strong>What is the cleaning start date? <span class="mandatory">*</span></strong></label>
				<input type="date" id="cleaning_start_date" name="cleaning_start_date" class="form-control datepicker"> 
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="cleaning_start_time"><strong>What is the cleaning start time? <span class="mandatory">*</span></strong></label>
				<div class="select_error">
					<select name="cleaning_start_time" id="cleaning_start_time" class="form-control">
						<option value="">Select Time</option>
						<option value="08:00 AM">08:00 AM</option>
						<option value="08:30 AM">08:30 AM</option>
						<option value="09:00 AM">09:00 AM</option>
						<option value="09:30 AM">09:30 AM</option>
						<option value="10:00 AM">10:00 AM</option>
						<option value="10:30 AM">10:30 AM</option>
						<option value="11:00 AM">11:00 AM</option>
						<option value="11:30 AM">11:30 AM</option>
						<option value="12:00 PM">12:00 PM</option>
						<option value="12:30 PM">12:30 PM</option>
						<option value="01:00 PM">01:00 PM</option>
						<option value="01:30 PM">01:30 PM</option>
						<option value="02:00 PM">02:00 PM</option>
						<option value="02:30 PM">02:30 PM</option>
						<option value="03:00 PM">03:00 PM</option>
						<option value="03:30 PM">03:30 PM</option>
						<option value="04:00 PM">04:00 PM</option>
						<option value="04:30 PM">04:30 PM</option>
						<option value="05:00 PM">05:00 PM</option>
						<option value="05:30 PM">05:30 PM</option>
						<option value="06:00 PM">06:00 PM</option>
						<option value="06:30 PM">06:30 PM</option>
						<option value="07:00 PM">07:00 PM</option>
					</select>
				</div> 
			</div>
		</div>
	</div>	
</div>

<script type="text/javascript" src="{{ asset('assets/js/date-time-picker.min.js') }}"></script>

<script type="text/javascript">

	$(function() {
		var dtToday = new Date();

		var month = dtToday.getMonth() + 1;
		var day = dtToday.getDate();
		var year = dtToday.getFullYear();
		if(month < 10) {
			month = '0' + month.toString();
		}
		if(day < 10) {
			day = '0' + day.toString();
		}

		var maxDate = year + '-' + month + '-' + day;
	
		$('#cleaning_start_date').attr('min', maxDate);

		if ( $('[type="date"]').prop('type') != 'date' ) {
   	 		$('#cleaning_start_date').dateTimePicker({
   	 			mode: 'date',
                limitMin: maxDate,
   	 		});
		}
	}); 

 	$(document).ready(function() {	
		$('#cleaning_start_date').on('change', function() {
            var cleaning_date = $("#cleaning_start_date").val();
            var cleaning_time = $("#cleaning_start_time").val();

            $(".service_date_icon i").css('color', '#5c9e30');

            var cleaning_datee = cleaning_date + ' at ' + cleaning_time;
            $(".service_date").text(cleaning_datee);
            $(".service_date").css('color', '#5c9e30');
        });

        $('#cleaning_start_time').on('change', function() {
            var cleaning_date = $("#cleaning_start_date").val();
            var cleaning_time = $("#cleaning_start_time").val();

            $(".service_date_icon i").css('color', '#5c9e30');

            var cleaning_datee = cleaning_date + ' at ' + cleaning_time;
            $(".service_date").text(cleaning_datee);
            $(".service_date").css('color', '#5c9e30');
        });
	});

</script>