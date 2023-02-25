<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> Transaksi Sukses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('assets/images/favicon.ico') }}">

    <!-- App css -->
    @include('page.includes.style')

</head>

<body>

    <div class="bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                            <div class="row">
                                <div class="col-lg-5 d-none d-lg-block bg-login rounded-left"></div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-center mb-5">
                                            <a href="index.html" class="text-dark font-size-22 font-family-secondary">
                                                <i class="mdi mdi-alpha-x-circle"></i> <b>RizkiGroups.</b>
                                            </a>
                                        </div>
                                        
                                        <div class="text-center">
                                            <img src="assets/images/maintenance.svg" alt="error" height="180">
                                            <h1 class="h4 mb-3 mt-4">Selamat transaksi kamu berhasil!</h1>
                                            <p class="text-muted mb-4 w-75 m-auto">Transaksi atas nama {{ $transaksi->nama_pelanggan }} berhasil di lakukan!</p>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-12 text-center">
                                                <a href="{{ route('transaksipribadi') }}" class="btn btn-success"><i class="mdi mdi-email mr-2"></i>Kembali</a>
                                                @if ($transaksi->status === 'lunas')
                                                <a href="{{ route('cetak-nota', $transaksi->id) }}" class="btn btn-success"><i class="mdi mdi-email mr-2"></i>Cetak Nota</a>
                                                @endif
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </div> <!-- end .padding-5 -->
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div> <!-- end .w-100 -->
                    </div> <!-- end .d-flex -->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- jQuery  -->
    @include('page.includes.script')

</body>
</html>