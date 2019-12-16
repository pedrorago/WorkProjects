@extends('layouts.app')



@section('content')




 <!-- Page Heading -->

 <h1 class="h3 mb-2 text-gray-800">Sprints</h1>

          <p class="mb-4">Aqui se encontra o quadro de todas as sprints criadas pela sua empresa</a>.</p>
          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
    
          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach


        @if(Auth::user()->type == 1 )
        <div class="buttons" style="margin-bottom: 1.4em">
            <a href="{{ route('sprints.create') }}" class="btn btn-secondary btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-arrow-right"></i>
                </span>
                <span class="text">Adicionar uma nova sprint</span>
              </a>
        </div>
        @endif

          <!-- DataTales Example -->

          <div class="card shadow mb-4">

            <div class="card-header py-3">

              <h6 class="m-0 font-weight-bold text-primary">Quadro de sprints</h6>

            </div>

            <div class="card-body">

              <div class="table-responsive">

                <table class="table table-bordered classTable" id="sprints" width="100%" cellspacing="0">

                <thead>

    <tr>

      <th scope="col">ID</th>

      <th scope="col">Sprint</th>

      <th scope="col">Situação</th>

      <th scope="col">Data de início</th>

      <th scope="col">Data de conclusão</th>
      @if(Auth::user()->type == 1 )
        <th scope="col">Ação</th>
      @endif
    </tr>

  </thead>

  <tbody>

    @foreach($sprints as $sprint)
        <?php 
        
        if($sprint->status == 'open')
        {
            $sprint->status = 'Aberta';
            $classeClose = '';
        }
        else
        {
            $sprint->status = 'Fechada';
            $classeClose = 'table-secondary';

        }
        if($sprint->active == 1)
        {
            $claseActive = 'table-primary';
        }
        else
        {
            $claseActive = '';
        }

        ?>

            <tr class="{{ $classeClose }} {{ $claseActive }} ">
                @if(Auth::user()->type == 1 )
                <th scope="row"><a href="{{ route('sprints.edit', ['sprint' => $sprint->id]) }}">#{{ $sprint->id }}</a></th>
                @else
                <th scope="row">#{{ $sprint->id }}</th>
                @endif
                @if(Auth::user()->type == 1 )
                <td><a href="{{ route('sprints.edit', ['sprint' => $sprint->id]) }}">{{ $sprint->name }}</a></td>
                @else
                <td>{{ $sprint->name }}</td>
                @endif
                <td>{{ $sprint->status }}</td>
                <td>{{ $sprint->start_date }}</td>
                <td>{{ $sprint->finish_date }}</td>
                @if(Auth::user()->type == 1 )
                <td>   <form action="{{ route('sprints.destroy', ['sprint' => $sprint->id]) }}" method="post">
                        @csrf

                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary btn-icon-split">
                                <span class="icon text-white-50">
                                  <i class="fas fa-trash"></i>
                                </span>
                                <span class="text" style="color: #fff">Remover</span>
                        </button></i>
                </form>
                </td>
                @endif
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

