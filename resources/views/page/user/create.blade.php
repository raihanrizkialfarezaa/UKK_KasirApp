@extends('page.layout')
@section('title', 'Create User')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <h1 class="mb-4">Create User</h1>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama User</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter menu name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter menu name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="text" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter menu name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select name="status" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="kasir">Kasir</option>
                                <option value="manajer">Manajer</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection