<h2 class="text-center mb-4">Recommendations for Client #{{ $clientId ?? 'Unknown' }}</h2>

@if(empty($recommendations) || !is_array($recommendations))
    <div class="alert alert-info text-center">No recommendations found.</div>
@else
    <div class="row justify-content-center">
        @foreach($recommendations as $item)
            @php
                $serviceId = is_array($item) 
                ? ($item['service_id'] ?? $item['id'] ?? $item)
                : $item;
                $serviceModel = \App\Models\Services::find((int)$serviceId);
            @endphp

            @if($serviceModel)
                <div class="col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                    <div class="card shadow-sm w-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $serviceModel->name }}</h5>
                            <p class="card-text text-muted">{{ $serviceModel->description }}</p>
                            <a href="{{ route('Works.Show.Client', ['id' => $serviceModel->id, 'clientid' => $clientId]) }}" class="btn btn-primary btn-block">View Details</a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endif
