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
<div class="row p-4">
    <form action="agregar" class="col-md-12" method="post">
        @csrf
        <div class="row">
            <div class="col-md-4 mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <h2>Crear factura</h2>
                        </div>

                        <input
                            type="text"
                            class="form-control"
                            placeholder="documento del cliente"
                            name="documentoCliente"
                            value="{{ old('documentoCliente') }}"
                        />
                        <input
                            type="text"
                            class="form-control"
                            placeholder="total factura"
                            name="total"
                            id="total"
                            value="{{ old('documentoCliente') }}"
                            readonly
                        />
                    </div>
                </div>
            </div>
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <h2>detalles</h2>
                        </div>
                        <select name="idProducto" id="producto" class="form-control" onchange="colocarPrecio()">
                            <option value="">seleccione</option>
                            @foreach ($productos as $producto)
                            <option precio={{$producto->precio}} value="{{$producto->id}}">
                                {{$producto->nombre}}
                            </option>
                            @endforeach
                        </select>
                        <input 
                            type="text" 
                            class="form-control mt-2"
                            placeholder="cantidad"
                            name="cantidad" 
                            id="cantidad"
                        >
                        <input
                            type="text"
                            class="form-control mt-2"
                            placeholder="precio"
                            name="precio"
                            id="precio"
                            value="{{ old('precio') }}"
                            readonly
                        />
                        <button type="button" onclick="agregarProducto()" class="btn btn-primary mt-2">
                            agregar
                        </button>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id del producto</th>
                                <th>producto</th>
                                <th>cantidad</th>
                                <th>precio</th>
                                <th>subtotal</th>
                                <th>opciones</th>
                            </tr>
                        </thead>
                        <tbody id="detalles">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-4">Guardar factura</button>
    </form>
</div>



@endsection

@section('scripts')
    <script>
        function colocarPrecio() {
            let precio = $("#producto option:selected").attr("precio");
            
            $("#precio").val(precio);
            
        }

        function agregarProducto() {
            let productoId = $("#producto option:selected").val();
            let productoNombre = $("#producto option:selected").text();
            let cantidad = $("#cantidad").val();
            let precio = $("#precio").val();
            let subtotal = parseInt(cantidad) * parseInt(precio);

            if(cantidad > 0 && precio > 0){
                $("#detalles").append(`
                    <tr id="tr${productoId}">
                        <td>${productoId}</td>
                        <td>
                            <input type="hidden" name="idProducto[]" value="${productoId}">
                            <input type="hidden" name="cantidades[]" value="${cantidad}">
                            <input type="hidden" name="precios[]" value="${precio}">
                            ${productoNombre}
                        </td>
                        <td>${cantidad}</td>
                        <td>${precio}</td>
                        <td>${subtotal}</td>
                        <td><button type="button" class="btn btn-danger" onclick="eliminarProducto(${productoId},${subtotal})">Eliminar producto</button></td>
                    </tr>
                `)
                let precioTotal = $("#total").val() || 0;
                $("#total").val(parseInt(precioTotal) + parseInt(subtotal));
                
            }else{
                alert("ingrese una cantidad o precio válido");
            }
        }

        function eliminarProducto(id, dinero) {
            $("#tr"+id).remove();
            let precioTotal = $("#total").val() || 0;
                $("#total").val(parseInt(precioTotal) - parseInt(dinero));
        }
    </script>
@endsection