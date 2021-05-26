<div class="choose_window_side radio_error mb-4">
	<div class="row">
        <div class="col-md-12">
            <label><strong>Which sides of the windows should we clean? <span class="mandatory">*</span></strong></label>
        </div>
    </div>
    <div class="row">
		
        @foreach($items as $item)
            @if($item->item_id == 9)
                <div class="col-md-4">
                    <div class="radio icheck-emerland"> 
                    	<input type="radio" name="window_sides" id="window_clean_side_{{ $item->id }}" value="{{ $item->id }}">
                        <label for="window_clean_side_{{ $item->id }}">{{ $item->title }}</label>
                    </div>
                </div>
            @endif
        @endforeach
    
    </div>
</div>