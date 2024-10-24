<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> View Works </title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/toster.css')}}">
</head>
<body>
    <div class="containerr">
        
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <a href="{{route('ServiceHouse.Supplier.Dashboard')}}">
                    <button>Dashboard</button>
                </a>
                <a href="{{route('ServiceHouse.Home.Supplier')}}">
                    <button>Home Page</button>
                </a>
            </div>
            <table class="table table-view-section">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Service</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Description</th>
                        <th scope="col">price</th>
                        <th scope="col">IMG</th>
                        <th scope="col">Attachment</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            <tbody class="table-group-divider">
            @foreach ($data as $datas)
                <tr>
                    <td>{{$datas->title}}</td>
                    <td>{{$datas->service->name}}</td>
                    <td>{{$datas->Supplier->id}}</td>
                    <td class="description">{{$datas->description}}</td>
                    <td class="description">{{$datas->price}}</td>
                    <td><img src="{{ asset($datas->attachment) }}" alt="" style="width: 120px; height: 80px;border-radius: 5px;"></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{route('#', $datas->id)}}" class="btn1 btn custom-btn-primary">Update</a>
                            <button type="button" class="btn-delete btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $datas->id }}">delete</button>
                            <div class="modal fade" id="exampleModal{{ $datas->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete </h5>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure to delete?
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="{{ route('#', $datas->id) }}">
                                                @csrf
                                                @method('DELETE') 
                                                <button type="submit" class="btn btn-yes custom-btn-primary">yes</button>
                                                <button type="button" class=" btn btn-secondary" data-dismiss="modal">Close</button>
                                            </form>
                                        </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
    <script src="{{asset('js/jqure.js')}}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{asset('js/toster.js')}}"></script>
    @if(session('success_create_service'))
        <script>
            show_create_service();
        </script>
    @endif

    @if(session('success_update_service'))
        <script>
            show_update_service();
        </script>
    @endif

    @if(session('success_delete_service'))
        <script>
            show_delete_service();
        </script>
    @endif




</body>
</html>