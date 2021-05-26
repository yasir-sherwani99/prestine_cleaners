<div class="choose_house_things d-none checkbox_error mb-4">
    <div class="row">
        <div class="col-md-12">
            <label><strong>Which of the following apply to your house? <span class="mandatory">*</span></strong></label>
        </div>
    </div>
    <div class="row">
        @foreach($items as $item)
            @if($item->item_id == 1)        
                @php
                    $new_house_title = trim($item->title);
                @endphp
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="select_error">
                            <select class="form-control" name="house_parts_{{ strtolower($new_house_title) }}">
                                <option value="">Select {{ $item->title }}</option> 
                                <option value="1">1 {{ $item->title }}</option>
                                <option value="2">2 {{ $item->title }}</option>
                                <option value="3">3 {{ $item->title }}</option>
                                <option value="4">4 {{ $item->title }}</option>
                                <option value="5">5 {{ $item->title }}</option>
                                <option value="6">6 {{ $item->title }}</option>
                                <option value="7">7 {{ $item->title }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
