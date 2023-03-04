@extends('page.layout')
@section('title', 'Konfirmasi Pembayaran')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <h1 class="mb-4">Konfirmasi Pembayaran</h1>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('konfirmasiupdate', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Total Bayar</label>
                            <input type="number" name="total_bayar" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter total bayar">
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection