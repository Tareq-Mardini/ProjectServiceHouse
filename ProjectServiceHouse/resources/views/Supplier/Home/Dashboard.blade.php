<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Boxicons -->
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <!-- My CSS -->
  <link rel="stylesheet" href="{{asset('css/supplier-dashboard.css')}}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
    rel="stylesheet">
  <link rel="icon" href="{{asset('images/visitor/logo-3.png')}}" type="image/png">
  <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/SupplierDashboard.css') }}">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Service House</title>
</head>

<body>
  <!-- SIDEBAR -->
  <section id="sidebar">
    <a href="#" class="logo">
      <img src="{{asset('images/visitor/logo-3.png')}}" width="150" height="100" alt="EduWeb logo" style="margin-left: 70px; margin-top:20px">
    </a>
    @include('Supplier.Home.sidebar')

  </section>
  <!-- SIDEBAR -->
  <!-- CONTENT -->
  <section id="content">
    <!-- NAVBAR -->
    <nav>
      <i class='bx bx-menu'></i>
      <div>
        <a style="color: white;" class="home-page" href="{{route('ServiceHouse.Home.Supplier')}}">Home Page <i class='bx bx-right-arrow-alt'></i> </a>
      </div>
    </nav>
    <!-- NAVBAR -->
    <!-- MAIN -->
    <main>
      <div style="margin-top: -30px;" class="stat-card-wrapper">
        @foreach ($stats as $card)
        <div class="stat-card {{ $card['color'] }} animate-card" style="animation-delay: {{ $loop->index * 0.1 }}s;">
          <div class="icon">
            <i data-lucide="{{ $card['icon'] }}"></i>
          </div>
          <div class="details">
            <h6>{{ $card['label'] }}</h6>
            <h2>{{ number_format($card['value']) }}</h2>
          </div>
        </div>
        @endforeach
      </div>
      <h2 style=" text-align:center;margin-top:-5px"><i style="color: #ee4962;" data-lucide="trending-up"></i> Monthly<span style="color: #ee4962;"> Earnings</span></h2>
      <hr style="margin-top: 10px;">

      <canvas style="margin-top:20px" id="earningsChart" width="400" height="200"></canvas>
      <hr>
      <h2 style=" text-align:center;margin-top:10px"><i style="color: #ee4962;" data-lucide="trending-up"></i> Year<span style="color: #ee4962;"> Earnings</span></h2>
      <hr style="margin-top: 10px;">

      <div style="width: 100%; max-width: 700px; margin: auto;">
        <canvas id="earningsYearlyChart"></canvas>
      </div>
      <hr>

      <script>
        const ctxMonthly = document.getElementById('earningsChart').getContext('2d');

        const earningsChart = new Chart(ctxMonthly, {
          type: 'line',
          data: {
            labels: @json($earningsChartData['labels']),
            datasets: [{
              label: 'Monthly Earnings',
              data: @json($earningsChartData['data']),
              backgroundColor: 'rgba(54, 162, 235, 0.2)',
              borderColor: 'rgba(54, 162, 235, 1)',
              borderWidth: 2,
              fill: true,
              tension: 0.3
            }]
          },
          options: {
            responsive: true,
            scales: {
              y: {
                beginAtZero: true,
                title: {
                  display: true,
                  text: 'Earnings (in your currency)'
                }
              },
              x: {
                title: {
                  display: true,
                  text: 'Month'
                }
              }
            }
          }
        });
      </script>

      <script>
        const ctxYearly = document.getElementById('earningsYearlyChart').getContext('2d');

        const earningsYearlyChart = new Chart(ctxYearly, {
          type: 'bar',
          data: {
            labels: @json($earningsChartDataYearly['labels']),
            datasets: [{
              label: 'Yearly Earnings',
              data: @json($earningsChartDataYearly['data']),
              backgroundColor: 'rgba(54, 162, 235, 0.7)',
              borderColor: 'rgba(54, 162, 235, 1)',
              borderWidth: 1,
              borderRadius: 6,
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
                ticks: {
                  callback: function(value) {
                    return '$' + value.toLocaleString();
                  }
                }
              }
            },
            plugins: {
              legend: {
                display: true,
                labels: {
                  font: {
                    size: 14
                  }
                }
              },
              tooltip: {
                callbacks: {
                  label: function(context) {
                    return '$' + context.parsed.y.toLocaleString();
                  }
                }
              }
            }
          }
        });
      </script>

    </main>
    <!-- MAIN -->
    <script>
      lucide.createIcons();
    </script>
  </section>
  <!-- CONTENT -->
  <script src="{{asset('js/Loading.js')}}"></script>
  <script src="{{asset('js/supplier-dashboard.js')}}"></script>
</body>

</html>