<div class="choose_house_things checkbox_error mb-4">
    <div class="row">
        <div class="col-md-12 col-12">
            <label><strong>Which of the following apply to your house? <span class="mandatory">*</span></strong></label>
        </div>
    </div>
    @foreach($items as $item)
        @if($item->item_id == 1)        
        <div class="row">
            @php
                $new_house_title = trim($item->title);
            @endphp
            <div class="col-md-6 col-12">
                <div class="row no-gutters">
                    <div class="col-md-4 col-6">
                        <div class="form-check p-0 m-0">
                            <label class="form-check-label text-center">
                                <input 
                                    type="checkbox" 
                                    class="house_things form-check-input ml-4" 
                                    name="house_parts[]" 
                                    value="{{ $item->id }}"
                                    id="house_things_{{ $item->id }}" 
                                    onclick='toggle("{{ '.house_' . strtolower($new_house_title) . '_qty' }}", this);'
                                    style="opacity: 0;"
                                >
                                <img src="{{ asset('assets/img/booking/' . $item->avatar) }}" style="cursor: pointer;" class="img_checkbox border">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-8 col-6 pt-4">
                        <span>{{ $item->title }}(s)</span>
                    </div>
                </div>       
            </div>
            <div class="col-md-2 ml-auto col-12 text-center">
                <small>How many?</small>
                 <div class="input-group input-group-sm">
                    <input type="text" name="{{ 'house_' . strtolower($new_house_title) . '_qty' }}" class="text-center count touchspin input-sm {{ 'house_' . strtolower($new_house_title) . '_qty' }}" data-bts-min="1" data-bts-button-down-class="btn btn-secondary" data-bts-button-up-class="btn btn-secondary" value="1" disabled />
                </div>
                <script>
                    $(".{{ 'house_' . strtolower($new_house_title) . '_qty' }}").TouchSpin();
                </script>
            </div>
        </div>
        @endif
    @endforeach
</div>