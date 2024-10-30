<!DOCTYPE html>
<html lang="en">

<head>
    <title> Update Work </title>
</head>

<body>
    <div class="col-md-8">
        <h1>Update Work</h1>
    </div>
    <form action="{{ route('Supplier.Update.Myworks', $work->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="service_id" class="form-label">Service</label>
        <select name="service_id" class="form-control" required>
            @foreach ($work_Service as $service)
            <option value="{{ $service->id }}">
                {{ $service->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required value="{{ old('title', $work->title) }}">
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $work->description) }}</textarea>
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" required value="{{ old('price', $work->price) }}">
        @error('price')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('Supplier.Show.Myworks') }}" class="btn btn-secondary">Cancel</a>
</form>
</body>

</html>