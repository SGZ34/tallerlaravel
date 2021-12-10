@extends('layouts.app')

@section('content')
<div class="container">

  <div class="col-md-6 offset-3 mt-4">
  <div class="card">
      
      <div class="card-body">
          <div class="card-title text-center">
              <h2>Editar Cliente</h2>
          </div>
          <form action="{{ url('/Cliente/actualizar/'.$cliente->documento) }}" method="post">
              @csrf
              <input type="hidden" class="form-control" placeholder="documento del cliente" name="documento" value="{{$cliente->documento}}">
              <input type="text" class="form-control" placeholder="precio del producto" name="nombre" value="{{$cliente->nombre}}">
              <input type="hidden" name="Estado" value="{{$cliente->estado}}">
              <button type="submit" class="btn btn-primary mt-2">Editar cliente</button>
            </form>
      </div>
  </div>
 
  </div>
</div>
@endsection