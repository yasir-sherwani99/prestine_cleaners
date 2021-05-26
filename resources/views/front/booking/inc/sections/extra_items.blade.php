<div class="choose_extra_items checkbox_error mb-4">
    <div class="row">
        <div class="col-md-12">
            <label><strong>Would you also like to add? </strong></label>
        </div>
    </div>
    <div class="row">    
        @foreach($items as $item)
            @if($item->item_id == 11)
                <div class="col-md-4 col-12">
                    <div class="row no-gutters">
                        <div class="col-md-6 col-6">
                            <div class="form-check p-0 m-0">
                                <label class="form-check-label">
                                    <input 
                                        type="checkbox" 
                                        class="form-check-input ml-5 d-none" 
                                        name="extra_items[]" 
                                        value="{{ $item->id }}"
                                        id="extra_items_{{ $item->id }}"
                                    >
                                    <img src="{{ asset('assets/img/booking/' . $item->avatar) }}" class="img_checkbox border" style="cursor: pointer;">
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-6 pt-4">
                            <span>{{ $item->title }}</span>
                        </div>
                        <script>
                            $("#extra_items_{{ $item->id }}").on('click', function() {
                                
                                var price = "{{ $item->price }}";

                                if("{{ $item->id }}" == 4) {
                                    var qty = 1;
                                    var item_id = 'balcony';
                                    var item = 'Balcony';
                                }
                                if("{{ $item->id }}" == 5) {
                                    var qty = 1;
                                    var item_id = 'garage';
                                    var item = 'Garage';
                                }
                                if("{{ $item->id }}" == 57) {
                                    var qty = $(".window_qty").val();
                                    var item_id = 'window';
                                    var item = 'Window';
                                }

                                var total = price * qty;

                                var grand_total = 0;

                                var service = '';

                                if($("#extra_items_{{ $item->id }}").is(':checked')) {
                                    
                                    service += "<div class='row' id='extra_" + item_id + "'><div class='col-md-9 col-9'>+ " + item + " x <span class='d-inline' id='extra_" + item_id + "_qty'>" + qty + "</span></div><div class='col-md-3 col-3'>&pound; <span class='d-inline' id='extra_" + item_id + "_total'>" + Math.round(total) + "</span></div></div>";

                                    $(".service_estimated_cost").append(service);

                                    if("{{ $item->id }}" == 57)  {
                                        
                                        $(".window_qty_2").removeClass('d-none');
                                        $("#window_qty").removeAttr('disabled');
                                    }

                                    $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                        grand_total += parseInt($(this).text());
                                    });

                                    $(".service_total .col-md-3 #cost_total").text(grand_total);

                                } else {
                                    if("{{ $item->id }}" == 4)  {
                                        $("#extra_balcony").remove();
                                    }
                                    if("{{ $item->id }}" == 5)  {
                                        $("#extra_garage").remove();
                                    }
                                    if("{{ $item->id }}" == 57)  {
                                        $("#extra_window").remove();
                                        $(".window_qty_2").addClass('d-none');
                                        $("#window_qty").attr('disabled', 'disabled');
                                    }

                                    $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                        grand_total -= parseInt($(this).text());
                                    });

                                    $(".service_total .col-md-3 #cost_total").text(Math.abs(grand_total));
                                }
                            });

                            $(".window_qty").on('change', function() {
                                var qty = $(this).val();
                                var price = "{{ $item->price }}";
                                var total = price * qty;

                                var grand_total = 0;
                                
                                $("#extra_window_qty").text(qty);
                                $("#extra_window_total").text(total);
                            
                                $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                    grand_total += parseInt($(this).text());
                                });

                                $(".service_total .col-md-3 #cost_total").text(grand_total);
                            });
                        </script>
                    </div>
                </div>
            @endif
        @endforeach
     </div>
     <div class="row window_qty_2 d-none">
        <div class="col-md-6">
            <div class="form-group">
                <label for="windows_qty"><strong>How many windows do you have?</strong></label>
               <input type="text" name="window_qty" id="window_qty" class="text-center count touchspin input-sm window_qty" data-bts-min="1" data-bts-button-down-class="btn btn-secondary" data-bts-button-up-class="btn btn-secondary" value="1" disabled />
            </div>
            <script>
                $(".window_qty").TouchSpin();
            </script>
        </div>
    </div>  
</div>