@extends('page.layout')
@section('title', 'Create Menu')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <h1 class="mb-4">Create Menu</h1>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Menu</label>
                            <input type="text" name="nama_menu" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter menu name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Jenis</label>
                            <select name="jenis" class="form-control" id="">
                                <option value="makanan">Makanan</option>
                                <option value="minuman">Minuman</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Gambar</label>
                            <input type="file" name="gambar" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Harga</label>
                            <input type="number" name="harga" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection