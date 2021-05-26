<div class="choose_oven_extras checkbox_error mb-4">
    <div class="row">
        <div class="col-md-12">
            <label><strong>Would you like to add any of the following?</strong></label>
        </div>
    </div>
    @foreach($items as $item)
        @if($item->item_id == 13)
            <div class="row">
                @php
                    $new_oven_extra_title = trim($item->title);
                @endphp
                <div class="col-md-6 col-12">
                    <div class="row no-gutters">
                        <div class="col-md-4 col-6">
                            <div class="form-check p-0 m-0"> 
                                <label class="form-check-label">
                                    <input 
                                        type="checkbox" 
                                        name="oven_extras[]" 
                                        class="form-check-input ml-5 d-none" 
                                        value="{{ $item->id }}" 
                                        onclick='toggle("{{ '.' . strtolower($new_oven_extra_title) . '_qty' }}", this)'
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
                        <input type="text" name="{{ strtolower($new_oven_extra_title) . '_qty' }}" class="text-center count touchspin input-sm {{ strtolower($new_oven_extra_title) . '_qty' }}" data-bts-min="1" data-bts-button-down-class="btn btn-secondary" data-bts-button-up-class="btn btn-secondary" value="1" disabled />
                    </div>
                    <script>
                        $(".{{ strtolower($new_oven_extra_title) . '_qty' }}").TouchSpin();
                    </script>
                </div>
            </div>
        @endif
    @endforeach  
</div>