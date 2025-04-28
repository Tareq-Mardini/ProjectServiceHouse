<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/visitor.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('css/visitor-sections.css')}}">
    <link rel="icon" href="{{asset('images/visitor/logo-3.png')}}" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
    <title>Service House</title>
</head>

<body id="top">
    <header class="header" data-header>
        <div class="container">
            <a href="#" class="logo">
                <img src="{{asset('images/visitor/logo-3.png')}}" width="150" height="40" alt="EduWeb logo" style="margin-left: 70px;">
            </a>
            <nav class="navbar" data-navbar>
                <div class="wrapper">
                    <a href="#" class="logo">
                        <img src="{{asset('images/visitor/logo.png')}}" width="162" height="40" alt="EduWeb logo">
                    </a>
                    <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
                        <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
                    </button>
                </div>
                <ul class="navbar-list">
                    <li class="navbar-item">
                        <a href="{{route('ServiceHouse.Home.Client')}}" class="navbar-link" data-nav-link>Home</a>
                    </li>
                    <li class="navbar-item">
                        <a href="{{route('ServiceHouse.Home.Client')}}" class="navbar-link" data-nav-link>Benefits</a>
                    </li>
                    <li class="navbar-item">
                        <a href="{{route('ServiceHouse.Home.Client')}}" class="navbar-link" data-nav-link>About</a>
                    </li>
                    <li class="navbar-item">
                        <a href="{{route('ServiceHouse.Home.Client')}}" class="navbar-link" data-nav-link>Sections</a>
                    </li>
                    <li class="navbar-item">
                        <a href="{{route('ServiceHouse.Home.Client')}}" class="navbar-link" data-nav-link>Contact</a>
                    </li>
                    <li class="navbar-item">
                        <button style="width: 120px;" class="option-btn" id="customerBtn">
                            <a href="{{route('ServiceHouse.Client.Settings')}}">Settings</a>
                            <i class='bx bx-cog bx-spin'></i>
                        </button>
                    </li>
                </ul>
            </nav>
            <div class="header-actions">
                <button class="header-action-btn" aria-label="open menu" data-nav-toggler>
                    <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
                </button>
            </div>
            <div class="overlay" data-nav-toggler data-overlay></div>
        </div>
    </header>
    <main>

        <body>
            <div class="container" style="margin-top: 170px; display: flex; flex-wrap: wrap; gap: 30px; justify-content: center;">

                <!-- السعر الأساسي -->
                @if ($offers->count())
                <div class="card" style="flex: 1; min-width: 280px; background: #fff; border-radius: 20px; padding: 25px; box-shadow: 0px 8px 20px rgba(0,0,0,0.08); text-align: center;">
                    <h2 style="color:#ee4962; margin-bottom: 15px;">
                        <i style="color: #1ab79d;" class='bx bxs-dollar-circle'></i> Base Price
                    </h2>
                    <div style="font-size: 24px; font-weight: bold;">
                        <span id="basePrice">{{ $works->price }}$</span>
                    </div>
                </div>
                @endif

                <!-- العروض الإضافية -->
                @if ($offers->count())
                <div class="card" style="flex: 1; min-width: 300px; background: linear-gradient(135deg, #ffffff, #f0f0f0); border-radius: 20px; padding: 25px; box-shadow: 0px 8px 20px rgba(0,0,0,0.08); text-align: right; ">
                    <h2 style="color: #ee4962; text-align:center; margin-bottom: 20px;">
                        <i style="color: #1ab79d;" class='bx bx-gift'></i> Additional offers
                    </h2>
                    @foreach ($offers as $offer)
                    <div style="border: 1px solid #ddd; border-radius: 15px; padding: 15px; margin-bottom: 15px; background: #fff; transition: 0.3s; display: flex; gap: 12px; align-items: flex-start; cursor: pointer;">
                        <input type="checkbox" class="extra-offer-checkbox" value="{{ $offer->price }}" data-id="{{ $offer->id }}" style="transform: scale(1.3); accent-color: #ee4962;">
                        <div>
                            <strong style="font-size: 18px;"><i class='bx bxs-star' style='color:#f5c518'></i> {{ $offer->title }}</strong>
                            <p style="margin: 5px 0 0; color: #666; font-size: 14px;">
                                <i class='bx bxs-dollar-circle' style='color:#1ab79d'></i> {{ $offer->price }}$
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- السعر النهائي -->
                <div class="card" style="flex: 1; min-width: 280px; background: #fff; border-radius: 20px; padding: 25px; box-shadow: 0px 8px 20px rgba(0,0,0,0.08); text-align: center;">
                    <h2 style="color:#ee4962; margin-bottom: 15px;">
                        <i style="color: #1ab79d;" class='bx bx-calculator'></i> Total Price
                    </h2>
                    <div style="font-size: 24px; font-weight: bold;">
                        <span id="totalPrice">{{ $works->price }}$</span>
                    </div>
                </div>
            </div>

            <!-- نموذج الدفع -->
            <form action="{{ route('test') }}" method="POST" style="margin-top: 30px; max-width: 500px; margin-left:auto; margin-right:auto; background: #fff; padding: 30px; border-radius: 20px; box-shadow: 0px 8px 20px rgba(0,0,0,0.08);">
                @csrf
                <input type="hidden" name="total_price" id="hiddenTotalPrice" value="{{ $works->price }}">
                <input type="hidden" name="id_supplier" value="{{ $works->supplier->id }}">
                <input type="hidden" name="id_work" value="{{ $works->id }}">
                <input type="hidden" name="selected_offers" id="selectedOffers">
                <input type="text" name="wallet_number" placeholder="Wallet Number" style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 10px;">
                <input type="text" name="order_description" placeholder="Order Description" style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 10px;">
                <input type="password" name="wallet_password" placeholder="Wallet Password" style="width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 10px;">
                <button type="submit" style="width: 100%; padding: 15px; background-color: #1ab79d; color: white; font-size: 18px; border: none; border-radius: 12px; transition: 0.3s;">أرسل</button>
            </form>

            <!-- سكربت حساب السعر -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const basePrice = parseFloat(document.getElementById('basePrice').textContent);
                    const totalPriceElement = document.getElementById('totalPrice');
                    const hiddenInput = document.getElementById('hiddenTotalPrice');
                    const selectedOffersInput = document.getElementById('selectedOffers');
                    const checkboxes = document.querySelectorAll('.extra-offer-checkbox');

                    function updateTotal() {
                        let total = basePrice;
                        let selectedIds = [];

                        checkboxes.forEach(checkbox => {
                            if (checkbox.checked) {
                                total += parseFloat(checkbox.value);
                                selectedIds.push(checkbox.getAttribute('data-id'));
                            }
                        });

                        totalPriceElement.textContent = total.toFixed(2) + '$';
                        hiddenInput.value = total.toFixed(2);
                        selectedOffersInput.value = selectedIds.join(',');
                    }

                    checkboxes.forEach(checkbox => {
                        checkbox.addEventListener('change', updateTotal);
                    });
                });
            </script>
        </body>
    </main>

    <a href="#top" class="back-top-btn" aria-label="back top top" data-back-top-btn>
        <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
    </a>
    <script src="{{asset('js/Loading.js')}}"></script>
    <script src="{{asset('js/visitor.js')}}" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>