<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title> @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="MyraStudio" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        @include('page.includes.style')

    </head>
<body>
    <div id="layout-wrapper">
        @include('page.includes.topbar')
        @include('page.includes.sidebar')

        <div class="main-content">
            @yield('content')
            @include('page.includes.footer')
        </div>

    </div>
    @include('page.includes.script');
    @include('sweetalert::alert')
</body>
</html>