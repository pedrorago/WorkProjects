@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Criar uma tarefa</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>
        <form action="{{ route('modelo.store') }}" class="form-horizontal" method="POST">
            <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
            
            @csrf

            <div class="row">
                <div class="form-group">
                    <label for="modelo">Modelo do carro</label>
                    <input type="text" id="modelo" name="modelo" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                   <label for="status">Status</label>
                   <select name="status" id="status" class="form-control">
                       <option value="Ativo">Ativo</option>
                       <option value="Inativo">Inativo</option>
                   </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </form>
</div>

@endsection
