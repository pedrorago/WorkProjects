@extends('layouts.app')



@section('content')





<div class="d-sm-flex justify-content-between flex-column mb-2">
    
    <h1 class="h3 mb-0 text-gray-800">Criar uma nova sprint</h1>
    
    <p class="mb-4" style="margin-top: .4em">Preencha o formulário abaixo</a>.</p>    
    
</div>

<div>
    <form action="{{ route('sprints.store') }}" class="form-horizontal formSprintCreate" method="POST">
        @csrf
        <div>

            <!-- Content Row -->
            <div class="row">
  
              <div class="col-lg-6">
  
                <!-- Overflow Hidden -->
                <div class="card mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Formulário de criação</h6>
                  </div>
                  <div class="card-body">
                    <!-- Criar uma sprint <code>aberta</code> torna todas as outras fechadas. -->

                    <div class="form-group">

                        <label for="name">Numeração da sprint:</label>
        
                        <input type="number" id="name" name="name" placeholder="000" class="form-control">
        
                    </div>

                    <div class="form-group">

                        <label for="description">Descrição da sprint:</label>
        
                        <textarea name="description" style="height: 6em" id="description" class="form-control" placeholder="Digite a descrição"></textarea>

                    </div>

                    <div class="form-group">
                        <label for="start_date">Date de início</label>
                          <input class="form-control" name="start_date" type="date" id="start_date">
                    </div>

                    <div class="form-group ">
                            <label for="finish_date" >Date de conclusão</label>
                              <input class="form-control" type="date" name="finish_date" id="finish_date">
                        </div>


                    <div class="form-group">

                        <label for="status">Situação da sprint:</label>
                        
                        <select name="status" id="status" class="form-control">
                            <option value="close">Fechada</option>
                            <option value="open">Aberta</option>
                        </select>

                    </div>

                    <div class="dropdown no-arrow mb-2 mt-4" >
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Concluir sprint
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <label class="dropdown-item" style="cursor: pointer;" for="justcreate">Apenas criar</label>
                          <label class="dropdown-item" style="cursor: pointer;" for="activecreate">Tornar essa sprint a atual</label>
                        </div>
                      </div>
                  </div>

                  <input type="radio" name="active" hidden value="0" id="justcreate">
                  <input type="radio" name="active" hidden value="1" id="activecreate">
                </div>
  
  
              </div>
  
              <div class="col-lg-6">
  
                  <!-- Progress Small -->
                  <div class="card mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Histórico de criação</h6>
                    </div>
                    <div class="card-body">
                     <p class="mb-2">Última sprint criada: <strong><code>{{ $versions[0]->name }}</code></strong></p>
                       <p>Quantidade de tarefas: <strong><code>{{ $totalIssues }}</code></strong></p>

                      <div class="mb-1 mt-3 small">Conclusão da sprint: {{$porcentagem}}%</div>
                      <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: {{$porcentagem}}%" aria-valuenow="{{$porcentagem}}" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
             
                    </div>
                  </div>
                
              </div>
  
            </div>
  
          </div>
          <!-- /.container-fluid -->
  
        </div>
    </form>
</div>








@endsection

