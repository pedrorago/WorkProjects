@extends('layouts.app')



@section('content')





<div class="d-sm-flex justify-content-between flex-column mb-4">

    <h1 class="h3 mb-0 text-gray-800">Criar uma nova tarefa</h1>

    <p class="mb-4" style="margin-top: .4em">Preencha o formulário abaixo</a>.</p>

    

</div>





<div>

    <form action="{{ route('issues.store') }}" class="form-horizontal" method="POST">

        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->

        

        @csrf

        <input type="hidden" name="author_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="created_name" value="{{ Auth::user()->name}}">

        <div class="row">

            <div class="form-group col-md-4">

                <label for="subject">Título da tarefa:</label>

                <input type="text" id="subject" name="subject" placeholder="Preencha o título da tarefa" class="form-control">

            </div>

            

            <div class="form-group col-md-4">

                <label for="project_id">Projeto relacionado:</label>

                <select name="project_id" id="project_id" class="form-control">

                    <option value="">Selecione um projeto</option>

                    @foreach($projects as $project)

                    <option value="{{ $project->id }}">{{ $project->name }}</option>

                    @endforeach

                </select>

            </div>

            <div class="form-group col-md-4">

                <label for="status_id">Status da tarefa:</label>

                <select name="status_id" id="status_id" class="form-control">

                    <option value="">Selecione um status</option>

                    <option value="1">A Fazer</option>

                    <option value="2">Fazendo</option>

                    <option value="3">Feito</option>

                    <option value="4">Bloqueado</option>

                    <option value="5">Aprovado</option>

                </select>

            </div>
            <div class="form-group col-md-4">

<label for="priority_id">Prioridade da tarefa:</label>

<select name="priority_id" id="priority_id" class="form-control">

    <option value="">Selecione uma prioridade</option>

    <option value="1">Baixa</option>

    <option value="2">Normal</option>

    <option value="3">Alta</option>

    <option value="4">Urgente</option>

</select>

</div>


        


            <div class="form-group col-md-4">

                    <label for="fixed_version_id">Versão da tarefa:</label>

                    <select name="fixed_version_id" id="fixed_version_id" class="form-control">

                        <option value="">Selecione uma versão</option>

                        @foreach($versions as $versions)

                    <option value="{{ $versions->id }}">{{ $versions->name }}</option>

                    @endforeach

                    </select>

                </div>



                <div class="form-group col-md-4">

                        <label for="tracker_id">Tipo da tarefa:</label>

                        <select name="tracker_id" id="tracker_id" class="form-control">

                            <option value="">Selecione um tipo</option>

                            @foreach($trackers as $tracker)

                            <option value="{{ $tracker->id }}">{{ $tracker->name }}</option>

                            @endforeach

                            </select>

                    </div>
                    <div class="form-group col-md-4">



<label for="funcion_id">Área da tarefa:</label>


<select  name="funcion_id" id="funcion_id" class="form-control">

    <option value="">Selecione uma área</option>

    @foreach($Functions as $Function)

    <option value="{{ $Function->id }}">{{ $Function->name }}</option>

    @endforeach

    </select>

</div>
<div class="form-group col-md-4">
                        <label for="start_date">Prazo da tarefa</label>
                          <input class="form-control" name="due_date" type="date" id="due_date">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="start_date">Atribuir tarefa para:</label>
                        <select name="assigned_to_id" id="assigned_to_id"  class="form-control">
                        <option value="69">Nenhuma atribuição</option>
                        @foreach($users as $user)

                            @if($user->id == Auth::user()->id)
                                <option value="{{$user->id}}">{{$user->name}} (EU)</option>
                            @else
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
        </div>
   

        </div>
        <div class="row">

            <div class="form-group col-md-12">

                <label for="description">Descrição da tarefa</label>

                <textarea name="description" id="summernote" class="form-control"></textarea>

            </div>

        </div>

        <div class="row col-md-12">

            <div class="form-group">

                <button type="submit" class="btn btn-primary">Cadastrar</button>

            </div>

        </div>

    </form>

</div>





@endsection

