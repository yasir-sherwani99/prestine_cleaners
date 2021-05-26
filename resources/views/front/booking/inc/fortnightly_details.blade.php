<div class="container service_details fortnightly_details">
	<div class="row">
    	<div class="col-lg-12">
    		<h4 class="mb-5">Regular/Fornightly Service Details</h4>

			@include('front.booking.inc.sections.property_types')

			@include('front.booking.inc.sections.property_things')

			@include('front.booking.inc.sections.property_details')	

			@include('front.booking.inc.sections.cleaning_schedule')

			<div class="choose_pets radio_error mb-4">
			    <div class="row">
			        <div class="col-md-12 col-12">
			        	<label><strong>Do you have any pets? <span class="mandatory">*</span></strong></label>
			        </div>
			    </div>
			    <div class="row">
			        <div class="col-md-2 col-12">
			            <div class="radio icheck-emerland"> 
			                <input type="radio" name="pets" id="pets_yes" value="yes">
			                <label for="pets_yes">Yes</label>
			            </div>
			        </div>
			        <div class="col-md-2 col-12">
			            <div class="radio icheck-emerland"> 
			                <input type="radio" name="pets" id="pets_no" value="no">
			                <label for="pets_no">No</label>
			            </div>
			        </div>
			    </div>  
			</div>

			<div class="choose_ironing radio_error mb-4">
			    <div class="row">
			        <div class="col-md-12 col-12">
			        	<label><strong>Do you require any irnoning? <span class="mandatory">*</span></strong></label>
			        </div>
			    </div>
			    <div class="row">
			        <div class="col-md-2 col-12">
			            <div class="radio icheck-emerland">
			                <input type="radio" name="iron" id="iron_yes" value="yes">
			                <label for="iron_yes">Yes</label>
			            </div>
			        </div>
			        <div class="col-md-2 col-12">
			            <div class="radio icheck-emerland"> 
			                <input type="radio" name="iron" id="iron_no" value="no">
			                <label for="iron_no">No</label>
			            </div>
			        </div>
			    </div>  
			</div>
			<p>
				(<span class="mandatory">*</span>) Mandatory
			</p>
		</div>
	</div>
</div>
<script>
    $(document).ready(function(){
        $(".img_checkbox").imgCheckbox({
            "checkMarkSize": "25px",
            "checkMarkPosition": "top-left",
            "styles": {
                "span.imgCheckbox.imgChked img": {

                    // This property will overwrite the default grayscaling, we need to add it back in
                    "filter": "blur(2px) grayscale(20%)",

                    // This is just css: remember compatibility
                    "-webkit-filter": "blur(2px) grayscale(20%)",

                    // Let's change the amount of scaling from the default of "0.8"
                    "transform": "scale(0.9)"
                }
            }
        });
    });
    $(document).ready(function(){
        $(".img_radio").imgCheckbox({
            "checkMarkSize": "25px",
            "checkMarkPosition": "top-left",
            "radio": true,
            "styles": {
                "span.imgCheckbox.imgChked img": {

                    // This property will overwrite the default grayscaling, we need to add it back in
                    "filter": "blur(2px) grayscale(20%)",

                    // This is just css: remember compatibility
                    "-webkit-filter": "blur(2px) grayscale(20%)",

                    // Let's change the amount of scaling from the default of "0.8"
                    "transform": "scale(0.9)"
                }
            }
        });
    });
</script>