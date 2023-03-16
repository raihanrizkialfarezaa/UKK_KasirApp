@extends('page.layout')

@section('title', 'Dashboard Page')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
            @can('check_most')
            <div class="mt-4 container containera" style="height: 800px; width: 1200px;" id="container"></div>
            @endcan
        </div>
        <!-- end page title -->

        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script>
   
            Highcharts.chart('container', {
                title: {
                    text: 'Laporan'
                },
                subtitle: {
                    text: 'Berikut Menu Terlaris Wikusama Cafe'
                },
                xAxis: {
                    categories: [@foreach ($penjualan as $row)
                    '<?= $row->nama_menu ?>',
                    @endforeach],
                },
                yAxis: {
                    title: {
                        text: 'Menu Terlaris'
                    }
                },
                legend: {
                    layout: 'vertical', 
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true
                    }
                },
                series: [{
                    type: 'bar',
                    name: 'penjualan',
                    data: [
                     @foreach ($penjualan as $row)
                        {
                            name: '<?= $row->nama_menu ?>',
                            @if ($row->total <= 0)
                                y: <?= 1 ?>
                            @else
                                y: <?= $row->total ?>
                            @endif,
                        },
                    @endforeach
                    ]
                }],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'vertical',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
         });
             </script>

    </div> <!-- container-fluid -->
</div>
@endsection