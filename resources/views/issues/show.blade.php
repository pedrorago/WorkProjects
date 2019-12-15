@extends('layouts.app')
@section('content')

<div class="d-sm-flex justify-content-between flex-column mb-4">
  
  <h1 class="h3 mb-0 text-gray-800">Visualizando uma tarefa</h1>
  
  <p class="mb-4" style="margin-top: .4em">Aqui se encontra todos os detalhes da tarefa {{ $issue[0]->subject }}</a>.</p>
  
  
  
</div>

@foreach (['danger', 'warning', 'success', 'info'] as $msg)
@if(Session::has('alert-' . $msg))

<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif
@endforeach


<div>
  
  <div class="card mb-12">
    
    <div class="card-header py-3 d-sm-flex justify-content-between align-items-center">
      
      <h6 class="m-0 font-weight-bold text-primary titleIssue">{{ $issue[0]->subject }} - {{ $issue[0]->project }} 
        <div class='boxUsericon showIssue'>
          <div class='boxAttrImg'>
            @if( $issue[0]->attr_id != 69)
            <img src="{{ $issue[0]->attr_img }}" alt="">
            @endif
          </div>
          
          <span class='boxAttr'>
            @if( $issue[0]->attr_id != 69)
            Atividade atribuida para <strong>{{ $issue[0]->attr }}</strong>
            @else
            Atividade sem atribuição
            @endif
            
          </span>
        </div>
      </h6>
      
      <div class='actions'>
        <a href="{{ route('issues.edit', ['issue' => $issue[0]->id]) }}" class="editA" style='color: #858796; font-size: 14px; display: flex; align-items: center;'>
          
          Editar tarefa <i class="fas fa-edit" style='font-size: 22px; margin-left: .5em;'></i>
          
        </a>
        
        @if(Auth::user()->type == 1)
        
        <form action="{{ route('issues.destroy', ['issue' => $issue[0]->id]) }}" method="post" style='position: relative'>
          @csrf
          
          @method('DELETE')

            
          <div class='ConfirmDelete'>
                          <p>Confirmar exclusão</p>
                          <span>
                            <button type='button' class='nDelete'>Cancelar</button>
                            <button type='submit' class='yDelete'>Confirmar</button>
                          </span>
                      </div>



          <input type="hidden" name='url' id='url' value="internal">
          <button type="button" class="btn btn-secondary btn-icon-split buttonEditDelete">
            <span class="icon text-white-50">
              <i class="fas fa-trash"></i>
            </span>
            <span class="text" style="color: #fff">Remover</span>
          </button></i>
        </form>
        
        @endif
        
      </div>
    </div>
    
    <div class="card-body">
      
      Tipo: <strong>{{ $issue[0]->name }}</strong> | 
      Area: <strong>{{ $issue[0]->function }}</strong> | 
      
      Projeto: <strong>{{ $issue[0]->project }}</strong> | 
      
      Status: <strong>{{ $issue[0]->status }}</strong> | 
      
      Situação: <strong>{{ $issue[0]->priority }}</strong> | 
      
      Versão: <strong>Sprint {{ $issue[0]->version }}</strong> |
      Prazo: <strong> {{ $issue[0]->due_date }}</strong> 
      Autor: <strong> {{ $issue[0]->created_name }}</strong> 
      
      
      <br/>
      
      <br/>
      
      
      @if($issue[0]->status_id == 2)
      <div class="doingBox" style='border-bottom: 0px'>
        <span class="doingImg"> 
          <img src="{{$issue[0]->author_pic}}" alt="">
        </span>
        <p><strong>{{$issue[0]->author_name}}</strong><br/>
          Está fazendo essa tarefa.
          
        </p>
      </div>
      @endif
      <div class='descriptionBody'>
        {{ $issue[0]->description }}
      </div>
      
    </div>
    
  </div>
  
</div>

