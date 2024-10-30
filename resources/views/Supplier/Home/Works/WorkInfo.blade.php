<!DOCTYPE html>
<html lang="en">
<head>
    <title>Info Works</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
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
            </tr>
        </thead>
        <tbody>
            <div>
            @foreach ($works as $work)
            <tr>
                <td>{{$work->title}}</td>
                <td>{{$work->service->name}}</td>
                <td>{{$work->description}}</td>
                <td>{{$work->price}}</td>
            </tr>
            @endforeach
            </div>
        </tbody>
    </table>
</body>

</html>