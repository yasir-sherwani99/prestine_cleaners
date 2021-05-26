<div class="choose_carpet_locations d-none checkbox_error mb-4">
    <div class="row">
        <div class="col-md-12">
            <label><strong>What areas need carpet cleaning? <span class="mandatory">*</span></strong></label>
        </div>
    </div>
    @foreach($items as $item)
        @if($item->item_id == 2)
        <div class="row">
            @php
                $new_carpet_title = trim($item->title);
                $new_carpet_title = str_replace(' ', '', $new_carpet_title);
            @endphp
            <div class="col-md-6 col-12">
                <div class="row no-gutters">
                    <div class="col-md-4 col-6">
                        <div class="form-check p-0 m-0">
                            <label class="form-check-label text-center">
                                <input 
                                    type="checkbox" 
                                    name="carpet_house_location[]" 
                                    class="carpet_house_location form-check-input ml-5" 
                                    value="{{ $item->id }}" 
                                    id="carpet_house_location_{{ $item->id }}"
                                    onclick='toggle("{{ '.carpet_' . strtolower($new_carpet_title) . '_qty' }}", this)'
                                    style="opacity: 0;"
                                >
                                <img src="{{ asset('assets/img/booking/' . $item->avatar) }}" class="img_checkbox border" style="cursor: pointer;">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-8 col-6 pt-4">
                        <span>{{ $item->title }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-2 ml-auto col-12 text-center">
                <small>How many?</small>
                <div class="input-group input-group-sm">
                    <input type="text" name="{{ 'carpet_' . strtolower($new_carpet_title) . '_qty' }}" class="text-center count touchspin input-sm carpet_house_location_qtyy {{ 'carpet_' . strtolower($new_carpet_title) . '_qty' }}" data-bts-min="1" data-bts-button-down-class="btn btn-secondary" data-bts-button-up-class="btn btn-secondary" value="1" disabled />
                </div>
                <script>
                    $(".{{ 'carpet_' . strtolower($new_carpet_title) . '_qty' }}").TouchSpin();

                    $("#carpet_house_location_{{ $item->id }}").on('click', function() {

                        var qty = $(".{{ 'carpet_' . strtolower($new_carpet_title) . '_qty' }}").val();
                        if(isNaN(qty)) {
                            qty = 1;
                        }else {
                            qty = $(".{{ 'carpet_' . strtolower($new_carpet_title) . '_qty' }}").val();
                        }

                        var price = "{{ $item->price }}";
                        var total = (price/2) * qty;

                        var grand_total = 0;

                        if("{{ $item->id }}" == 11) {
                            var item_id = 'bedroom';
                            var item = 'Carpet Bedroom';
                        }
                        if("{{ $item->id }}" == 12) {
                            var item_id = 'living';
                            var item = 'Carpet Living';
                        }
                        if("{{ $item->id }}" == 13) {
                            var item_id = 'dining';
                            var item = 'Carpet Dining';
                        }
                        if("{{ $item->id }}" == 14) {
                            var item_id = 'hallway';
                            var item = 'Carpet Hallway';
                        }
                        if("{{ $item->id }}" == 15) {
                            var item_id = 'staircase';
                            var item = 'Carpet Staircase';
                        }
                        if("{{ $item->id }}" == 16) {
                            var item_id = 'landing';
                            var item = 'Carpet Landing';
                        }

                        var service = '';

                        if($("#carpet_house_location_{{ $item->id }}").is(':checked')) {
                            
                            service = "<div class='row' id='carpet_" + item_id + "'><div class='col-md-9 col-9'>+ " + item + " x <span class='d-inline' id='carpet_" + item_id + "_qty'>" + qty + "</span></div><div class='col-md-3 col-3'>&pound; <span class='d-inline' id='carpet_" + item_id + "_total'>" + Math.round(total) + "</span></div></div>";

                            $(".service_estimated_cost").append(service);

                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total += parseInt($(this).text());
                            });

                            $(".service_total .col-md-3 #cost_total").text(grand_total);

                        } else {
                            if("{{ $item->id }}" == 11) {
                                $(".service_estimated_cost #carpet_bedroom").remove();
                            }
                            if("{{ $item->id }}" == 12) {
                                $(".service_estimated_cost #carpet_living").remove();
                            }
                            if("{{ $item->id }}" == 13) {
                                $(".service_estimated_cost #carpet_dining").remove();
                            }
                            if("{{ $item->id }}" == 14) {
                                $(".service_estimated_cost #carpet_hallway").remove();
                            }
                            if("{{ $item->id }}" == 15) {
                                $(".service_estimated_cost #carpet_staircase").remove();
                            }
                            if("{{ $item->id }}" == 16) {
                                $(".service_estimated_cost #carpet_landing").remove();
                            }

                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total -= parseInt($(this).text());
                            });

                            $(".service_total .col-md-3 #cost_total").text(Math.abs(grand_total));
                        }

                    });

                    $(".{{ 'carpet_' . strtolower($new_carpet_title) . '_qty' }}").on('change', function() {
                        var qty = $(this).val();
                        var price = "{{ $item->price }}";
                        var total = (price/2) * qty;

                        var grand_total = 0;

                        if("{{ $item->id }}" == 11) {
                            $(".service_estimated_cost #carpet_bedroom_qty").text(qty);
                            $(".service_estimated_cost #carpet_bedroom_total").text(total);

                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total += parseInt($(this).text());
                            });
                        }
                        if("{{ $item->id }}" == 12) {
                            $(".service_estimated_cost #carpet_living_qty").text(qty);
                            $(".service_estimated_cost #carpet_living_total").text(total);

                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total += parseInt($(this).text());
                            });
                        }
                        if("{{ $item->id }}" == 13) {
                            $(".service_estimated_cost #carpet_dining_qty").text(qty);
                            $(".service_estimated_cost #carpet_dining_total").text(total);

                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total += parseInt($(this).text());
                            });
                        }
                        if("{{ $item->id }}" == 14) {
                            $(".service_estimated_cost #carpet_hallway_qty").text(qty);
                            $(".service_estimated_cost #carpet_hallway_total").text(total);

                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total += parseInt($(this).text());
                            });
                        }
                        if("{{ $item->id }}" == 15) {
                            $(".service_estimated_cost #carpet_staircase_qty").text(qty);
                            $(".service_estimated_cost #carpet_staircase_total").text(total);

                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total += parseInt($(this).text());
                            });
                        }
                        if("{{ $item->id }}" == 16) {
                            $(".service_estimated_cost #carpet_landing_qty").text(qty);
                            $(".service_estimated_cost #carpet_landing_total").text(total);

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