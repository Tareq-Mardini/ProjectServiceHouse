<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link rel="stylesheet" href="{{asset('css/ViewFavoriate.css')}}">
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Service House</title>
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="logo">
            <img src="{{asset('images/visitor/logo-3.png')}}" width="150" height="100" alt="EduWeb logo" style="margin-left: 70px; margin-top:20px">
        </a>
        @include('Client.Settings.sidebar')

    </section>
    <!-- SIDEBAR -->
    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <div>
                <a style="color: white;" class="home-page" href="{{route('ServiceHouse.Home.Client')}}">Home Page <i class='bx bx-right-arrow-alt'></i> </a>
            </div>
        </nav>
        <!-- NAVBAR -->
        <!-- MAIN -->
        <main>
            <div class="container" >
                <div class="Section">
                    @foreach ($data as $work)
                    <div style="padding: 10px;" class="content-section">
                        <img src="{{ Storage::url($work->thumbnail) }}" alt="Work Thumbnail" class="work-thumbnail">
                        <div class="text">
                            <h3>{{ $work->title }}</h3>
                            <p>price:
                                <span style="display: inline; color:green; font-size:15px;">{{ $work->price }}<i class="fa fa-dollar-sign"></i></span>
                            </p>
                            <div class="info-supplier" style="display: flex; justify-content: space-between; align-items: center;">
                                <div style="display: flex; align-items: center;">
                                    <img style="margin-right: 4px;" class="image-supplier" src="{{ Storage::url($work->supplier->image) }}" alt="Supplier Image">
                                    <span style="font-size: 15px;" class="supplier-name">{{ $work->supplier->name }}</span>
                                </div>
                                <i class="fa fa-heart favorite-icon"
                                    data-work-id="{{ $work->id }}"
                                    style="color: {{ in_array($work->id, $favorites) ? 'red' : 'gray' }}; cursor: pointer;"
                                    title="Add to Favorites"></i>
                            </div>
                            <a href="{{ route('Works.info.Client', ['id' => $work->id]) }}">
                                <button class="info-button">View Info</button>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </main>
        <a href="#top" class="back-top-btn" aria-label="back top top" data-back-top-btn>
            <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
        </a>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const favoriteIcons = document.querySelectorAll('.favorite-icon');
                favoriteIcons.forEach(icon => {
                    icon.addEventListener('click', function() {
                        const workId = this.dataset.workId;
                        fetch(`/favorite/${workId}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({})
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'added') {
                                    this.style.color = 'red';
                                    Notiflix.Notify.success("Added to favorites");
                                } else if (data.status === 'removed') {
                                    this.style.color = 'gray';
                                    Notiflix.Notify.warning("Removed from favorites");
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    });
                });
            });
        </script>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script src="{{asset('js/Loading.js')}}"></script>
    <script src="{{asset('js/supplier-dashboard.js')}}"></script>
</body>

</html>