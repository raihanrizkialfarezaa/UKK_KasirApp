@extends('page.layout')
@section('title', 'Edit Status Meja')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <h1 class="mb-4">Edit Status Meja</h1>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('updatemeja', $meja->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Meja</label>
                            <select name="status" id="" class="form-control">
                                <option value=1>Kosong</option>
                                <option value=2>Terisi</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection