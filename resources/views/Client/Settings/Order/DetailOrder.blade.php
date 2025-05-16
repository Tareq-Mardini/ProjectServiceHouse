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
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-3.2.6.min.css" />
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
      @if (!in_array($TestOrder->supplier_status, ['rejection', 'waitings']) && !in_array($TestOrder->order_status, ['approved']))
      <h3 style="text-align: center; margin-top:20px; font-weight:900; font-size:18px"><i style="color: #ee4962;" class='bx bx-conversation'></i> download samples and chat with the supplier about the order</h3>
      <div style="margin-top: 20px;" class="bottom-sections">
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
              Sample Delivery Status
            </div>
          </div>
          @if ($fileorder->count() > 0)
          @foreach ($fileorder as $file)
          <div class="delivery-item" data-file-id="{{ $file->id }}">
            <div class="file-info" style="display: flex; justify-content: space-between; align-items: center; gap: 8px;">
              <div style="display: flex; align-items: center; gap: 8px;">
                <i class='bx bx-file'></i>
                <a style="color: #10b981;" href="{{ Storage::url($file->file_path) }}" target="_blank" class="file-link">
                  Download File
                </a>
              </div>

              <button type="button" class="modal-toggle-btn" style="background: none; border: none; cursor: pointer;">
                <i class='bx bx-dots-vertical-rounded' style="font-size: 1.5rem; color: #6b7280;"></i>
              </button>
            </div>

            <!-- المودال -->
            <div class="note-modal" style="display: none; position: fixed; inset: 0; background-color: rgba(0, 0, 0, 0.4); z-index: 9999; justify-content: center; align-items: center;">
              <div style="background: white; border-radius: 12px; padding: 20px; width: 90%; max-width: 400px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); position: relative;">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">Add a Note</h2>

                <form method="POST" action="{{ route('SendNoteClient') }}">
                  @csrf
                  <input type="hidden" name="file_id" value="{{ $file->id }}">
                  <textarea name="client_note" rows="4" placeholder="Write your note here..." style="width: 100%; border: 1px solid #d1d5db; border-radius: 6px; padding: 8px;"></textarea>
                  <div style="margin-top: 1rem; display: flex; justify-content: flex-end; gap: 8px;">
                    <button type="button" class="modal-close-btn" style="padding: 6px 12px; border: none; background-color: #e5e7eb; border-radius: 6px; cursor: pointer;">Cancel</button>
                    <button type="submit" style="padding: 6px 12px; border: none; background-color: #10b981; color: white; border-radius: 6px; cursor: pointer;">Send</button>
                  </div>
                </form>

                <button class="modal-close-btn" style="position: absolute; top: 10px; right: 10px; background: none; border: none; font-size: 1.2rem; color: #6b7280;">✖</button>
              </div>
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

          <script>
            document.addEventListener('DOMContentLoaded', function() {
              document.querySelectorAll('.modal-toggle-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                  const modal = this.closest('.delivery-item').querySelector('.note-modal');
                  modal.style.display = 'flex';
                });
              });

              document.querySelectorAll('.modal-close-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                  const modal = this.closest('.note-modal');
                  modal.style.display = 'none';
                });
              });

              document.querySelectorAll('.note-modal').forEach(modal => {
                modal.addEventListener('click', function(e) {
                  if (e.target === this) {
                    this.style.display = 'none';
                  }
                });
              });
            });
          </script>
          @else
          <div class="delivery-status-message">
            <i class='bx bx-download'></i>
            Once the supplier submits the sample work, your delivery will appear here.
          </div>
          @endif
        </div>
      </div>
      <h3 style="text-align: center; margin-top:20px; font-weight:900; font-size:18px"><i style="color: #ee4962;" class='bx bx-conversation'></i> Download the final file and approve</h3>
      <div style=" width:50% ;margin:auto;margin-top: 20px;" class="delivery-status-card">
        <div class="modern-section-title" style="display: flex; justify-content: space-between; align-items: center;">
          <div>
            <i class='bx bx-package' style="color: #ee4962;"></i>
            Final order delivery status
          </div>
          <form method="get" action="{{ route('ApprovedOrder', $TestOrder->id) }}" onsubmit="return confirm('Are you sure you want to approve this delivery?')">
            <button type="submit" class="btn btn-sm" style="background-color: #10b981; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 0.85rem;">
              <i class='bx bx-check-circle' style="margin-right: 4px;"></i> Approve
            </button>
          </form>
        </div>
        @if ($fileorder->count() > 0)
        @foreach ($fileorderFinall as $file)
        <div class="delivery-item" data-file-id="{{ $file->id }}">
          <div class="file-info" style="display: flex; justify-content: space-between; align-items: center; gap: 8px;">
            <div style="display: flex; align-items: center; gap: 8px;">
              <i class='bx bx-file'></i>
              <a style="color: #10b981;" href="{{ Storage::url($file->file_path) }}" target="_blank" class="file-link">
                Download File
              </a>
            </div>
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
      @endif

      @php
      use App\Models\Review;
      $clientId = session('Client_user_id');
      $review = Review::where('client_id', $clientId)
      ->where('work_id', $TestOrder->work->id)
      ->first();

      $fields = [
      'quality' => ['label' => 'Work Quality', 'icon' => '⭐'],
      'communication' => ['label' => 'Communication', 'icon' => '💬'],
      'timeliness' => ['label' => 'Punctuality', 'icon' => '⏰'],
      'satisfaction' => ['label' => 'Overall Satisfaction', 'icon' => '😊']
      ];
      @endphp
      @if($TestOrder->order_status == 'approved')
      <form style="margin-top: 20px;" action="{{ route('reviews.store') }}" method="POST" class="max-w-md mx-auto bg-white p-4 rounded-xl shadow-md space-y-4">
        @csrf
        <h1 class="text-xl font-bold text-gray-800 flex items-center mb-2">
          ✏️ <span class="ml-2">Review</span>
        </h1>
        <input type="hidden" name="work_id" value="{{ $TestOrder->work->id }}">
        @foreach($fields as $field => $info)
        <div>
          <label class="block text-gray-700 text-base font-semibold mb-1 flex items-center">
            <span class="mr-1">{{ $info['icon'] }}</span> {{ $info['label'] }}:
          </label>
          <div class="flex space-x-1">
            @for($i = 1; $i <= 5; $i++)
              <svg class="w-6 h-6 cursor-pointer star transition duration-150"
              data-group="{{ $field }}"
              data-value="{{ $i }}"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              fill="{{ isset($review) && $i <= $review->$field ? 'gold' : 'gray' }}">
              <path d="M11.48 3.499a.562.562 0 011.04 0l2.28 4.614a.562.562 0 00.423.308l5.093.74a.562.562 0 01.312.96l-3.683 3.59a.562.562 0 00-.162.497l.87 5.07a.562.562 0 01-.816.592l-4.552-2.392a.562.562 0 00-.523 0l-4.553 2.392a.562.562 0 01-.816-.592l.87-5.07a.562.562 0 00-.162-.497l-3.683-3.59a.562.562 0 01.312-.96l5.093-.74a.562.562 0 00.423-.308l2.28-4.614z" />
              </svg>
              @endfor
          </div>
          <input type="hidden" name="{{ $field }}" id="input-{{ $field }}" value="{{ $review->$field ?? '' }}" required>
        </div>
        @endforeach
        <div>
          <label class="block text-gray-700 text-base font-semibold mb-1">📝 Comment:</label>
          <textarea name="comment" rows="3" class="w-full border border-gray-300 p-2 rounded-md focus:ring-1 focus:ring-yellow-400 shadow-sm text-sm">{{ $review->comment ?? '' }}</textarea>
        </div>
        <button type="submit"
          class="w-full bg-yellow-400 hover:bg-yellow-500 text-white text-base font-semibold py-2 rounded-lg transition shadow">
          {{ $review ? 'Update Review' : 'Submit Review' }}
        </button>
      </form>
      <script>
        document.querySelectorAll('.star').forEach(star => {
          star.addEventListener('click', function() {
            const group = this.dataset.group;
            const value = parseInt(this.dataset.value);
            const groupStars = document.querySelectorAll(`.star[data-group="${group}"]`);
            groupStars.forEach((s, index) => {
              s.setAttribute('fill', index < value ? 'gold' : 'gray');
            });
            document.getElementById(`input-${group}`).value = value;
          });
        });
      </script>
      <script>
        function confirmApproval() {
          Notiflix.Confirm.show(
            'Confirm Approval',
            'Are you sure you want to approve this delivery?',
            'Yes, Approve',
            'Cancel',
            function okCb() {
              document.getElementById('approveForm').submit();
            },
            function cancelCb() {
              Notiflix.Notify.info('Approval cancelled.');
            }
          );
        }
      </script>
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
  @if(session('Update_Review'))
  <script>
    Notiflix.Notify.success("{{ session('Update_Review') }}");
  </script>
  @endif
  @if(session('Create_Review'))
  <script>
    Notiflix.Notify.success("{{ session('Create_Review') }}");
  </script>
  @endif
  @if(session('wrong_approved_order'))
  <script>
    Notiflix.Notify.warning("{{ session('wrong_approved_order') }}");
  </script>
  @endif
  @if(session('not_completed_order'))
  <script>
    Notiflix.Notify.warning("{{ session('not_completed_order') }}");
  </script>
  @endif
  @if(session('SendNote'))
  <script>
    Notiflix.Notify.success("{{ session('SendNote') }}");
  </script>
  @endif
  <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
  <script src="{{asset('js/Loading.js')}}"></script>
  <script src="{{asset('js/supplier-dashboard.js')}}"></script>
</body>

</html>