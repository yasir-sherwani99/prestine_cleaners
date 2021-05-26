<div class="container service_details window_details">
	<div class="row">
    	<div class="col-lg-12">
    		<h4 class="mb-5">Window Service Details</h4>

    		@include('front.booking.inc.sections.property_extra_types')

    		@include('front.booking.inc.sections.highest_window')

    		@include('front.booking.inc.sections.window_side')

    		@include('front.booking.inc.sections.window_qty')

    		@include('front.booking.inc.sections.window_extras')

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