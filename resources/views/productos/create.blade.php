@extends('layouts.app')

@section('content')
<div class="container">
@if(count($errors)>0)
  <div class="alert alert-danger" role="alert">
    <ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
  </div>
  
@endif
<div class="col-md-6 offset-3 mt-4">
  <div class="card">
    <div class="card-body">
        <div class="card-title text-center">
            <h2>Crear producto</h2>
        </div>
        <form action="{{ url('/productos/agregar') }}" method="post">
          @csrf
          <input type="text" class="form-control" placeholder="nombre del producto" name="nombre" value="{{old('nombre')}}">
          <input type="text" class="form-control" placeholder="precio del producto" name="precio" value="{{old('precio')}}">
          <input type="text" class="form-control" placeholder="Cantidad del producto" name="cantidad" value="{{old('cantidad')}}">
          <input type="hidden" name="Estado" value="1">
          <button type="submit" class="btn btn-primary mt-2">Crear producto</button>
        </form>
    </div>
  </div>
</div>
</div>
@endsection
  