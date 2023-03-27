@extends('adminlte::page')

@section('content_header')
<style>
  *{
    
  }
  .small-box,.headerss{
    background-color: #FFFFFF;
    color: #001f3f;
  }
  .description-header{
    color: #001f3f;
  }
  .fa-school,.fa-user-tie,.fa-chart-pie{
    color: white;
    -webkit-text-stroke: 2px #001f3f;
  }
  .headerss{
    background-color: #001f3f;
    color: white;
  }
  .contoh{
    width: 20em; 
    float: right; 
    padding:0.5em;
  }
  #ok1{
    border-block-end-style: solid;
    border-block-end-color: #001f3f;
    padding:1em;
    
  }
  #ok2{
    border-block-end-style: solid;
    border-block-end-color: #001f3f;
      padding: 2em;
    }
  #try{
    width: 30%;
  }
  td{
    padding:10em;
  }
  .small-box{
  border-block-start-style: solid;
  border-block-start-color: #001f3f;
  transform: translateY(3px);
  animation: wavyText 10s ease-in-out infinite;
  
}
#focy{
  animation: wavyText2 10s ease-in-out infinite;
}
#mo{
  animation-delay: 1s;
}

#mo2 {
  animation-delay: 2s;
}

#mo3 {
  animation-delay: 3s;
}


@keyframes wavyText {
  0%{
    
  }
  20%{
    background: #1D3456;
    color: white;
    
  }
  40%{
    background: #1D3456;
    color: white;
    
  }
  60% {
    background: #1D3456;
    color: white;
    
  }
  80% {
    background: #1D3456;
    color: white;
    
  }
  100% {
  }
}

@keyframes wavyText2 {
  0%{
    
  }
  20%{
    color: white;
  }
  40%{
    color: white;
  }
  60% {
    color: white;
  }
  80% {
    color: white;
  }
  100% {
  }
}

  @media(max-width: 424px){
    .contoh{
      padding-left: 1em;
    }
    #ok{
      width: 15em;
      padding: 2em;
      border-style: solid;
      border-color: black;
      font-size: 1em;
    }
    #okss{
      width: 100%;
      padding: 1em;
      border-style: solid;
      border-color: black
    }
    .card{
      border-style: solid;
      border-color: black
    }
  }
  #johns{
    background: #1D3456;
    color: #FFFFFF; 
    width: 100%;
  }
  .date{
    text-shadow: 0 1px 0 #CCCCCC, 0 2px 0 #c9c9c9, 0 3px 0 #bbb, 0 4px 0 #b9b9b9, 
    0 5px 0 #aaa, 0 6px 1px rgba(0,0,0,.1), 0 0 5px rgba(0,0,0,.1), 0 1px 3px rgba(0,0,0,.3), 
    0 3px 5px rgba(0,0,0,.2), 0 5px 10px rgba(0,0,0,.25), 0 10px 10px rgba(0,0,0,.2), 0 20px 20px rgba(0,0,0,.15);
    font-weight: bold
}

.time{
  text-shadow: 0 1px 0 #CCCCCC, 0 2px 0 #c9c9c9, 0 3px 0 #bbb, 0 4px 0 #b9b9b9, 
    0 5px 0 #aaa, 0 6px 1px rgba(0,0,0,.1), 0 0 5px rgba(0,0,0,.1), 0 1px 3px rgba(0,0,0,.3), 
    0 3px 5px rgba(0,0,0,.2), 0 5px 10px rgba(0,0,0,.25), 0 10px 10px rgba(0,0,0,.2), 0 20px 20px rgba(0,0,0,.15);
  font-weight: bold
}
</style>
@php

    if(app()->currentLocale() == 'ms-my')
    {
        $title = 'Dashboard UM';
        $tsurvey = 'Jumlah Tinjauan';
        $tuser = 'Jumlah Pengguna';
        $tvisitor = 'Jumlah Intervensi Khusus';

        $stff = 'Staf';
        $stdnt = 'Pelajar';

        $title2 = 'Bilangan Pelajar Mengikut Kaunselor';
        $name = 'Nama';
        $complete = 'Selesai';
        $reference = 'Rujuk';
        $incomplete = 'Belum Selesai';
        $total = 'Jumlah';

        $title3 = 'Maklumat Saringan';
        $label = 'Institusi Pengajian';
        $yaxistext = 'Jumlah Pelajar';
    }
    
    elseif(app()->currentLocale() == 'en')
    {
        $title = 'UM Dashboard';
        $tsurvey = 'Total Survey';
        $tuser = 'Total User';
        $tvisitor = 'Total Special Intervention ';

        $stff = 'Staff';
        $stdnt = 'Student';

        $title2 = 'Number of Students by Counselor';
        $name = 'Name';
        $complete = 'Complete';
        $reference = 'Reference';
        $incomplete = 'Incomplete';
        $total = 'Total';

        $title3 = 'Screening Information';
        $label = 'Institution';
        $yaxistext = 'Total Student';
    }

