<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('css/supplier-dashboard.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/CreateWork.css')}}">
</head>


<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="logo">
            <img src="{{asset('images/visitor/logo-3.png')}}" width="150" height="100" alt="EduWeb logo" style="margin-left: 70px; margin-top:20px">
        </a>
        <ul style="margin-top:0px" class="side-menu top">
            <li class="active">
                <a href="#">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">My Profile</span>
                </a>
            </li>
            <li>
                <a href="{{route('Supplier.Show.Myworks')}}">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">My works</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Analytics</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">Message</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-group'></i>
                    <span class="text">Mange Order</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="#" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
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
        <main style="background-color: #eeeeee;">
            <div style="margin-top: -17px;" class="container">
                <div class="form-container">
                    <div style="height: 145px; width:330px; margin-left:auto; margin-right:auto;">
                        <img src="{{asset('images/mange_work/update_work-removebg-preview-transformed.png')}}" style="height: 140px; width:300px; margin-left:auto; margin-right:auto;" alt="">
                    </div>
                    <form action="{{ route('Supplier.Update.Myworks', $work->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                        <i class='bx bx-select-multiple' style='color:#1ab79d' ></i>
                            <label for="service_id">Service</label>
                            <select name="service_id" id="service_id" required>
                                @foreach ($work_Service as $service)
                                <option value="{{ $service->id }}" {{ $service->id == $work->service_id ? 'selected' : '' }}>
                                    {{ $service->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <i class='bx bx-captions' style='color:#1ab79d' ></i>
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" required value="{{ old('title', $work->title) }}" placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                        <i class='bx bx-data' style='color:#1ab79d'  ></i>
                            <label for="description">Description</label>
                            <textarea id="description" name="description" rows="3" required placeholder="Enter Description">{{ old('description', $work->description) }}</textarea>
                        </div>
                        <div class="form-group">
                        <i class='bx bx-dollar-circle' style='color:#1ab79d'  ></i>
                            <label for="price">Price</label>
                            <input type="number" id="price" name="price" required value="{{ old('price', $work->price) }}" placeholder="Enter Price">
                        </div>
                        <div class="form-group">
                        <i class='bx bx-time' style='color:#1ab79d'  ></i>
                            <label for="average_delivery_time">Average Delivery Time</label>
                            <input type="text" id="average_delivery_time" name="Average_delivery_time" required value="{{ old('Average_delivery_time', $work->Average_delivery_time) }}" placeholder="Enter Average Delivery Time">
                        </div>
                        <div class="form-group">
                        <i class='bx bx-time-five' style='color:#1ab79d' ></i>
                            <label for="average_speed_of_response">Average Speed of Response</label>
                            <input type="text" id="average_speed_of_response" name="Average_speed_of_response" required value="{{ old('Average_speed_of_response', $work->Average_speed_of_response) }}" placeholder="Enter Average Speed of Response">
                        </div>
                        <div class="form-group">
                        <i class='bx bx-photo-album' style='color:#1ab79d' ></i>
                            <label for="thumbnail">Thumbnail</label>
                            <input type="file" id="thumbnail" name="thumbnail">
                        </div>
                        <div class="form-group">
                        <i class='bx bx-select-multiple' style='color:#1ab79d' ></i>
                            <label for="images">Additional Images</label>
                            <input type="file" id="images" name="images[]" multiple>
                        </div>
                        <div class="form-group">
                        <i class='bx bxl-youtube' style='color:#1ab79d' ></i>
                            <label for="youtube_link">YouTube Link</label>
                            <input type="url" id="youtube_link" name="youtube_link" value="{{ old('youtube_link', $work->youtube_link) }}" placeholder="https://www.youtube.com/watch?v=example">
                        </div>
                        <button type="submit" class="btn-primary">Update Work</button>
                    </form>
                </div>
            </div>
        </main>
    </section>
    <script src="{{asset('js/supplier-dashboard.js')}}"></script>
</body>

</html>