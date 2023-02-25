@extends('page.layout')
@section('title', 'Transaksi')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <h1 class="mb-4">Semua Transaksi</h1>
        <div class="row">
            <div class="col-md-6 ms-2 mb-3">
                <a href="{{ route('transaksiview') }}" class="btn btn-primary">Tambah Data</a>
            </div>
            <div class="col-md-6">
                <form class="" action="/see-all-transaction" method="GET">
                    <div class="form-group m-0">
                        <div class="input-group">
                            <input type="text" name="nama_karyawan" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 mb-4">
                <form class="" action="/see-all-transaction" method="GET">
                    <div class="form-group m-0">
                        <div class="input-group">
                            <input type="date" name="tanggal" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table mb-0 text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>Tanggal Transaksi</th>
                                <th>Nomor Meja</th>
                                <th>Nama Kasir</th>
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
                                        <td>{{ $row->user->name }}</td>
                                        <td>{{ $row->nama_pelanggan }}</td>
                                        <td>{{ $row->status }}</td>
                                        <td>{{ $row->total_harga }}</td>
                                        <td><a href="{{ route('detail-transaksi', $row->id) }}" class="btn btn-primary">Detail</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Belum Ada Data!</td>
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