<div class="choose_furniture checkbox_error mb-4">
    <div class="row">
        <div class="col-md-12">
            <label><strong>What kind of Sofas/Chairs would you like cleaned? <span class="mandatory">*</span></strong></label>
        </div>
    </div>
    @foreach($items as $item)
        @if($item->item_id == 8)
        <div class="row">
            @php
                $new_furniture_title = trim($item->title);
                $new_furniture_title = str_replace(' ', '', $new_furniture_title);
            @endphp
            <div class="col-md-6 col-12">
                <div class="row no-gutters">
                    <div class="col-md-4 col-6">
                        <div class="form-check p-0 m-0">
                            <label class="form-check-label">
                                <input 
                                    type="checkbox" 
                                    name="furniture_items[]" 
                                    class="form-check-input ml-5" 
                                    value="{{ $item->id }}" 
                                    onclick='toggle("{{ '.' . strtolower($new_furniture_title) . '_qty' }}", this)' 
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
                    <input type="text" name="{{ strtolower($new_furniture_title) . '_qty' }}" class="text-center count touchspin input-sm {{ strtolower($new_furniture_title) . '_qty' }}" data-bts-min="1" data-bts-button-down-class="btn btn-secondary" data-bts-button-up-class="btn btn-secondary" value="1" disabled />
                </div>
                <script>
                    $(".{{ strtolower($new_furniture_title) . '_qty' }}").TouchSpin();
                </script>
            </div>
        </div>
        @endif
    @endforeach  
</div>