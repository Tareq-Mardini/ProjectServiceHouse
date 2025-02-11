<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/style-section.css')}}">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
    <title> Admin Dashboard </title>
</head>
<body >
    <div class="create-section">
        <div class="row">
            <div class="col-md-8">
                <h1>Create Section</h1>
            </div>
        </div>
        <div class="row mt-4">
    <div class="col-md-12">
        <form action="{{ route('section.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Image</label><br>
                <input type="file" name="image" class="form-control" required><br>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('section.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
    </div>
    <script src="{{asset('js/Loading.js')}}"></script>
    </body>
</html>

