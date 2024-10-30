<!DOCTYPE html>
<html lang="en">
<head>

    <title> View Works </title>

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
                </tr>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>

</body>
</html>