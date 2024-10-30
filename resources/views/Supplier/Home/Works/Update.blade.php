<!DOCTYPE html>
<html lang="en">
<head>
    <title> Update Work </title>
</head>
<body>
            <div class="col-md-8">
                <h1>Update Work</h1>
            </div>
            <form action="{{route('Supplier.Update.Myworks', $work->id)}}" method="POST"  enctype="multipart/form-data" >
                @csrf
                @method('PUT')
                <div>
                    <label for="name" class="form-label">service</label>
                    <select name="section_id" class="form-control">
                        @foreach ($work_Service as $service)
                            <option value="{{$service->id}}" > {{$service->name}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                        <label for="title" class="form-label" >Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required value="{{ $work->title }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                
                <div>
                        <label for="description" class="form-label ll">Description</label>
                        <input class="form-control" id="name" name="description"value="{{ $work->description }}" rows="5" required ></input>
                </div>

                <div>
                        <label for="price" class="form-label ll">Price</label>
                        <input class="form-control" id="name" name="price"value="{{ $work->price }}" rows="5" required ></input>
                </div>
                        <button type="submit">Save</button>
                        <a href="{{ route('Supplier.Show.Myworks') }}" class=" btn btn-secondary">Cancel</a>
            </form>
    </body>
</html>
