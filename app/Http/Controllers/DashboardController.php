<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() 
    { 
        $penjualan = DB::table('menus')
                        ->leftJoin('detail_transaksis', 'menus.id','=','detail_transaksis.id_menu')
                        ->selectRaw('menus.id, menus.nama_menu, SUM(detail_transaksis.quantity) as total')
                        ->groupBy('menus.id')
                        ->orderBy('total', 'asc')
                        ->get();
        // dd($penjualan);
        return view('page.dashboard.index', compact('penjualan'));
    }
}
