<button class="{{ config('adminlte.btn_primary') }}" type="submit" name="submit" value="submit">
    @if(isset($isUpdate))
        <i class="fa fa-edit"></i> {{ __('Update') }}
    @else
        <i class="fa fa-save"></i> {{ __('Save') }}
    @endif
</button>