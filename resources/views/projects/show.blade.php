@extends('layouts.app')



@section('content')





<div class="d-sm-flex justify-content-between flex-column mb-4">

    <h1 class="h3 mb-0 text-gray-800">Visualizando um projeto</h1>

    <p class="mb-4" style="margin-top: .4em">Aqui se encontra todos os detalhes do projeto {{ $project[0]->name }}</a>.</p>

    

</div>

@foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
    
          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach


<div>

            <div class="card mb-12">

                <div class="card-header py-3 d-sm-flex justify-content-between align-items-center">

                  <h6 class="m-0 font-weight-bold text-primary">{{ $project[0]->name }} >> {{ $parent[0]->name }}</h6>

                    <a href="{{ route('projects.edit', ['project' => $project[0]->id]) }}" class="editA" style='color: #858796; font-size: 14px; display: flex; align-items: center;'>

                        Editar projeto <i class="fas fa-edit" style='font-size: 22px; margin-left: .5em;'></i>

                    </a>

                </div>

                <div class="card-body">

                  Filho de: <strong>{{ $parent[0]->name }}</strong> | 
                  Criado em: <strong>{{ $project[0]->created_at }}</strong> | 



                  <br/>

                  <br/>

                    <div class='projectBody' style="display: flex;
                    flex-direction: column;">

@if($project[0]->id != 7)

<div class="familys">
    @if($gram != null)
  
        <a href="{{ route('projects.show', [$gram[0]->id]) }}" class='gram'>- {{$gram[0]->name}}</a>
    @endif
  <a href="{{ route('projects.show', [$daddy[0]->id]) }}" class='daddy'>-- {{$daddy[0]->name}}</a>
  <a href="{{ route('projects.show', [$project[0]->id]) }}" class='son'>---- {{$project[0]->name}}</a>

  @foreach($brothers as $brother)
  <a href="{{ route('projects.show', [$brother->id]) }}" class='brother'>---- {{$brother->name}}</a>
  @endforeach()
  </div>
  

@endif


<h5>Tarefas do projeto:</h5>
@foreach($issuesOnProject as $issue)

<a href="{{ route('issues.show', [ 'issues' => $issue->id]) }}" style="color: #000;">{{$issue->subject}} / {{$issue->name}}</a>

    @endforeach

                    </div>

                </div>

              </div>

</div>





@endsection

