<div class="container service_details carpet_rug_details">
    <div class="row">
        <div class="col-lg-12">
            <h4 class="mb-5">Carpet/Rug Service Details</h4>
	
	        @include('front.booking.inc.sections.carpet_locations_2')

	        @include('front.booking.inc.sections.rugs')

            <div class="choose_carpet_rug_fibrics checkbox_error mb-4">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <label for="post_code"><strong>What fibres are your carpet/rugs made of? <span class="mandatory">*</span></strong></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="checkbox icheck-emerland">
                            <input type="checkbox" name="carpet_rug_material[]" id="carpet_standard" value="standard">
                            <label for="carpet_standard">
                                Standard/fabric, synthetic etc
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="checkbox icheck-emerland">
                            <input type="checkbox" name="carpet_rug_material[]" id="carpet_delicate" value="delicate">
                            <label for="carpet_delicate">
                                Delicate/wool, cotton etc
                            </label>
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
</script>