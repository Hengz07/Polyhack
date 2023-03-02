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
    background: #001f3f;
    color: white;
  }
  40%{
    background: #001f3f;
    color: white;
  }
  60% {
    background: #001f3f;
    color: white;
  }
  80% {
    background: #001f3f;
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
    background: #001f3f;
    color: #FFFFFF;
    width: 100%;
  }
</style>

  <div class="d-flex">
      <div class="mr-auto p-2"><h1>UM Dashboard</h1></div>
          <div class="p-1">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('ewp.dashboards.index') }}">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
                  </ol>
              </nav>
          </div>
      </div>
@stop

@section('content')

<div class="container-fluid" style="">
    <br>
    <body>
        <section class="ftco-section">
            {{-- Header/Title & Manual/Start Test Button Section --}}
            <div class="card-header">
    
              <div class="card-tools shadow-lg rounded">
                  <div class="input-group-append">
                    <select id="johns" name="year" class="form-control">
                      <option value="">All Years</option>
                      <option value="2022">2022</option>
                      <option value="2021">2021</option>
                      <option value="2020">2020</option>
                      <option value="2019">2019</option>
                      <option value="2018">2018</option>
                    </select>
                  </div>
                </div>
              </div>
              
              
              <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4 col-15">
                      <!-- small card -->
                      <div id="mo" class="small-box shadow p-3 mb-5  rounded">
                        <div class="inner">
                          <h1>
                            @foreach ($overallsurvey as $all)
                                      {{ $all->overallcount }}
                                  @endforeach
                          </h1>

                          <p class="mb-4">Total Survey</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-school"></i>
                        </div>
                        <div class="card-footer">
                          <div class="row">
                            <div class="col-sm-6 border-right">
                              <div class="description-block">
                                <h5 id="focy" class="description-header">
                                  @foreach ($staffsurvey as $staff)
                                          {{$staff->staffcount}}
                                  @endforeach
                                </h5>
                                <span class="description-text">Staff</span>
                              </div>
                              <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                              <div class="description-block">
                                <h5 id="focy" class="description-header">
                                  @foreach ($studentsurvey as $student)
                                      {{ $student->studentcount }}
                                  @endforeach
                                </h5>
                                <span class="description-text">Student</span>
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
                                <h1>{{$put3->count3}}</h1>
  
                                <p class="mb-4">Total Users</p>
                              </div>
                              <div class="icon">
                                <i class="fas fa-user-tie"></i>
                              </div>
                              <div class="card-footer">
                                <div class="row">
                                  <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                      <h5 id="focy" class="description-header">{{$put2->count2}}</h5>
                                      <span class="description-text">Staff</span>
                                    </div>
                                    <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-6">
                                    <div class="description-block">
                                      <h5 id="focy" class="description-header">{{$put->count}}</h5>
                                      <span class="description-text">Student</span>
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
                                <h1>{{$results->count('intervention')}}</h1>
                                <p class="mb-4">Total Visitor</p>
                            </div>
                              <div class="icon">
                                <i class="fas fa-chart-pie"></i>
                              </div>
                                <div class="card-footer">
                                  <div class="row">
                                    <div class="col-sm-6 border-right">
                                      <div class="description-block">
                                        <h5 id="focy" class="description-header">{{$results->where('intervention','INTERVENSI KHUSUS')->count()}}</h5>
                                        <span class="description-text">INTERVENSI KHUSUS</span>
                                      </div>
                                      <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6">
                                      <div class="description-block">
                                        <h5 id="focy" class="description-header">{{$results->where('intervention','INTERVENSI UMUM')->count()}}</h5>
                                        <span class="description-text">INTERVENSI UMUM</span>
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
                
            <!--------TABLE INFO-------->
            
            <div class="row">         
              <div class="col-12">
                <div class="card shadow-lg rounded">
                  <div class="card-header rounded" style="cursor: move; background: #001f3f; color:white; border-style:solid; border-color:white;">
                    <h3 class="card-title">Bilangan Pelajar Mengikut Kaunselor</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-3 table-striped " style="border-style:solid; border-color:white;">
                    <table class="table table-head-fixed text-nowrap table-bordered table-hover shadow rounded">
                      <thead>
                        <tr>
                          <th class="text-center" style="background:#001f3f; color:white;">#</th>
                          <th style="background:#001f3f; color:white;" >Nama</th>
                          <th class="text-center" style="background:#001f3f; color:white;">Selesai</th>
                          <th class="text-center" style="background:#001f3f; color:white;">Rujuk</th>
                          <th class="text-center" style="background:#001f3f; color:white;">Belum Selesai</th>
                          <th class="text-center" style="background:#001f3f; color:white;">Jumlah</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                                  $i = 0;
                              @endphp
                          @foreach($assign as $items)
                          <tr>
                              <td class="text-center" >{{ ++$i."." }}</td>
                              <td >{{ $items->name}}</td> 
                              <td class="text-center" >{{ $items->get_assign->where('status', 'S')->count() }}</td>
                              <td class="text-center" >{{ $items->get_assign->where('status', 'R')->count() }}</td>
                              <td class="text-center" >{{ $items->get_assign->where('status', 'B')->count() }}</td>
                              <td class="text-center" >{{ $items ->get_assign->count() }}</td>
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
            <div class="card-header ui-sortable-handle" style="cursor: move; background: #001f3f; color:white">
            <h3 class="card-title">
            Maklumat Saringan
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
label: 'Instisusi Pengajian',
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
  text: 'Jumlah Pelajar',
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
label: 'Instisusi Pengajian',
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
  text: 'Jumlah Pelajar',
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