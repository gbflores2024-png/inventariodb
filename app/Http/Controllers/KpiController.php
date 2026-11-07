<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class KpiController extends Controller
{
    private function indicadores(): array
    {
        return [
            'ingresos' => (float) DB::table('ventas')->sum('total'),
            'ventas' => DB::table('ventas')->count(),
            'productos' => DB::table('productos')->count(),
            'disponible' => (int) DB::table('inventario')->sum('stock_disponible'),
            'reservado' => (int) DB::table('inventario')->sum('stock_reservado'),
            'bajo' => DB::table('inventario')->whereColumn('stock_disponible', '<=', 'stock_minimo')->count(),
            'pedidos' => DB::table('pedidos')->count(),
            'reservas' => DB::table('reservas')->count(),
            'devoluciones' => DB::table('devoluciones')->count(),
        ];
    }

    private function meses(): array
    {
        $inicio = now()->startOfMonth()->subMonths(11);
        $filas = DB::table('ventas')
            ->selectRaw('YEAR(fecha_venta) anio, MONTH(fecha_venta) mes, COUNT(*) cantidad, SUM(total) importe')
            ->where('fecha_venta', '>=', $inicio->toDateString())
            ->groupByRaw('YEAR(fecha_venta), MONTH(fecha_venta)')
            ->get()->keyBy(fn ($fila) => $fila->anio . '-' . $fila->mes);
        $labels = []; $montos = []; $cantidades = [];
        for ($i = 0; $i < 12; $i++) {
            $fecha = $inicio->copy()->addMonths($i);
            $fila = $filas->get($fecha->year . '-' . $fecha->month);
            $labels[] = $fecha->translatedFormat('M Y');
            $montos[] = (float) ($fila->importe ?? 0);
            $cantidades[] = (int) ($fila->cantidad ?? 0);
        }
        return compact('labels', 'montos', 'cantidades');
    }

    public function resumen()
    {
        return view('kpis.resumen', ['kpi' => $this->indicadores(), 'meses' => $this->meses()]);
    }
    public function ventas()
    {
        return view('kpis.ventas', ['kpi' => $this->indicadores(), 'meses' => $this->meses()]);
    }
    public function productos()
    {
        $masVendidos = DB::table('detalle_ventas as d')
            ->join('productos as p', 'p.id_producto', '=', 'd.id_producto')
            ->select('p.nombre')
            ->selectRaw('SUM(d.cantidad) as unidades, SUM(d.subtotal) as importe')
            ->groupBy('p.id_producto', 'p.nombre')
            ->orderByDesc('unidades')->limit(10)->get();
        return view('kpis.productos', ['kpi' => $this->indicadores(), 'masVendidos' => $masVendidos]);
    }
    public function inventario()
    {
        $bajos = DB::table('inventario as i')
            ->join('productos as p', 'p.id_producto', '=', 'i.id_producto')
            ->leftJoin('producto_variantes as v', 'v.id_variante', '=', 'i.id_variante')
            ->whereColumn('i.stock_disponible', '<=', 'i.stock_minimo')
            ->select('p.nombre', 'i.stock_disponible', 'i.stock_minimo', 'v.talla', 'v.color')
            ->orderBy('p.nombre')->get();
        return view('kpis.inventario', ['kpi' => $this->indicadores(), 'bajos' => $bajos]);
    }
    public function operaciones()
    {
        return view('kpis.operaciones', ['kpi' => $this->indicadores()]);
    }
}
