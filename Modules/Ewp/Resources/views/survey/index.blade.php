@extends('adminlte::page')

@section('title', config('app.name') . ' - ')

@section('content_header')
<div class="d-flex">
    <div class="mr-auto p-2"><h1></h1></div>
    <div class="p-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Questions</li>
            </ol>
        </nav>
    </div>
</div>
@stop
@section('content')
<div class="container-fluid">
    <div class="{{ config('adminlte.card_default') }}">
        <div class="card-header">
            <div class="box">
                <div class="card">
                    <div class="card-header">
                            Berikan pendapat anda untuk pernyataan berikut:<br>
                            <span class="text-primary"> Please state your level of agreement with the following statements:</span> 
                    </div>
        </div>
        <div class="card-body">

            <table width="100%" border="1">
                <tr>
                    <td colspan="2">Tandakan semua / <i class="text-primary">Tick all</i></td>
                    <?php 
                    
                    for($ans =0; $ans <= 3 ; $ans++ ){
                        ?><td  align="center">
                        
                        <span class=""><?php echo $ans; ?></span>
                    </td>
                    <?php  }?>                              
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                @if (count($question) == 0)
                <td style="text-align: center" colspan="6">No data availables</td>
                @else
                @foreach ($question as $key => $row)
                    <tr>
                        <td>{{ ++$key }}.</td>
                        <td>{{ $row->ewp_desc_bm }}</td>

                          @php   $tooltipdesc = '';
                            for($x =0; $x <= 3 ; $x++ ){
                                
                                if($x == 0){
                                  $tooltipdesc = 'Did not apply to me at all';
                                  $color = 'icheck-success';
                                }else if($x == 1){
                                  $tooltipdesc = 'Applied to me to some degree, or some of the time';
                                  $color = 'icheck-info';
                                }else if($x == 2){
                                  $tooltipdesc = ' Applied to me to a considerable degree or a good part of time';
                                  $color = 'icheck-warning';
                                }
                                else{
                                  $tooltipdesc = 'Applied to me very much or most of the time';
                                  $color = 'icheck-secondary';
                                } 
                        @endphp
                                <td align="center"> 
                                                <div class="<?=$color?> d-inline" data-toggle="tooltip"  title="<?=$tooltipdesc?>">
                                                  <input type="radio"  id="{{ $row->id.$x }}" name="<?php echo "Q[]"; ?>" value="<?php echo $x;?>" 
                                                  onclick="pilih(1)">
                                                  <label class="" for="{{ $row->id.$x }}"></label>
                                                </div>                 
                                </td>
                          @php  } @endphp
                    </tr>
                @endforeach
                @endif
            </table>

        </div>
    </div>
</div>



@endsection

@push('js')
    <script>
        $('.myTable').dataTable();
    </script>
@endpush