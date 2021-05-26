<div class="choose_office_rooms checkbox_error mb-4">
    <div class="row">
        <div class="col-md-12">
            <label><strong>Which of the following apply to your office? <span class="mandatory">*</span></strong></label><br/>
        </div>
    </div>
    @foreach($items as $item)
        @if($item->item_id == 15)
        <div class="row">
            @php
                $new_office_title = trim($item->title);
            @endphp
            <div class="col-md-6 pt-3">
                <div class="checkbox icheck-emerland"> 
                    <input type="checkbox" name="office_rooms[]" id="office_rooms_{{ $item->id }}" value="{{ $item->id }}" onclick='toggle("{{ '.office_' . strtolower($new_office_title) . '_qty' }}", this)'>
                    <label for="office_rooms_{{ $item->id }}">{{ $item->title }}</label>
                </div>
            </div>
            <div class="col-md-2 ml-auto text-center">
                <small>How many?</small>
                <div class="input-group input-group-sm">
                    <input type="text" name="{{ 'office_' . strtolower($new_office_title) . '_qty' }}" class="text-center count touchspin input-sm {{ 'office_' . strtolower($new_office_title) . '_qty' }}" data-bts-min="1" data-bts-button-down-class="btn btn-secondary" data-bts-button-up-class="btn btn-secondary" value="1" disabled />
                </div>
                <script>
                    $(".{{ 'office_' . strtolower($new_office_title) . '_qty' }}").TouchSpin();
                </script>
            </div>
        </div>
        @endif
    @endforeach  
</div>