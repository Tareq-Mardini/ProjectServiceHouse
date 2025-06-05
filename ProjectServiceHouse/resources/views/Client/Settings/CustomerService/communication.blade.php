<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- My CSS -->
    <link rel="stylesheet" href="{{asset('css/supplier-dashboard.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="{{asset('images/visitor/logo-3.png')}}" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/ChatClientSupplier.css')}}">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Service House</title>
    <style>
        .image-preview {
            max-width: 100px;
            max-height: 100px;
            margin-top: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .loading-spinner {
            display: none;
            color: #007bff;
        }

        /* التنسيق الجديد لصندوق الإرسال */
        .message-form-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }

        .message-input-container {
            display: flex;
            gap: 10px;
            align-items: flex-end;
        }

        .message-input-wrapper {
            flex-grow: 1;
        }

        .message-input {
            width: 100%;
            min-height: 80px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            resize: none;
        }

        .image-upload-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        .image-upload-btn {
            background: #f0f0f0;
            border: 1px dashed #ccc;
            border-radius: 8px;
            padding: 10px;
            cursor: pointer;
            text-align: center;
            width: 60px;
            height: 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }



        .image-upload-btn i {
            font-size: 20px;
            color: #007bff;
        }

        .send-btn-container {
            display: flex;
            justify-content: flex-end;
        }

        .send-btn {
            padding: 8px 16px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
        }

        .clear-image-btn {
            background: none;
            border: none;
            color: #ff0000;
            cursor: pointer;
            padding: 0;
        }

        .image-preview {
            max-width: 100px;
            max-height: 100px;
            margin-top: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .loading-spinner {
            display: none;
            color: #007bff;
        }

        /* التنسيق الجديد */
        .message-form-container {
            position: relative;
            margin-top: 20px;
        }

        .message-input-wrapper {
            position: relative;
        }

        .message-input {
            width: 100%;
            min-height: 80px;
            padding: 10px 50px 10px 10px;
            /* زيادة padding لليمين لأيقونة الصورة */
            border-radius: 8px;
            border: 1px solid #ccc;
            resize: none;
            box-sizing: border-box;
        }

        .image-upload-btn {
            position: absolute;
            right: 10px;
            bottom: 10px;
            background: none;
            border: none;
            color: #007bff;
            cursor: pointer;
            font-size: 20px;
            padding: 5px;
        }

        .send-btn-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        .send-btn {
            padding: 8px 16px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            margin-top: 5px;
        }

        .clear-image-btn {
            background: none;
            border: none;
            color: #ff0000;
            cursor: pointer;
            padding: 0;
        }
    </style>
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
        <main style="padding:0px ;margin:0px;max-height: 598px;min-height: 598px;">
            <div id="chat-box" class="chat-box">
                <ul class="chat-list">
                    @foreach($messages as $message)
                    <li class="chat-bubble {{ $message->receiver_id == 0 ? 'bubble-sender' : 'bubble-receiver' }} {{ $message->receiver_id == 0 ? 'align-end text-right' : 'align-start text-left' }}">
                        <strong class="sender-name">
                            {{ $message->receiver_id == 0 ?   'You' : 'Customer Service'}}
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
            <form id="send-message-form" class="message-form-container" enctype="multipart/form-data">
                @csrf
                <div class="message-input-wrapper" style="display: flex; align-items: center; width: 100%; margin-top:-20px;">
                    <!-- Textarea -->
                    <textarea name="message" id="message" placeholder="Write your message here..."
                        class="message-input"
                        style="flex: 1; min-height: 50px; resize: none; padding-right: 40px;"></textarea>
                    <!-- ديف الأيقونة -->
                    <div class="image-upload-container" style="position: absolute; right: 80px; cursor: pointer; display: flex; align-items: center; top: 50%; transform: translateY(-50%);">
                        <label for="image" class="image-upload-btn" title="Attach Image">
                            <i style="margin-top: 85px; margin-left:80px;font-size:100%;" class="fas fa-image fa-lg"></i>
                        </label>
                        <input type="file" name="image" id="image" accept="image/*" style="display: none;">
                    </div>
                    <!-- ديف زر الإرسال -->
                    <div class="send-btn-container" style="margin-left: 10px;">
                        <button type="submit" id="send-btn" class="send-btn" style="padding: 8px 12px; display: flex; align-items: center;">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
                <!-- تحميل وانتظار -->
                <span id="loading-spinner" class="loading-spinner" style="display: none; margin-top: 5px;">
                    <i class="fas fa-spinner fa-spin"></i>
                </span>
                <!-- معلومات الملف -->
                <div id="file-info" class="file-info" style="display: none; margin-top: 5px;">
                    <span id="file-name"></span>
                    <button type="button" id="clear-image" class="clear-image-btn" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!-- معاينة الصورة -->
                <div id="image-preview-container" style="margin-top: 10px;"></div>
            </form>
            <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
            <script>
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
                Pusher.logToConsole = true;
                const pusher = new Pusher('24e1f355567319d1811a', {
                    cluster: 'eu',
                    forceTLS: true
                });
                const clientId = "{{ $client->id }}";
                const channel = pusher.subscribe('AdminToClient');
                channel.bind('AdminClient-message', function(data) {
                    console.log('Received message:', data);
                    // التحقق من أن الرسالة موجهة لنا
                    if (clientId == data.receiver_id && data.role == 'client') {
                        appendMessage('Customer Service', data.message, data.image_url);
                        scrollToBottom();
                    }
                });

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
                document.getElementById('send-message-form').addEventListener('submit', function(event) {
                    event.preventDefault();
                    let formData = new FormData(this);
                    let message = formData.get('message');
                    let imageFile = formData.get('image');
                    // Validate that either message or image exists
                    if (!message && !imageFile) {
                        alert("Please enter a message or select an image to send");
                        return;
                    }
                    // Show loading spinner
                    const sendBtn = document.getElementById('send-btn');
                    const spinner = document.getElementById('loading-spinner');
                    sendBtn.disabled = true;
                    spinner.style.display = 'inline';
                    // Send the data
                    fetch('/send-message-Client-To-Admin', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                appendSentMessage(message, data.image_url);
                                resetForm();
                            } else {
                                throw new Error(data.message || 'Failed to send message');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert(error.message);
                        })
                        .finally(() => {
                            sendBtn.disabled = false;
                            spinner.style.display = 'none';
                        });
                });
                window.addEventListener('load', function() {
                    scrollToBottom();
                });
            </script>
            <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- Core plugin JavaScript-->
            <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
            <!-- Custom scripts for all pages-->
            <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
            <script src="{{asset('js/Loading.js')}}"></script>
            <!-- Page level plugins -->
            <!-- Page level custom scripts -->
</body>
</html>