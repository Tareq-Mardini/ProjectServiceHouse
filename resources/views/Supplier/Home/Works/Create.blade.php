<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/style-section.css')}}">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <title> Create Work </title>
</head>
<body>
    <div class="create-section" style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-8">
                <h1>Create Work</h1>
            </div>
        </div>
        <div class="row mt-4">
    <div class="col-md-12">
        <form action="{{ route('Works.Store.Supplier') }}" method="POST" enctype="multipart/form-data">
            @csrf
        
            <input type="hidden" name="service_id" value="{{ $serviceId ?? '' }}">
        
            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
        
            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
        
            <div>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required>
            </div>
        
            <div>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
        
            <button type="submit">Create Work</button>
        </form>
    </div>
</div>
    </div>
    </body>
</html>

