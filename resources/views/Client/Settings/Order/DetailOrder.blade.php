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
  <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
  <link rel="stylesheet" href="{{asset('css/OrderClient.css')}}">
  <link rel="stylesheet" href="{{asset('css/DetailOrder.css')}}">

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
          @if ($TestOrder->supplier_status !='rejection' && $TestOrder->order_status !='approved')
          <div style="display: flex; align-items: center; gap: 8px; color: #f59e0b; margin-top: 6px; font-style: italic;">
            <i class='bx bx-time-five'></i>
            <span>Payment is currently pending in the system</span>
          </div>
          @endif
          <div style="display: flex; align-items: center; gap: 8px; margin-top: 10px;
                        color: {{ $TestOrder->supplier_status == 'acceptance' ? '#10b981' : ($TestOrder->supplier_status == 'rejection' ? '#ef4444' : '#10b981') }};
                        font-weight: 500;">
            <i class='bx bx-user-check'></i>
            <span>
              Supplier Status:
              @if ($TestOrder->supplier_status == 'acceptance')
              Accepted the Order
              @elseif ($TestOrder->supplier_status == 'rejection')
              Rejected the Order (The money is returned to your wallet)
              @elseif ($TestOrder->supplier_status == 'waitings')
              Awaiting Supplier Response
              @else
              completed the order
              @endif
            </span>
          </div>
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
      @if ($TestOrder->supplier_status != 'rejection')
      <div class="bottom-sections">
        <!-- Contact Supplier Section -->
        <div class="contact-client">
          <div class="modern-section-title">
            <i style="color: #ee4962;" class='bx bx-user'></i>
            Contact with Supplier
          </div>
          <div class="client-profile">
            <img src="{{ Storage::url($TestOrder->supplier->image) }}" alt="Supplier Image">
            <div class="client-info">
              <h4><i class='bx bx-id-card'></i> {{ $TestOrder->supplier->name }}</h4>
              <p><i class='bx bx-user-pin'></i> Supplier</p>
            </div>
          </div>
          <div class="chat-status-note">
            <i class='bx bx-info-circle'></i>
            Need help or have a question? Feel free to chat with the supplier at any time.
          </div>
          <div class="chat-status-note">
            <i class='bx bx-bulb'></i>
            Want to see progress? You can request samples before receiving the final delivery.
          </div>
          <div class="contact-buttons" style="margin-top: 10px;">
            <a href="{{ url('ServiceHouse/Client/Settings/Chat/Supplier/' . $TestOrder->supplier->id) }}" class="btn contact"><i class='bx bx-chat'></i> Chat</a>
          </div>
        </div>
        <!-- Order Status Section -->
        <div class="delivery-status-card">
          <div class="modern-section-title" style="display: flex; justify-content: space-between; align-items: center;">
            <div>
              <i class='bx bx-package' style="color: #ee4962;"></i>
              Order Delivery Status
            </div>
            <form method="get" action="{{ route('ApprovedOrder', $TestOrder->id) }}" onsubmit="return confirm('Are you sure you want to approve this delivery?')">
              <button type="submit" class="btn btn-sm" style="background-color: #10b981; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 0.85rem;">
                <i class='bx bx-check-circle' style="margin-right: 4px;"></i> Approve
              </button>
            </form>
          </div>
          @if ($fileorder->count() > 0)
          @foreach ($fileorder as $file)
          <div class="delivery-item">
            <div class="file-info">
              <i class='bx bx-file'></i>
              <a style="color: #10b981;" href="{{ Storage::url($file->file_path) }}" target="_blank" class="file-link">
                Download File
              </a>
            </div>
            @if($file->note)
            <div class="file-note">
              <i class='bx bx-message-rounded-dots'></i>
              {{ $file->note }}
            </div>
            @endif
            <hr style="border-top: 1px dashed #ccc; margin: 15px 0;">
          </div>
          @endforeach
          @else
          <div class="delivery-status-message">
            <i class='bx bx-download'></i>
            Once the supplier submits the final work, your delivery will appear here.
          </div>
          @endif
        </div>
      </div>
      @endif
    </main>
    <!-- MAIN -->
  </section>
  <!-- CONTENT -->
  @if(session('approved_order'))
  <script>
    Notiflix.Notify.success("{{ session('approved_order') }}");
  </script>
  @endif
  <script src="{{asset('js/Loading.js')}}"></script>
  <script src="{{asset('js/supplier-dashboard.js')}}"></script>
</body>

</html>