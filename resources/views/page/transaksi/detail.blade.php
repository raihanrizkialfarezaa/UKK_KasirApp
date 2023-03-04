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
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($detail as $row)
                                <tr>
                                    <td>{{ $row->menu->pluck('nama_menu')[0] }}</td>
                                    <td>{{ $row->quantity }}</td>
                                    <td>{{ $row->menu->pluck('harga')[0] }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td> Total </td>
                                    <td colspan="1">
                                        <td>{{ $transaksi->total_harga }}</td>
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