@endphp
  <div class="d-flex">
      <div class="mr-auto p-2" style="text-shadow: 0 1px 0 #CCCCCC, 0 2px 0 #c9c9c9, 0 3px 0 #bbb, 0 4px 0 #b9b9b9, 0 5px 0 #aaa, 0 6px 1px rgba(0,0,0,.1), 0 0 5px rgba(0,0,0,.1), 0 1px 3px rgba(0,0,0,.3), 0 3px 5px rgba(0,0,0,.2), 0 5px 10px rgba(0,0,0,.25), 0 10px 10px rgba(0,0,0,.2), 0 20px 20px rgba(0,0,0,.15);" ><h1>{{$title}}</h1></div>
      <div class="p-1">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('ewp.dashboards.index') }}">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
                  </ol>
              </nav>
              <div class="datetime">
                <div class="date">
                  <span id="dayname">Day</span>,
                  <span id="month">Month</span>
                  <span id="daynum">00</span>,
                  <span id="year">Year</span>
                </div>
                <div class="time">
                  <span id="hour">00</span>:
                  <span id="minutes">00</span>:
                  <span id="seconds">00</span>
                  <span id="period">AM</span>
                </div>
              </div>  
          </div>
      </div>
@stop

@section('content')

<div class="container-fluid" style="">
    <br>
    <body onload="initClock()">
        <section class="ftco-section">
            {{-- Header/Title & Manual/Start Test Button Section --}}
            <div class="card-header">
    
              <div class="card-tools shadow-lg rounded">
                  <div class="input-group-append">
                    <form action="{{ route('ewp.dashboards.admin_dash', ['year' => $selectedYear]) }}" method="GET">
                      <select class="form-control" name="year" id="year" onchange="this.form.submit()">
                        @for( $x=date('Y')-1; $x <= date('Y')+1 ; $x++)
                          <option value="{{ $x }}" @if($x ==  $selectedYear)selected @endif >{{ $x }}</option>
                         @endfor
                      </select>
                  </form>
                  </div>
                </div>
              </div>
              {{-- @if($selectedYear == date('Y')) --}}
              <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4 col-15">
                      <!-- small card -->
                      <div id="mo" class="small-box shadow p-3 mb-5  rounded">
                        <div class="inner">
                          <h1>
                            {{ $overallsurvey[0]->overallcount }}
                          </h1>
                          <p class="mb-4">{{$tsurvey}}</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-school"></i>
                        </div>
                        <div class="card-footer">
                          <div class="row">
                            <div class="col-sm-6 border-right">
                              <div class="description-block">
                                <h5 id="focy" class="description-header">
                                  {{$staffsurvey}}
                                </h5>
                                <span class="description-text">{{$stff}}</span>
                              </div>
                              <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                              <div class="description-block">
                                <h5 id="focy" class="description-header">
                                  {{$studentsurvey}}
                                </h5>
                                <span class="description-text">{{$stdnt}}</span>
                              </div>
                              <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                        </div>
                      </div>
                    </div>
                        
                          <div class="col-md-4 col-12">
                            <!-- small card -->
                            <div id="mo2" class="small-box shadow p-3 mb-5  rounded" style="">
                              <div class="inner">
                                <h1>{{$data['total_user']}}</h1>

                                <p class="mb-4">{{$tuser}}</p>
                              </div>
                              <div class="icon">
                                <i class="fas fa-user-tie"></i>
                              </div>
                              <div class="card-footer">
                                <div class="row">
                                  <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                      <h5 id="focy" class="description-header">{{ $data['total_student'] }}</h5>
                                      <span class="description-text">{{$stff}}</span>
                                    </div>
                                    <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-6">
                                    <div class="description-block">
                                      <h5 id="focy" class="description-header">{{ $data['total_staff'] }}</h5>
                                      <span class="description-text">{{$stdnt}}</span>
                                    </div>
                                    <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.row -->
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-4 col-15">
                            <!-- small card -->
                            <div id="mo3" class="small-box shadow p-3 mb-5  rounded" style="">
                              <div class="inner">
                                <h1>{{$results + $results2}}</h1>
                                <p class="mb-4">{{$tvisitor}}</p>
                            </div>
                              <div class="icon">
                                <i class="fas fa-chart-pie"></i>
                              </div>
                                <div class="card-footer">
                                  <div class="row">
                                    <div class="col-sm-6 border-right">
                                      <div class="description-block">
                                        <h5 id="focy" class="description-header">{{$results}}</h5>
                                        <span class="description-text">{{$stff}}</span>
                                      </div>
                                      <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6">
                                      <div class="description-block">
                                        <h5 id="focy" class="description-header">{{$results2}}</h5>
                                        <span class="description-text">{{$stdnt}}</span>
                                      </div>
                                      <!-- /.description-block -->
                                    </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                            </div>
                          </div>
                        </div>
                      
                    </div>
                </div>

                
                {{-- @endif --}}
            <!--------TABLE INFO-------->
            
            <div class="row">         
              <div class="col-12">
                <div class="card shadow-lg rounded">
                  <div class="card-header rounded" style="cursor: move; background: #1D3456; color:white; border-style:solid; border-color:white;">
                    <h3 class="card-title">{{$title2}}</h3>
                        <form action="{{ route('ewp.dashboards.admin_dash') }}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-primary" style="float:right;"><i class="fas fa-user-friends"></i>
                                                    <span class="badge badge-light" style="position: absolute; top: 10px; right: 15px;">{{ $unassignedCount }}</span></button>
                      </form>
                  </div>
                  <script>
                    function split() {
                        alert("Button clicked!");
                    }
                    </script>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-3 table-striped " style="border-style:solid; border-color:white;">
                    <table class="table table-head-fixed text-nowrap table-bordered table-hover shadow rounded">
                      <thead>
                        <tr>
                          <th class="text-center" style="background:#1D3456; color:white;">#</th>
                          <th style="background:#1D3456; color:white;" >{{$name}}</th>
                          <th class="text-center" style="background:#1D3456; color:white;">{{$complete}}</th>
                          <th class="text-center" style="background:#1D3456; color:white;">{{$reference}}</th>
                          <th class="text-center" style="background:#1D3456; color:white;">{{$incomplete}}</th>
                          <th class="text-center" style="background:#1D3456; color:white;">{{$total}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                                  $i = 0;
                              @endphp
                              @foreach($assign as $items)
                              <tr>
                                  <td class="text-center">{{ ++$i }}.</td>
                                  <td>{{ $items->name }}</td>
                                  <td class="text-center">{{ $items->get_assign->where('status', 'S')->count() }}</td>
                                  <td class="text-center">{{ $items->get_assign->where('status', 'R')->count() }}</td>
                                  <td class="text-center">{{ $items->get_assign->where('status', 'B')->count() }}</td>
                                  <td class="text-center">{{ $items->total_assign->first()->total_count ?? 0 }}</td>
                              </tr>
                          @endforeach
                          

                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
            <!-- /.row -->
          <!--------TABLE INFO-------->
          <div class="card shadow-lg rounded">
            <div class="card-header ui-sortable-handle" style="cursor: move; background: #1D3456; color:white">
            <h3 class="card-title">
            {{$title3}}
            </h3>
            <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
            <a class="nav-link active" href="#revenue-chart" style="color: white;" data-toggle="tab">Area</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#sales-chart" style="color: white;" data-toggle="tab">Donut</a>
            </li>
            </ul>
            </div>
            </div>
            <div class="card-body">
            <div class="tab-content p-0">
            
            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 500px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            <canvas id="revenue-chart-canvas" height="300" style="height: 300px; display: block; width: 503px;" width="503" class="chartjs-render-monitor"></canvas>
            </div>
            <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 500px;">
            <canvas id="sales-chart-canvas" height="300" style="height: 300px; display: block; width: 503px;" width="503" class="chartjs-render-monitor" width="0"></canvas>
            </div>
            </div>
            </div>
            </div>
        
    </div>
</section>
</body>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const areaChart = document.getElementById('revenue-chart-canvas');
const donutChart = document.getElementById('sales-chart-canvas');
var color = [
    '#0c172b',
    '#15274a',
    '#2e335a',
    '#192F59',
    '#223f78',
    '#2a4f95',
    '#264787',
    '#2f4369',
    '#2f57a6',
    '#233067',
    '#346FB3',
    '#4472cb',
    '#46587a',
    '#638ad3',
    '#7295D7',
    '#1a3e66',
    '#82a1dc',
    '#A0B8E4',
    '#bfcfed',
    '#DDE6F6',
  ];

  new Chart(areaChart, {
  type: 'bar',
  data: {
    labels: [
      @foreach ($overall as $stat)
        "{{ $stat->ptj_desc }}",
      @endforeach
    ],
    datasets: [{
      label: '{{ $stdnt }}',
      data: [
        @foreach ($overall as $stat)
          "{{ $stat->student_count }}",
        @endforeach
    ],
    borderWidth: 1,
    backgroundColor: 'rgba(168, 62, 50, 1)',
    categoryPercentage: 0.4,
    },
    {
      label: '{{ $stff }}',
      data: [
        @foreach ($overall as $stat)
          "{{ $stat->staff_count }}",
        @endforeach
    ],
    borderWidth: 1,
    backgroundColor: 'rgba(4, 143, 55, 1)',
    categoryPercentage: 0.4,
    },
    {
      label: '{{ $label }}',
      data: [
        @foreach ($overall as $stat)
          "{{ $stat->count }}",
        @endforeach
    ],
    borderWidth: 1,
    backgroundColor: color,
    grouped: false,
    }]
  },
  options: {
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: 'bottom',
        display: true,
        labels: {
          fontColor: 'black'
        }
      }
    },
    scales: {
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: '{{ $yaxistext }}',
        }
      },
      x: {
        grid: {
          display: false,
        }
      },
    }
  }
});


