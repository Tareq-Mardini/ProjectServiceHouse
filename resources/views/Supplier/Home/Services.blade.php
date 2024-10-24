<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/visitor.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/visitor-sections.css')}}">
</head>

<body>
<div class="container" style="margin-top: 160px;">
    <h2 class="h2 section-title"><span class="span">Services </span></h2>
        <div class="Section">
            @foreach ($data as $service)
            <div class="content-section">
                <img src="{{ asset($service->image) }}" alt="">
                <div class="text">
                    <h3>{{$service->name}}</h3>
                    <p>{{$service->description}}
                    </p>
                   <a href="{{route('Works.Show.Supplier',['id' => $service->id])}}">
                        <button>View Works</button>
                   </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>