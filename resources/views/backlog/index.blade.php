@extends('layouts.app')



@section('content')

 <!-- Page Heading -->

 <h1 class="h3 mb-2 text-gray-800">Capiba Backlog</h1>

          <p class="mb-4">Aqui é se encontra um quadro geral de todas as atividades do backlog da Agencia Capiba. É possível fazer alterações, pesquisas e consultas nessa parte da aplicação.</a>.</p>


          <?php
    $url_atual= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $serve = "http://$_SERVER[HTTP_HOST]";

?>

<input type='hidden' id='url' value='{{$url_atual}}'>
<input type='hidden' id='serve' value='{{$serve}}'>
<ul class='custom-menu shadow'>
  <input type='hidden' class='user' name='id_user' value='{{Auth::user()->id}}'>
  <li class="menuLi six" ><a href="#" target="_blank" class='ListLink visuMenu'><img src="{{ asset('img/icons/open.png') }}"> Visualizar Tarefa</a></li>
  <li class="menuLi first" data-action="first"><a href="" class='ListLink'> <img src="{{ asset('img/icons/Status.png') }}"> Editar Status <i class="material-icons">arrow_right</i></a>
    <form id="form_status" class='submenu'>
        @csrf
        @method('PUT')
        <label class='labelMenuStatus' for="1">A Fazer</label>
        <input type="radio" name='status' value='1' hidden id='1'>

        <label class='labelMenuStatus' for="2">Fazendo</label>
        <input type="radio" name='status' value='2' hidden id='2'>

        <label class='labelMenuStatus' for="3">Feito</label>
        <input type="radio" name='status' value='3' hidden id='3'>

        <label class='labelMenuStatus' for="4">Bloqueado</label>
        <input type="radio" name='status' value='4' hidden id='4'>

        <label class='labelMenuStatus' for="5">Aprovado</label>
        <input type="radio" name='status' value='5' hidden id='5'>
    </form>
  </li>
  <li class="menuLi second" data-action="second"><a href="" class="ListLink"><img src="{{ asset('img/icons/Attr.png') }}"> Editar Atribuição<i class="material-icons">arrow_right</i></a>
    <form id="form_attr" class='submenu'>
        @csrf
        @method('PUT')
        @foreach($users as $user)
        <?php if($user->name == Auth::user()->name)
          { 
            $user->name = $user->name." (EU)";
          } ?>
          <label class='labelAttr' for="{{$user->id}}">{{$user->name}}</label>
          <input type="radio" name='attr' value='{{$user->name}}' hidden id='{{$user->id}}'>
        @endforeach
    </form>  
</li>
  <li class='menuLi third' data-action="third"><a href="" class="ListLink"><img src="{{ asset('img/icons/priority.png') }}"> Editar Prioridade <i class="material-icons">arrow_right</i></a>
    <form id='form_priority' class='submenu'>
        @csrf
        @method('PUT')
        <label class='labelPriority' for="1">Baixa</label>
        <input type="radio" name='priority' value='1' hidden id='1'>

        <label class='labelPriority' for="2">Normal</label>
        <input type="radio" name='priority' value='2' hidden id='2'>

        <label class='labelPriority' for="3">Alta</label>
        <input type="radio" name='priority' value='3' hidden id='3'>

        <label class='labelPriority' for="4">Urgente</label>
        <input type="radio" name='priority' value='4' hidden id='4'>

    </form>  
</li>
  <li class="menuLi four" data-action="four"><a href="" class="ListLink"><img src="{{ asset('img/icons/move.png') }}"> Mover Tarefa <i class="material-icons">arrow_right</i></a>

    <form id='form_versios' class='submenu'>
        @csrf
        @method('PUT')
        <label class='labelVersions' for="{{$backlog[0]->id}}">{{$backlog[0]->name}}</label>
        <input type="radio" name='versios' value='{{$backlog[0]->id}}' hidden id='{{$backlog[0]->id}}'>        

        
        @foreach($lastVersios as $version)
          <label class='labelVersions' for="{{$version->id}}">{{$version->name}}</label>
          <input type="radio" name='versios' value='{{$version->id}}' hidden id='{{$version->id}}'>        
        @endforeach
    </form>  

</li>
  <!-- <li class='menuLi five' data-action="five"><a href="" class="ListLink"><img src="{{ asset('img/icons/Remove.png') }}"> Remover Tarefa </a></li> -->
</ul>

          <!-- DataTales Example -->

          <div class="card shadow mb-4">

            <div class="card-header py-3">

              <h6 class="m-0 font-weight-bold text-primary">Quadro do backlog</h6>

            </div>

            <div class="card-body">

              <div class="table-responsive">

                <table class="table table-bordered classTable issuesTable" id="dataTable" width="100%" cellspacing="0">

                <thead>

    <tr>

      <th scope="col">Sprint</th>
      <th scope="col">ID</th>

      <th scope="col">Projeto</th>

      <th scope="col">Título</th>

      <th scope="col">Tipo</th>

      <th scope="col">Área</th>

      <th scope="col">Status</th>

      <th scope="col">Prioridade</th>
      <th scope="col">Ações</th>


    </tr>

  </thead>

  <tbody>

    @foreach($issues as $issue)

        <tr>

          <th scope="row">#{{$issue->version}}</th>
          <th scope="row">#<a href="{{ route('issues.show', ['issue' => $issue->id]) }}" class='idIssue'>{{$issue->id}}</a></th>
          <td>{{$issue->project}}</td>

          <td><a href="{{ route('issues.show', ['issue' => $issue->id]) }}">{{$issue->subject}}</a></td>

          <td>{{$issue->name}}</td>

          <td>{{$issue->function}}</td>

          <td>{{$issue->status}}</td>

          <td>{{$issue->priority}}</td>
          
          <td>
          @if(Auth::user()->type == 1)
                    
                    <form action="{{ route('issues.destroy', ['issue' => $issue->id]) }}" method="post" class='formDelete'>
                      @csrf
                      
                      @method('DELETE')
                      
                      <input type="hidden" name='url' id='url' value="{{$_SERVER['REQUEST_URI']}}">
                      <button type="submit" class='deleteIndex'>
                        <i class='fas fa-trash'>
                        </button></i>
                      </form>
                      
                      
                      @endif
                      
          </td>

        </tr>

    @endforeach

 

  </tbody>

                </table>

              </div>

            </div>

          </div>



        </div>

        <!-- /.container-fluid -->



      </div>

      <!-- End of Main Content -->

@endsection

