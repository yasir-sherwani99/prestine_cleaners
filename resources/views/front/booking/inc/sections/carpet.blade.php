<div class="choose_carpet radio_error mb-4">
    <div class="row">
        <div class="col-md-12">
            <label><strong>How would you like your carpets to be cleaned? <span class="mandatory">*</span></strong></label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 col-12">
            <div class="radio icheck-emerland"> 
                <input type="radio" class="carpet_service" name="carpet_service" value="hoovered" id="hoovered">
                <label for="hoovered">Hoovered only</label>
                <small>(part of the service)</small>
            </div>
            <!-- onclick="toggleCarpet('hoovered', this)" -->
        </div>
        <div class="col-md-3 col-12">
            <div class="radio icheck-emerland">
                <input type="radio" class="carpet_service" name="carpet_service" value="machine" id="machine_cleaned">
                <label for="machine_cleaned">Machine cleaned</label>
            </div>
            <!-- onclick="toggleCarpet('machine', this)" -->
        </div>
        <div class="col-md-4 col-12">
            <div class="radio icheck-emerland">
                <input type="radio" class="carpet_service" name="carpet_service" value="no_carpet" id="no_carpet">
                <label for="no_carpet">I don't have carpets</label>
            </div>
            <!-- onclick="toggleCarpet('no_carpet', this)" -->
        </div>
        <script>
            $("input[name='carpet_service']").on('click', function() {
                var value = $("input[name='carpet_service']:checked").val();    
                toggleCarpet(value, this);
                var grand_total = 0;

                if(value == 'hoovered' || value == 'no_carpet') {

                    $(".choose_carpet_locations .form-check-label .carpet_house_location").prop('checked', false);
                    $(".choose_carpet_locations .form-check-label span").removeClass('imgChked');
                    $(".choose_carpet_locations .carpet_house_location_qtyy").attr('disabled', 'disabled');

                    $(".service_estimated_cost #carpet_bedroom,#carpet_living,#carpet_dining,#carpet_hallway,#carpet_staircase,#carpet_landing").remove();

                    $(".service_estimated_cost > .row > .col-md-3 > span").each(function(){
                        grand_total -= parseInt($(this).text());
                    });

                    $(".service_total .col-md-3 #cost_total").text(Math.abs(grand_total));

                }
            });
        </script>
    </div>  
</div>