@extends('layouts.app') 
@section('titulo') Clientes 
@endsection

@section('content')

@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">

        {{ Session::get('error') }}
        
        
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">

        {{ Session::get('success') }}
        
        
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (Session::has('editado'))
    <div class="alert alert-warning alert-dismissible" role="alert">

        {{ Session::get('editado') }}
        
        
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (Session::has('eliminado'))
    <div class="alert alert-danger alert-dismissible" role="alert">

        {{ Session::get('eliminado') }}
        
        
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


<div class="d-flex justify-content-center">
    <a href="Cliente/crear" class="btn btn-primary">Crear cliente</a>
</div>

<div class="p-4">
    <table class="table table-bordered table-striped mt-4" id="clientes">
        <thead class="text-center">
            <tr>
                <th>Documento</th>
                <th>Nombre del cliente</th>
                <th>Estado</th>
                <th>Acciones</th>
                
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>
@endsection
@section('scripts')
    <script>
         $('#clientes').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/Cliente/listar',
        columns: [
            {data: 'documento', name: 'documento'},
            {data: 'nombre', name: 'nombre'},
            {data: 'estado', name: 'estado'},
            {data: 'acciones', name: 'acciones', orderable: false, searchable: false},
        ]
    });
    </script>
@endsection
