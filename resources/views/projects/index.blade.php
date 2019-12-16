@extends('layouts.app')



@section('content')

 <!-- Page Heading -->

<?php function tirarAcentos($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}
?>


<div class="d-sm-flex justify-content-between mb-4">

    <div class="d-sm-flex flex-column">
    <h1 class="h3 mb-0 text-gray-800">Projetos</h1>
    <p class="mb-4" style="margin-top: .4em">Aqui se encontra todos os projetos e sub projetos.</p>
    @if(Auth::user()->type == 1 )
        <div class="buttons" style="margin-bottom: 1.4em">
            <a href="{{ route('projects.create') }}" class="btn btn-secondary btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-arrow-right"></i>
                </span>
                <span class="text">Adicionar um novo projeto</span>
              </a>
        </div>
        @endif
    </div>
    

    <form action="">
        <div class="form-group row d-sm-flex align-items-center">
                <label for="searchProject">Pesquisar</label>
                  <input class="form-control" placeholder='Pesquise pelo nome do projeto' name="search" type="text" id="searchProject">
            </div>
    </form>
</div>

<div class="ContentCustom">

    <?php 
    $letter = 'a';?>

    @foreach($projects as $project)

    <?php if($letter != $project->ordering)
    {
        ?>
            <h2 class="h3 mb-3 text-gray-800 titleOrigim {{ strtoupper($project->ordering) }}" style="width: 100%;">Ordem: {{ strtoupper($project->ordering) }}</h2>
        <?php
        $letter = $project->ordering;
    }
    ?>

    <a href="{{ route('projects.show', ['project' => $project->id ]) }}" class="BoxProjects">
            <div>
                <span>
                    <strong>{{ substr(tirarAcentos($project->name), 0, 3) }}</strong> 
                </span>
                <p>{{$project->name}}</p>
            </div>
        </a>
    @endforeach

</div>

@endsection

