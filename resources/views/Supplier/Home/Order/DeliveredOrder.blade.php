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
    <link rel="stylesheet" href="{{asset('css/DetailOrder.css')}}">
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
            <!-- Boxicons CDN in <head> -->
            <div class="cards-container">
                <!-- Order Description -->
                <div class="modern-card">
                    <div class="modern-header">
                        <i class='bx bx-detail'></i>
                        Order Description
                    </div>
                    <p>{{ $TestOrder->order_description }}</p>
                    <hr style="margin: 20px 0; border-top: 1px solid #eee;">
                    <div style="display: flex; align-items: center; gap: 8px; color: #6b7280; margin-bottom: 8px;">
                        <i class='bx bx-calendar'></i>
                        <span>Created At: {{ $TestOrder->created_at->format('Y-m-d H:i') }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px; color: #6b7280;">
                        <i class='bx bx-wallet'></i>
                        <span>Order Payment: {{ number_format($TestOrder->price, 2) }} Dollar</span>
                    </div>
                    @if($TestOrder->order_status !='approved')
                    <div style="display: flex; align-items: center; gap: 8px; color: #f59e0b; margin-top: 6px; font-style: italic;">
                        <i class='bx bx-time-five'></i>
                        <span>Payment is currently pending in the system</span>
                    </div>
                    @endif
                    @if($TestOrder->order_status =='approved')
                    <div style="display: flex; align-items: center; gap: 8px; color:#10b981; margin-top: 6px; font-style: italic;">
                        <i class='bx bx-time-five'></i>
                        <span>The client agreed to the request and the money was in the wallet</span>
                    </div>
                    @endif
                </div>
                <!-- Selected Offers -->
                <div class="modern-card">
                    <div class="modern-header">
                        <i class='bx bx-gift'></i>
                        Selected Offers
                    </div>
                    @forelse($selectedOffers as $offer)
                    <div class="offer-item">
                        <i class='bx bx-check-circle'></i>
                        {{ $offer->title }}
                    </div>
                    @empty
                    <p class="empty-message">No offers selected.</p>
                    @endforelse
                </div>
            </div>
            @if($TestOrder->supplier_status =='acceptance')
            <h3 style="text-align: center; margin-top:20px"><i style="color: #ee4962;" class='bx bx-conversation'></i> Share samples and chat with the client about the order</h3>
            <div style="margin-top: 20px;" class="bottom-sections ">

                <!-- Contact Client Section -->
                <div class="contact-client">
                    <div class="modern-section-title">
                        <i style="color: #ee4962;" class='bx bx-user'></i>
                        Contact with Client
                    </div>
                    <div class="client-profile">
                        <img src="{{ Storage::url($TestOrder->client->image) }}" alt="Client Image">
                        <div class="client-info">
                            <h4><i class='bx bx-id-card'></i> {{ $TestOrder->client->name }}</h4>
                            <p><i class='bx bx-user-pin'></i> Client</p>
                        </div>
                    </div>
                    <div class="chat-status-note">
                        <i class='bx bx-info-circle'></i>
                        Use the chat to coordinate delivery details or ask questions.
                    </div>
                    <div class="chat-status-note">
                        <i class='bx bx-bulb'></i>
                        You can send samples to the client before delivering the final work.
                    </div>
                    <div style="margin-top: 6px;" class="contact-buttons">
                        <a href="{{ url('ServiceHouse/Supplier/Dashboard/chat/' . $TestOrder->client->id) }}" class="btn contact"><i class='bx bx-chat'></i> Chat</a>
                    </div>
                </div>
                <div class="submit-delivery sample-mode">
                    <div class="modern-section-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="modern-section-title" style="display: flex; align-items: center; gap: 8px;">
                            <i style="color: #ee4962;" class='bx bx-upload'></i>
                            Submit Samples
                        </div>

                        <button onclick="openCommentModal()" style="background: none; border: none; cursor: pointer;">
                            <i class='bx bx-dots-horizontal-rounded' style="font-size: 1.6rem; color: #6b7280;"></i>
                        </button>
                    </div>

                    <div id="commentModal" style="display: none; position: fixed; inset: 0; background-color: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center;">
                        <div style="background: white; border-radius: 12px; padding: 20px; width: 90%; max-width: 500px; max-height: 80vh; overflow-y: auto; box-shadow: 0 10px 25px rgba(0,0,0,0.2); position: relative;">
                            <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem; text-align:center">Comments on <span style="color: #ee4962;">sample</span> Files</h2>
                            @forelse ($OrderFile as $file)
                            @if($file->client_note)
                            <div style="border-left: 3px solid #10b981; padding-left: 10px; margin-bottom: 12px;">
                                <strong style="color:#10b981;">File:</strong><br> {{ basename($file->file_path) }}<br>
                                <strong style="color:#10b981;">Comment:</strong><br> {{ $file->client_note }}<br>
                            </div>
                            @endif
                            @empty
                            <p style="color: #6b7280;">No files or comments found.</p>
                            @endforelse

                            <!-- إغلاق -->
                            <button onclick="closeCommentModal()" style="position: absolute; top: 10px; right: 10px; background: none; border: none; font-size: 1.2rem; color: #6b7280;">✖</button>
                        </div>
                    </div>
                    <form action="{{ route('DeliveredOrder') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="sampleFileInput"><i class='bx bx-file'></i> Upload Your Sample File:</label>
                        <div class="custom-file-input">
                            <div class="file-warning" style="color: #f59e0b; font-size: 0.9rem; display: flex; align-items: center; gap: 6px;">
                                <i class='bx bx-info-circle'></i>
                                Please upload a compressed file in .zip or .rar format.
                            </div>
                            <input type="file" name="sample_file" id="sampleFileInput" required onchange="showSampleFileName(this)">
                            <label for="sampleFileInput"><i class='bx bx-cloud-upload'></i> Choose File</label>
                            <input type="hidden" name="id_order" value="{{ $TestOrder->id }}">

                            <!-- File preview -->
                            <div id="sampleFilePreview" style="margin-top: 10px; display: none; align-items: center; gap: 8px;">
                                <span id="sampleFileName" style="font-size: 0.9rem; color: #374151;"></span>
                                <button type="button" onclick="removeSampleFile()" style="border: none; background: transparent; color: red; font-size: 1.2rem; cursor: pointer;">✖</button>
                            </div>
                        </div>

                        <label for="sample_note"><i class='bx bx-pencil'></i> Add a Note:</label>
                        <textarea name="sample_note" placeholder="Write something for the client..." rows="3"></textarea>
                        <button type="submit" class="btn deliver-btn"><i class='bx bx-paper-plane'></i> Submit Samples</button>
                    </form>

                    <script>
                        function showSampleFileName(input) {
                            const preview = document.getElementById('sampleFilePreview');
                            const fileName = document.getElementById('sampleFileName');

                            if (input.files.length > 0) {
                                fileName.textContent = input.files[0].name;
                                preview.style.display = 'flex';
                            } else {
                                preview.style.display = 'none';
                                fileName.textContent = '';
                            }
                        }

                        function removeSampleFile() {
                            const fileInput = document.getElementById('sampleFileInput');
                            fileInput.value = '';
                            showSampleFileName(fileInput);
                        }
                    </script>
                </div>
            </div>
            <h3 style="text-align: center; margin-top:20px"><i style="color: #ee4962;" class='bx bx-package'></i> Delivery of the final order</h3>
            <div style="width:50%; margin:auto; margin-top:20px;" class="submit-delivery">
                <div class="modern-section-title">
                    <i style="color: #ee4962;" class='bx bx-upload'></i>
                    Submit Delivery
                </div>
                <form action="{{ route('DeliveredOrderFinall') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="deliveryFile"><i class='bx bx-file'></i> Deliver Your Work File:</label>
                    <div class="custom-file-input">
                        <div class="file-warning" style="color: #f59e0b; font-size: 0.9rem; display: flex; align-items: center; gap: 6px;">
                            <i class='bx bx-info-circle'></i>
                            Please upload a compressed file in .zip or .rar format.
                        </div>
                        <input type="file" name="delivery_file" id="deliveryFile" required onchange="showFileName(this)">
                        <label for="deliveryFile"><i class='bx bx-cloud-upload'></i> Choose File</label>
                        <input type="hidden" name="id_order" value="{{ $TestOrder->id }}">

                        <!-- File preview -->
                        <div id="filePreview" style="margin-top: 10px; display: none; align-items: center; gap: 8px;">
                            <span id="fileName" style="font-size: 0.9rem; color: #374151;"></span>
                            <button type="button" onclick="removeFile()" style="border: none; background: transparent; color: red; font-size: 1.2rem; cursor: pointer;">✖</button>
                        </div>
                    </div>

                    <label for="delivery_note"><i class='bx bx-pencil'></i> Add a Note:</label>
                    <textarea name="delivery_note" placeholder="Write something for the client..." rows="3"></textarea>
                    <button type="submit" class="btn deliver-btn"><i class='bx bx-paper-plane'></i> Submit Delivery</button>
                </form>
                <script>
                    function showFileName(input) {
                        const preview = document.getElementById('filePreview');
                        const fileName = document.getElementById('fileName');

                        if (input.files.length > 0) {
                            fileName.textContent = input.files[0].name;
                            preview.style.display = 'flex';
                        } else {
                            preview.style.display = 'none';
                            fileName.textContent = '';
                        }
                    }

                    function removeFile() {
                        const fileInput = document.getElementById('deliveryFile');
                        fileInput.value = '';
                        showFileName(fileInput);
                    }
                </script>
                <script>
                    function openCommentModal() {
                        document.getElementById('commentModal').style.display = 'flex';
                    }

                    function closeCommentModal() {
                        document.getElementById('commentModal').style.display = 'none';
                    }
                </script>

            </div>
            @endif
        </main>
        <!-- MAIN -->
    </section>
    @if(session('DeliveredOrder'))
    <script>
        Notiflix.Notify.success("{{ session('DeliveredOrder') }}");
    </script>
    @endif
    <!-- CONTENT -->
    <script src="{{asset('js/Loading.js')}}"></script>
    <script src="{{asset('js/supplier-dashboard.js')}}"></script>
</body>

</html>