new Chart(donutChart, {
type: 'doughnut',
data: {
labels: [
@foreach ($overall as $stat)
"{{ $stat->ptj_desc }}",
@endforeach
],
datasets: [{
label: '{{$label}}',
data: [
@foreach ($overall as $stat)
"{{ $stat->count }}",
@endforeach
],
borderWidth: 1,
backgroundColor: color,
}]
},
options: {
maintainAspectRatio: false,
plugins: {
legend: {
position: 'bottom',
display: true,
labels: {
  fontColor: 'black'
}
}
},
scales: {
y: {
beginAtZero: true,
title: {
  display: true,
  text: '{{$yaxistext}}',
}
},
x: {
grid: {
  display: false,
}
},
}
}
});

function getRandomColor() {
  var ok = [
    '#056608',
    '#50C878',
    '#FF2400',
    '#87CEEB',
    '#DC143C',
  ];
  return ok;
}
function updateClock(){
      var now = new Date();
      var dname = now.getDay(),
          mo = now.getMonth(),
          dnum = now.getDate(),
          yr = now.getFullYear(),
          hou = now.getHours(),
          min = now.getMinutes(),
          sec = now.getSeconds(),
          pe = "AM";
		  
          if(hou >= 12){
            pe = "PM";
          }
          if(hou == 0){
            hou = 12;
          }
          if(hou > 12){
            hou = hou - 12;
          }

          Number.prototype.pad = function(digits){
            for(var n = this.toString(); n.length < digits; n = 0 + n);
            return n;
          }

          var months = ["January", "February", "March", "April", "May", "June", "July", "Augest", "September", "October", "November", "December"];
          var week = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
          var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
          var values = [week[dname], months[mo], dnum.pad(2), yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
          for(var i = 0; i < ids.length; i++)
          document.getElementById(ids[i]).firstChild.nodeValue = values[i];
    }

    function initClock(){
      updateClock();
      window.setInterval("updateClock()", 1);
    }
/*
      #056608
      #50C878
      #FF2400
      #87CEEB
      #DC143C
  
var r = Math.random();
var g = Math.random();
var b = Math.random();
var a = Math.random();

return 'rgba(' + r + ', ' + g + ', ' + b + ', ' + a + ')';
*/
</script>
        </section>
    </body>
</div>
  
@endsection
