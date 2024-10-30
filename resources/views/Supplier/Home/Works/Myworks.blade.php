<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Works</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div>
        <a class="home-page" href="{{route('ServiceHouse.Home.Supplier')}}">Home Page <i class='bx bx-right-arrow-alt'></i> </a>
        <a class="home-page" href="{{route('Works.Create.Supplier')}}">Create Work <i class='bx bx-right-arrow-alt'></i> </a>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <div>
            @foreach ($works as $work)
            <tr>
                <td>{{$work->title}}</td>
                <td>{{$work->description}}</td>
                <td><a href="{{route('Supplier.Edite.Myworks', $work->id)}}"><button>Update</button></a>
                    <a href="{{route('Supplier.Work.Info', $work->id)}}"><button>View</button></a>
                    <form action="{{ route('Supplier.Delete.Work', $work->id) }}" method="POST">
                        @csrf
                        @method('DELETE')  <button type="submit" style="background-color: red; margin-left: 0; margin-right:0;" class="btn1 btn custom-btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </div>
        </tbody>
    </table>
</body>

</html>