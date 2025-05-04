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
            <div class="bottom-sections">
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
                <!-- Submit Delivery Section -->
                <div class="submit-delivery">
                    <div class="modern-section-title">
                        <i style="color: #ee4962;" class='bx bx-upload'></i>
                        Submit Delivery
                    </div>
                    <form action="{{ route('DeliveredOrder') }}" method="POST" enctype="multipart/form-data">
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

                </div>
            </div>
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