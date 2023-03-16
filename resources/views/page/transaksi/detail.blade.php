@extends('page.layout')
@section('title', 'Detail Transaksi')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <h1 class="mb-4">Detail Transaksi</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table mb-0 text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama Menu</th>
                                <th>Gambar</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($detail as $row)
                                <tr>
                                    <td>{{ $row->menu->pluck('nama_menu')[0] }}</td>
                                    <td><img src="{{ asset('/storage/' .$row->menu->pluck('gambar')[0]) }}" height="100" alt="">
                                    <td>{{ $row->quantity }}</td>
                                    <td>Rp{{ number_format($row->menu->pluck('harga')[0]) }}</td>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>
                                        <b>Total</b>
                                    </td>
                                    <td colspan="2">
                                        <td>
                                            <b>Rp{{ number_format($transaksi->total_harga) }}</b>
                                        </td>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection