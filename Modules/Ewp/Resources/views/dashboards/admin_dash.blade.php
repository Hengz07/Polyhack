@extends('adminlte::page')

@section('content_header')
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css"> 
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
    .johnnys{
      width: 100%;
      margin-inline: 0.5em;
    }
    
  }
  #johns{
    background: #1D3456;
    color: #FFFFFF; 
    width: 100%;
  }
  .container-fluid{
    width: 97%;
  }
  .mr-2{
    margin-right: -2em;
  }
  .p-4{
    padding: 1.5rem !important;
  }
  table,th,td{
    padding: 0.9rem !important;
  }
  #scrollToTopButton {
  position: fixed;
  bottom: 8rem;
  right: 1.2rem;
  z-index: 9999;
  background: red;
  border: none;
  display: block; /* Initially show the button */
  transition: opacity 0.3s ease-in-out; /* Add transition effect */
  opacity: 1; /* Initially fully visible */
}

#scrollToTopButton.hidden {
  opacity: 0; /* Make the button transparent when hidden */
  pointer-events: none; /* Disable button clicks when hidden */
}
</style>
<script>
  document.addEventListener('DOMContentLoaded', function() {
  const scrollToTopButton = document.getElementById('scrollToTopButton');

  scrollToTopButton.addEventListener('click', function() {
    scrollToTop();
  });

  window.addEventListener('scroll', function() {
    if (window.pageYOffset > 0) {
      scrollToTopButton.classList.remove('hidden'); // Show the button
    } else {
      scrollToTopButton.classList.add('hidden'); // Hide the button
    }
  });

  // Function to scroll the page to the top
  function scrollToTop() {
    // Scroll smoothly to the top of the page
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
}); 
</script>
@php

    if(app()->currentLocale() == 'ms-my')
    {
        $title = 'Dashboard UM';
        $tsurvey = 'Jumlah Tinjauan';
        $tuser = 'Jumlah Pengguna';
        $tvisitor = 'Jumlah Intervensi<br>Khusus';

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
        $tvisitor = 'Total Special<br>Intervention';

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
  <div class="johnnys" style="display:flex; flex-wrap: wrap; gap:6px; width:96%;">
      <div class="ml-5 p-2" ><h1>{{$title}}</h1></div>
      <div class="ml-auto p-2">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('ewp.dashboards.index') }}">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page" style="color:#1D3456; font-weight:bold;">Admin Dashboard</li>
                  </ol>
              </nav>
          </div>
      </div>
@stop

@section('content')

