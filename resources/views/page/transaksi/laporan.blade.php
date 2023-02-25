@extends('page.layout')

@section('title', 'Dashboard Page')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <h1>Laporan Keuangan</h1>

        <div class="row">
                <div class="col-md-12 mt-3 mb-4">
                    <form class="" action="/see-all-transaction" method="GET">
                        <div class="m-0">
                            <div class="input-group">
                                <div class="col-md-6 form-group">
                                    <label for="">Date From</label>
                                    <input type="date" name="date_from" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="">Date To</label>
                                    <input type="date" name="date_to" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-5">
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
                                            @forelse ($data['data'] as $row)
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
                                        @if ($data['data']->count() > 0)
                                            <tr>
                                                <th colspan="5">Total Bayar</th>
                                                <td>{{ $data['total'] }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div> <!-- container-fluid -->
</div>
@endsection