@extends('layouts.app')

@section('titulo')
    Productos
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
    <a href="{{ url('productos/crear') }}" class="btn btn-primary">Crear producto</a>

</div>


 
<div class="p-4">
    <table class="table table-bordered table-striped" id="productos">
        <thead class="text-center">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
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
         $('#productos').DataTable({
        language: spanish,
        processing: true,
        serverSide: true,
        ajax: '/productos/listar',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nombre', name: 'nombre'},
            {data: 'precio', name: 'precio'},
            {data: 'cantidad', name: 'cantidad'},
            {data: 'estado', name: 'estado'},
            {data: 'acciones', name: 'acciones', orderable: false, searchable: false},
        ]
    });
    </script>
@endsection
