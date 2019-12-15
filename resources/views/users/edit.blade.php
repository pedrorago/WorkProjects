@extends('layouts.app')



@section('content')





<div class="d-sm-flex justify-content-between flex-column mb-2">
    
    <h1 class="h3 mb-0 text-gray-800">Configurações de usuário</h1>
    <p class="mb-4" style="margin-top: .4em">Olá, {{ $user->name }}. Aqui está todas as suas informações</a>.</p>    
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))

    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
  @endforeach
</div>

<div>
    <form action="{{route('users.update', $user)}}"  enctype="multipart/form-data" class="form-horizontal" method="POST">
        @csrf
        @method('PATCH')
        <div>
            
            <!-- Content Row -->
            <div class="row">
                
                <div class="col-lg-6">
                    
                    <!-- Overflow Hidden -->
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Quadro de configurações</h6>
                        </div>
                        <div class="card-body">
                            <!-- Criar uma sprint <code>aberta</code> torna todas as outras fechadas. -->
                            
                            
                            <div class="form-group">
                                
                                <label for="name">Nome de usuário:</label>
                                
                                <input type="text" id="name" <?php echo @(Auth::user()->email == 'guest@geprojetos.com.br' ? 'readonly disabled' : ''); ?> name="name" placeholder="Digite seu nome" class="form-control" value="{{ $user->name }}">
                                
                            </div>
                            
                            <div class="form-group">
                                <label for="email">E-mail de usuário:</label>
                                <input type="text" <?php echo @(Auth::user()->email == 'guest@geprojetos.com.br' ? 'readonly disabled' : ''); ?> id="email" name="email" placeholder="Digite seu email" class="form-control" value="{{ $user->email }}">
                            </div>
                            
                            <div class="form-group">
                                <label for="function_name">Área do usuário:</label>
                                <input type="text" id="function_name" name="function_name" disabled class="form-control" value="{{ $function_user[0]->name }}">
                            </div>
                            
                            <input type="hidden" name="function_id" value="{{ $function_user[0]->id }}">
                            
                            
                            <!--<div class="form-group">-->
                            <!--    <label for="password">Nova senha:</label>-->
                            <!--    <input type="password" id="password" name="password" class="form-control">-->
                            <!--</div>-->
                            <!--<div class="form-group">-->
                            <!--    <label for="password">Confirmação da senha:</label>-->
                            <!--    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">-->
                            <!--</div>-->
                            
                            
                            
                            
                            
                            
                            <input type="hidden" name='ordering'>
                            
                            <button type="submit" class="btn btn-primary btnProject btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Confirmar</span>
                            </button>
                            
                        </div>
                        
                        
                    </div>
                    
                    
                    
                </div>

               
              
                <p class="sprints0" style="display: none">{{$sprint029}}
                </p>
                 
                <p class="sprints1" style="display: none">{{$sprint033}}
                </p>
                 
                <p class="sprints2" style="display: none">{{$sprint034}}
                </p>
                 
                <p class="sprints3" style="display: none">{{$sprint035}}
                </p>

                <p class="function" style="display: none">{{ $function_user[0]->name }}</p>
                 
                <div class="col-lg-6">
                    
                        <!-- Overflow Hidden -->
                        <div class="card border-bottom-primary mb-4">
                    
                            <div class="card-body bodyProfile">
                                <!-- Criar uma sprint <code>aberta</code> torna todas as outras fechadas. -->
                                
                                <label for="avatar" class="PictureContainer">
                                    <span class="gradient"><i class="fas fa-pencil-alt"></i></span>
                                    <img src="{{ $user->avatar }}" alt="">
                                </label>
                                
                                <input type="file" hidden id="avatar" name="avatar">
                                <h2>{{ $user->name }}</h2>
                                <h3>{{ $function_user[0]->name }}</h3>

                                <div class="chart-area">
                                        <canvas id="myChartProfile"></canvas>
                                      </div>

                            </div>
                            
                            
                        </div>
                        
                     
                    </div>

                <!-- /.container-fluid -->
                
            </div>
        </form>
    </div>
    
    
  <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    
@endsection
    
    