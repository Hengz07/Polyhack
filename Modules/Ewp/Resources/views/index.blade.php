@extends('adminlte::page')

@section('content_header')
<div class="d-flex">
    <div class="mr-auto p-2"><h1>Dashboard</h1></div>
        <div class="p-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
@stop

@section('content')

<div class="container-fluid">
    
    {{-- Module information --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5>Question Testing</h5>
                </div>
                <div class="card-body">
                    {{-- Load form module --}}
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sections</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Sections">
                            </div>
                                
                            <div class="form-group">
                                <label for="exampleInputPassword1">Descriptions</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Descriptions">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Status</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Status">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Versions</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Versions">
                            </div>
                                
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Questions Table --}}

    <br>

    <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
            <h2 class="heading-section">Table Examples</h2>
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"></path>
            </svg>
        </div>
    </div>

    {{-- Table Design 1 --}}
    <div class="col-xl-12">

        <div class="table-responsive">
                
            <!-- .table -->
            <table class="table table-primary table-hover">

                {{-- thead --}}
                <thead class="thead-dark text-center">
                    <tr>
                        <th style="min-width:200px"> SKOR BAHAGIAN </th>
                    </tr>
                </thead><!-- /thead -->
            </table>
        </div>

        <!-- .table-responsive -->
        <div class="table-responsive">
                
            <!-- .table -->
            <table class="table table-hover">

                {{-- thead --}}
                <thead class="thead-navy">
                    <tr>
                        <th style="min-width:200px"> NO </th>
                        <th> BM / BI </th>
                        <th> Status </th>
                        <th> Bahagian </th>
                    </tr>
                </thead><!-- /thead -->
                        <!-- tbody -->
                <tbody>
                            <!-- tr -->
                    <tr>
                        <td> S1 </td>
                        <td> 
                            Saya rasa susah untuk bertenang
                            <br>
                            <p class="text-primary">
                                I find it difficult to calm down
                            </p>
                        </td>
                        <td> v1 </td>
                        <td> Stress </td>
                    </tr><!-- /tr -->
                        <!-- tr -->
                    <tr>
                        <td> A1 </td>
                        <td> 
                            Saya sedar mulut saya rasa kering
                            <br>
                            <p class="text-primary">
                                I was aware of dryness of my mouth
                            </p>
                        </td>
                        <td> v1 </td>
                        <td> Anxiety </td>
                    </tr><!-- /tr -->
                            <!-- tr -->
                    <tr>
                        <td> D1 </td>
                        <td> 
                            Saya seolah-olah tidak dapat mengalami perasaan positif sama sekali
                            <br>
                            <p class="text-primary">
                                I couldn't seem to experience any positive feeling at all
                            </p>
                        </td>
                        <td> v1 </td>
                        <td> Depression </td>
                    </tr><!-- /tr -->
                        <!-- tr -->
                    <tr>
                        <td> A2 </td>
                        <td> 
                            Saya mengalami kesukaran bernafas (contohnya bernafas terlalu cepat, tercungap-cungap walaupun tidak melakukan aktiviti fizikal)
                            <br>
                            <p class="text-primary">
                                I experienced breathing difficulty (e.g. excessively rapid breathing, breathlessness in the absence of physical exertion)
                            </p>
                        </td>
                        <td> v1 </td>
                        <td> Anxiety </td>
                    </tr><!-- /tr -->
                </tbody><!-- /tbody -->
            </table><!-- /.table -->
        </div><!-- /.table-responsive -->
    </div><!-- /.card -->

    <br>
    {{-- Table Design 2 --}}
    <body>
        <section class="ftco-section">
            <div>
                <div class="row justify-content-center pb-5">
                    <div class="col-md-12 text-center mb-5">
                        <h2 class="heading-section">Table #02 (Practicing to replicate official main page for ewp)</h2>
                    </div>
                </div>
                
                <hr>

                {{-- Header/Title & Manual/Start Test Button Section --}}
                <div class="row"> 
                    <div class="col-md-8 pt-3">
                        <div>
                            <h3><strong>
                                Profiling Bagi Kesejahteraan Emosi
                            </h3></strong>
                        </div>
                        <div>
                            <p>
                                Emotional Wellbeing Profiling bagi sesi 2021|1/Undergraduate
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4 text-right pt-3">
                        <div>
                            <button type="button" class="btn btn-outline-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                                    <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"></path>
                                    <path d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"></path>
                                </svg>

                                MANUAL
                            </button>
                            <button type="button" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">

                                </path>
                                </svg>

                                START TEST
                            </button>
                        </div>
                        <div>
                            <p>
                                
                            </p>
                        </div>
                    </div>
                </div>

                <hr>
                
                {{-- Report & Test Score Section --}}
                <div class="row">
                    {{-- Report (Table, Columns) --}}
                    <div class="col-md-12 pb-5 text-center">
                        <h3 class="pb-4"><strong>
                            Test Score
                        </h3></strong>
                        <div>
                            <p class="lead"><strong>
                                STRESS (TEKANAN)
                            </p></strong>
                            <p class="lead"><strong>
                                ANXIETY (KEBIMBINGAN)
                            </p></strong>
                            <p class="lead"><strong>
                                DEPRESSION (KEMURUNGAN)
                            </p></strong>
                        </div>
                    </div>

                    {{-- Test Score (Stress, Anxiety, Depression + Test Acknowledgement) --}}
                    <div class="row col-md-12 text-center pt-5">
                        <div class="col-md-6 text-center">
                            <div>
                                <h3 class="text-center pb-4"><strong>
                                    Report
                                </h3></strong>
                            </div>
                            <div class="table-wrap">
                                <table class="table">
                                    <thead class="thead-light justify-content-left">
                                        <tr>
                                            <th>No.</th>
                                            <th>Session / Semester</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            {{-- <th>&nbsp;</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="alert" role="alert">
                                            <th scope="row">1</th>
                                            <td>2022|2</td>
                                            <td>06-MAY-23</td>
                                            <td>Umum</td>
                                            {{-- <td>
                                                <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                                </a>
                                            </td> --}}
                                        </tr>
                                        
                                        <tr class="alert" role="alert">
                                            <th scope="row">2</th>
                                            <td>2023|3</td>
                                            <td>08-SEP-24</td>
                                            <td>Umum</td>
                                            {{-- <td>
                                                <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                                </a>
                                            </td> --}}
                                        </tr>
                                        
                                        <tr class="alert" role="alert">
                                            <th scope="row">3</th>
                                            <td>2021|1</td>
                                            <td>21-APR-22</td>
                                            <td>Umum</td>
                                            {{-- <td>
                                                <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                                </a>
                                            </td> --}}
                                        </tr>
                                        <tr class="alert" role="alert">
                                            <th scope="row">4</th>
                                            <td>2022|2</td>
                                            <td>06-MAY-23</td>
                                            <td>Umum</td>
                                            {{-- <td>
                                                <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                                </a>
                                            </td> --}}
                                        </tr>
                                        
                                        <tr class="alert" role="alert">
                                            <th scope="row">5</th>
                                            <td>2023|3</td>
                                            <td>08-SEP-24</td>
                                            <td>Umum</td>
                                            {{-- <td>
                                                <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                                </a>
                                            </td> --}}
                                        </tr>
                                        
                                        <tr class="alert" role="alert">
                                            <th scope="row">6</th>
                                            <td>2021|1</td>
                                            <td>21-APR-22</td>
                                            <td>Umum</td>
                                            {{-- <td>
                                                <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                                </a>
                                            </td> --}}
                                        </tr>
                                        <tr class="alert" role="alert">
                                            <th scope="row">7</th>
                                            <td>2022|2</td>
                                            <td>06-MAY-23</td>
                                            <td>Umum</td>
                                            {{-- <td>
                                                <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                                </a>
                                            </td> --}}
                                        </tr>
                                        
                                        <tr class="alert" role="alert">
                                            <th scope="row">8</th>
                                            <td>2023|3</td>
                                            <td>08-SEP-24</td>
                                            <td>Umum</td>
                                            {{-- <td>
                                                <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                                </a>
                                            </td> --}}
                                        </tr>
                                        
                                        <tr class="alert" role="alert">
                                            <th scope="row">9</th>
                                            <td>2021|1</td>
                                            <td>21-APR-22</td>
                                            <td>Umum</td>
                                            {{-- <td>
                                                <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                                </a>
                                            </td> --}}
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <h3 class="pb-4"><strong>
                                Acknowledgement & Informations
                            </h3></strong>
                            <div class="pt-4">
                                <p>
                                    Terima kasih kerana mengisi saringan ini.
                                </p>
                                <p class="text-primary font-italic ">
                                    Thank you for participating in this screening test.
                                </p>
                            </div>
                            <div>
                                <p>
                                    Dimaklumkan bahawa ini hanya saringan awal untuk kegunaan pihak SPPsK
                                    sebagai panduan intervensi awal. Untuk maklumat lanjut mengenai keputusan
                                    saringan, pelajar boleh berhubung terus dengan pegawai psikologi di:
                                </p>
                                <p class="text-primary font-italic">
                                    Kindly be informed that this is only a preliminary test used by Section of Psychology Management &
                                    Counseling to determine early intervention. For more information on the results, please contact
                                    the psychology officers at:
                                </p>
                            </div>
                            <div>
                                <p><strong>
                                    Seksyen Pengurusan Psikologi & Kaunseling,
                                </p></strong>
                           
                                <p>
                                    Blok D Aras 1, Kompleks Perdanasiswa Universiti Malaya.
                                </p>
                            </div>

                            <div class="text-primary font-italic">
                                <p><strong>
                                    Section of Psychology Management & Counseling,
                                </p></strong>

                                <p>
                                    Level 1, Block D, Kompleks Perdanasiswa Universiti Malaya.
                                </p>
                            </div>
        
                            <p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                </svg>

                                03-79673244/3322
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</div>

@endsection

{{-- @section('content')
    <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Quick Example</h3>
                            </div>
                                    
                            <form>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                            </div>
                        <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
@endsection  --}}
       