<div class="container-fluid" style="">
    <br>
    <body onload="initClock()">
        <section class="ftco-section">
            {{-- Header/Title & Manual/Start Test Button Section --}}
            <div class="card-header" style="border-style:solid; border-color:transparent;">
              <div class="card-tools shadow-sm rounded">
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
              <div class="col-md-20" style="display: inline-flexbox;">
                <div class="row">
                    <div class="col-md-4 col-15">
                      <!-- small card -->
                      <div id="mo" class="small-box shadow p-3 mb-5  rounded">
                        <div class="inner">
                          <h1 style="font-weight:bold;">
                            {{ $overallsurvey }}
                          </h1>
                          <p class="mb-5" style="font-weight:bold; font-size:20px; display:block;">{{$tsurvey}}</p>
                        </div>
                        <div class="icon">
                          <i class='fas fa-file-alt' style='font-size:86px; color:#001f3f;'></i>
                        </div>
                        <div class="card-footer" style="background: transparent;">
                          <div class="row">
                            <div class="col-sm-6 border-right">
                              <div class="description-block">
                                <h5 id="focy" class="description-header" style="font-weight:bold;">
                                  {{$staffsurvey}}
                                </h5>
                                <span class="description-text" style="font-weight:bold; ">{{$stff}}</span>
                              </div>
                              <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                              <div class="description-block">
                                <h5 id="focy" class="description-header" style="font-weight:bold;">
                                  {{$studentsurvey}}
                                </h5>
                                <span class="description-text" style="font-weight:bold;">{{$stdnt}}</span>
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
                            <div id="mo2" class="small-box shadow p-3 mb-5 rounded" style="">
                              <div class="inner">
                                <h1 style="font-weight:bold;">{{$data['total_user']}}</h1>

                                <p class="mb-5"style="font-weight:bold; font-size:20px; display:block;">{{$tuser}}</p>
                              </div>
                              <div class="icon">
                                {{-- <i class="fas fa-user-tie"></i> --}}
                                <i class='far fa-user-circle' style='color:#001f3f; font-size:86px;'></i>
                              </div>
                              <div class="card-footer" style="background: transparent;">
                                <div class="row">
                                  <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                      <h5 id="focy" class="description-header" style="font-weight:bold; display:block;">{{ $data['total_student'] }}</h5>
                                      <span class="description-text" style="font-weight:bold;">{{$stff}}</span>
                                    </div>
                                    <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-6">
                                    <div class="description-block">
                                      <h5 id="focy" class="description-header" style="font-weight:bold;">{{ $data['total_staff'] }}</h5>
                                      <span class="description-text" style="font-weight:bold;">{{$stdnt}}</span>
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
                                <h1 style="font-weight:bold;">{{$results + $results2}}</h1>
                                <p class="mb-3" style="font-weight:bold; font-size:20.7px; text-align:;">{!! $tvisitor !!}</p>
                            </div>
                              <div class="icon">
                                <i class="fa fa-comment-medical" style="font-size:86px; color:#001f3f;"></i>
                              </div>
                                <div class="card-footer" style="background: transparent;">
                                  <div class="row">
                                    <div class="col-sm-6 border-right">
                                      <div class="description-block">
                                        <h5 id="focy" class="description-header" style="font-weight:bold;">{{$results}}</h5>
                                        <span class="description-text" style="font-weight:bold;">{{$stff}}</span>
                                      </div>
                                      <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6">
                                      <div class="description-block">
                                        <h5 id="focy" class="description-header" style="font-weight:bold;">{{$results2}}</h5>
                                        <span class="description-text" style="font-weight:bold;">{{$stdnt}}</span>
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

                {{-- <button id="scrollToTopButton" class="btn btn-primary float-right"><i class="fas fa-angle-up"></i></button> --}}
                <button id="scrollToTopButton" class="btn btn-primary float-right"><i class="fas fa-angle-up"></i></button>
                {{-- @endif --}}
            <!--------TABLE INFO-------->
            
            <div class="row">         
              <div class="col-12">
                <div class="card shadow-lg rounded">
                  <div class="card-header rounded" style="cursor: move; background: #E3E6EB; color:#001f3f;">
                    <h3 class="card-title p-2 text-bold">{{$title2}}</h3>
                  </div>
                  <!-- /.card-header -->
                  
                  <div class="card-body table-responsive px-5">
                    {{-- <form class="form-inline float-right mb-3" action="{{ route('ewp.dashboards.admin_dash') }}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-secondary">
                        Unassigned Report <span class="badge badge-light">{{ $unassignedCount }}</span>
                      </button>
                    </form> --}}
                    <table class="table text-nowrap  mb-2" >
                      <thead>
                      <tr>
                        <td colspan="6">
                        <form class="form-inline d-flex justify-content-end" action="{{ route('ewp.dashboards.admin_dash') }}" method="POST">
                          @csrf
                          <button type="submit" class="btn" style="color:#001f3f; background:#E3E6EB; font-weight:bold;">
                            Unassigned Report <span class="badge badge-light" style="color:#001f3f;">{{ $unassignedCount }}</span>
                          </button>
                        </form>    
                      
                      </td>
                    </tr>
                    
                        <tr>
                          <th class=""></th>
                          <th >{{$name}}</th>
                          <th class="">{{$complete}}</th>
                          <th class="">{{$reference}}</th>
                          <th class="">{{$incomplete}}</th>
                          <th class="">{{$total}}</th>
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
                                  <td class="">{{ $items->get_assign->where('status', 'S')->count() }}</td>
                                  <td class="">{{ $items->get_assign->where('status', 'R')->count() }}</td>
                                  <td class="">{{ $items->get_assign->where('status', 'B')->count() }}</td>
                                  <td class="">{{ $items->total_assign->first()->total_count ?? 0 }}</td>
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

            <div class="card shadow-lg rounded">
              <div class="card-header ui-sortable-handle" style="cursor: move; background: #E3E6EB; color:#001f3f;">
              <h3 class="card-title p-1" style="font-weight:bold; ">
              {{$title3}}
              </h3>
              <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
              {{-- <li class="nav-item">
              <a class="nav-link active" href="#revenue-chart" style="color: white;" data-toggle="tab">Area</a>
              </li>
              <li class="nav-item">
              <a class="nav-link" href="#sales-chart" style="color: white;" data-toggle="tab">Donut</a>
              </li> --}}
              </ul>
              </div>
              </div>
              <div class="card-body">
              <div class="tab-content p-0">
                {{-- <canvas id="myChart"></canvas> --}}
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 500px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <canvas id="revenue-chart-canvas" height="300" style="height: 300px; display: block; width: 503px;" width="503" class="chartjs-render-monitor"></canvas>
              </div>
              {{-- <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 500px;">
              <canvas id="sales-chart-canvas" height="300" style="height: 300px; display: block; width: 503px;" width="503" class="chartjs-render-monitor" width="0"></canvas>
              </div> --}}
              </div>
              </div>
              </div>
          <!--------TABLE INFO-------->
          
            
        
    </div>
</section>
</body>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

<script>
      // setup 
      const monthlyCounts = {!! $monthly !!}.map(item => item.count);
      const data = {
  labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
  datasets: [
    {
      label: 'Students',
      data: <?php echo json_encode($student_counts); ?>,
      backgroundColor: ['rgba(53, 111, 179, 0.7)'],
      borderWidth: 1,
      borderRadius: 7,
    },
    {
      label: 'Staff',
      data: <?php echo json_encode($staff_counts); ?>,
      backgroundColor: ['rgba(99, 138, 211, 0.5)'],
      borderWidth: 1,
      borderRadius: 7,
    },
  ],
};

// Chart configuration
const config = {
  type: 'bar',
  data,
  options: {
    interaction: {
      mode: 'index',
    },
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: 'bottom',
        display: true,
        labels: {
          usePointStyle: true,
        },
      },
    },
    scales: {
      x: {
        stacked: true,
        grid: {
          display: false, // Remove x-axis gridlines
          drawBorder: false
        },
      },
      y: {
        beginAtZero: true,
        stacked: true,
        title: {
          display: true,
          text: 'Total',
        },
        grid: {
          display: true,
          borderColor: 'rgba(0, 0, 0, 0.1)', // Set gridline color
          borderDash: [5, 5], // Set border dash pattern (5 pixels dashed, 5 pixels gap)
          drawBorder: false
        },
        ticks: {
          stepSize: 1, // Adjust the step size as needed
          callback: function (value, index, values) {
            return value.toString(); // Display the tick value as a string
          },
      },
    },
    },
  },
};

    // render init block
    const myChart = new Chart(
      document.getElementById('revenue-chart-canvas'),
      config
    );

    // Instantly assign Chart.js version
    const chartVersion = document.getElementById('chartVersion');
    chartVersion.innerText = Chart.version;
</script>

        </section>
    </body>
</div>
  
@endsection
