<div class="choose_house_things d-none checkbox_error mb-4">
    <div class="row">
        <div class="col-md-12">
            <label><strong>Which of the following apply to your house? <span class="mandatory">*</span></strong></label>
        </div>
    </div>
    @foreach($items as $item)
        @if($item->item_id == 1)        
        <div class="row">
            @php
                $new_house_title = trim($item->title);
            @endphp
            <div class="col-md-6 col-12">
                <div class="row no-gutters">
                    <div class="col-md-4 col-6">
                        <div class="form-check p-0 m-0">
                            <label class="form-check-label text-center">
                                <input 
                                    type="checkbox" 
                                    class="house_things form-check-input ml-4" 
                                    name="house_parts[]" 
                                    value="{{ $item->id }}"
                                    id="house_things_{{ $item->id }}" 
                                    onclick='toggle("{{ '.house_' . strtolower($new_house_title) . '_qty' }}", this);'
                                    style="opacity: 0;"
                                >
                                <img src="{{ asset('assets/img/booking/' . $item->avatar) }}" style="cursor: pointer;" class="img_checkbox imgChked border">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-8 col-6 pt-4">
                        <span>{{ $item->title }}(s)</span>
                    </div>
                </div>
            </div>
            <div class="col-md-2 ml-auto col-12 text-center">
                <small>How many?</small>
                 <div class="input-group input-group-sm">
                    <input type="text" name="{{ 'house_' . strtolower($new_house_title) . '_qty' }}" class="text-center count touchspin input-sm house_things_qtyy {{ 'house_' . strtolower($new_house_title) . '_qty' }}" data-bts-min="1" data-bts-button-down-class="btn btn-secondary" data-bts-button-up-class="btn btn-secondary" value="1" disabled />
                </div>
                <script>
                    $(".{{ 'house_' . strtolower($new_house_title) . '_qty' }}").TouchSpin();

                    $("#house_things_{{ $item->id }}").on('click', function() {
                        
                        var qty = $(".{{ 'house_' . strtolower($new_house_title) . '_qty' }}").val();
                        var price = "{{ $item->price }}";
                        var total = price * qty;

                        var grand_total = 0;

                        if("{{ $item->id }}" == 1) {
                            var item_id = 'bedrooms';
                            var item = 'Bedrooms';
                        }
                        if("{{ $item->id }}" == 2) {
                            var item_id = 'bathrooms';
                            var item = 'Bathrooms';
                        }
                        if("{{ $item->id }}" == 3) {
                            var item_id = 'floors';
                            var item = 'Floors';
                        }

                        var service = '';
                        var service_cost = '';

                        if($("#house_things_{{ $item->id }}").is(':checked')) {
                            
                            service += "<div class='row' id='property_" + item_id + "'><div class='col-md-9 col-9'>+ " + item + " x <span class='d-inline' id='property_" + item_id + "_qty'>" + qty + "</span></div><div class='col-md-3 col-3'>&pound; <span class='d-inline' id='property_" + item_id + "_total'>" + Math.round(total) + "</span></div></div>";

                            $(".service_estimated_cost").append(service);

                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total += parseInt($(this).text());
                            });

                            $(".service_total .col-md-3 #cost_total").text(grand_total);

                        } else {
                            if("{{ $item->id }}" == 1) {
                                $(".service_estimated_cost #property_bedrooms").remove();
                            
                                $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                    grand_total -= parseInt($(this).text());
                                });
                            }
                            if("{{ $item->id }}" == 2) {
                                $(".service_estimated_cost #property_bathrooms").remove();
                                
                                $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                    grand_total -= parseInt($(this).text());
                                });
                            }
                            if("{{ $item->id }}" == 3) {
                                $(".service_estimated_cost #property_floors").remove();
                            
                                $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                    grand_total -= parseInt($(this).text());
                                });
                            }

                            $(".service_total .col-md-3 #cost_total").text(Math.abs(grand_total));
                        }
                    });

                    $(".{{ 'house_' . strtolower($new_house_title) . '_qty' }}").on('change', function() {
                        var qty = $(this).val();
                        var price = "{{ $item->price }}";
                        var total = price * qty;
                        var grand_total = 0;

                        if("{{ $item->id }}" == 1) {
                            $(".service_estimated_cost #property_bedrooms_qty").text(qty);
                            $(".service_estimated_cost #property_bedrooms_total").text(total);
                        
                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total += parseInt($(this).text());
                            });
                        }
                        if("{{ $item->id }}" == 2) {
                            $(".service_estimated_cost #property_bathrooms_qty").text(qty);
                            $(".service_estimated_cost #property_bathrooms_total").text(total);
                        
                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total += parseInt($(this).text());
                            });
                        }
                        if("{{ $item->id }}" == 3) {
                            $(".service_estimated_cost #property_floors_qty").text(qty);
                            $(".service_estimated_cost #property_floors_total").text(total);
                        
                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total += parseInt($(this).text());
                            });
                        }

                        $(".service_total .col-md-3 #cost_total").text(grand_total);
                    });
                </script>
            </div>
        </div>
        @endif
    @endforeach
</div>
