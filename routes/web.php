<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you permission register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/assign-new-perm', function () {
//     $permission = Permission::create(['name' => 'cetak_nota']);
//     $permission = Permission::create(['name' => 'cek_keuangan']);

//     $manajer = Role::findByName('manajer');
//     $kasir = Role::findByName('kasir');

//     $manajer->givePermissionTo('cek_keuangan');
//     $kasir->givePermissionTo('cetak_nota');
// });
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dash');
Route::resource('user', UserController::class);
Route::resource('meja', MejaController::class);
Route::resource('menu', MenuController::class);
Route::post('/transaction', [TransaksiController::class, 'transaksi'])->name('transaksi')->middleware('permission:do_transaction');
Route::get('/cek-harga/{id}', [TransaksiController::class, 'cekHarga'])->middleware('permission:do_transaction')->name('cekharga');
Route::get('/transaction', [TransaksiController::class, 'transaksiView'])->middleware('permission:do_transaction')->name('transaksiview');
Route::get('/see-transaction', [TransaksiController::class, 'transaksiPribadi'])->middleware('permission:see_private_transaction')->name('transaksipribadi');
Route::get('/transaksi-sukses/{id}', [TransaksiController::class, 'transaksiSukses'])->middleware('permission:do_transaction')->name('transaksi-sukses');
Route::get('/pemesanan-sukses/{id}', [TransaksiController::class, 'pemesananSukses'])->middleware('permission:do_transaction')->name('pemesanan-sukses');
Route::get('/cetak-nota/{id}', [TransaksiController::class, 'cetakNota'])->middleware('permission:do_transaction')->name('cetak-nota');
Route::get('/see-all-transaction', [TransaksiController::class, 'transaksiSemua'])->middleware('permission:see_all_transaction')->name('transaksisemua');
Route::get('/see-detail-transaction/{id}', [TransaksiController::class, 'lihatDetailTransaksi'])->middleware(['permission:see_private_transaction|see_all_transaction'])->name('detail-transaksi');
Route::get('/check-table', [TransaksiController::class, 'checkMejaView'])->middleware('permission:check_table_number')->name('lihatmeja');
Route::get('/check-table/{id}', [TransaksiController::class, 'changeMejaView'])->middleware('permission:check_table_number')->name('editmeja');
Route::put('/update-table/{id}', [TransaksiController::class, 'changeStatusMeja'])->middleware('permission:check_table_number')->name('updatemeja');
Route::get('/check-keuangan', [TransaksiController::class, 'laporanKeuangan'])->middleware('permission:cek_keuangan')->name('cek_keuangan');
Route::get('/konfirmasipembayaran', [TransaksiController::class, 'konfirmasiPembayaranView'])->middleware('permission:do_transaction')->name('konfirmasibayar');
Route::get('/konfirmasi-pembayaran/{id}', [TransaksiController::class, 'konfirmasiPembayaranEditView'])->middleware('permission:do_transaction')->name('konfirmasi-pembayaran');
Route::put('/konfirmasipembayaran/{id}', [TransaksiController::class, 'konfirmasiPembayaran'])->middleware('permission:do_transaction')->name('konfirmasiupdate');

Route::resource('menu', MenuController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
