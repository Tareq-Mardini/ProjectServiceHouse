<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="{{asset('images/visitor/logo-3.png')}}" type="image/png">
    <title>Admin Dashboard</title>
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/ViewChatsSupplier.css')}}">
    <link rel="stylesheet" href="{{asset('css/ChatClientSupplier.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body id="page-top">
    <div id="wrapper">
    @include('dashboard.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div style="overflow-y: hidden;" id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                            aria-label="Search" aria-describedby="basic-addon2" />
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="{{asset('images/istockphoto-2041572395-612x612.jpg')}}" />
                            </a>
                        </li>
                    </ul>
                </nav>
                <div style="margin-top: -22px;" id="chat-box" class="chat-box">
                    <ul class="chat-list">
                        @foreach($messages as $message)
                        <li class="chat-bubble {{ $message->receiver_id != 0 ? 'bubble-sender' : 'bubble-receiver' }} {{ $message->receiver_id != 0 ? 'align-end text-right' : 'align-start text-left' }}">
                            <strong class="sender-name">
                                {{ $message->receiver_id != 0 ?   'You' : $supplier->name}}
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
                    <input type="hidden" name="id" id="receiver_id" value="{{ $supplier->id }}">
                </form>
            </div>
        </div>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
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
        Pusher.logToConsole = true;
        const pusher = new Pusher('24e1f355567319d1811a', {
            cluster: 'eu',
            forceTLS: true
        });
        const supplierId = "{{ $supplier->id }}";
        const channel = pusher.subscribe('SupplierToAdmin');
        channel.bind('SupplierAdmin-message', function(data) {
            console.log('Received message:', data);

            // التحقق من أن الرسالة موجهة لنا
            if (supplierId == data.sender_id && data.role == 'supplier') {
                appendMessage(data.Supplier.name, data.message, data.image_url);
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
            fetch('/send-message--admin', {
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


    <!-- Bootstrap core JavaScript-->
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