<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/style-section.css')}}">
    <link rel="stylesheet" href="{{asset('css/style-section-edit.css')}}">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
    <title> Admin Dashboard </title>
</head>
<body>
    <div class="create-section" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-8">
                <h1>Update Service</h1>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
            <form action="{{ route('admin.service.update', $data->id) }}" method="POST"  enctype="multipart/form-data" >
                @csrf
                @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label" >Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ $data->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <label for="name" class="form-label">sections</label>
                        <select name="section_id" class="form-control">
                            @foreach ($data_section as $datas)
                                <option value="{{$datas->id}}" > {{$datas->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label ll">Description</label>
                        <input class="form-control" id="name" name="description"value="{{ $data->description }}" rows="5" required ></input>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Image</label><br>
                        <input type="file" name="image" class="form-control" value="" ><br>
                    </div>
                    <button type="submit" class="btn1 btn btn-primary">Save</button>
                    <a href="{{ route('admin.view.service') }}" class=" btn btn-secondary">Cancel</a>
            </form>
            </div>
        </div>
    </div>
    <script src="{{asset('js/Loading.js')}}"></script>
    </body>
</html>
