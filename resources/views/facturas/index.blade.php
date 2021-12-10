@extends('layouts.app') @section('titulo') facturas @endsection
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
    <a href="facturas/crear" class="btn btn-primary">Crear factura</a>
</div>

<div class="p-4">
    <table class="table table-bordered" id="facturas">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre del cliente</th>
                <th>Total</th>
                <th>Detalles</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>
@endsection
@section('scripts')
    <script>
         $('#facturas').DataTable({
        language: spanish,
        processing: true,
        serverSide: true,
        ajax: '/facturas/listar',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nombre', name: 'nombre'},
            {data: 'total', name: 'total'},
            {data: 'detalles', name: 'detalles', orderable: false, searchable: false},
            
        ]
    });
    </script>
@endsection

