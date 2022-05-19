<form action="{{ $route??null }}" method="get">
    <div class="input-group mb-3">        
        {!! Form::text('q', $q, array('placeholder' => __('Search....'),'class' => 'form-control')) !!}
        <div class="input-group-append">
            <button class="{{ config('adminlte.btn_search') }}" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>