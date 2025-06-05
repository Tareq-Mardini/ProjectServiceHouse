<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="{{asset('images/visitor/logo-3.png')}}" type="image/png">
    <title>Admin Dashboard</title>
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Dashboard CSS -->
    <link rel="stylesheet" href="{{ asset('css/AdminDashboard.css') }}">
</head>

<body id="page-top">
    <div id="wrapper">
        @include('dashboard.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                            aria-label="Search" aria-describedby="basic-addon2" />
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="{{asset('images/istockphoto-2041572395-612x612.jpg')}}" />
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="container py-4">
                    {{-- Stats Cards --}}
                    <div class="row g-4 mb-5">
                        @php
                        $cards = [
                        ['label' => 'Clients', 'value' => $stats['Clients'], 'icon' => 'users', 'color' => 'card-blue'],
                        ['label' => 'Suppliers', 'value' => $stats['Suppliers'], 'icon' => 'briefcase', 'color' => 'card-purple'],
                        ['label' => 'Orders', 'value' => $stats['Orders'], 'icon' => 'shopping-cart', 'color' => 'card-orange'],
                        ['label' => 'Sections', 'value' => $stats['Sections'], 'icon' => 'layers', 'color' => 'card-green'],
                        ['label' => 'Services', 'value' => $stats['Services'], 'icon' => 'settings', 'color' => 'card-teal'],
                        ['label' => 'Works', 'value' => $stats['Works'], 'icon' => 'file-text', 'color' => 'card-red'],
                        ];
                        if (isset($stats['Top Service'])) {
                        $cards[] = ['label' => 'Top Service', 'value' => $stats['Top Service'], 'icon' => 'star', 'color' => 'card-purple'];
                        }
                        if (isset($stats['Top Work'])) {
                        $cards[] = ['label' => 'Top Work', 'value' => $stats['Top Work'], 'icon' => 'trending-up', 'color' => 'card-yellow'];
                        }
                        $cards[] = ['label' => 'Total Earnings ($)', 'value' => $stats['Total Earnings ($)'], 'icon' => 'dollar-sign', 'color' => 'card-dark'];
                        @endphp
                        @foreach ($cards as $card)
                        @if($card)
                        <div class="col-md-4 col-sm-6">
                            <div class="stat-card {{ $card['color'] }} animate-card" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                                <div class="icon">
                                    <i data-lucide="{{ $card['icon'] }}"></i>
                                </div>
                                <div class="details">
                                    <h6>{{ $card['label'] }}</h6>
                                    <h2>
                                        @if(is_numeric($card['value']))
                                        {{ number_format($card['value']) }}
                                        @else
                                        {{ $card['value'] }}
                                        @endif
                                        @if($card['label'] == 'Total Earnings ($)')
                                        $
                                        @endif
                                    </h2>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <h2 style=" text-align:center;margin-top:-50px"><i style="color: #ee4962;" data-lucide="calendar"></i> Number of <span style="color: #ee4962;">orders</span> per day</h2>
                <div style="width: 90%; margin:auto; margin-top:14px" class="card p-4">
                    <canvas id="dailyOrdersChart"></canvas>
                </div>
                <h2 style=" text-align:center;margin-top:10px"><i style="color: #ee4962;" data-lucide="calendar"></i> Number of <span style="color: #ee4962;">orders</span> per month</h2>
                <div style="width: 90%; margin:auto;margin-top:15px" class="card p-4">
                    <canvas id="ordersChart" class="chart-canvas"></canvas>
                </div>
                <h2 style=" text-align:center; margin:10px"><i style="color: #ee4962;" data-lucide="calendar"></i> Number of <span style="color: #ee4962;">orders</span> per year</h2>
                <div style="width: 40%; margin:auto" class="card p-4 mb-4">
                    <canvas id="yearlyOrdersChart"></canvas>
                </div>
                <script>
                    const ctx1 = document.getElementById('ordersChart').getContext('2d');
                    const ordersChart = new Chart(ctx1, {
                        type: 'bar',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            datasets: [{
                                label: 'Orders per Month',
                                data: @json($monthlyOrders),
                                backgroundColor: 'rgba(59, 246, 190, 0.7)',
                                borderRadius: 8,
                                borderSkipped: false
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: (ctx) => `Orders: ${ctx.parsed.y}`
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                    const dailyOrdersData = @json($dailyOrders);
                    const dailyLabels = @json($dailyLabels);
                    console.log('dailyLabels:', dailyLabels);
                    console.log('dailyOrdersData:', dailyOrdersData);
                    const ctx2 = document.getElementById('dailyOrdersChart').getContext('2d');
                    const dailyOrdersChart = new Chart(ctx2, {
                        type: 'line',
                        data: {
                            labels: dailyLabels,
                            datasets: [{
                                label: 'Daily Orders',
                                data: dailyOrdersData,
                                backgroundColor: 'rgba(59, 246, 190, 0.7)',
                                borderColor: 'rgba(59, 246, 190, 0.7)',
                                borderWidth: 1,
                                borderRadius: 5,
                                barPercentage: 0.6,
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    stepSize: 1,
                                    ticks: {
                                        precision: 0
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top'
                                }
                            }
                        }
                    });
                    const yearlyLabels = @json($yearlyLabels);
                    const yearlyOrders = @json($yearlyOrders);
                    const yearlyColors = [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                        '#9966FF', '#FF9F40', '#C9CBCF', '#00C49F',
                        '#FF6B6B', '#8E44AD', '#2ECC71', '#F39C12'
                    ];
                    const ctx3 = document.getElementById('yearlyOrdersChart').getContext('2d');
                    const yearlyChart = new Chart(ctx3, {
                        type: 'doughnut',
                        data: {
                            labels: yearlyLabels,
                            datasets: [{
                                label: 'Orders Per Year',
                                data: yearlyOrders,
                                backgroundColor: yearlyColors.slice(0, yearlyLabels.length), // استخدام نفس عدد الألوان مثل السنوات
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top'
                                }
                            }
                        }
                    });
                </script>
                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>
                <script>
                    lucide.createIcons();
                </script>
                <!-- Bootstrap core JavaScript-->
                <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
                <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                <!-- Core plugin JavaScript-->
                <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
                <!-- Custom scripts for all pages-->
                <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
                <script src="{{asset('js/Loading.js')}}"></script>
</body>

</html>