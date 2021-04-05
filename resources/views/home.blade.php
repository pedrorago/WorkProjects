@extends('layouts.app')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card cardLinkBody border-left-primary shadow h-100 py-2">
                <a href="{{ route('issues.index', ['sprint' => $versions->id, app()->getLocale()]) }}" class="card-body cardLink">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('current sprint') }}:</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      {{ $versions->name }}
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </a>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tarefas da sprint:</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalIssues }} Tarefas</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Conclusão da sprint</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $porcentagem }}%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ $porcentagem }}%" aria-valuenow="{{ $porcentagem }}" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tarefas pendentes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pending }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">{{ $function_user[0]->name }} Overview</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
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
            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4" style='height: 29.5em'>
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Quadra de avisos</h6>
                    </div>
                    <div class="card-body quadroAvisos">
                        
                      
                                             <p>
                      Bom dia, {{Auth::user()->name}} ! A opção de trocar sua senha atual foi removida temporariamente 
                       <i>14 de agosto</i>
                      </p>
                      
                       <p>
                       Gente, é importante marcas as historias que estão sendo <strong>FEITAS</strong> como <strong>FAZENDO</strong>, para melhor controle da sprint.
                       <br/>
                    
                       <i>15 de julho</i>
                 
                      
                             </p>
                    </div>
                  </div>


            </div>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-20 mb-4" style="    display: flex;
            width: 100%;">

              <!-- Project Card Example -->
              <div class="card shadow mb-4" style="    width: 50%;
              height: 31em;">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Projetos</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Desenvolvimento <span class="float-right">20%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Planejamento <span class="float-right">40%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Criação <span class="float-right">60%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Produção/Midia <span class="float-right">80%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Digital <span class="float-right">Complete!</span></h4>
                  <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>

       
            <div class="col-lg-6 mb-4">

              <!-- Illustrations -->
          
              <div class="card shadow mb-4 cardDoing">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Histórico rápido</h6>
                    <div class="dropdown no-arrow">
                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                      </a>
                      <!-- <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div> -->
                    </div>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    
                   @foreach($doing as $value)
  
                   <div class="doingBox">
                      <span class="doingImg"> 
                        <img src="{{ $value->author_pic_histories }}" alt="">
                      </span>
                      <p><strong>{{ $value->author_name_histories }}</strong>
                        alterou a tarefa tarefa: <a href="{{ route('issues.show', ['issue' => $value->	issue_id, app()->getLocale()]) }}">{{ $value->issue_name }}</a>
                        para<strong>  {{ $value->issue_status}}</strong>
                      </p>
                    </div>
  
  
                   @endforeach
  
                  </div>
                </div>
              <!-- Approach -->
            

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<script src="{{ asset('js/home.js') }}" ></script> 

@endsection
