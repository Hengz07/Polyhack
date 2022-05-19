<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ env('APP_NAME', 'Laravel') }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Krub:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">

            {{-- <h1 class="logo"><img src="{{ asset('img/img-logo-UM.png') }}" alt="" class="img-fluid"> <a href="{{ route('home') }}">{{ env('APP_NAME', 'Laravel') }}</a></h1> --}}
            <!-- Uncomment below if you prefer to use an image logo -->
            <a href="index.html" class="logo"><img src="{{ asset('img/img-logo-UM.png') }}" alt=""
                    class="img-fluid"></a>

            <nav id="navbar" class="navbar">
                <ul>
                    @foreach(config('app.available_locales') as $locale_name => $available_locale)
                        @if (session()->get('locale') == $available_locale)
                        <a href="{{ route('language', $available_locale) }}" class="">
                            <li><img src="{{ asset('locale/'.$available_locale.'.png') }}" alt="" width="30"></li>
                        </a>
                        @else    
                        <a href="{{ route('language', $available_locale) }}" class="">
                          <li><img src="{{ asset('locale/'.$available_locale.'.png') }}" alt="" width="30"></li>
                        </a>
                        @endif
                    @endforeach
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    {{-- <li><a class="nav-link scrollto" href="#services">Services</a></li> --}}
                    {{-- <li><a class="nav-link scrollto" href="#features">Disclaimer</a></li> --}}
                    {{-- <li><a class="nav-link scrollto" href="#faq">FAQ</a></li> --}}
                    <li><a class="nav-link scrollto" href="#contact">Contact Us</a></li>
                    @if (env('APP_CAS'))
                        <li><a class="getstarted scrollto" href="{{ route('cas') }}">Sign In</a></li>
                    @else
                        <li><a class="getstarted scrollto" href="{{ route('login') }}">Sign In</a></li>
                    @endif

                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            @include('layouts.message')
            <h1>{{ config('app.name') }}</h1>
            <h2>{{ __('Welcome') }}</h2>
            <a href="{{ route('cas') }}" class="btn-get-started scrollto">Sign in</a>
        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Services Section ======= -->
        {{-- <section id="services" class="services">
        <div class="container" data-aos="fade-up">
  
        
  
          <div class="row">
            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
              <div class="icon-box shadow-sm">
                <div class="icon"><img src="{{ asset('img/logo-gmail.png') }}" width="80px" alt=""></div>
                <h4 class="title"><a href="">Create New Account</a></h4>
                <p class="description">Free Web-based e-mail service that provides users with a gigabyte of storage for messages and provides the ability to search for specific messages.</p>
              </div>
            </div>

            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box shadow-sm">
                  <div class="icon"><img src="{{ asset('img/logo-calendar.png') }}" width="80px" alt=""></div>
                  <h4 class="title"><a href="">Create New Account</a></h4>
                  <p class="description">An online calendar with Gmail integration, calendar sharing and a "quick add" function to create events using natural language.</p>
                </div>
              </div>
  
            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="200">
              <div class="icon-box shadow-sm">
                <div class="icon"><img src="{{ asset('img/logo-gdrive.png') }}" width="80px" alt=""></div>
                <h4 class="title"><a href="">Create New Special Account</a></h4>
                <p class="description">A file hosting service with synchronisation option; tightly integrated with Google Docs Editors</p>
              </div>
            </div>
  
            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="300">
              <div class="icon-box shadow-sm">
                <div class="icon"><img src="{{ asset('img/google-meet.png') }}" width="80px" alt=""></div>
                <h4 class="title"><a href="">Google Meet</a></h4>
                <p class="description">Hold meetings on the go, virtual training classes, remote interviews, and more. Everything you need to get anything done, now in one place</p>
              </div>
            </div>
  
            
  
          </div>
  
        </div>
      </section><!-- End Services Section --> --}}

        <!-- ======= Features Section ======= -->
        {{-- <section id="features" class="features" data-aos="fade-up">
      <div class="container">

        <div class="section-title">
          <h2>Disclaimer</h2>
          
        </div>

        <div class="row content">
          <div class="col-md-3" data-aos="fade-right" data-aos-delay="100">
            <img src="img/features-1.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-12 pt-4 text-center" data-aos="fade-left" data-aos-delay="100">
            <h3>Please be advised that all email shall now be park directly to Google Apps Server.</h3>
     
            <ul>
              <li><i class="bi bi-check"></i> Universiti Malaya SHALL NOT BE liable for any loss or damage caused by the usage of Google Mail from within the UMMAIL Portal.</li>
              <li><i class="bi bi-check"></i> UM reserves the right to give your email address to 3rd party for the University’s programmme purposes.</li>
              <li><i class="bi bi-check"></i> Any problem arises regarding the account, please DIRECT your question to Google Mail Administrator at <a href="http://mail.google.com/support" target="_blank">Google Support</a></li>
            </ul>
          </div>
        </div>


      </div>
    </section><!-- End Features Section --> --}}


        <!-- ======= Frequently Asked Questions Section ======= -->
        {{-- <section id="faq" class="faq">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
        </div>

        <ul class="faq-list">

          <li>
            <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">Non consectetur a erat nam at lectus urna duis? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq1" class="collapse" data-bs-parent=".faq-list">
              <p>
                Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq2" class="collapse" data-bs-parent=".faq-list">
              <p>
                Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq3" class="collapse" data-bs-parent=".faq-list">
              <p>
                Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq4" class="collapse" data-bs-parent=".faq-list">
              <p>
                Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq5" class="collapse" data-bs-parent=".faq-list">
              <p>
                Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq6" class="collapsed question">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq6" class="collapse" data-bs-parent=".faq-list">
              <p>
                Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.
              </p>
            </div>
          </li>

        </ul>

      </div>
    </section><!-- End Frequently Asked Questions Section --> --}}

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Contact Us</h2>
                    
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="info-box mt-4">
                            <i class="bx bx-envelope"></i>
                            <h3><a href="https://helpdesk.um.edu.my" target="_blank">Helpdesk</a></h3>
                            <p>helpdesk@um.edu.my</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box mt-4">
                            <i class="bx bx-phone-call"></i>
                            <h3>ChatBot</h3>
                            <p>+03 7967 4001 / 6726</p>
                        </div>
                    </div>
                  </div>

            </div>

            </div>
        </section><!-- End Contact Section -->
    </main><!-- End #main -->

    {{-- @include('layouts.footer') --}}

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
