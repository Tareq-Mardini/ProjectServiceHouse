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
            <section id="orders">
                <div class="orders-container">
                    @foreach ($info as $data)
                    <div class="order-card">
                        <div class="order-status 
                            @if($data->supplier_status == 'acceptance') bg-green 
                            @elseif($data->supplier_status == 'completed') bg-blue 
                            @endif">
                            {{ $data->supplier_status }}
                        </div>
                        <div class="order-settings">
                            <i class='bx bx-dots-vertical-rounded' onclick="toggleDropdown(this)"></i>
                            <ul class="settings-dropdown">
                                <li>
                                    <a href="javascript:void(0);" onclick="confirmAction('accept', {{ $data->id }})">
                                        <i class='bx bx-check-circle' style="color: #10b981;"></i>
                                        Acceptance
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" onclick="confirmAction('reject', {{ $data->id }})">
                                        <i class='bx bx-x-circle' style="color: #ef4444;"></i>
                                        Rejection
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" onclick="confirmAction('completed', {{ $data->id }})">
                                        <i class='bx bx-task' style="color: #3b82f6;"></i>
                                        Completed
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="profile-image">
                            <img src="{{ Storage::url($data->client->image) }}" alt="User Image">
                        </div>
                        <h3>{{ $data->client->name }}</h3>
                        <p class="order-title">{{ $data->work->title }}</p>
                        <p class="price">Price: <span>${{ $data->price }} <i class="fa fa-dollar-sign"></i></span></p>
                        <a href="{{ url('ServiceHouse/Supplier/Dashboard/Order/' . $data->id) }}" class="details-button">View Details</a>
                    </div>
                    @endforeach
                </div>
            </section>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script>
        function toggleDropdown(icon) {
            const dropdown = icon.nextElementSibling;
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            // Close others
            document.querySelectorAll('.settings-dropdown').forEach(el => {
                if (el !== dropdown) el.style.display = 'none';
            });
        }
        // Close dropdown if clicked outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.order-settings')) {
                document.querySelectorAll('.settings-dropdown').forEach(el => {
                    el.style.display = 'none';
                });
            }
        });
    </script>
    @if(session('acceptance_order'))
    <script>
        Notiflix.Notify.success("{{ session('acceptance_order') }}");
    </script>
    @endif
    @if(session('already_acceptance_order'))
    <script>
        Notiflix.Notify.warning("{{ session('already_acceptance_order') }}");
    </script>
    @endif
    @if(session('rejection_order'))
    <script>
        Notiflix.Notify.success("{{ session('rejection_order') }}");
    </script>
    @endif
    @if(session('already_acceptance_order_after_accept'))
    <script>
        Notiflix.Notify.warning("{{ session('already_acceptance_order_after_accept') }}");
    </script>
    @endif
    @if(session('completed_order'))
    <script>
        Notiflix.Notify.success("{{ session('completed_order') }}");
    </script>
    @endif
    @if(session('error_completed_order'))
    <script>
        Notiflix.Notify.warning("{{ session('error_completed_order') }}");
    </script>
    @endif
    <script>
        function confirmAction(action, orderId) {
            let messages = {
                accept: {
                    title: 'Confirm Acceptance',
                    message: 'Are you sure you want to accept this order?',
                    url: '/ServiceHouse/Supplier/Dashboard/Order/Acceptance/' + orderId
                },
                reject: {
                    title: 'Confirm Rejection',
                    message: 'Are you sure you want to reject this order?',
                    url: '/ServiceHouse/Supplier/Dashboard/Order/Rejection/' + orderId
                },
                completed: {
                    title: 'Mark as Completed',
                    message: 'Are you sure the order is completed and ready to send to the client?',
                    url: '/ServiceHouse/Supplier/Dashboard/Order/Completed/' + orderId
                }
            };
            const selected = messages[action];
            Notiflix.Confirm.show(
                selected.title,
                selected.message,
                'Yes',
                'No',
                function okCb() {
                    window.location.href = selected.url;
                },
            );
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
    <script src="{{asset('js/Loading.js')}}"></script>
    <script src="{{asset('js/supplier-dashboard.js')}}"></script>
</body>

</html>