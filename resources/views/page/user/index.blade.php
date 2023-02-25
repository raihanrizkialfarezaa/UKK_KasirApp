@extends('page.layout')
@section('title', 'User')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <h1 class="mb-4">Semua User</h1>
            <div class="row">
                <div class="col-md-12 ms-2 mb-3">
                    <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah Data</a>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table mb-0 text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama User</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th colspan="2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @forelse ($user as $row)
                                        <tr>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->roles->pluck('name')[0] }}</td>
                                            <th class="text-center">
                                                <form action="{{ route('user.edit', $row->id) }}" class="d-inline">
                                                    @method('PUT')
                                                    <button class="btn btn-primary">
                                                        Edit
                                                    </button>
                                                </form> |
                                                <form action="{{ route('user.destroy', $row->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">
                                                        Hapus
                                                    </button>
                    
                                                </form>
                                            </th>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Belum Ada Data!</td>
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