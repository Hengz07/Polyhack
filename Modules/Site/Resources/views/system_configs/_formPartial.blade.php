<div class="row">
    <div class="col-lg-3">
        <h5>Maintenance</h5>
        <p class="text-muted">Switch on to enable maintenance mode</p>
    </div>
    <div class="col-lg-9">

        <div class="form-group">
            <div class="">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" name="config[maintenance]" value='1' id="input_active" @if($config['maintenance']??true==true) checked @endif>
                    <label class="custom-control-label" for="input_active"></label>
                </div>
            </div>
        </div>
    </div>
</div>