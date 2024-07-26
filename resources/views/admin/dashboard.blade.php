@extends('admin.layout_admin')

@session('title')
    Tổng quan
@endsession

@section('body')
    <div class="d-flex justify-content-between">
        <h3 class="mb-4">Dashboard</h3>
    </div>
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card border-0 rounded-0 bg-primary-subtle text-primary">
                <div class="card-body text-end">
                    <div class="display-6 d-flex justify-content-between">
                        <i class="fal fa-file-invoice-dollar"></i>
                        {{ $soDonHang }}
                    </div>
                    Đơn hàng
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-0 rounded-0 bg-warning-subtle text-warning">
                <div class="card-body text-end">
                    <div class="display-6 d-flex justify-content-between">
                        <i class="fal fa-boxes"></i>
                        {{ $soSanPham }}
                    </div>
                    Sản phẩm
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-0 rounded-0 bg-danger-subtle text-danger">
                <div class="card-body text-end">
                    <div class="display-6 d-flex justify-content-between">
                        <i class="fal fa-users"></i>
                        {{ $soUser }}
                    </div>
                    Users
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-0 rounded-0 bg-success-subtle text-success">
                <div class="card-body text-end">
                    <div class="display-6 d-flex justify-content-between">
                        <i class="fal fa-chart-line"></i>
                        {{number_format($doanhthu) }} VNĐ
                    </div>
                    Doanh thu
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card rounded-0 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex border-bottom pb-2 justify-content-between">
                        <h6 class="mb-0">
                            <i class="fal fa-file-invoice-dollar fa-lg"></i>
                            Đơn hàng gần đây
                        </h6>
                        <small>
                            <a href="{{asset('admin/admin/orders')}}" class="text-decoration-none">All Orders</a>
                        </small>
                    </div>
                    @foreach ($dsDH as $dh)
                        <div class="d-flex text-body-secondary pt-3">
                            <div
                                class="p-2 me-2 bg-{{ $dh->status == 'success' ? 'success' : ($dh->status == 'cancel' ? 'danger' : 'warning') }} text-white">
                                <i class="fal fa-receipt"></i>
                            </div>

                            <a href="#"
                                class="py-2 mb-0 small lh-sm border-bottom w-100 text-decoration-none text-body-secondary">
                                <strong class="d-flex justify-content-between">
                                    Đơn #{{ $dh->id }}
                                    <div>
                                        <span class="badge text-bg-warning">
                                            <i class="far fa-box"></i> {{ $dh->total_quantity }}
                                        </span>
                                        <span class="badge bg-success-subtle text-success"><i
                                                class="far fa-money-bill-wave"></i> {{ number_format($dh->total_money) }}
                                            vnđ</span>
                                    </div>
                                </strong>
                                Đặt bởi <i>{{ $dh->name }}</i> lúc {{ $dh->created_at->diffForHumans() }}
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>


        <div class="col-md-6 ">
            <div class="card rounded-0 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex border-bottom pb-2 justify-content-between">
                        <h6 class="mb-0">
                            <i class="fal fa-chart-pie fa-lg"></i>
                            Thống kê
                        </h6>
                    </div>


                    <div id="curve_chart" style="width:100%;height: 300px"></div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Month/Year', 'Thu nhập'],
                @foreach ($tkDoanhThu as $tk)
                    ['{{ $tk->month }}/{{ $tk->year }}', {{ $tk->total }}],
                @endforeach
            ]);

            var options = {
                title: 'Hiệu suất',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>
@endsection
