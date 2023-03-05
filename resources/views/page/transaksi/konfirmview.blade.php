@extends('page.layout')
@section('title', 'Transaksi')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <h1 class="mb-4">Semua Transaksi</h1>
        <div class="row">
            <div class="col-md-12 ms-2 mb-3">
                <a href="{{ route('transaksiview') }}" class="btn btn-primary">Tambah Data</a>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table mb-0 text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>Tanggal Transaksi</th>
                                <th>Nomor Meja</th>
                                <th>Nama Pelanggan</th>
                                <th>Status</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @forelse ($transaksi as $row)
                                    <tr>
                                        <td>{{ $row->tgl_transaksi }}</td>
                                        <td>{{ $row->meja->nomor_meja }}</td>
                                        <td>{{ $row->nama_pelanggan }}</td>
                                        <td>{{ $row->status }}</td>
                                        <td>Rp{{ number_format($row->total_harga)}}</td>
                                        <td><a href="{{ route('konfirmasi-pembayaran', $row->id) }}" class="btn btn-primary">Konfirmasi Pembayaran</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Belum Ada Data!</td>
                                    </tr>
                                @endforelse
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection