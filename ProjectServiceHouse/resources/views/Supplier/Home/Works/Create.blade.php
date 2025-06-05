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
      <div style="margin-top: -17px;" class="container ">
        <div class="form-container">
          <div style="height: 140px ; width:300px; margin-left:auto;margin-right:auto;">
            <img src="{{asset('images/mange_work/work_form-removebg-preview-transformed.png')}}" style="height: 140px ; width:300px; margin-left:auto;margin-right:auto;" alt="">
          </div>
          <form action="{{ route('Works.Store.Supplier') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <i class='bx bx-select-multiple' style='color:#1ab79d'></i>
              <label for="service_id">Service</label>
              <select name="service_id" id="service_id" required>
                <option value="" selected disabled>Choose a Service</option>
                @foreach ($data as $datas)
                <option value="{{ $datas->id }}" {{ old('service_id') == $datas->id ? 'selected' : '' }}>{{ $datas->name }}</option>
                @endforeach
              </select>
              @error('service_id')
              <div style="color: red; font-size: 13px;">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <i class='bx bx-captions' style='color:#1ab79d'></i>
              <label for="title">Title</label>
              <input type="text" id="title" name="title" required placeholder="Enter Title" value="{{ old('title') }}">
              @error('title')
              <div style="color: red; font-size: 13px;">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <i class='bx bxs-edit-alt' style='color:#1ab79d'></i>
              <label for="description">Description</label>
              <textarea id="description" name="description" rows="3" required placeholder="Enter Description">{{ old('description') }}</textarea>
              @error('description')
              <div style="color: red; font-size: 13px;">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <i class='bx bx-dollar-circle' style='color:#1ab79d'></i>
              <label for="price">Price</label>
              <input type="number" id="price" name="price" required placeholder="Enter Price" value="{{ old('price') }}">
              @error('price')
              <div style="color: red; font-size: 13px;">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <i class='bx bx-time' style='color:#1ab79d'></i>
              <label for="average_delivery_time">Average Delivery Time</label>
              <select id="average_delivery_time" name="Average_delivery_time" required>
                <option value="">Select delivery time (in days)</option>
                @for ($i = 1; $i <= 30; $i++)
                  <option value="{{ $i }}" {{ old('Average_delivery_time') == $i ? 'selected' : '' }}>
                  {{ $i }} day{{ $i > 1 ? 's' : '' }}
                  </option>
                  @endfor
                  <option value="other" {{ old('Average_delivery_time') == 'other' ? 'selected' : '' }}>Other</option>
              </select>
              <input type="number" min="1" id="custom_delivery_time" name="custom_delivery_time"
                placeholder="Enter delivery time in days"
                style="display: none; margin-top: 10px;"
                value="{{ old('custom_delivery_time') }}">
              @error('Average_delivery_time')
              <div style="color: red; font-size: 13px;">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <i class='bx bx-time-five' style='color:#1ab79d'></i>
              <label for="average_speed_of_response">Average Speed of Response</label>
              <select id="average_speed_of_response" name="Average_speed_of_response" required>
                <option value="">Select response speed (in hours)</option>
                @for ($i = 1; $i <= 24; $i++)
                  <option value="{{ $i }}" {{ old('Average_speed_of_response') == $i ? 'selected' : '' }}>
                  {{ $i }} hour{{ $i > 1 ? 's' : '' }}
                  </option>
                  @endfor
                  <option value="other" {{ old('Average_speed_of_response') == 'other' ? 'selected' : '' }}>Other</option>
              </select>
              <input type="number" min="1" id="custom_response_speed" name="custom_response_speed"
                placeholder="Enter response speed in hours"
                style="display: none; margin-top: 10px;"
                value="{{ old('custom_response_speed') }}">
              @error('Average_speed_of_response')
              <div style="color: red; font-size: 13px;">{{ $message }}</div>
              @enderror
            </div>
            <script>
              document.addEventListener('DOMContentLoaded', function() {
                const deliverySelect = document.getElementById('average_delivery_time');
                const deliveryInput = document.getElementById('custom_delivery_time');
                const responseSelect = document.getElementById('average_speed_of_response');
                const responseInput = document.getElementById('custom_response_speed');

                // Hidden fields to store final values
                const deliveryHidden = document.createElement('input');
                deliveryHidden.type = 'hidden';
                deliveryHidden.name = 'Average_delivery_time';
                deliverySelect.parentNode.appendChild(deliveryHidden);

                const responseHidden = document.createElement('input');
                responseHidden.type = 'hidden';
                responseHidden.name = 'Average_speed_of_response';
                responseSelect.parentNode.appendChild(responseHidden);

                function updateFields() {
                  if (deliverySelect.value === 'other') {
                    deliveryInput.style.display = 'block';
                    deliveryHidden.value = deliveryInput.value ? `${deliveryInput.value} days` : '';
                  } else {
                    deliveryInput.style.display = 'none';
                    deliveryHidden.value = deliverySelect.value ? `${deliverySelect.value} days` : '';
                  }

                  if (responseSelect.value === 'other') {
                    responseInput.style.display = 'block';
                    responseHidden.value = responseInput.value ? `${responseInput.value} hours` : '';
                  } else {
                    responseInput.style.display = 'none';
                    responseHidden.value = responseSelect.value ? `${responseSelect.value} hours` : '';
                  }
                }

                // Initial state
                updateFields();

                // Event listeners
                deliverySelect.addEventListener('change', updateFields);
                deliveryInput.addEventListener('input', updateFields);
                responseSelect.addEventListener('change', updateFields);
                responseInput.addEventListener('input', updateFields);
              });
            </script>

            <div class="form-group">
              <i class='bx bx-photo-album' style='color:#1ab79d'></i>
              <label for="thumbnail">Thumbnail</label>
              <input type="file" id="thumbnail" name="thumbnail" required>
              @error('thumbnail')
              <div style="color: red; font-size: 13px;">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <i class='bx bx-select-multiple' style='color:#1ab79d'></i>
              <label for="images">Additional Images</label>
              <input type="file" id="images" name="images[]" multiple>
              @error('images.*')
              <div style="color: red; font-size: 13px;">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <i class='bx bxl-youtube' style='color:#1ab79d'></i>
              <label for="youtube_link">YouTube Link</label>
              <input type="url" id="youtube_link" name="youtube_link" placeholder="https://www.youtube.com/watch?v=example" value="{{ old('youtube_link') }}">
              @error('youtube_link')
              <div style="color: red; font-size: 13px;">{{ $message }}</div>
              @enderror
            </div>
            <div id="extra-container">
              <label style="font-weight: bold; color: #1ab79d;">Extra Offers</label>
              <div class="extra-item-wrapper">
                <div class="form-group extra-item">
                  <i class='bx bx-cube' style='color:#1ab79d'></i>
                  <label>Title </label>
                  <input type="text" name="extras[0][title]" placeholder="Extra Title" value="{{ old('extras.0.title') }}">
                  @error('extras.0.title')
                  <div style="color: red; font-size: 13px;">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <i class='bx bx-dollar' style='color:#1ab79d'></i>
                  <label>Price </label>
                  <input type="number" step="0.01" name="extras[0][price]" placeholder="Extra Price" value="{{ old('extras.0.price') }}">
                  @error('extras.0.price')
                  <div style="color: red; font-size: 13px;">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <button style="border: #1ab79d;" type="button" class="btn-secondary" onclick="removeExtra(this)">❌</button>
                </div>
              </div>
            </div>
            <div class="form-group">
              <button type="button" onclick="addExtra()" class="btn-primary" style="margin-top: 10px;">Add Extra Offer</button>
            </div>
            <button type="submit" class="btn-primary">Create Work</button>
          </form>
          <script>
            let extraIndex = 1;

            function addExtra() {
              const container = document.getElementById('extra-container');
              const wrapper = document.createElement('div');
              wrapper.classList.add('extra-item-wrapper');
              wrapper.innerHTML = `
        <div class="form-group extra-item">
          <i class='bx bx-cube' style='color:#1ab79d'></i>
          <label>Title </label>
          <input type="text" name="extras[${extraIndex}][title]" placeholder="Extra Title">
        </div>
        <div class="form-group">
          <i class='bx bx-dollar' style='color:#1ab79d'></i>
          <label>Price </label>
          <input type="number" step="0.01" name="extras[${extraIndex}][price]" placeholder="Extra Price">
        </div>
        <div class="form-group">
          <button style="border: #1ab79d;" type="button" class="btn-secondary" onclick="removeExtra(this)">❌</button>
        </div>
        `;
              container.appendChild(wrapper);
              extraIndex++;
            }

            function removeExtra(button) {
              button.closest('.extra-item-wrapper').remove();
            }
          </script>
        </div>
      </div>
    </main>
  </section>
  <!--  المودل -->
  <div class="modal-overlay" id="modal-overlay">
    <div class="modal">
      <div class="modal-header">
        <div style="color: #1ab79d;" class="modal-title"> <i class='bx bx-error-alt bx-tada' style='color:#1ab79d ;margin-right: 8px;'></i>Form Entry Instructions</div>
        <span class="modal-close" onclick="closeModal()">×</span>
      </div>
      <div class="modal-content">
        <p><span>1-</span> Choose the service you want to work in.</p>
        <p><span>2-</span> Choose a suitable and brief title for the work.</p>
        <p><span>3-</span> Write a description of the work explaining what you can do and the skills that lead to attracting client to you.</p>
        <p><span>4-</span> Write the appropriate price for the work and for your information you cannot reduce the price of the work to less than two dollars.</p>
        <p><span>5-</span> Write the average time to deliver the work to the client.</p>
        <p><span>6-</span> Write the average time to respond to the client.</p>
        <p><span>7-</span> Choose a picture to display the work from the list of works supplier and make sure that the picture is attractive to clients.
        <p>
        <p><span>8-</span> Choose several pictures or one picture in which you explain the work you have.</p>
        <p><span>9-</span> If the work requires placing a link from YouTube explaining your work, that is okay.</p>
      </div>
      <div class="modal-footer">
        <button class="modal-button" onclick="closeModal()">Close</button>
      </div>
    </div>
  </div>
  <script>
    window.onload = function() {
      setTimeout(function() {
        document.getElementById('modal-overlay').classList.add('show');
      }, 1000);
    };

    function closeModal() {
      document.getElementById('modal-overlay').classList.remove('show');
    }
  </script>
  <script src="{{asset('js/supplier-dashboard.js')}}"></script>
  <script src="{{asset('js/Loading.js')}}"></script>
</body>

</html>