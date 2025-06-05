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
    <link rel="stylesheet" href="{{asset('css/ManageOrder.css')}}">
    <link rel="stylesheet" href="{{asset('css/DetailOrder.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>



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
            <!-- Boxicons CDN in <head> -->
            <div class="cards-container">
                <!-- Order Description -->
                <div class="modern-card">
                    <div class="modern-header">
                        <i class='bx bx-detail'></i>
                        Order Description
                    </div>
                    <p>{{ $TestOrder->order_description }}</p>
                    <hr style="margin: 20px 0; border-top: 1px solid #eee;">
                    <div style="display: flex; align-items: center; gap: 8px; color: #6b7280; margin-bottom: 8px;">
                        <i class='bx bx-calendar'></i>
                        <span>Created At: {{ $TestOrder->created_at->format('Y-m-d H:i') }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px; color: #6b7280;">
                        <i class='bx bx-wallet'></i>
                        <span>Order Payment: {{ number_format($TestOrder->price, 2) }} Dollar</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px; color: #f59e0b; margin-top: 6px; font-style: italic;">
                        <i class='bx bx-time-five'></i>
                        <span>Payment is currently pending in the system</span>
                    </div>
                </div>
                <!-- Selected Offers -->
                <div class="modern-card">
                    <div class="modern-header">
                        <i class='bx bx-gift'></i>
                        Selected Offers
                    </div>
                    @forelse($selectedOffers as $offer)
                    <div class="offer-item">
                        <i class='bx bx-check-circle'></i>
                        {{ $offer->title }}
                    </div>
                    @empty
                    <p class="empty-message">No offers selected.</p>
                    @endforelse
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script src="{{asset('js/Loading.js')}}"></script>
    <script src="{{asset('js/supplier-dashboard.js')}}"></script>
</body>

</html>