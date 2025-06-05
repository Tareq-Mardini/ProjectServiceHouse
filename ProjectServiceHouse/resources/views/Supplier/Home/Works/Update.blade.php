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
  <link rel="icon" href="{{asset('images/visitor/logo-3.png')}}" type="image/png">
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
              <i class='bx bx-select-multiple' style='color:#1ab79d'></i>
              <label for="service_id">Service</label>
              <select name="service_id" id="service_id" required>
                @foreach ($work_Service as $service)
                <option value="{{ $service->id }}" {{ $service->id == $work->service_id ? 'selected' : '' }}>
                  {{ $service->name }}
                </option>
                @endforeach
              </select>
              @error('service_id')
              <small style="color: red;">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <i class='bx bx-captions' style='color:#1ab79d'></i>
              <label for="title">Title</label>
              <input type="text" id="title" name="title" required value="{{ old('title', $work->title) }}" placeholder="Enter Title">
              @error('title')
              <small style="color: red;">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <i class='bx bx-data' style='color:#1ab79d'></i>
              <label for="description">Description</label>
              <textarea id="description" name="description" rows="3" required placeholder="Enter Description">{{ old('description', $work->description) }}</textarea>
              @error('description')
              <small style="color: red;">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <i class='bx bx-dollar-circle' style='color:#1ab79d'></i>
              <label for="price">Price</label>
              <input type="number" id="price" name="price" required value="{{ old('price', $work->price) }}" placeholder="Enter Price">
              @error('price')
              <small style="color: red;">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <i class='bx bx-time' style='color:#1ab79d'></i>
              <label for="average_delivery_time_select">Average Delivery Time</label>
              <select id="average_delivery_time_select" required>
                <option value="">Select delivery time (in days)</option>
                @for ($i = 1; $i <= 30; $i++)
                  <option value="{{ $i }} days" {{ (old('Average_delivery_time', $work->Average_delivery_time) == "$i days") ? 'selected' : '' }}>
                  {{ $i }} day{{ $i > 1 ? 's' : '' }}
                  </option>
                  @endfor
                  <option value="other" {{ !preg_match('/^\d+ days$/', old('Average_delivery_time', $work->Average_delivery_time)) ? 'selected' : '' }}>
                    Other
                  </option>
              </select>
              <input type="number" min="1" id="custom_delivery_time" placeholder="Enter delivery time in days"
                style="display: none; margin-top: 10px;"
                value="{{ preg_match('/^\d+ days$/', old('Average_delivery_time', $work->Average_delivery_time)) ? '' : (int) filter_var(old('Average_delivery_time', $work->Average_delivery_time), FILTER_SANITIZE_NUMBER_INT) }}">
              <input type="hidden" name="Average_delivery_time" id="average_delivery_time"
                value="{{ old('Average_delivery_time', $work->Average_delivery_time) }}">
              @error('Average_delivery_time')
              <small style="color: red;">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <i class='bx bx-time-five' style='color:#1ab79d'></i>
              <label for="average_speed_of_response_select">Average Speed of Response</label>
              <select id="average_speed_of_response_select" required>
                <option value="">Select response speed (in hours)</option>
                @for ($i = 1; $i <= 24; $i++)
                  <option value="{{ $i }} hours" {{ (old('Average_speed_of_response', $work->Average_speed_of_response) == "$i hours") ? 'selected' : '' }}>
                  {{ $i }} hour{{ $i > 1 ? 's' : '' }}
                  </option>
                  @endfor
                  <option value="other" {{ !preg_match('/^\d+ hours$/', old('Average_speed_of_response', $work->Average_speed_of_response)) ? 'selected' : '' }}>
                    Other
                  </option>
              </select>
              <input type="number" min="1" id="custom_response_speed" placeholder="Enter response speed in hours"
                style="display: none; margin-top: 10px;"
                value="{{ preg_match('/^\d+ hours$/', old('Average_speed_of_response', $work->Average_speed_of_response)) ? '' : (int) filter_var(old('Average_speed_of_response', $work->Average_speed_of_response), FILTER_SANITIZE_NUMBER_INT) }}">
              <input type="hidden" name="Average_speed_of_response" id="average_speed_of_response"
                value="{{ old('Average_speed_of_response', $work->Average_speed_of_response) }}">
              @error('Average_speed_of_response')
              <small style="color: red;">{{ $message }}</small>
              @enderror
            </div>
            <script>
              document.addEventListener('DOMContentLoaded', function() {
                const deliverySelect = document.getElementById('average_delivery_time_select');
                const deliveryInput = document.getElementById('custom_delivery_time');
                const deliveryHidden = document.getElementById('average_delivery_time');
                const responseSelect = document.getElementById('average_speed_of_response_select');
                const responseInput = document.getElementById('custom_response_speed');
                const responseHidden = document.getElementById('average_speed_of_response');

                function updateDelivery() {
                  if (deliverySelect.value === 'other') {
                    deliveryInput.style.display = 'block';
                    deliveryHidden.value = deliveryInput.value ? `${deliveryInput.value} days` : '';
                  } else {
                    deliveryInput.style.display = 'none';
                    deliveryHidden.value = deliverySelect.value;
                  }
                }

                function updateResponse() {
                  if (responseSelect.value === 'other') {
                    responseInput.style.display = 'block';
                    responseHidden.value = responseInput.value ? `${responseInput.value} hours` : '';
                  } else {
                    responseInput.style.display = 'none';
                    responseHidden.value = responseSelect.value;
                  }
                }
                updateDelivery();
                updateResponse();
                deliverySelect.addEventListener('change', updateDelivery);
                deliveryInput.addEventListener('input', updateDelivery);
                responseSelect.addEventListener('change', updateResponse);
                responseInput.addEventListener('input', updateResponse);
              });
            </script>
            <div class="form-group">
              <i class='bx bx-photo-album' style='color:#1ab79d'></i>
              <label for="thumbnail">Thumbnail</label>
              <input type="file" id="thumbnail" name="thumbnail">
              @error('thumbnail')
              <small style="color: red;">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <i class='bx bx-select-multiple' style='color:#1ab79d'></i>
              <label for="images">Additional Images</label>
              <input type="file" id="images" name="images[]" multiple>
              @error('images.*')
              <small style="color: red;">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <i class='bx bxl-youtube' style='color:#1ab79d'></i>
              <label for="youtube_link">YouTube Link</label>
              <input type="url" id="youtube_link" name="youtube_link" value="{{ old('youtube_link', $work->youtube_link) }}" placeholder="https://www.youtube.com/watch?v=example">
              @error('youtube_link')
              <small style="color: red;">{{ $message }}</small>
              @enderror
            </div>
            <button type="submit" class="btn-primary">Update Work</button>
          </form>
        </div>
      </div>
    </main>
  </section>
  <script src="{{asset('js/Loading.js')}}"></script>
  <script src="{{asset('js/supplier-dashboard.js')}}"></script>
</body>

</html>