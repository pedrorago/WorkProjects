@extends('layouts.app')



@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">WorkProjects {{__('tasks')}}</h1>

<p class="mb-4">{{__('here is an overview of all activities. it is possible to make changes, searches and queries in this part of the application')}}.</a>.</p>

@foreach (['danger', 'warning', 'success', 'info'] as $msg)
@if(Session::has('alert-' . $msg))

<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif
@endforeach

<?php 
?>
<!-- DataTales Example -->

<?php
    $url_atual= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


    $serve = "http://$_SERVER[HTTP_HOST]";
?>

<input type='hidden' id='url' value='{{$url_atual}}'>
<input type='hidden' id='serve' value='{{$serve}}'>
<ul class='custom-menu shadow'>
  <input type='hidden' class='user' name='id_user' value='{{Auth::user()->id}}'>
  <li class="menuLi six" ><a href="#" target="_blank" class='ListLink visuMenu'><img src="{{ asset('img/icons/open.png') }}"> {{__('view task')}}</a></li>
  <li class="menuLi first" data-action="first"><a href="" class='ListLink'> <img src="{{ asset('img/icons/Status.png') }}"> {{__('edit status')}} <i class="material-icons">arrow_right</i></a>
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
  <li class="menuLi second" data-action="second"><a href="" class="ListLink"><img src="{{ asset('img/icons/Attr.png') }}"> {{__('edit assignment')}}<i class="material-icons">arrow_right</i></a>
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
  <li class='menuLi third' data-action="third"><a href="" class="ListLink"><img src="{{ asset('img/icons/priority.png') }}"> {{__('edit priority')}} <i class="material-icons">arrow_right</i></a>
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
  <li class="menuLi four" data-action="four"><a href="" class="ListLink"><img src="{{ asset('img/icons/move.png') }}"> {{__('move task')}} <i class="material-icons">arrow_right</i></a>

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


<div class="card shadow mb-4">
  
  <div class="card-header py-3">
    
    <h6 class="m-0 font-weight-bold text-primary">{{__('general board')}}</h6>
    
  </div>
  
  <div class="card-body">
    
    <div class="table-responsive">
      
      <table class="table table-bordered classTable issuesTable" id="dataTable" width="100%" cellspacing="0">
        
        <thead>
          
          <tr>
            
            <th scope="col">ID</th>
            
            <th scope="col">{{__('project')}}</th>
            
            <th scope="col">{{__('title')}}</th>
            
            <th scope="col">{{__('section')}}</th>
            
            <th scope="col">{{__('role')}}</th>
            <th scope="col">{{__('priority')}}</th>
            <th scope="col">Status</th>
            
            
            <th scope="col">Sprint</th>
            <th scope="col" style="width: 73px !important">{{__('deadline')}}</th>
            <!-- <th scope="col" style='min-width: 5em;'>Extras</th> -->
            <th scope="col" style='width: 30px !important' >Extras</th>
            
            
          </tr>
          
        </thead>
        
        <tbody>
          
          @foreach($issues as $issue)
          @if($issue->status == 'Fazendo')
          <tr class='table-primary trStatus'>
            @else
            <tr>
              @endif
              
              
              
              <th scope="row">#<a href="{{ route('issues.show', [ app()->getLocale(), 'issue' => $issue->id]) }}" class='idIssue'>{{$issue->id}}</a></th>
              
              <td>{{$issue->project}}</td>
              
              <td class="NameTD">
                <a href="{{ route('issues.show', [ app()->getLocale(), 'issue' => $issue->id]) }}">{{$issue->subject}}</a>
                
                @if($issue->status == 'Fazendo')
                <div class="statusBox">
                  <span>
                    <img src="{{ $issue->author_pic }}" alt="">
                  </span>
                  
                  <p>
                    <strong>{{$issue->author_name}}</strong>
                    Está fazendo essa tarefa nesse momento.
                  </p>
                  
                </div>
                @endif
                
              </td>
              
              <td>{{$issue->name}}</td>
              
              <td>{{$issue->function}}</td>
              
              
              
              <td>{{$issue->priority}}</td>
              <?php if(empty($issue->due_date)){
                $issue->due_date = '0000-00-00';
              }else
              {
                $issue->due_date = $issue->due_date;
              } ?>
              <td>{{$issue->status}}</td>
              
              <td>#{{$issue->version}}</td>
              
              <td>{{$issue->due_date}}</td>
              
              <td class='td_extra'>
                <div class='extras' style='justify-content: center'>
                  <?php if($issue->attr_id != 69){ ?>
                    
                    <div class='boxUsericon'>
                      <div class='boxAttrImg'>
                        <img src="{{$issue->attr_img}}" alt="">
                      </div>
                      <span class='boxAttr'>Atividade atribuida para <strong>{{$issue->attr}}</strong></span>
                    </div>
                    <?php } else
                    {
                      ?>
                      
                      <div class='boxUsericon'>
                        <div class='boxAttrImg'>
                        </div>
                        <span class='boxAttr'>Nenhuma atribuição para essa tarefa</span>
                      </div>
                      <?php
                    }
                    ?>
                    
                    <div class='Comments'>
                      @if($issue->comments_count != 0)
                      <i class="fas fa-comment-alt"></i>
                      <span class="badge badge-danger badge-counter">{{$issue->comments_count}}</span>
                      @else
                      <i class="fas fa-comment-alt" style='opacity: 0.3'></i>
                      
                      @endif
                      
                      
                    </div>
                    @if(Auth::user()->type == 1)
                    
                    <form action="{{ route('issues.destroy', [ app()->getLocale(), 'issue' => $issue->id]) }}" method="post" class='formDelete'>
                      @csrf
                      
                      @method('DELETE')
                      
                      <div class='ConfirmDelete'>
                          <p>Confirmar exclusão</p>
                          <span>
                            <button type='button' class='nDelete'>Cancelar</button>
                            <button type='submit' class='yDelete'>Confirmar</button>
                          </span>
                      </div>

                      <input type="hidden" name='url' id='url' value="{{$_SERVER['REQUEST_URI']}}">
                      <button type="button" class='deleteIndex'>
                        <i class='fas fa-trash'>
                        </button></i>
                      </form>
                      
                      
                      @endif
                      
                    </div>
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
  
  