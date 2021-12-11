<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\detalles_factura;
use App\Models\productos;
use App\Models\Cliente;
use DataTables;
use Illuminate\Http\Request;
use DB;


class FacturaController extends Controller
{
    public function index()
    {

        return view('facturas.index');
    }

    public function listar(Request $request)
    {
        $facturas = Factura::select("facturas.*", "clientes.nombre as nombre")
            ->join("clientes", "facturas.documentoCliente", "=", "clientes.documento")
            ->get();

        return DataTables::of($facturas)
            ->addColumn('detalles', function ($factura) {
                return '<a href="facturas/ver/detalle/' . $factura->id . '" class="btn btn-success">Ver detalles</a>';
            })
            ->rawColumns(['detalles'])
            ->make(true);
    }

    public function crear()
    {
        $productos = productos::select("productos.*")
            ->where("productos.cantidad", ">=", "1")
            ->get();
        return view('facturas.crear', compact('productos'));
    }

    public function agregar(Request $request)
    {
        $inputs = request()->except('_token');

        try {
            foreach ($inputs["idProducto"] as $key => $value) {
                $productoRecorrido = productos::findOrFail($value);
                if ($inputs["cantidades"][$key] > $productoRecorrido->cantidad) {
                    return redirect('facturas')->with('error', 'Revise que haya stock suficiente de productos');
                }
            }
            $factura = Factura::create([
                "documentoCliente" => $inputs["documentoCliente"],
                "total" => $this->calcularPrecio($inputs["idProducto"], $inputs["cantidades"])
            ]);

            foreach ($inputs["idProducto"] as $key => $value) {
                detalles_factura::create([
                    "idFactura" => $factura->id,
                    "idProducto" => $value,
                    "cantidad" => $inputs["cantidades"][$key],
                    "precioUnidad" => $inputs["precios"][$key],
                    "subtotal" => $inputs["precios"][$key] * $inputs["cantidades"][$key]
                ]);
                $productoEditar = productos::findOrFail($value);
                $productoEditar = productos::where("id", "=", $value)
                    ->update(["cantidad" => $productoEditar->cantidad - $inputs["cantidades"][$key]]);
            }
            return redirect('facturas')->with('success', 'factura agregada satifactoriamente');
        } catch (\Exception $e) {
            return redirect('facturas')->with('error', $e->getMessage());
        }
    }

    public function calcularPrecio($datos, $cantidades)
    {
        $precio = 0;

        foreach ($datos as $key => $dato) {
            $producto = productos::find($dato);
            $precio += ($producto->precio * $cantidades[$key]);
        }

        return $precio;
    }

    public function mostrar($id)
    {
        // $facturaDetalle = Factura::select("facturas.*", "clientes.nombre as nombre")
        // ->join("clientes", "facturas.documentoCliente", "=", "clientes.documento")
        // ->where("id","=", $id)
        // ->get();
        $facturaDetalle = Factura::findOrFail($id);

        $detalles = detalles_factura::select("detalles_factura.*", "productos.nombre as nombre")
            ->join("productos", "detalles_factura.idProducto", "=", "productos.id")
            ->join("facturas", "detalles_factura.idFactura", "=", "facturas.id")
            ->where("idFactura", "=", $id)
            ->get();

        // print_r($detalles);

        return view("facturas.mostrar", compact("facturaDetalle", "detalles"));
    }
}
