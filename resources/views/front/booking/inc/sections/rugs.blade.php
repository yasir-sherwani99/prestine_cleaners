<div class="choose_rugs checkbox_error mb-4">
    <div class="row">
        <div class="col-md-12">
            <label><strong>If there are any rugs to be cleaned, please select below?</strong></label>
        </div>
    </div>
    @foreach($items as $item)
        @if($item->item_id == 3)
        <div class="row">
            @php
                $new_rug_title = trim($item->title);
            @endphp
            <div class="col-md-6 col-12">
                <div class="row no-gutters">
                    <div class="col-md-4 col-6">
                        <div class="form-check p-0 m-0">
                            <label class="form-check-label text-center">                   
                                <input 
                                    type="checkbox" 
                                    name="rug_size[]" 
                                    class="form-check-input ml-4 d-none" 
                                    value="{{ $item->id }}" 
                                    id="rug_size_{{ $item->id }}"
                                    onclick='toggle("{{ '.rugs_' . strtolower($new_rug_title) . '_qty' }}", this)'
                                >
                                <img src="{{ asset('assets/img/booking/' . $item->avatar) }}" style="cursor: pointer;" class="img_checkbox border">
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
                    <input type="text" name="{{ 'rugs_' . strtolower($new_rug_title) . '_qty' }}" class="text-center count touchspin input-sm {{ 'rugs_' . strtolower($new_rug_title) . '_qty' }}" data-bts-min="1" data-bts-button-down-class="btn btn-secondary" data-bts-button-up-class="btn btn-secondary" value="1" disabled />
                </div>
                <script>
                    $(".{{ 'rugs_' . strtolower($new_rug_title) . '_qty' }}").TouchSpin();

                    $("#rug_size_{{ $item->id }}").on('click', function() {

                        var qty = $(".{{ 'rugs_' . strtolower($new_rug_title) . '_qty' }}").val();
                        var price = "{{ $item->price }}";
                        var total = price * qty;

                        var grand_total = 0;

                        if("{{ $item->id }}" == 17) {
                            var item_id = 'small';
                            var item = 'Rug Small';
                        }
                        if("{{ $item->id }}" == 18) {
                            var item_id = 'medium';
                            var item = 'Rug Medium';
                        }
                        if("{{ $item->id }}" == 19) {
                            var item_id = 'large';
                            var item = 'Rug Large';
                        }

                        var service = '';

                        if($("#rug_size_{{ $item->id }}").is(':checked')) {

                            service += "<div class='row' id='rug_" + item_id + "'><div class='col-md-9 col-9'>+ " + item + " x <span class='d-inline' id='rug_" + item_id + "_qty'>" + qty + "</span></div><div class='col-md-3 col-3'>&pound; <span class='d-inline' id='rug_" + item_id + "_total'>" + Math.round(total) + "</span></div></div>";

                            $(".service_estimated_cost").append(service);

                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total += parseInt($(this).text());
                            });

                            $(".service_total .col-md-3 #cost_total").text(grand_total);

                        } else {
                            if("{{ $item->id }}" == 17) {
                                $(".service_estimated_cost #rug_small").remove();
                            }
                            if("{{ $item->id }}" == 18) {
                                $(".service_estimated_cost #rug_medium").remove();
                            }
                            if("{{ $item->id }}" == 19) {
                                $(".service_estimated_cost #rug_large").remove();
                            }

                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total -= parseInt($(this).text());
                            });

                            $(".service_total .col-md-3 #cost_total").text(Math.abs(grand_total));
                        }
                    });

                    $(".{{ 'rugs_' . strtolower($new_rug_title) . '_qty' }}").on('change', function() {
                        var qty = $(this).val();
                        var price = "{{ $item->price }}";
                        var total = price * qty;

                        var grand_total = 0;

                        if("{{ $item->id }}" == 17) {
                            $(".service_estimated_cost #rug_small_qty").text(qty);
                            $(".service_estimated_cost #rug_small_total").text(total);

                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total += parseInt($(this).text());
                            });
                        }
                        if("{{ $item->id }}" == 18) {
                            $(".service_estimated_cost #rug_medium_qty").text(qty);
                            $(".service_estimated_cost #rug_medium_total").text(total);

                            $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                grand_total += parseInt($(this).text());
                            });
                        }
                        if("{{ $item->id }}" == 19) {
                            $(".service_estimated_cost #rug_large_qty").text(qty);
                            $(".service_estimated_cost #rug_large_total").text(total);

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