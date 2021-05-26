<div class="choose_furniture_material checkbox_error mb-4">
    <div class="row">
        <div class="col-md-12 col-12">
            <label><strong>What kind of material are your items? <span class="mandatory">*</span></strong></label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-12">
            <div class="checkbox icheck-emerland">
                <input type="checkbox" name="furniture_material[]" id="furniture_fabric" value="fabric">
                <label for="furniture_fabric">Fabric</label>
            </div>
        </div>
        <div class="col-md-2 col-12">
            <div class="checkbox icheck-emerland"> 
                <input type="checkbox" name="furniture_material[]" id="furniture_velvet" value="velvet">
                <label for="furniture_velvet">Velvet</label>
            </div>
        </div>
        <div class="col-md-2 col-12">
            <div class="checkbox icheck-emerland">
                <input type="checkbox" name="furniture_material[]" id="furniture_delicate" value="delicate">
                <label for="furniture_delicate">Delicate</label>
            </div>
        </div>
        <div class="col-md-2 col-12">
            <div class="checkbox icheck-emerland">                
                <input type="checkbox" name="furniture_material[]" id="furniture_other" value="other" onclick="toggle('.furniture_material_others', this)">
                <label for="furniture_other">Other</label>
            </div>
        </div>
    </div>
    <div class="row furniture_matherial_other_field d-none">
        <div class="col-md-6 col-12">
            <div class="form-group">
        	   <input type="text" name="furniture_material_others" class="form-control furniture_material_others" disabled>
            </div>
        </div>
    </div>
</div>