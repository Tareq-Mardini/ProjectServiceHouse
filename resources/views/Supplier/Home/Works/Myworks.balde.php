<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Works</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <span class="text">My Profile</span>
    <span class="text">My works</span>
    <div>
        <a class="home-page" href="{{route('ServiceHouse.Home.Supplier')}}">Home Page <i class='bx bx-right-arrow-alt'></i> </a>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Service</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                <th scope="col">Attachment</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $datas)
            <tr>
                <td>{{$datas->title}}</td>
                <td>{{$datas->service->name}}</td>
                <td>{{$datas->description}}</td>
                <td>{{$datas->price}}</td>
                <td><img src="{{ asset($datas->attachment) }}" alt="" style="width: 120px; height: 80px;border-radius: 5px;"></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{route('update_data', $datas->id)}}">Update</a>
                        <form action="{{route('delete_data', $datas->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>