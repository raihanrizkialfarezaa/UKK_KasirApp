@extends('page.layout')
@section('title', 'Menu')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <h1 class="mb-4">Semua Menu</h1>
            <div class="row">
                <div class="col-md-12 ms-2 mb-3">
                    <a href="{{ route('menu.create') }}" class="btn btn-primary">Tambah Data</a>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table mb-0 text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama Menu</th>
                                    <th>Jenis Menu</th>
                                    <th>Harga</th>
                                    <th colspan="2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @forelse ($menu as $row)
                                        <tr>
                                            <td>{{ $row->nama_menu }}</td>
                                            <td>{{ $row->jenis }}</td>
                                            <td>Rp{{ number_format($row->harga) }}</td>
                                            <th class="text-center">
                                                <form action="{{ route('menu.edit', $row->id) }}" class="d-inline">
                                                    @method('PUT')
                                                    <button class="btn btn-primary">
                                                        Edit
                                                    </button>
                                                </form> |
                                                <form action="{{ route('menu.destroy', $row->id) }}" method="POST" class="d-inline">
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