<div class='row contentShow'  style='margin-top:3em; display: flex; justify-content: space-between'>
  
  <div class="card mb-12">
    
    <div class="card-header py-3 d-sm-flex justify-content-between align-items-center">
      
      <h6 class="m-0 font-weight-bold text-primary">Área de comentários</h6>
      <a href="{{ route('issues.show', ['issue' => $issue[0]->id, 'comment' => 'true']) }}" class="editA" style='color: #858796; font-size: 14px; display: flex; align-items: center;'>
        Adicionar um comentário <i class="fas fa-comment-medical" style='font-size: 22px; margin-left: .5em;'></i>
      </a>
    </div>
    
    <div class="card-body boxComments" style='max-height: 32em; overflow: auto;'>
      @if(Session::has('create-comment'))
      <form action="{{ route('comments.store', ['issue' => $issue[0]->id ]) }}" method="POST">
        @csrf
        @method('POST')
        <textarea name="comments_text" id="summernote" class="form-control"></textarea>
        <input type="hidden" name='author_id' value='{{ Auth::user()->id }}'>
        <input type="hidden" name='issue_id' value='{{ $issue[0]->id }}'>
        
        <div>
          <button type='submit' class="btn btn-primary btn-icon-split" style='    margin-top: 1em;
          margin-bottom: 3em;'>
          <span class="icon text-white-50">
            <i class="fas fa-check"></i>
          </span>
          <span class="text">Adicionar comentário</span>
        </button>
        
        <a href="{{ route('issues.show', ['issue' => $issue[0]->id]) }}" class="btn btn-secondary btn-icon-split" style='    margin-top: 1em;
          margin-bottom: 3em;'>
          <span class="icon text-white-50">
            <i class="fas fa-trash"></i>
          </span>
          <span class="text">Cancelar</span>
        </a>
      </div>
      
      
    </form>
    @endif
    
    
    @if($comments == 'Sem comentários existentes')
    
    <p>Nenhum comentário existente.</p>
    
    @else
    
    
    @foreach($comments as $comment)
    <div class="doingBox" style='border-bottom: 0px; margin-bottom: 0px'>
      <span class="doingImg"> 
        <img src="{{$comment->avatar}}" alt="">
      </span>
      <p><strong>{{$comment->user_name}} <i style='font-weight: 300; font-size: 13px; margin-left: 1px;'>{{$comment->create}}</i></strong><br/>
        Comentou:
      </p>
      <div class='commentBody'>
        {{$comment->comments_text}} 
      </div>
      <br/>
      @if(Auth::user()->id == $comment->author_id)
      <form action="{{ route('comments.destroy', ['issue' => $issue[0]->id, 'comment' => $comment->id]) }}" method='post'>
        @csrf
        @method('DELETE')
        <input type="hidden" value='{{$issue[0]->id}}' name='issue_id'>
        <button style='padding-bottom: 2em;margin-bottom: 2em;width: 100%;display: flex;align-items: center;background: transparent;border: 0;color: #737373;border-bottom: 1px solid #eeee;'><i class="fas fa-trash" style='font-size: 22px; margin-right: .5em;'></i>Remover comentário</button>
      </form>
      @endif
    </div>
    @endforeach
    @endif
  </div>
  
  
  
  
</div>






<div class="card mb-12">
  
  <div class="card-header py-3 d-sm-flex justify-content-between align-items-center">
    
    <h6 class="m-0 font-weight-bold text-primary titleIssue">Checklist</h6>
    
  </div>
  
  <div class="card-body">
    <form class='updateForm'>
      @csrf
      @method('PUT')
      <ul class="list-items">
        
        @foreach($checklist as $value)
        <li class="item">
          <input type="hidden" name='id' id='id_checklist' value='{{$value->id}}'>
          @if($value->status == 'open')
          <input type="checkbox" class="checkbox">
          @else
          <input type="checkbox" class="checkbox" checked>
          @endif
          <label for="">{{$value->name}}</label>
          <span><i class="fas fa-check"></i></span>
        </li>
        @endforeach
        
      </ul>
    </form>
    <div class='RodapeList'>
      <form class='CreateNew' method='GET'>
        @csrf
        @method('GET')
        <input type='hidden' name='issue_id' id='issue_id' value='{{$issue[0]->id}}'>
        <div class='ContentList ContentListActive'>
          <textarea name="name" id='name' placeholder='Digite aqui' id=""></textarea>
          <button type="submit" class="btn btn-primary">Adicionar</button>
        </div>
      </form>
      
      <form id='deleteArea'>
        @csrf
        @method('DELETE')
        <i class="fas fa-trash-alt"></i>
      </form>
      
    </div>
    
  </div>
  
  
</div>
</div>
@endsection

