<div class="choose_upholstery checkbox_error mb-4">
    <div class="row">
        <div class="col-md-12">
            <label><strong>Would you like to upholstery to be cleaned?</strong></label>
        </div>
    </div>
    @foreach($items as $item)
        @if($item->item_id == 4)
        <div class="row">
            @php
                $new_upholstery_title = trim($item->title);
            @endphp
            <div class="col-md-6 col-12">
                <div class="row no-gutters">
                    <div class="col-md-4 col-6">
                        <div class="form-check p-0 m-0">
                            <label class="form-check-label">
                                <input 
                                    type="checkbox" 
                                    name="upholstery[]" 
                                    class="form-check-input ml-5 d-none" 
                                    value="{{ $item->id }}" 
                                    id="upholstery_{{ $item->id }}"
                                    onclick='toggle("{{ '.' . strtolower($new_upholstery_title) . '_qty' }}", this)'
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
            <div class="col-md-3 ml-auto col-12 text-center">
                <small>How many?</small>
                 <div class="input-group input-group-sm">
                    <input type="text" name="{{ strtolower($new_upholstery_title) . '_qty' }}" class="text-center count touchspin input-sm {{ strtolower($new_upholstery_title) . '_qty' }}" data-bts-min="1" data-bts-button-down-class="btn btn-secondary" data-bts-button-up-class="btn btn-secondary" value="1" disabled />
                </div>
                <script>
                    @if($item->title == 'Sofa')
                        $(".{{ strtolower($new_upholstery_title) . '_qty' }}").TouchSpin({
                            postfix: 'seater'
                        });
                    @else
                        $(".{{ strtolower($new_upholstery_title) . '_qty' }}").TouchSpin({});
                    @endif

                    $("#upholstery_{{ $item->id }}").on('click', function() {
                        
                        var qty = $(".{{ strtolower($new_upholstery_title) . '_qty' }}").val();
                        var price = "{{ $item->price }}";
                        var total = price * qty;

                        var grand_total = 0;

                        if("{{ $item->id }}" == 53) {
                            var item_id = 'sofa';
                            var item = 'Sofa';
                        }
                        if("{{ $item->id }}" == 54) {
                            var item_id = 'armchair';
                            var item = 'Armchair';
                        }
                        if("{{ $item->id }}" == 55) {
                            var item_id = 'mattress';
                            var item = 'Mattress';
                        }
                        if("{{ $item->id }}" == 56) {
                            var item_id = 'curtain';
                            var item = 'Curtain';
                        }

                        var service = '';

                        if($("#upholstery_{{ $item->id }}").is(':checked')) {
                            
                            service += "<div class='row' id='upholstery_" + item_id + "'><div class='col-md-9 col-9'>+ " + item + " x <span class='d-inline' id='upholstery_" + item_id + "_qty'>" + qty + "</span></div><div class='col-md-3 col-3'>&pound; <span class='d-inline' id='upholstery_" + item_id + "_total'>" + Math.round(total) + "</span></div></div>";

                            $(".service_estimated_cost").append(service);

                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total += parseInt($(this).text());
                            });

                            $(".service_total .col-md-3 #cost_total").text(grand_total);
                            
                        } else {
                            if("{{ $item->id }}" == 53) {
                                $(".service_estimated_cost #upholstery_sofa").remove();
                            }
                            if("{{ $item->id }}" == 54) {
                                $(".service_estimated_cost #upholstery_armchair").remove();
                            }
                            if("{{ $item->id }}" == 55) {
                                $(".service_estimated_cost #upholstery_mattress").remove();
                            }
                            if("{{ $item->id }}" == 56) {
                                $(".service_estimated_cost #upholstery_curtain").remove();
                            }

                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total -= parseInt($(this).text());
                            });

                            $(".service_total .col-md-3 #cost_total").text(Math.abs(grand_total));
                        }
                    });

                    $(".{{ strtolower($new_upholstery_title) . '_qty' }}").on('change', function() {
                        var qty = $(this).val();
                        var price = "{{ $item->price }}";
                        var total = price * qty;

                        var grand_total = 0;

                        if("{{ $item->id }}" == 53) {
                            $(".service_estimated_cost #upholstery_sofa_qty").text(qty);
                            $(".service_estimated_cost #upholstery_sofa_total").text(total);

                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total += parseInt($(this).text());
                            });
                        }
                        if("{{ $item->id }}" == 54) {
                            $(".service_estimated_cost #upholstery_armchair_qty").text(qty);
                            $(".service_estimated_cost #upholstery_armchair_total").text(total);

                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total += parseInt($(this).text());
                            });
                        }
                        if("{{ $item->id }}" == 55) {
                            $(".service_estimated_cost #upholstery_mattress_qty").text(qty);
                            $(".service_estimated_cost #upholstery_mattress_total").text(total);

                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total += parseInt($(this).text());
                            });
                        }
                        if("{{ $item->id }}" == 56) {
                            $(".service_estimated_cost #upholstery_curtain_qty").text(qty);
                            $(".service_estimated_cost #upholstery_curtain_total").text(total);

                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total += parseInt($(this).text());
                            });
                        }

                        $(".service_total .col-md-3 #cost_total").text(grand_total);
                    });
                </script>
                <!-- <small>How many?</small>
                <div class="form-group">
                    <select class="custom-select custom-select-sm {{ strtolower($new_upholstery_title) . '_qty' }}" name="{{ strtolower($new_upholstery_title) . '_qty' }}" disabled>
                        @if($item->title == 'Sofa')
                            <option value="2">2 seater</option>
                            <option value="3">3 seater</option>
                            <option value="4">4 seater</option>
                            <option value="5">5 seater</option>
                        @elseif($item->title == 'Armchair')
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        @elseif($item->title == 'Mattress')
                            <option value="single">Single</option>
                            <option value="double">Double</option>
                            <option value="king">King Size</option>
                        @else
                            <option value="half">Half length</option>
                            <option value="full">Full length</option>
                        @endif
                    </select>
                </div> -->
            </div>
        </div>
        @endif
    @endforeach  
</div>