@extends('layouts.app')



@section('content')





<?php



$situacoes = [

    'A Fazer',

    'Fazendo',

    'Feito',

    'Bloqueado',

    'Aprovado'

];



$prioridades = [

    'Baixa',

    'Normal',

    'Alta',

    'Urgente'

];





?>



<div class="d-sm-flex justify-content-between flex-column mb-4">

    <h1 class="h3 mb-0 text-gray-800">Editar uma tarefa</h1>

    <p class="mb-4" style="margin-top: .4em">Preencha o formulário abaixo</a>.</p>

    

</div>



<div>

    <form action="{{ route('issues.update', ['issue' => $issue[0]->id ]) }}" class="form-horizontal" method="POST">

        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->

        

        @csrf

        @method('PUT')




        <input type="hidden" name="author_id" value="{{ Auth::user()->id }}">

        <input type="hidden" name='issue_name' value='{{ $issue[0]->subject }}'>
        <input type="hidden" name='issue_status' value=''>
        <input type="hidden" name='issue_id' value='{{ $issue[0]->id }}'>
        <input type="hidden" name='author_name_histories' value='{{  Auth::user()->name }}'>
        <input type="hidden" name='author_id' value='{{ Auth::user()->id }}'>
        <input type="hidden" name='author_pic_histories' value='{{  Auth::user()->avatar }}'>


        <div class="row">

            <div class="form-group col-md-4">

                <label for="subject">Título da tarefa:</label>

                <input type="text" id="subject" name="subject" value="{{ $issue[0]->subject }}" placeholder="Preencha o título da tarefa" class="form-control">

            </div>


            

            <div class="form-group col-md-4">

                <label for="project_id">Projeto relacionado:</label>



                <select name="project_id" id="project_id" class="form-control">

                <option value="">Selecione um projeto</option>



                    <?php

                        foreach($projects as $project)

                        {

                        if($project->name == $issue[0]->project) {

                            ?>

                                    <option value="{{ $project->id }}" selected>{{ $project->name }}</option>

                            <?php

                        }

                        else{

                            ?>

                                    <option value="{{ $project->id }}" >{{ $project->name }}</option>



                            <?php

                        }

                    ?>

                    <?php } ?>

                </select>

            </div>

            <div class="form-group col-md-4">

                <label for="status_id">Status da tarefa:</label>

                <select name="status_id" id="status_id" class="form-control">

                    <option value="">Selecione um status</option>

                    <?php 

                    $counter = 1;

                    foreach($situacoes as $situacao)

                    {

                        if($situacao == $issue[0]->status ){

                        ?>

                        

                            <option value="{{ $counter }}" selected>{{ $situacao }}</option>

                        <?php

                        }else

                        {

                            ?>

                            <option value="{{ $counter }}">{{ $situacao }}</option>



                            <?php

                        }

                        $counter++;

                    }

                    ?>

                </select>

            </div>
            <div class="form-group col-md-4">

<label for="priority_id">Prioridade da tarefa:</label>

<select name="priority_id" id="priority_id" class="form-control">

    <option value="">Selecione uma prioridade</option>

    <?php 

    $counter = 1;

    foreach($prioridades as $prioridade)

    {

        if($prioridade == $issue[0]->priority ){

        ?>

        

            <option value="{{ $counter }}" selected>{{ $prioridade }}</option>

        <?php

        }else

        {

            ?>

            <option value="{{ $counter }}">{{ $prioridade }}</option>



            <?php

        }

        $counter++;

    }

    ?>

</select>

</div>

            <div class="form-group col-md-4">

                    <label for="fixed_version_id">Versão da tarefa:</label>

                    <select name="fixed_version_id" id="fixed_version_id" class="form-control">

                        <option value="">Selecione uma versão</option>



                        <?php

                        foreach($versions as $version)

                        {

                        if($version->name == $issue[0]->version) {

                            ?>

                                    <option value="{{ $version->id }}" selected>{{ $version->name }}</option>

                            <?php

                        }

                        else{

                            ?>

                                    <option value="{{ $version->id }}" >{{ $version->name }}</option>



                            <?php

                        }

                    ?>

                    <?php } ?>



                      

                    </select>

                </div>


                

                <div class="form-group col-md-4">

                        <label for="tracker_id">Setor da tarefa:</label>

                        <select name="tracker_id" id="tracker_id" class="form-control">

                            <option value="">Selecione uma versão</option>

                            <?php

                        foreach($trackers as $tracker)

                        {

                        if($tracker->name == $issue[0]->name) {

                            ?>

                                    <option value="{{ $tracker->id }}" selected>{{ $tracker->name }}</option>

                            <?php

                        }

                        else{

                            ?>

                                    <option value="{{ $tracker->id }}" >{{ $tracker->name }}</option>



                            <?php

                        }

                    ?>

                    <?php } ?>

                            </select>

                    </div>

                 <div class="form-group col-md-4">
                 <label for="funcion_id">Área da tarefa:</label>

<select name="funcion_id" id="funcion_id" class="form-control">

    <option value="">Selecione uma área</option>

    <?php

foreach($Functions as $Function)

{

if($Function->name == $issue[0]->function) {

    ?>

            <option value="{{ $Function->id }}" selected>{{ $Function->name }}</option>

    <?php

}

else{

    ?>

            <option value="{{ $Function->id }}" >{{ $Function->name }}</option>



    <?php

}

?>

<?php } ?>

    </select>

                 </div>
                 <div class="form-group col-md-4">
                        <label for="start_date">Prazo da tarefa</label>
                          <input class="form-control" name="due_date" value="{{ $issue[0]->due_date }}" type="date" id="due_date">
                    </div>
                    <div class="form-group col-md-4">

<label for="project_id">Atribuir tarefa para:</label>

<select name="assigned_to_id" id="assigned_to_id" class="form-control">

<option value="69">Nenhuma atribuição</option>



    <?php

        foreach($users as $user)

        {

        if($user->id == $issue[0]->assigned_to_id) {

            ?>

                    <option value="{{ $user->id }}" selected>{{ $user->name }}</option>

            <?php

        }

        else{

            ?>

                    <option value="{{ $user->id }}" >{{ $user->name }}</option>



            <?php

        }

    ?>

    <?php } ?>

</select>

</div>
</div>

<input type="hidden" name="author_name" value="">
<input type="hidden" name="author_pic" value="http://gestao.agenciacapiba.com.br/img/avatar.png">


        </div>

        <div class="row">

            <div class="form-group col-md-12">

                <label for="description">Descrição da tarefa</label>

                <textarea name="description" id="summernote" class="form-control">{{ $issue[0]->description }}</textarea>

            </div>

        </div>

        <div class="row col-md-12">

            <div class="form-group">

                <button type="submit" class="btn btn-primary">Salvar edição</button>

            </div>
    </form>
<!-- 
            <form action="" style='margin-left: 1em'>
            <button type="submit" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50">
              <i class="fas fa-copy"></i>
            </span>
            <span class="text" style="color: #fff">Duplicar tarefa</span>
          </button></i>

    </form> -->
        </div>




</div>





@endsection

