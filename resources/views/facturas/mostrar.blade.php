@extends('layouts.app') @section('titulo') facturas @endsection
@section('content')
<div class="col-md-6 offset-3 mt-4">
    <div class="card">
        <div class="card-body">
            <div class="card-title text-center">
                <h2>Detalles de la factura {{$facturaDetalle->id}}</h2>
            </div>
            <h2 class="text-center">
                <b>documento del cliente: </b
                >{{$facturaDetalle->documentoCliente}}
            </h2>
            <h2 class="text-center"><b>Total de la factura: </b>{{$facturaDetalle->total}}</h2>
        </div>
    </div>
</div>

<table class="table table-bordered table-striped col-md-6 offset-3 mt-4">
    <thead>
        <tr>
            
            <th>Producto</th>
            <th>Cantidad</th>
            <th>precio por unidad</th>
            <th>subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detalles as $detalle)
        <tr>
            <td>{{ $detalle->nombre }}</td>
            <td>{{ $detalle->cantidad }}</td>
            <td>{{ $detalle->precioUnidad }}</td>
            <td>{{ $detalle->subtotal}}</td>
        </tr>
        @endforeach
        <td colspan="4" class="text-center" style="font-weight: bold">{{ $facturaDetalle->total }}</td>
    </tbody>
</table>
@endsection
