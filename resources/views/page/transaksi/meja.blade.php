@extends('page.layout')
@section('title', 'Meja')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <h1 class="mb-4">Semua Meja</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table mb-0 text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nomor Meja</th>
                                    <th>Status Meja</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @forelse ($meja as $row)
                                        <tr>
                                            <td>{{ $row->nomor_meja }}</td>
                                            @if ($row->status == 1)
                                                <td>Kosong</td>
                                            @else
                                                <td>Terisi</td>
                                            @endif
                                            <td><a href="{{ route('editmeja', $row->id) }}" class="btn btn-primary">Edit</a></td>
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