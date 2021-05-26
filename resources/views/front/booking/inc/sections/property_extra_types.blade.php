<div class="choose_property_extra_types radio_error mb-4">
  	<div class="row">
        <div class="col-md-12">
            <label><strong>Please tell us about your place? <span class="mandatory">*</span></strong></label>
        </div>
    </div>
    <div class="row">
  		<div class="col-md-6 col-12">
            <div class="row no-gutters">
                <div class="col-md-4 col-6">
                    <div class="form-check p-0 m-0"> 
                        <label class="form-check-label">
                  			<input 
                                type="radio" 
                                class="property_type form-check-input" 
                                name="property_type" 
                                value="studio" 
                                onclick="toggleProperty('studio', this)" 
                                style="opacity: 0;"
                            >
                            <img src="{{ asset('assets/img/booking/Studio-flat.png') }}" class="img_radio border" style="cursor: pointer;">
                        </label>
                  	</div>
                </div>
                <div class="col-md-8 col-6 pt-4">
                    <span>Studio</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row no-gutters">
                <div class="col-md-4 col-6">
                  	<div class="form-check p-0 m-0"> 
                        <label class="form-check-label">
                  			<input
                                type="radio" 
                                class="property_type form-check-input" 
                                name="property_type" 
                                value="terraced-house" 
                                onclick="toggleProperty('terraced-house', this)" 
                                style="opacity: 0;"
                            >
                            <img src="{{ asset('assets/img/booking/Terraced-house.png') }}" class="img_radio border" style="cursor: pointer;">
                        </label>
                	</div>
                </div>
                <div class="col-md-8 col-6 pt-4">
                    <span>Terraced House</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="row no-gutters">
                <div class="col-md-4 col-6">
                	<div class="form-check p-0 m-0"> 
                        <label class="form-check-label">
                  			<input 
                                type="radio" 
                                class="property_type form-check-input" 
                                name="property_type" 
                                value="semi-detached-house" 
                                onclick="toggleProperty('semi-detached-house', this)" 
                                style="opacity: 0;"
                            >
                            <img src="{{ asset('assets/img/booking/Semi-detached-house.png') }}" class="img_radio border" style="cursor: pointer;">
                        </label>
                	</div>
                </div>
                <div class="col-md-8 col-6 pt-4">
                    <span>Semi Detached</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row no-gutters">
                <div class="col-md-4 col-6">
                	<div class="form-check p-0 m-0"> 
                        <label class="form-check-label">
                  			<input 
                                type="radio" 
                                class="property_type form-check-input" 
                                name="property_type" 
                                value="detached-house" 
                                onclick="toggleProperty('detached-house', this)" 
                                style="opacity: 0;"
                            >
                            <img src="{{ asset('assets/img/booking/Detached-house.png') }}" class="img_radio border" style="cursor: pointer;">
                        </label>
                	</div>
                </div>
                <div class="col-md-8 col-6 pt-4">
                    <span>Detached House</span>
                </div>
            </div>
        </div>
    </div>
</div>
