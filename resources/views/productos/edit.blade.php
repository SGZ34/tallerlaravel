@extends('layouts.app')

@section('content')
<div class="container">

  <div class="col-md-6 offset-3 mt-4">
  <div class="card">
      
      <div class="card-body">
          <div class="card-title text-center">
              <h2>Editar producto</h2>
          </div>
          <form action="{{ url('/productos/actualizar/'.$producto->id) }}" method="post">
              @csrf
                
              <input type="text" class="form-control" placeholder="nombre del producto" name="nombre" value="{{$producto->nombre}}">
              <input type="text" class="form-control" placeholder="precio del producto" name="precio" value="{{$producto->precio}}">
              <input type="text" class="form-control" placeholder="Cantidad del producto" name="cantidad" value="{{$producto->cantidad}}">
              <input type="hidden" name="Estado" value="{{$producto->estado}}">
              <button type="submit" class="btn btn-primary mt-2">Editar producto</button>
            </form>
      </div>
  </div>
 
  </div>
</div>
@endsection