<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="{{ asset('dashboard/assets/img/favicon.ico') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Admin | Székelykeve</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />


  
  <link href="{{ asset('dashboard/assets/css/dashboard.css') }}" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="{{asset('summernote/summernote.css')}}">

  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="{{ asset('dashboard/assets/img/sidebar-5.jpg') }}">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

      <div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{ route('admin.index') }}" class="simple-text">
                    <b>ADMIN</b>
                </a>
            </div>

            <ul class="nav">
                <li class="{{ Nav::isRoute('admin.index', 'active') }}">
                    <a href="{{ route('admin.index') }}">
                        <i class="fa fa-pie-chart"></i>
                        <p>Vezérlőpult</p>
                    </a>
                </li>
                <li class="{{ Nav::isRoute('admin.ujcikk', 'active') }}">
                  <a href="{{ route('admin.ujcikk') }}">
                    <i class="fa fa-pencil-square-o"></i>
                    <p>Új Cikk</p>
                  </a>
                </li>
                <li class="{{ Nav::isRoute('cikkek', 'active') }}">
                  <a href="{{ route('admin.cikkek') }}">
                    <i class="fa fa-list-alt"></i>
                    <p>Cikkek</p>
                  </a>
                </li>
            </ul>
      </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('admin.index') }}">Vezérlőpult</a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               {{ Auth::user()->fullname() }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                  <div class="alert alert-success text-center" role="alert" style="position: fixed; top:0; left: 0; width: 100%; z-index: 1; text-shadow: 0 1px 0 #387338; font-weight: bold; letter-spacing: 0.6px; display: none; opacity: .9; background-color: #5cb85c" id="alert-success">
                    <i class="fa fa-check-circle"></i> <span></span>
                  </div>                  

                  <div class="alert alert-danger text-center" role="alert" style="position: fixed; top:0; left: 0; width: 100%; z-index: 1; text-shadow: 0 1px 0 #e05159; font-weight: bold; letter-spacing: 0.6px; display: none; opacity: .9" id="alert-danger">
                    <i class="fa fa-exclamation-triangle"></i> <span></span>
                  </div>

                  @if (Request::session()->exists('status')) 
                    @push('javascript')
                      <script type="text/javascript">
                        showSuccessAlert('{{Request::session()->get('status')}}');
                      </script>
                    @endpush
                  @endif               

                  @yield('content')

                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                
                            </a>
                        </li>

                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">Székelykeve</a>
                </p>
            </div>
        </footer>

    </div>
</div>


  <!--   Core JS Files   -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js" type="text/javascript"></script>
  <script src="{{ asset('dashboard/assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

  <!--  Checkbox, Radio & Switch Plugins -->
  <script src="{{ asset('dashboard/assets/js/bootstrap-checkbox-radio-switch.js') }}"></script>

  <!--  Charts Plugin -->
  <script src="{{ asset('dashboard/assets/js/chartist.min.js') }}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{ asset('dashboard/assets/js/bootstrap-notify.js') }}"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
  <script src="{{ asset('dashboard/assets/js/light-bootstrap-dashboard.js') }}"></script>  
  <script src="{{ asset('dashboard/assets/js/bootstrap-switch.min.js') }}"></script>  
  
  <script src="{{ asset('dashboard/assets/js/vue.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/axios.min.js') }}"></script>


  <script src="{{ asset('dashboard/tinymce/tinymce.min.js') }}"></script>


  

  <script type="text/javascript">
    function showSuccessAlert(message) {
      $("#alert-success span").text(message);
      $("#alert-success").slideDown('fast');

      setTimeout(
        function() {
          $("#alert-success").slideUp('fast');          
        }, 3000);      
    }    

    function showDangerAlert(message) {
      $("#alert-danger span").text(message);
      $("#alert-danger").slideDown('fast');

      setTimeout(
        function() {
          $("#alert-danger").slideUp('fast');          
        }, 3000);      
    }
  </script>

  @stack('javascript')


  

</body>




</html>