<?php

namespace App\Http\Controllers;

use App\Models\productos;
use DataTables;
use Illuminate\Http\Request;

class ProductosController extends Controller
{

    public function index()
    {

        return view("productos.index");
    }

    public function listar(Request $request)
    {
        $productos = productos::all();

        return DataTables::of($productos)
            ->editColumn("estado", function ($producto) {
                return $producto->estado == 1 ? "activo" : "inactivo";
            })
            ->addColumn('acciones', function ($producto) {
                if ($producto->estado == 1) {
                    return '<div class="d-flex justify-content-center">
                        <a href="productos/editar/' . $producto->id . '" class="btn btn-warning"><i class="fas fa-edit"></i></a>'
                        . '<a href="productos/cambiar/estado/' . $producto->id . '/0" class="btn btn-danger text-white mx-4"><i class="fas fa-ban"></i></a>'
                        . '<a href="productos/eliminar/' . $producto->id . '" class="btn btn-danger"><i class="fas fa-trash"></i></a>'
                        . '</div>';
                } else {
                    return '<div class="d-flex justify-content-center">
                        <a href="productos/editar/' . $producto->id . '" class="btn btn-warning"><i class="fas fa-edit"></i></a>'
                        . '<a href="productos/cambiar/estado/' . $producto->id . '/1" class="btn btn-success text-white mx-4"><i class="fas fa-check"></i></a>'
                        . '<a href="productos/eliminar/' . $producto->id . '" class="btn btn-danger"><i class="fas fa-trash"></i></a>'
                        . '</div>';
                }
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }



    public function crear()
    {
        return view("productos.create");
    }


    public function agregar(Request $request)
    {
        $campos = [
            'nombre' => 'required|string|max:40',
            'precio' => 'required|int',
            'cantidad' => 'required|int'
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            'cantidad.required' => 'La :attribute es requerida'
        ];

        $this->validate($request, $campos, $mensaje);

        $productos["productos"] = productos::all();
        $datosProducto = request()->except('_token');

        try {
            foreach ($productos as $producto) {
                foreach ($producto as $p) {
                    if ($datosProducto["nombre"] == $p->nombre) {
                        return redirect('productos')->with('error', 'El producto ya existe');
                    } else {
                        productos::insert($datosProducto);
                        return redirect('productos')->with('success', 'Producto agregado satifactoriamente');
                    }
                }
            }
        } catch (\Exception $e) {
            return redirect('productos')->with('error', $e->getMessage());
        }
    }


    public function editar($id)
    {
        $producto = productos::findOrFail($id);

        return view("productos.edit", compact('producto'));
    }


    public function actualizar(Request $request, $id)
    {
        $datosProducto = request()->except(['_token', '_method']);
        try {
            productos::where('id', '=', $id)->update($datosProducto);
            return redirect('productos')->with('editado', 'Producto editado satifactoriamente');
        } catch (\Exception $e) {
            return redirect('productos')->with('error', $e->getMessage());
        }
    }

    public function cambiarEstado($id, $estado)
    {
        try {
            productos::where('id', '=', $id)->update(['estado' => $estado]);
            return redirect('productos')->with('success', 'Actualización de estado exitosa');
        } catch (\Exception $e) {
            return redirect('productos')->with('error', $e->getMessage());
        }
    }
    public function eliminar($id)
    {
        try {
            productos::destroy($id);
            return redirect('productos')->with('eliminado', 'Producto eliminado satisfactoriamente');
        } catch (\Exception $e) {
            return redirect('productos')->with('error', $e->getMessage());
        }
    }
}
