<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style='height: 100%'>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/logotipo/LogoMarca-4.png') }}" >
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GeProjetos - Login</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->

    <link href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- <link href="{{ asset('css/semantic.min.css') }}" rel="stylesheet"> -->
    <!-- <link href="{{ asset('css/dataTables.semanticui.min.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

</head>





<body class="nav-md" style='background: rgba(93, 2, 73, 0.01); display: flex; align-items: center; justify-content: center; background-size: contain;
background-repeat: repeat; background-image: url({{ asset('img/bgicons.svg') }})'>
    
        <form method="POST" class='FormLogin' action="{{ route('login') }}" aria-label="{{ __('Login') }}">
            @csrf

            <img src="{{ asset('img/logotipo/LogoMarca-5.png') }}"  class='logotipo' alt="">
        
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">@</span>
            <input id="email" type="email"  placeholder="E-mail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" aria-describedby="basic-addon1" name="email" value="{{ old('email') }}" required autofocus>
            
            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
        
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fas fa-key"></i></span>
            <input id="password" type="password" placeholder="Senha"  class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" aria-describedby="basic-addon1" name="password" required>
            
            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
        
        <div class="form-group input-group row">
            <div class="col-md-6 offset-md-4" style='padding: 0em;'>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    
                    <label class="form-check-label" for="remember">
                        {{ __('Lembrar senha') }}
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group input-group row mb-0" style='margin-top: .5em'>
                <div class="col-md-8 offset-md-4" style='padding: 0em; width: 100%;'>
                    <button type="submit" class="btn btn-purple">
                        {{ __('Entrar') }}
                    </button>
<!-- 
                    <a class="btn btn-link" href="{{ route('password.request') }}" style='padding: 0'>
                        {{ __('Esqueceu sua senha?') }}
                    </a> -->
                    
                    <a class="btn btn-link" href="javascript:void(0)" style='padding: 0'>
                        {{ __('Esqueceu sua senha?') }}
                    </a>
<!-- 
                     <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li> -->
                </div>
            </div>
    </form>
    



  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->

  <!-- Page level custom scripts -->
  <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  
    <!-- Page level custom scripts -->
    <!-- <script src="{{ asset('js/demo/datatables-demo.js') }}"></script> -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script src="{{ asset('js/script.js') }}" ></script> 


</body>
</html>
