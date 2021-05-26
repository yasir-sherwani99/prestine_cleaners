<div class="container service_details one_off_details">
    <div class="row">
        <div class="col-lg-12">
            <h4 class="mb-5">One-off Service Details</h4>

            @include('front.booking.inc.sections.property_types')

            @include('front.booking.inc.sections.property_things')

            @include('front.booking.inc.sections.property_details')

    
            <div class="choose_kitchen_appliances radio_error mb-4">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <label><strong>How would you like your kitchen cupboards and appliances to be cleaned? <span class="mandatory">*</span></strong></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="radio icheck-emerland"> 
                            <input type="radio" name="kitchen_appliances" id="kitchen_appliance_outside" value="outside">
                            <label for="kitchen_appliance_outside">Outside only</label>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="radio icheck-emerland"> 
                            <input type="radio" name="kitchen_appliances" id="kitchen_appliance_both" value="inside-and-outside">
                            <label for="kitchen_appliance_both">Inside and outside</label>   
                        </div> 
                    </div>
                </div>
            </div>

            @include('front.booking.inc.sections.carpet')

            @include('front.booking.inc.sections.carpet_locations')

            @include('front.booking.inc.sections.rugs')

            @include('front.booking.inc.sections.upholstery')

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