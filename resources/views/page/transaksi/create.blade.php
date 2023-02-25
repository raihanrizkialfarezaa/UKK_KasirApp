@extends('page.layout')
@section('title', 'Transaksi')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <h1 class="mb-4">Transaksi</h1>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('transaksi') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Meja</label>
                            <select name="id_meja" id="" class="form-control">
                                @foreach ($meja as $row)
                                    <option value="{{ $row->id }}">{{ $row->nomor_meja }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="belum_bayar">Belum Bayar</option>
                                <option value="lunas">Lunas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Pelanggan</label>
                            <input type="text" class="form-control" name="nama_pelanggan">
                        </div>
                        <div class="form-group classAdded mb-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Menu</label>
                                    <select name="id_menu[]" class="form-control">
                                        @foreach ($menu as $row)
                                            <option value="{{ $row->id }}">{{ $row->nama_menu }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label for="exampleInputEmail1">Jumlah</label>
                                    <input type="number" name="quantity[]" class="form-control">
                                </div>
                                <div class="col-md-1" style="margin-top: 1.8rem">
                                    <a class="btn btn-success addClass" href="javascript:void(0)">+</a>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect subm waves-light">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-add')
<script>
    $('form').on('click', '.addClass', function () {
        var form = "<div class='form-group classAdded'>"+
                            "<div class='row'>"+
                                "<div class='col-md-6'>"+
                                    "<label for='exampleInputEmail1'>Menu</label>"+
                                    "<select id='selectmenu' name='id_menu[]' class='form-control'>"+
                                        "@foreach ($menu as $row)"+
                                            "<option value='{{ $row->id }}'>{{ $row->nama_menu }}</option>"+
                                        "@endforeach"+
                                    "</select>"+
                                "</div>"+
                                "<div class='col-md-5'>"+
                                    "<label for='exampleInputEmail1'>Jumlah</label>"+
                                    "<input type='number' name='quantity[]' class='form-control'>"+
                                "</div>"+
                                "<div class='col-md-1' style='margin-top: 1.8rem'>"+
                                    "<a class='btn btn-danger removeClass' href='javascript:void(0)'>-</a>"+
                                "</div>"+
                            "</div>"+
                        "</div>"
        $(form).insertBefore('.subm');
    });

    $('form').on('click', '.removeClass', function() {
        $(this).parent().parent().remove();
    });
</script>
@endsection