<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function transaksiView() 
    { 
        $menu = Menu::all();
        $meja = Meja::where('status', 1)->get();
        return view('page.transaksi.create', compact('menu', 'meja'));
    }

    public function transaksiPribadi() 
    { 
        $transaksi = Transaksi::where('id_user', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('page.transaksi.transaksipribadi', compact('transaksi'));
    }
    public function transaksiSemua(Request $request)
    { 
        if ($request->has('tanggal')) {
            // dd($request->tanggal);
            $transaksi = Transaksi::whereDate('created_at', $request->tanggal)->orderBy('created_at', 'desc')->get();
        } elseif($request->has('nama_karyawan')) {
            $id = User::where('name', 'LIKE', '%' . $request->nama_karyawan . '%')->orderBy('created_at', 'desc')->get();
            // dd($request->nama_karyawan);
            if ($id->count() > 1) {
                // dd($id);
                $id_all = $id->id;
                $transaksi = Transaksi::whereIn('id_user', $id->id)->orderBy('created_at', 'desc')->get();
                if ($transaksi->count() > 0) {
                    $transaksi = Transaksi::whereIn('id_user', $id->id)->orderBy('created_at', 'desc')->get();
                } else {
                    $transaksi = [];
                }
            } else {
                $id_all = $id[0]->id;
                $transaksi = Transaksi::where('id_user', $id[0]->id)->orderBy('created_at', 'desc')->get();
                if ($transaksi->count() > 0) {
                    $transaksi = Transaksi::where('id_user', $id[0]->id)->orderBy('created_at', 'desc')->get();
                } else {
                    $transaksi = [];
                }
            }
            
        } else {
            $transaksi = Transaksi::orderBy('created_at', 'desc')->get();
        }
        

        return view('page.transaksi.transaksisemua', compact('transaksi'));
    }

    public function laporanKeuangan(Request $request) 
    { 
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        if ($request->has('date_from') && $request->has('date_to')) {
            $data = [];
            $data['data'] = DB::table('transaksis')
                    ->whereBetween('tgl_transaksi', [$date_from, $date_to])
                    ->groupBy('tgl_transaksi')
                    ->get();
            $data['total'] = DB::table('transaksis')
                            ->whereBetween('tgl_transaksi', [$date_from, $date_to])
                            ->groupBy('tgl_transaksi')
                            ->sum('total_harga');
        } else {
            $data = [];

            $data['data'] = DB::table('transaksis')
                                    ->where('tgl_transaksi', Date::now())
                                    ->get();
            $data['total'] = DB::table('transaksis')
                                    ->where('tgl_transaksi', Date::now())
                                    ->sum('total_harga');                             

            // dd($data);
        }
        
        return view('page.transaksi.laporan', compact('data'));
    }

    public function cekHarga(string $id) 
    { 
        $menu = Menu::where('id', $id)->first();
        return response()->json($menu);
    }

    public function lihatDetailTransaksi(string $id) 
    {
        $detail = DetailTransaksi::where('id_transaksi', $id)->get();
        $transaksi = Transaksi::where('id', $id)->first();
        // dd($detail);
        return view('page.transaksi.detail', compact('detail','transaksi'));
    }

    public function transaksi(Request $request) 
    { 
        $total = [];
        $id_menu = $request->id_menu;
        for ($i= 0; $i < count($id_menu); $i++) { 
            $i - 1;
            $datasave = [
                'data_menu' => $id_menu,
            ];
            $req = $request->all();
            $data = Menu::whereIn('id', $id_menu)->get();
            $total_harga = ['total_harga' => $data[$i]->harga * $request->quantity[$i]];
            array_push($total, $total_harga);
        }
        

        // dd($request->id_menu);
        // $a = array("a" => 1,"b" => 2);
        $value = array_sum(array_column($total,'total_harga'));
        $create = Transaksi::create([
            'tgl_transaksi' => Date::now(),
            'id_user' => Auth::id(),
            'id_meja' => $request->id_meja,
            'nama_pelanggan' => $request->nama_pelanggan,
            'status' => $request->status,
            'total_harga' => $value,
        ]);

        if ($create) {
            $meja = Meja::where('id', $create->id_meja)->first();
            $meja->update([
                'status' => 2,
            ]);
            $id_menu = $request->id_menu;
            $quantity = $request->quantity;
            for ($i=0; $i < count($id_menu); $i++) { 
                $i - 1;
                $datas = Menu::whereIn('id', $id_menu)->get();
                $data = [
                    'id_transaksi' => $create->id,
                    'id_menu' => $id_menu[$i],
                    'quantity' => $quantity[$i],
                    'harga' => $datas[$i]->harga,
                ];
                DB::table('detail_transaksis')->insert($data);
            }

            Alert::success('Transaksi Sukses', 'Transaksi Anda Berhasil Di Lakukan');
            return redirect()->route('pemesanan-sukses', $create->id);
        } else {
            Alert::error('Transaksi Gagal', 'Transaksi Anda Tidak Berhasil Di Lakukan');
            return redirect()->route('transaksipribadi');
        }
        
    }

    public function pemesananSukses(string $id) 
    { 
        $transaksi = Transaksi::where('id', $id)->first();
        $detail = DetailTransaksi::where('id_transaksi',$id)->get();
        $meja = Meja::where('id',$transaksi->id_meja)->first();
        return view('page.transaksi.pemesanansukses', compact('transaksi','detail','meja'));
    }

    public function konfirmasiPembayaranView() 
    { 
        $transaksi = Transaksi::where('status', 'belum_bayar')->orderBy('created_at', 'desc')->get();
        return view('page.transaksi.konfirmview', compact('transaksi'));
    }
    public function konfirmasiPembayaranEditView(string $id) 
    { 
        $transaksi = Transaksi::where('id', $id)->first();
        return view('page.transaksi.konfirmasi', compact('transaksi'));
    }

    public function transaksiSukses(string $id) 
    { 
        $transaksi = Transaksi::where('id', $id)->first();
        return view('page.transaksi.sukses', compact('transaksi'));
    }
    public function cetakNota(string $id) 
    { 
        $transaksi = Transaksi::where('id', $id)->first();
        $data['name'] = $transaksi->user->name;
        $data['tanggal_transaksi'] = $transaksi->tgl_transaksi;
        $data['total_harga'] = $transaksi->total_harga;
        $data['total_bayar'] = $transaksi->total_bayar;
        $data['id_transaksi'] = 'FJ - ' .Str::random(10);
        $data['nama_pelanggan'] = $transaksi->nama_pelanggan;
        $data['item'] = DetailTransaksi::where('id_transaksi', $id)->get();
        $pdf = Pdf::loadView('page.pdf.invoice', $data)->setPaper([0, 0, 277, 477], 'potrait');
        return $pdf->download('invoice.pdf');
    }

    public function konfirmasiPembayaran(Request $request, string $id) 
    { 
        $transaksi = Transaksi::where('id', $id)->first();
        if ($request->total_bayar < $transaksi->total_harga) {
            Alert::error('Gagal Konfirmasi Pembayaran', 'Jumlah bayar kurang dari total yang harus di bayar');
            return redirect()->route('konfirmasi-pembayaran', $id);
        } else {
            $update = $transaksi->update([
                'status' => 'lunas',
                'total_bayar' => $request->total_bayar,
            ]);
        }
        

        if ($update) {
            $transaksi = Transaksi::where('id', $id)->first();
            $meja = Meja::where('id', $transaksi->id_meja)->first();
            $updatemeja = $meja->update([
                'status' => 1,
            ]);
            Alert::success('Sukses Konfirmasi Pembayaran', 'Status Pembayaran anda berhasil di konfirmasi');
            return redirect()->route('transaksi-sukses', $id);
        } else {
            Alert::success('Gagal Konfirmasi Pembayaran', 'Status Pembayaran anda gagal di konfirmasi');
            return redirect()->route('transaksipribadi');
        }
    }

    public function checkMejaView() 
    { 
        $meja = Meja::all();

        return view('page.transaksi.meja', compact('meja'));
    }
    
    public function changeMejaView(string $id) 
    { 
        $meja = Meja::where('id', $id)->first();

        return view('page.transaksi.editmeja', compact('meja'));
    }

    public function changeStatusMeja(Request $request, string $id) 
    { 
        $meja = Meja::where('id', $id)->first();
        $update = $meja->update([
            'status' => $request->status,
        ]);

        if ($update) {
            Alert::success('Sukses Mengganti Status', 'Status Meja Berhasil Di Ganti');
            return redirect()->route('lihatmeja');
        } else {
            Alert::success('Gagal Mengganti Status', 'Status Meja Gagal Di Ganti');
            return redirect()->route('lihatmeja');
        }
        
    }
}
