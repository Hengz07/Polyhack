<table>
    <thead>
    <tr>
        <th>SESSION / SEMESTER</th>
        <th>REPORT CREATED AT</th>
        <th>EMAIL</th>
        <th>NAME</th>
        <th>MATRIKS / PROFILE NUMBER</th>
        <th>GENDER</th>
        <th>RACE</th>
        <th>FACULTY</th>
        <th>CONTACT NUMBER</th>
        <th>DEP SCORE</th>
        <th>ANX SCORE</th>
        <th>STR SCORE</th>
        <th>STATUS</th>
        <th>OFFICER</th>
    </tr>
    </thead>
    <tbody>
        @foreach($reports as $report => $rep)
            {{-- @dd($report) --}}

            @php
                $profile = $rep['profile'];
                $user    = $profile['user'];
                $assign  = $rep['assign'];

                $scale = $rep['scale'];
            @endphp

            <tr>
                <td>{{ $rep['session'].' - '.$rep['sem']}}</td>
                <td>{{ date('d/m/Y', strtotime($rep['created_at'])) }}</td>
                <td>{{ $profile['alt_email'] }}</td>
                <td>{{ $user['name'] }}</td>
                <td>{{ $profile['profile_no'] }}</td>
                <td>{{ $profile['meta']['gender'] }}</td>
                <td>{{ $profile['meta']['race'] }}</td>
                <td>{{ $profile['ptj']['code'].' - '.$profile['ptj']['desc'] }}</td>
                <td>{{ $profile['alt_phone'] }}</td>

                @if(isset($scale))
                    @foreach($minmax as $mm)

                        @php
                            $range = json_decode($mm['meta_value'], true);
                        @endphp

                        @foreach($scale as $up => $test)
                            @if($mm['code'] == $up)
                                <td>
                                    {{ $scale[$up]['value'] }}
                                </td>
                            @endif
                        @endforeach
                    @endforeach
                @else  
                    <td>
                        None
                    </td>
                @endif

                @if(isset($scale))
                    <td> 
                        @php
                            if ($scale['A']['status']['intervention'] == 'INTERVENSI KHUSUS' || 
                                $scale['D']['status']['intervention'] == 'INTERVENSI KHUSUS' || 
                                $scale['S']['status']['intervention'] == 'INTERVENSI KHUSUS')
                            {
                                $intervention = 'INTERVENSI KHUSUS';
                            }
                                                    
                            else
                            {
                                $intervention = 'INTERVENSI UMUM';
                            }  
                        @endphp
                        
                        {{ $intervention }}
                    </td>
                                        
                @else  
                    <td>
                        None
                    </td>
                @endif

                <td>
                    @if(isset($assign))
                        @foreach($officers as $officer)
                            @if($assign['officer_id'] == $officer['id'])
                                {{ $officer['name'] }}
                            @endif
                        @endforeach
                    @else 
                        {{ 'None' }}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>