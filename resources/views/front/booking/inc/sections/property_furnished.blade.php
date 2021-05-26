<div class="choose_furnished radio_error mb-4">
	<div class="row">
		<div class="col-md-12">
            <label class="d-block"><strong>Is your property furnished? <span class="mandatory">*</span></strong></label>
            <div class="row">
                @foreach($items as $item)
                    @if($item->item_id == 19)
                    <div class="col-md-2 col-12">
                        <div class="radio icheck-emerland"> 		
                            <input 
                                type="radio" 
                                class="furnished" 
                                id="{{ strtolower($item->title) }}" 
                                name="furnished" 
                                value="{{ strtolower($item->title) }}"
                            >
                            <label for="{{ strtolower($item->title) }}">{{ $item->title }}</label>
                        </div>
                    </div>
                    <script>
                        $("#{{ strtolower($item->title) }}").on('click', function() {
                            
                            var price = "{{ $item->price }}";
                            var qty = 1;
                            var total = price * qty;

                            var grand_total = 0;

                            if("{{ $item->id }}" == 66) {
                                title = "Furnished";
                                item_id = "{{ $item->id }}";
                            }
                            if("{{ $item->id }}" == 67) {
                                title = "Unfurnished";
                                item_id = "{{ $item->id }}";
                            }

                            var service = "";

                            if($("#{{ strtolower($item->title) }}").is(":checked")) {
                                if("{{ $item->id }}" == 66) {                        
                                    service = "<div class='row' id='property_furnished'><div class='col-md-9 col-9'>+ " + title + " </div><div class='col-md-3 col-3'>&pound; <span class='d-inline' id='property_furnished_total'>" + Math.round(total) + "</span></div></div>";

                                    $(".service_estimated_cost").append(service);

                                    $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                        grand_total += parseInt($(this).text());
                                    });

                                    $(".service_total .col-md-3 #cost_total").text(grand_total);
                                }
                                if("{{ $item->id }}" == 67) {
                                    $(".service_estimated_cost #property_furnished").remove();
                                
                                    $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                        grand_total -= parseInt($(this).text());
                                    });

                                    $(".service_total .col-md-3 #cost_total").text(Math.abs(grand_total));

                                }

                            } 

                        });
                    </script>
                    <!-- <div class="col-md-2 col-12">
                        <div class="radio icheck-emerland">
                            <input type="radio" class="furnished" id="no" name="furnished" value="no">
                            <label for="no">{{ $item->title }}</label>
                        </div>
                    </div> -->
                    @endif
                @endforeach
            </div>
    	</div>
    </div>
</div>