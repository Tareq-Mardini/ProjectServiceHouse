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

    <link rel="stylesheet" href="{{asset('css/visitor-sections.css')}}">
    <link rel="stylesheet" href="{{asset('css/SupplierWork.css')}}">
    <link rel="icon" href="{{asset('images/visitor/logo-3.png')}}" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/Search.css')}}">
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
        <div class="container" style="margin-top: 160px;">
            <h2 class="h2 section-title"><span class="span">Works <i class="fa fa-cogs" aria-hidden="true"></i></span></h2>
            <!-- 🔍 Search input -->
            <div class="search-container">
                <input type="text" id="worksSearch" placeholder="Search a work by title..." />
                <ion-icon name="search-outline" class="search-icon"></ion-icon>
            </div>

            <div class="Section">
                @foreach ($data as $work)
                <div class="content-section" data-name="{{ strtolower($work->title) }}">
                    <img src="{{ Storage::url($work->thumbnail) }}" alt="Work Thumbnail" class="work-thumbnail">
                    <div class="text">
                        <h3>{{ $work->title }}</h3>
                        <p>price:
                            <span style="display: inline; color:green; font-size:15px;">{{ $work->price }} <i class="fa fa-dollar-sign"></i></span>
                        </p>
                        <div class="info-supplier" style="display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; align-items: center;">
                                <img class="image-supplier" src="{{ Storage::url($work->supplier->image) }}" alt="Supplier Image">
                                <span class="supplier-name">{{ $work->supplier->name }}</span>
                            </div>
                            <!-- زر القلب -->
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
        <script>
            const worksSearchInput = document.getElementById('worksSearch');
            const works = document.querySelectorAll('.Section .content-section');
            worksSearchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();
                works.forEach(work => {
                    const name = work.dataset.name;
                    if (name.includes(query)) {
                        work.classList.remove('hidden');
                    } else {
                        work.classList.add('hidden');
                    }
                });
            });
        </script>
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
    <script src="{{asset('js/Loading.js')}}"></script>
    <script src="{{asset('js/visitor.js')}}" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>