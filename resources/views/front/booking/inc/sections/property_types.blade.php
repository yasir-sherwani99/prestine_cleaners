<div class="choose_property radio_error mb-4">
	<div class="row">
		<div class="col-md-12">
            <label><strong>Please tell us about your place? <span class="mandatory">*</span></strong></label>
        </div>
    </div>
    <div class="row">
        @foreach($items as $item)
            @if($item->item_id == 16)
                <div class="col-md-4 col-12">
                    <?php
    
                        if($item->id == 64) {
                            $value = 'studio';
                        } elseif($item->id == 65) {
                            $value = 'house';
                        }
     
                    ?>
                    <div class="row no-gutters">
                        <div class="col-md-6 col-6">
                            <div class="form-check p-0 m-0"> 
                        		<label class="form-check-label">
                                    <input 
                                        type="radio" 
                                        class="property_type form-check-input" 
                                        name="property_type" 
                                        value="{{ $value }}" 
                                        id="property_type_{{ $item->id }}" 
                                        style="opacity: 0;"
                                    >
                                    <img src="{{ asset('assets/img/booking/' . $item->avatar) }}" class="img_radio border" style="cursor: pointer;">
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-6 pt-4">
                            <span>{{ $item->title }}</span>
                        </div>
                        <script>
                            $("#property_type_{{ $item->id }}").on('click', function() {
                                
                                var price = "{{ $item->price }}";
                                var qty = 1;
                                var total = price * qty;

                                var grand_total = 0;

                                var service = "";

                                if($("#property_type_{{ $item->id }}").is(":checked")) {
                                    if("{{ $item->id }}" == 64) {
                                        
                                        service = "<div class='row' id='property_studio'><div class='col-md-9 col-9'>+ Studio x <span class='d-inline' id='property_studio_qty'>" + qty + "</span></div><div class='col-md-3 col-3'>&pound; <span class='d-inline' id='property_studio_total'>" + Math.round(total) + "</span></div></div>";

                                        $(".service_estimated_cost").append(service);

                                        toggleProperty('studio', this);

                                        $(".choose_house_things .form-check-label .house_things").prop('checked', false);
                                        $(".choose_house_things .form-check-label span").removeClass('imgChked');
                                        $(".choose_house_things .house_things_qtyy").attr('disabled', 'disabled');

                                        $(".service_estimated_cost #property_bedrooms,#property_bathrooms,#property_floors").remove();

                                        $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                            grand_total += parseInt($(this).text());
                                        });

                                        $(".service_total .col-md-3 #cost_total").text(grand_total);

                                    }
                                    if("{{ $item->id }}" == 65) {

                                        $(".service_estimated_cost #property_studio").remove();
                                        toggleProperty('house', this);

                                        $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                            grand_total -= parseInt($(this).text());
                                        });

                                        $(".service_total .col-md-3 #cost_total").text(Math.abs(grand_total));
                                   
                                    }
                                } 
    
                            });
                        </script>
                    </div>
                </div>
            @endif
        @endforeach
        <!-- <div class="col-md-3 col-6 text-center">
            <div class="form-check p-0 m-0">
        		<label class="form-check-label">
                    <input 
                        type="radio" 
                        class="property_type form-check-input" 
                        name="property_type" 
                        value="house" 
                        onclick="toggleProperty('house', this)" 
                        style="opacity: 0;"
                    >
                    <img src="{{ asset('assets/img/booking/Detached-house.png') }}" class="img_radio border" style="cursor: pointer;">
                </label>
                <span class='d-block'>Flat/House</span>
            </div>
    	</div> -->
    </div>
</div>
