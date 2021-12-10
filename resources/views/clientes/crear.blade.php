@extends('layouts.app') @section('content')

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
                <h2>Crear cliente</h2>
            </div>
            <form action="agregar" method="post">
                @csrf
                <input
                    type="text"
                    class="form-control"
                    placeholder="documento"
                    name="documento"
                    value="{{ old('documento') }}"
                />
                <input
                    type="text"
                    class="form-control"
                    placeholder="Nombre del cliente"
                    name="nombre"
                    value="{{ old('nombre') }}"
                />
                
                <input type="hidden" name="Estado" value="1" />
                <button type="submit" class="btn btn-primary mt-2">
                    Crear Cliente
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
