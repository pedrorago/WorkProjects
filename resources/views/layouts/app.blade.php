<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/logotipo/LogoMarca-4.png') }}" >
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WorkProjects</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <!-- <link href="{{ asset('css/semantic.min.css') }}" rel="stylesheet"> -->
    <!-- <link href="{{ asset('css/dataTables.semanticui.min.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel='stylesheet'>
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/contextMenu.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

</head>
<style>
.note-popover.popover
{
  display: none !important;
}
</style>
<body id="page-top">
        <div id="app">

  @if(Auth::user()->notification == 1)
  <!-- <div class='gradientModal'>
  </div>
  <div class='ModalInfo' style="background-size: cover; background-repeat: repeat; background-image: url({{ asset('img/bgicons.svg') }})">
      <i class="material-icons closeModalInfo"> close </i>
      <div class='ModalContent'>
          <h1>Nova funcionalidade!</h1>
          <legend>Para uma melhor experiencia, aperte uma unica vez as teclas <strong>CTRL + SHIFT + R </strong> para recarregar os caches do sistema.</legend>

          <h2>Update:</h2>
          <p>Agora está disponível a funcionalidade de edição em massa na listagem de tarefas.</p>

          <h2>Tutorial:</h2>
          <p>Para utilizar a edição na listagem, basta selecionar a(s) tarefa(s) clicando uma vez em cima dela(s). Em seguida, clicando com o botão <strong>direito</strong> do mouse, irá abrir um menu de opçãoes. Para finalizar a ação, basta clicar na opção que deseja e aguardar a página ser atualizada.</p>
          <p style="margin-top: .5em"><strong>OBS: </strong>Para selecionar várias tarefas, basta clicar na primeira, segurar o botão SHIFT e clicar onde deseja finalizar a seleção.</p>
          <img src="{{ asset('img/Select_new.gif') }}"  class='gifModal' alt="">
          
          <form class='formModal'>
          @csrf
          @method('patch')
                <input type="hidden" name='user_id' value='{{Auth::user()->id}}' class='user_id'>
                <button type='submit' class='btn btn-primary'>Não exibir novamente</button>
          </form>

      </div>
  </div> -->
  @endif
  <!-- Page Wrapper -->
  <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    
          <!-- Sidebar - Brand -->
          <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
            <div class="sidebar-brand-icon ">
              <img src="{{ asset('img/logotipo/LogoMarca-3.png') }}" alt="">
            </div>
            <div class="sidebar-brand-text mx-3" style='margin-left: .5em !important'>WorkProjects</div>
          </a>
    
          <!-- Divider -->
          <hr class="sidebar-divider my-0">
    
          <!-- Nav Item - Dashboard -->
          <li class="nav-item active">
            <a class="nav-link" href="/">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span></a>
          </li>
    
          <!-- Divider -->
          <hr class="sidebar-divider">
    
          <!-- Heading -->
          <div class="sidebar-heading">
            Utilidades
          </div>
    
          z
          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-fw fa-chart-area"></i>
              <span>Tarefas</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">OPÇÕES</h6>
                <a class="collapse-item" href="{{ route('issues.index', app()->getLocale()) }}">Listar todas</a>
                @guest
                @else
                <a class="collapse-item" href="{{ route('issues.index', ['attr' => Auth::user()->id, 'sprint' => $sprint, app()->getLocale()])  }}">Minhas tarefas</a>
                <a class="collapse-item" href="{{ route('issues.index', ['function' => Auth::user()->function_id, 'sprint' => $sprint, app()->getLocale()])  }}">Listar minha área</a>
                @endguest
                <a class="collapse-item" href="{{ route('issues.index', ['sprint' => $sprint, app()->getLocale()]) }}">Listar sprint atual</a>
                <a class="collapse-item" href="{{ route('issues.create', app()->getLocale()) }}">Criar uma nova</a>
              </div>
            </div>
          </li>

                    <li class="nav-item">
            <a class="nav-link" href="{{ route('projects.index', app()->getLocale())}}">
              <i class="fas fa-fw fa-folder"></i>
              <span>Projetos</span></a>
        </li>

            <li class="nav-item">
                    <a class="nav-link" href="/backlog">
                      <i class="fas fa-fw fa-folder"></i>
                      <span>Backlog</span></a>
                </li>
              
        <li class="nav-item">
                <a class="nav-link" href="{{ route('sprints.index', app()->getLocale()) }}">
                  <i class="fas fa-fw fa-table"></i>
                  <span>Sprints</span></a>
            </li>
          <!-- Nav Item - Utilities Collapse Menu -->
          <!-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
              <i class="fas fa-fw fa-wrench"></i>
              <span>Utilities</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
              </div>
            </div>
          </li>
     -->
          <!-- Divider -->
          <hr class="sidebar-divider">
    
          <!-- Heading -->
          <div class="sidebar-heading">
            Admin
          </div>
    
          <!-- Nav Item - Pages Collapse Menu -->
          @guest
          @else
          @if(Auth::user()->type == 1 )

          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
              <i class="fas fa-fw fa-cog"></i>
              <span>Gestão</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Cadastros:</h6>
                <a class="collapse-item" href="{{ route('issues.create', app()->getLocale()) }}">Criar Tarefas</a>
                <a class="collapse-item" href="{{ route('sprints.create', app()->getLocale()) }}">Criar Sprints</a>
                <a class="collapse-item" href="{{ route('projects.create', app()->getLocale())}}">Criar Projetos</a>
                <a class="collapse-item" href="/404">Criar Setor</a>
                <a class="collapse-item" href="/404">Criar Área</a>
                <a class="collapse-item" href="/404">Criar Usuário</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Incrementes:</h6>
                <a class="collapse-item" href="/404">Estátisticas</a>
                <a class="collapse-item" href="/404">Relátorios</a>
              </div>
            </div>
          </li>
          @endif
    
          @endguest
    

          @guest
          @else
          <!-- Nav Item - Tables -->
          <li class="nav-item">
            <a class="nav-link" href="{{ route('users.edit', [Auth::user()->id, app()->getLocale()]) }}">
              <i class="fas fa-fw fa-user"></i>
              <span>Usuário</span></a>
          </li>
        @endguest
          <!-- Divider -->
          <hr class="sidebar-divider d-none d-md-block">
    
          <!-- Sidebar Toggler (Sidebar) -->
          <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
          </div>
    
        </ul>
        <!-- End of Sidebar -->
    
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
    
          <!-- Main Content -->
          <div id="content">
    
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    
              <!-- Sidebar Toggle (Topbar) -->
              <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
              </button>
    
    @guest
    
    @else
              <!-- Topbar Search -->
              <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                  <input type="text" class="form-control bg-light border-0 small" placeholder="Pesquisar por..." aria-label="Search" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                      <i class="fas fa-search fa-sm"></i>
                    </button>
                  </div>
                </div>
              </form>
    @endguest
    
              <!-- Topbar Navbar -->
              <ul class="navbar-nav ml-auto">
    
                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                  <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                  </a>
                  <!-- Dropdown - Messages -->
                  <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                      <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                          <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </li>
                @guest
                
                @else
                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                  <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i> 
                    <!-- Counter - Alerts -->
                     <span class="badge badge-danger badge-counter">3+</span>
                  </a>
                  <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                      Central de Alertas
                    </h6>

                   <a class="dropdown-item d-flex align-items-center" href="#">
                      <div class="mr-3">
                      <div class="icon-circle bg-warning">
                          <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                      </div>
                      <div>
                        <div class="small text-gray-500">Agosto 14, 2019</div>
                        <span class="font-weight-bold"> A opção de trocar sua senha atual foi removida temporariamente </span>
                      </div>
                    </a> 


                    <a class="dropdown-item d-flex align-items-center" href="#">
                      <div class="mr-3">
                        <div class="icon-circle bg-primary">
                          <i class="fas fa-file-alt text-white"></i>
                        </div>
                      </div>
                      <div>
                        <div class="small text-gray-500">Julho 07, 2019</div>
                        <span class="font-weight-bold">Central de Sprints adicionada ao sistema. Ler nota da atualização na Home.</span>
                      </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                      <div class="mr-3">
                        <div class="icon-circle bg-success">
                          <i class="fas fa-folder text-white"></i>
                        </div>
                      </div>
                      <div>
                        <div class="small text-gray-500">Julho 07, 2019</div>
                        O backlog saiu do quadro de sprints geral e agora tem uma área própria.
                      </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                      <div class="mr-3">
                        <div class="icon-circle bg-warning">
                          <i class="fas fa-fw fa-cog text-white"></i>
                        </div>
                      </div>
                      <div>
                        <div class="small text-gray-500">Julho 08, 2019</div>
                        Central de projetos integrada ao sistema. 
                      </div>
                    </a>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Mostrar todos</a>
                  </div>
                </li> 
                
                <!-- Nav Item - Messages -->
                <!-- <li class="nav-item dropdown no-arrow mx-1">
                  <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope fa-fw"></i> -->
                    <!-- Counter - Messages -->
                    <!-- <span class="badge badge-danger badge-counter">7</span>
                  </a> -->
                  <!-- Dropdown - Messages -->
                  <!-- <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">
                      Message Center
                    </h6>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                      <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                        <div class="status-indicator bg-success"></div>
                      </div>
                      <div class="font-weight-bold">
                        <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                      </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                      <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                        <div class="status-indicator"></div>
                      </div>
                      <div>
                        <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                        <div class="small text-gray-500">Jae Chun · 1d</div>
                      </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                      <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                        <div class="status-indicator bg-warning"></div>
                      </div>
                      <div>
                        <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                      </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                      <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                        <div class="status-indicator bg-success"></div>
                      </div>
                      <div>
                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                      </div>
                    </a>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                  </div>
                </li> 
                @endguest
                <div class="topbar-divider d-none d-sm-block"></div>
    
             -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login, app()->getLocale()') }}">{{ __('Login') }}</a>
                </li>
         
                @else
                <li class="nav-item dropdown no-arrow">
                  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                    <div class='avatarContainer'> <img class="img-profile rounded-circle" src="{{ Auth::user()->avatar }}"></div>
                  </a>
                  
                  <style>
                      
                      .avatarContainer
                      {
                          width: 3em;
                        height: 3em;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        overflow: hidden;
                        border-radius: 100%;
                    }
                    .avatarContainer img
                    {
                        height: auto !important;
                        width: 100% !important;
                        border-radius: 0% !important;
                    }
                  </style>
                  <!-- Dropdown - User Information -->
                  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('users.edit', [Auth::user()->id, app()->getLocale()]) }}">
                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                      Perfil
                    </a>
            
                 
                    <div class="dropdown-divider"></div>


                    @if(Auth::user()->type == 1)
                        <a class="dropdown-item" href="/create">
                        <i class="fas fa-plus fa-sm fa-fw mr-2 text-gray-400"></i>
                        Novo usuário
                        </a>
                    @endif

                    <a class="dropdown-item" href="{{ route('logout', app()->getLocale()) }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>

                     Encerrar sessão

                     <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                  </div>
                </li>

                @endguest

    
              </ul>
    
            </nav>
            <!-- End of Topbar -->
    
            <!-- Begin Page Content -->
            <div class="container-fluid">
            @yield('content')
            <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                      <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Rago's Inc 2019</span>
                      </div>
                    </div>
                  </footer>
            </div>
                  <!-- Footer -->

      <!-- End of Footer -->
    </div>

    <!-- <script src="{{ asset('js/app.js') }}" ></script> -->
    <!-- <script src="{{ asset('js/datatables.min.js') }}" ></script>
    <script src="{{ asset('js/dataTables.semanticui.min.js') }}" ></script>
    <script src="{{ asset('js/semantic.min.js') }}" ></script>
    <script src="{{ asset('js/script.js') }}" ></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

  <!-- Bootstrap core JavaScript-->
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
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="{{ asset('js/contextMenu.js') }}"></script>
  
    <!-- Page level custom scripts -->
    <!-- <script src="{{ asset('js/demo/datatables-demo.js') }}"></script> -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script src="{{ asset('js/script.js') }}" ></script> 


</body>
</html>
