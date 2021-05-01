@extends('layouts.admins.default')

@section('admin-content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

    <form action="{{ url()->current() }}" class="row">
        @csrf

        <div class="form-group col-12 col-md-4">
            <input type="text" name="start_date" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="Tanggal awal . . ." autocomplete="off">
        </div>

        <div class="form-group col-12 col-md-4">
            <input type="text" name="last_date" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="Tanggal akhir . . ." autocomplete="off">
        </div>

        <div class="form-group col-12 col-md-4 align-self-center">
            <button type="submit" class="btn btn-primary px-5 shadow">Filter</button>
        </div>
    </form>
    
</div>

<!-- Content Row -->
<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Penghasilan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ 'Rp. ' . number_format($totalTransaction, 0, ',', '.') }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Transaksi Sukses</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $successTransaction }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Transaksi Pending</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingTransaction }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-spinner fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Transaksi Gagal</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $failedTransaction }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-times fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Riwayat Transaksi</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Transaksi</th>
                                <th>Kode Pesanan</th>
                                <th>Tanggal Transaksi</th>
                                <th>Nama Produk</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lastTransactions as $lastTransaction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $lastTransaction->code }}</td>
                                <td>{{ $lastTransaction->order->code }}</td>
                                <td>{{ $lastTransaction->created_at }}</td>
                                <td>{{ $lastTransaction->order->product->name }}</td>
                                <td>{{ 'Rp. ' . number_format($lastTransaction->total, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <span class="badge badge-success p-2 w-100">Sukses</span>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Presentase Status Transaksi (%)</h6>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="transactionStatusPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Sukses
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-warning"></i> Pending
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-danger"></i> Gagal
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('before-script')
<!-- Page level plugins -->
<script src="{{ asset('admin-assets/vendor/chart.js/Chart.min.js') }}"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
@endpush

@push('after-script')
<script>
    const uri = window.location.toString();

    if (uri.indexOf("?") > 0) {
        const clean_uri = uri.substring(0, uri.indexOf("?"));
        window.history.replaceState({}, document.title, clean_uri);
    }
</script>
@endpush   

@push('after-script')
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Pie Chart Example
    var ctx = document.getElementById("transactionStatusPieChart");

    var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Sukses", "Pending", "Gagal"],
        datasets: [{
        data: [{{ $portionSuccessTransaction }}, {{ $portionPendingTransaction }}, {{ $portionFailedTransaction }}],
        backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b'],
        hoverBackgroundColor: ['#19b47b', '#dbac33', '#cf392b'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        },
        legend: {
        display: false
        },
        cutoutPercentage: 80,
    },
    });
</script>
@endpush
