<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/style-section.css')}}">
    <link rel="stylesheet" href="{{asset('css/style-section-edit.css')}}">
    
    <title> Admin Dashboard </title>
</head>
<body>
    <div class="create-section">
        <div class="row">
            <div class="col-md-8">
                <h1>Update Section</h1>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
            <form action="{{ route('section.update', $data->id) }}" method="POST"  enctype="multipart/form-data" >
                @csrf
                @method('PUT')
                    <div class="mb-3">
                        <label style="color: white;" for="name" class="form-label" >Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ $data->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    <div class="mb-3">
                        <label for="description" style="color: white;" class="form-label ll">Description</label>
                        <input class="form-control" id="name" name="description"value="{{ $data->description }}" rows="5" required ></input>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label" style="color: white;">Image</label><br>
                        <input type="file" name="image" class="form-control" value="" ><br>
                    </div>
                    <button type="submit" class="btn1 btn btn-primary">Save</button>
                    <a href="{{ route('section.index') }}" class=" btn btn-secondary">Cancel</a>
            </form>
            </div>
        </div>
    </div>
    </body>
</html>
