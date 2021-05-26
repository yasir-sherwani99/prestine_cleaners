<div class="choose_property_details checkbox_error mb-4">
    <div class="row">
        <div class="col-md-12">
            <label><strong>Which of the following apply to your property? </strong></label>
        </div>
    </div>
    <div class="row">
        @foreach($items as $item)
            @if($item->item_id == 10)
            <div class="col-md-4 col-12">
                <div class="row no-gutters">
                    <div class="col-md-6 col-6">
                        <div class="form-check p-0 m-0">
                            <label class="form-check-label">
                                <input 
                                    type="checkbox" 
                                    class="form-check-input ml-5 d-none" 
                                    name="property_inside_design[]" 
                                    id="property_details_{{ $item->id }}"
                                    value="{{ $item->id }}"
                                >
                                <img src="{{ asset('assets/img/booking/' . $item->avatar) }}" class="img_checkbox border" style="cursor: pointer;">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 col-6 pt-4">
                        <span>{{ $item->title }}</span>
                    </div>
                    <script>
                        $("#property_details_{{ $item->id }}").on('click', function() {
                            
                            var price = "{{ $item->price }}";
                            var qty = 1;
                            var total = price * qty;
                            var grand_total = 0;

                            if("{{ $item->id }}" == 6) {
                                var item_id = 'utility_room';
                                var item = 'Utility Room';
                            }
                            if("{{ $item->id }}" == 7) {
                                var item_id = 'conservatory';
                                var item = 'Conservatory';
                            }
                            if("{{ $item->id }}" == 8) {
                                var item_id = 'study_office';
                                var item = 'Study/Office Room';
                            }
                            if("{{ $item->id }}" == 9) {
                                var item_id = 'separate_kitchen';
                                var item = 'Separate Kitchen/Living';
                            }
                            if("{{ $item->id }}" == 10) {
                                var item_id = 'combined_kitchen';
                                var item = 'Combined Kitchen/Living';
                            }

                            service = '';

                            if($("#property_details_{{ $item->id }}").is(':checked')) {
                                
                                service += "<div class='row' id='property_" + item_id + "'><div class='col-md-9 col-9'>+ " + item + " x <span class='d-inline' id='property_" +item_id + "_qty'>1</span></div><div class='col-md-3 col-3'>&pound; <span class='d-inline' id='property_" + item_id + "_total'>" + Math.round(price) + "</span></div></div>";

                                $(".service_estimated_cost").append(service);

                                $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                    grand_total += parseInt($(this).text());
                                });

                                $(".service_total .col-md-3 #cost_total").text(grand_total);


                            } else {
            
                                if("{{ $item->id }}" == 6)  {
                                    $(".service_estimated_cost #property_utility_room").remove();
                                }
                                if("{{ $item->id }}" == 7)  {
                                    $(".service_estimated_cost #property_conservatory").remove();
                                }
                                if("{{ $item->id }}" == 8)  {
                                    $(".service_estimated_cost #property_study_office").remove();
                                }
                                if("{{ $item->id }}" == 9)  {
                                    $(".service_estimated_cost #property_separate_kitchen").remove();
                                }
                                if("{{ $item->id }}" == 10)  {
                                    $(".service_estimated_cost #property_combined_kitchen").remove();
                                }

                                $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                                    grand_total -= parseInt($(this).text());
                                });

                                $(".service_total .col-md-3 #cost_total").text(grand_total);
                            }
                        });
                    </script>
                </div>
            </div>
            @endif
        @endforeach
    </div>  
</div>
