@extends('layouts.app')



@section('content')





<div class="d-sm-flex justify-content-between flex-column mb-2">
    
    <h1 class="h3 mb-0 text-gray-800">Criar uma novo projeto</h1>
    
    <p class="mb-4" style="margin-top: .4em">Preencha o formulário abaixo</a>.</p>    
    
</div>

<div>
    <form action="{{ route('projects.store') }}" class="form-horizontal formProjectCreate" method="POST">
        @csrf
        <div>

            <!-- Content Row -->
            <div class="row">
  
              <div class="col-lg-12">
  
                <!-- Overflow Hidden -->
                <div class="card mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Formulário de criação</h6>
                  </div>
                  <div class="card-body">
                    <!-- Criar uma sprint <code>aberta</code> torna todas as outras fechadas. -->

                    <input type="hidden" class="orderingProject" name="ordering">

                    <div class="form-group">

                        <label for="name">Nome do projeto:</label>
        
                        <input type="text" id="name" name="name" placeholder="Digite o nome do projeto" class="form-control nameProject">
        
                    </div>

                    <div class="form-group">

                        <label for="parent_id">Projeto pai:</label>

                        <select  name="parent_id" id="parent_id" class="form-control">

                            @foreach($projects as $project)

                            <option value="{{ $project->id }}">{{ $project->name }}</option>

                            @endforeach

                            </select>

                    </div>

                    <div class="form-group">

                        <label for="function_id">Área relacionada:</label>

                        <select  name="function_id" id="function_id" class="form-control">

                            @foreach($functions as $function)

                            <option value="{{ $function->id }}">{{ $function->name }}</option>

                            @endforeach

                            </select>

                        </div>
                    
                    <input type="hidden" name='ordering'>

                    <button type="submit" class="btn btn-primary btnProject btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Criar projeto</span>
</button>

                  <input type="radio" name="active" hidden value="0" id="justcreate">
                  <input type="radio" name="active" hidden value="1" id="activecreate">
                </div>
  
  
              </div>
  
             
  
          </div>
          <!-- /.container-fluid -->
  
        </div>
    </form>
</div>








@endsection

