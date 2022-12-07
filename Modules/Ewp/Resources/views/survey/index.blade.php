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
        <div class="card-body" style="padding: 0px;">
            <form id="formsubmit" action='POST'>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-navy">
                                <td style="width:60%" colspan="2">Tandakan semua / <i class="text-primary">Tick all</i></td>
                                <?php 
                                
                                for($ans = 0; $ans <= 3 ; $ans++ ){
                                    ?><td style="width:5%" align="center">
                                    
                                    <span class=""><?php echo $ans; ?></span>
                                </td>
                                <?php  }?>                              
                            </tr>
                        </thead>
                        {{-- <tr>
                            <td colspan="6">&nbsp;</td>
                        </tr> --}}
                        @if (count($question) == 0)
                        <td style="text-align: center" colspan="6">No data availables</td>
                        @else
                        @php $qCount = 0; @endphp
                        @foreach ($question as $key => $row)
                            <tr>
                                <td>{{ ++$key }}.</td>
                                @if(app()->currentLocale() == 'ms-my') {{-- LANGUAGE CHANGE --}}
                                    <td>{{ $row['value_local'] }}</td>
                                @elseif(app()->currentLocale() == 'en')
                                    <td>{{ $row['value_translation'] }}</td>
                                @endif

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
                                                            <input type="radio"  id="{{ $row->code.$x }}" name="<?php echo "Q[$row->code]"; ?>" value="<?php echo $x;?>" 
                                                        onclick="pilih(1)">
                                                        <label class="" for="{{ $row->code.$x }}"></label>
                                                        </div>                 
                                        </td>
                                @php  } @endphp
                            </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
            </p>
                <div class="pull-rigth">   
                    <span class="float-right mr-3"> <a id='count'>0</a> / <span>{{ count($question) }}</span> &nbsp;          
                    <input type="submit" name="submit" id="submit" class="btn btn-outline-success" style="float: right;" value="Submit" disabled="disabled"> <br>
                </div>
            <p>&nbsp;<small>SULIT</small></p>
        </form>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script>
        $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    });

    var qCounting = 21;
    function pilih(i){
        var inputs = document.getElementById("formsubmit").elements;
        count=0;
        for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type == 'radio' && inputs[i].checked) {
                count++;
                document.getElementById("count").innerHTML =  count;
            }
        }
        // document.getElementById("totals").innerHTML =  qCounting;
    // console.log(count +'-'+qCounting);
    if(count == 21 )
    
    $("#submit").removeAttr("disabled");
    }
    
    $(document).ready(function(e) {


    $('#formsubmit').on('submit' , function(e){

    e.preventDefault();
    var data = $('#formsubmit').serializeArray();
    var id = "{{ $uuid }}";
    submitformSwal(data,id);
    });
    });

    function submitformSwal(datas,ids){
        swal.fire({
                title: "Simpan",
                text: "Maklumat yang diberikan adalah sulit",
                icon: "warning",
                buttons: true,
                closeOnConfirm: true,
                })
                .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        url: "/ewp/survey/save",
                        method:"POST",
                        dataType: "json",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "q": JSON.stringify(datas),
                            "id": ids,
                            },
                        success: function(data){   
                            $("#formsubmit")[0].reset();
                            swal.fire('Terima Kasih ,Maklumat Disimpan');
                            readProducts();
                        }
                    });
                }
                });
                }
                function readProducts(){
                window.location.href="/ewp/dashboards/dashboard";	
                }
    </script>
@endpush