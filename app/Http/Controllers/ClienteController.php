<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use DataTables;
use Illuminate\Http\Request;


class ClienteController extends Controller
{
    public function index()
    {

        return view("clientes.index");
    }

    public function listar(Request $request)
    {
        $clientes = Cliente::all();

        return DataTables::of($clientes)
            ->editColumn("estado", function ($cliente) {
                return $cliente->estado == 1 ? "activo" : "inactivo";
            })
            ->addColumn("acciones", function ($cliente) {
                if ($cliente->estado == 1) {
                    return '<div class="d-flex justify-content-center">'
                        . '<a href="Cliente/editar/' . $cliente->documento . '" class="btn btn-warning"><i class="fas fa-edit"></i></a>'
                        . '<a href="Cliente/cambiar/estado/' . $cliente->documento . '/0" class="btn btn-danger text-white mx-4"><i class="fas fa-ban"></i></a>'
                        . '<a href="Cliente/eliminar/' . $cliente->documento . '" class="btn btn-danger"><i class="fas fa-trash"></i></a>'
                        . '</div>';
                } else {
                    return '<div class="d-flex justify-content-center">'
                        . '<a href="Cliente/editar/' . $cliente->documento . '" class="btn btn-warning"><i class="fas fa-edit"></i></a>'
                        . '<a href="Cliente/cambiar/estado/' . $cliente->documento . '/1" class="btn btn-success text-white mx-4"><i class="fas fa-check"></i></a>'
                        . '<a href="Cliente/eliminar/' . $cliente->documento . '" class="btn btn-danger"><i class="fas fa-trash"></i></a>'
                        . '</div>';
                }
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }
    public function crear()
    {
        return view('clientes.crear');
    }

    public function agregar(Request $request)
    {
        $campos = [
            'documento' => 'required',
            'nombre' => 'required'
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido'
        ];

        $this->validate($request, $campos, $mensaje);

        $datosCliente = request()->except('_token');
        try {
            Cliente::insert($datosCliente);
            return redirect('Cliente')->with('success', 'cliente agregado satifactoriamente');
        } catch (\Exception $e) {
            return redirect('Cliente')->with('error', $e->getMessage());
        }
    }

    public function editar($documento)
    {
        $cliente = Cliente::findOrFail($documento);
        return view('clientes.editar', compact('cliente'));
    }

    public function actualizar(Request $request, $documento)
    {
        $datosCliente = request()->except(['_token']);
        try {
            Cliente::where('documento', '=', $documento)->update($datosCliente);
            return redirect('Cliente')->with('editado', 'cliente editado satifactoriamente');
        } catch (\Exception $e) {
            return redirect('Cliente')->with('error', $e->getMessage());
        }
    }

    public function cambiarEstado($documento, $estado)
    {
        try {
            Cliente::where('documento', '=', $documento)->update(['estado' => $estado]);
            return redirect('Cliente')->with('success', 'Actualización de estado exitosa');
        } catch (\Exception $e) {
            return redirect('Cliente')->with('error', $e->getMessage());
        }
    }
    public function eliminar($documento)
    {
        try {
            Cliente::destroy($documento);
            return redirect('Cliente')->with('eliminado', 'cliente eliminado satifactoriamente');
        } catch (\Exception $e) {
            return redirect('Cliente')->with('error', $e->getMessage());
        }
    }
}
