{!! Form::open(['route' => ['ewp.assign.surveyanswer', $report->id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
@method('PUT')

{{-- @include('setup.question.form') --}}

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-navy">
                        
                        @if(app()->currentLocale() == 'ms-my')
                            <th style="width:60%" colspan="2">Soalan</th>
                        @elseif(app()->currentLocale() == 'en')
                            <th style="width:60%" colspan="2">Questions</th>
                        @endif

                        @if(app()->currentLocale() == 'ms-my')
                            <th style="width:10%" class="text-center">Skala Jawapan</th>
                        @elseif(app()->currentLocale() == 'en')
                            <th style="width:10%" class="text-center">Answer Scale</th>
                        @endif
                      
                    </tr>
                </thead>

                @if (count($question) == 0)
                    <td style="text-align: center" colspan="6">No data availables</td>
                @else
                    @foreach ($question as $key => $row)
                            <tr>
                                <td class="text-center">{{ ++$key }}</td>
                                @if(app()->currentLocale() == 'ms-my') {{-- LANGUAGE CHANGE --}}
                                    <td>{{ $row['value_local'] }}</td>
                                @elseif(app()->currentLocale() == 'en')
                                    <td>{{ $row['value_translation'] }}</td>
                                @endif

                                @foreach($meta as $m => $ans)
                                    @php
                                        if(str_contains($ans['name'], $row['code'])){
                                                // dd($ans);
                                                $value = $ans['value']; 
                                        }
                                        else{}
                                    @endphp
                                @endforeach

                                <td class="text-center">{{ $value }}</td>
                            </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
</div>

<hr>
<center>
    <a class="btn btn-default float-right" data-dismiss="modal" aria-label="Close">Cancel</a>
</center>

{!! Form::close() !!}