<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <audio id="receive-sound" src="https://assets.mixkit.co/sfx/preview/mixkit-positive-interface-beep-221.wav" preload="auto"></audio>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{asset('css/ChatClientSupplier.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <main style="padding-right: 0; padding-left:0; padding-top:0px;  ">
      <div id="chat-box" class="chat-box">
        <ul class="chat-list">
          @foreach($messages as $message)
          <li class="chat-bubble {{ $message->role === 'supplier' ? 'bubble-sender' : 'bubble-receiver' }} {{ $message->role === 'supplier' ? 'align-end text-right' : 'align-start text-left' }}">
            <strong class="sender-name">
              {{ $message->role === 'supplier' ? 'You' : $client->name }}
            </strong><br>
            @if($message->message)
            {{ $message->message }}
            @endif
            @if($message->image)
            <br>
            <img src="{{ asset('storage/'.$message->image) }}?t={{ time() }}"
              class="chat-image"
              alt="Chat image"
              onerror="retryImageLoad(this)">
            @endif
          </li>
          @endforeach
        </ul>
      </div>

      <!-- النموذج المعدل -->
      <form id="send-message-form" class="message-form-container" enctype="multipart/form-data">
        @csrf
        <div style=" display: flex; align-items: center; gap: 10px; width: 100%; height:30px ">
          <div style="flex: 1; position: relative;">
            <textarea name="message" id="message" placeholder="Write your message here..." class="message-input" style="height:0px; "></textarea>
            <label for="image" class="image-upload-btn" title="Attach Image" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
              <i class="fas fa-image"></i>
            </label>
            <input type="file" name="image" id="image" accept="image/*" style="display: none;">
          </div>

          <button style="width: fit-content; padding-top:10px;padding-bottom:10px ;margin-right:10px;" type="submit" id="send-btn" class="send-btn">
            <i class="fas fa-paper-plane"></i>
            <span id="loading-spinner" class="loading-spinner" style="display: none;">
              <i class="fas fa-spinner fa-spin"></i>
            </span>
          </button>
        </div>

        <div id="file-info" class="file-info" style="display: none; margin-top:30px;">
          <span id="file-name"></span>
          <button type="button" id="clear-image" class="clear-image-btn" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div id="image-preview-container"></div>
        <input type="hidden" name="id" id="receiver_id" value="{{ $client->id }}">
      </form>
      <!-- Pusher -->
      <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
      <script>
        // دالة للتمرير إلى آخر الرسائل
        function scrollToBottom() {
          const chatBox = document.getElementById('chat-box');
          chatBox.scrollTop = chatBox.scrollHeight;
        }

        // دالة لإعادة تحميل الصورة في حالة الخطأ
        function retryImageLoad(imgElement) {
          const originalSrc = imgElement.src.split('?')[0];
          let attempts = parseInt(imgElement.getAttribute('data-attempts')) || 0;

          if (attempts < 3) {
            attempts++;
            imgElement.setAttribute('data-attempts', attempts);
            imgElement.src = originalSrc + '?t=' + Date.now() + '&attempt=' + attempts;
          } else {
            console.error('Failed to load image after 3 attempts:', originalSrc);
          }
        }

        // دالة لتشغيل صوت عند استلام رسالة جديدة
        function playReceiveSound() {
          const sound = document.getElementById('receive-sound');
          if (sound) {
            sound.currentTime = 0;
            sound.play();
          }
        }

        // تهيئة Pusher للدردشة في الوقت الحقيقي
        Pusher.logToConsole = true;
        const pusher = new Pusher('24e1f355567319d1811a', {
          cluster: 'eu',
          forceTLS: true
        });

        const supplierId = "{{ session('supplier_user_id') }}";
        const clientId = "{{ $client->id }}";

        // الاشتراك في قناة Pusher
        const channel = pusher.subscribe('client');
        channel.bind('ClientSupplier-message', function(data) {
          console.log('Received message:', data);

          // التحقق من أن الرسالة موجهة لنا
          if (supplierId != data.receiver_id || clientId != data.sender_id || data.role != 'client') {
            return;
          }

          // عرض الرسالة الواردة
          appendMessage(data.Client.name, data.message, data.image_url);
          playReceiveSound();
          scrollToBottom();
        });

        // دالة لإضافة رسالة واردة إلى الشات
        function appendMessage(senderName, message, imageUrl) {
          const chatBox = document.querySelector('#chat-box ul');
          const messageItem = document.createElement('li');

          messageItem.className = senderName === 'You' ?
            'chat-bubble bubble-sender align-end text-right' :
            'chat-bubble bubble-receiver align-start text-left';

          let html = `<strong class="sender-name">${senderName}</strong><br>`;

          if (message) {
            html += message;
          }

          if (imageUrl) {
            if (message) {
              html += `<br>`;
            }
            html += `<img src="${imageUrl}?t=${Date.now()}" 
                   class="chat-image" 
                   alt="Chat image"
                   onerror="retryImageLoad(this)">`;
          }

          messageItem.innerHTML = html;
          chatBox.appendChild(messageItem);
          scrollToBottom();
        }

        // معاينة الصورة قبل الإرسال
        document.getElementById('image').addEventListener('change', function(e) {
          const fileInput = e.target;
          const fileNameSpan = document.getElementById('file-name');
          const fileInfoDiv = document.getElementById('file-info');
          const previewContainer = document.getElementById('image-preview-container');

          if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            fileNameSpan.textContent = file.name.substring(0, 10) + (file.name.length > 10 ? '...' : '');
            fileInfoDiv.style.display = 'flex';

            // إنشاء معاينة للصورة
            const reader = new FileReader();
            reader.onload = function(event) {
              previewContainer.innerHTML = '';
              const preview = document.createElement('img');
              preview.src = event.target.result;
              preview.className = 'image-preview';
              previewContainer.appendChild(preview);
            };
            reader.readAsDataURL(file);
          }
        });

        // مسح الصورة المحددة
        document.getElementById('clear-image').addEventListener('click', function() {
          document.getElementById('image').value = '';
          document.getElementById('file-name').textContent = '';
          document.getElementById('file-info').style.display = 'none';
          document.getElementById('image-preview-container').innerHTML = '';
        });

        // دالة لإضافة رسالة مرسلة إلى الشات
        function appendSentMessage(message, imageUrl) {
          const chatBox = document.querySelector('#chat-box ul');
          const messageItem = document.createElement('li');

          messageItem.className = 'chat-bubble bubble-sender align-end text-right';

          let html = `<strong class="sender-name">You</strong><br>`;

          if (message) {
            html += message;
          }

          if (imageUrl) {
            if (message) {
              html += `<br>`;
            }
            html += `<img src="${imageUrl}?t=${Date.now()}" 
                   class="chat-image" 
                   alt="Sent image"
                   onerror="retryImageLoad(this)">`;
          }

          messageItem.innerHTML = html;
          chatBox.appendChild(messageItem);
          scrollToBottom();
        }

        // دالة لمسح النموذج بعد الإرسال
        function resetForm() {
          document.getElementById('message').value = '';
          document.getElementById('image').value = '';
          document.getElementById('file-name').textContent = '';
          document.getElementById('file-info').style.display = 'none';
          document.getElementById('image-preview-container').innerHTML = '';
        }

        // إرسال الرسالة
        document.getElementById('send-message-form').addEventListener('submit', function(event) {
          event.preventDefault();

          const formData = new FormData(this);
          const message = formData.get('message');
          const imageFile = formData.get('image');

          // التحقق من وجود رسالة أو صورة
          if (!message && !imageFile) {
            Notiflix.Notify.Failure("Please enter a message or select an image to send");
            return;
          }

          // إظهار مؤشر التحميل
          const sendBtn = document.getElementById('send-btn');
          const spinner = document.getElementById('loading-spinner');
          sendBtn.disabled = true;
          spinner.style.display = 'inline';

          // إرسال البيانات إلى الخادم
          fetch('/send-message-supplier', {
              method: 'POST',
              body: formData,
              headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
              }
            })
            .then(response => {
              if (!response.ok) {
                throw new Error('Network response was not ok');
              }
              return response.json();
            })
            .then(data => {
              if (data.success) {
                // عرض الرسالة المرسلة
                appendSentMessage(data.message || '', data.image_url || '');
                resetForm();
              } else {
                throw new Error(data.message || 'Failed to send message');
              }
            })
            .catch(error => {
              console.error('Error:', error);
              Notiflix.Notify.Failure(error.message || 'An error occurred while sending the message');
            })
            .finally(() => {
              sendBtn.disabled = false;
              spinner.style.display = 'none';
            });
        });

        // التمرير إلى الأسفل عند تحميل الصفحة
        window.addEventListener('load', function() {
          scrollToBottom();
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