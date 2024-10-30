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
                @php
                // دالة لاستخراج معرف فيديو YouTube
                function getYoutubeId($url) {
                preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
                return $matches[1] ?? null;
                }
                @endphp

                @foreach ($works as $work)
                <tr>
                    <td>{{ $work->title }}</td>
                    <td>{{ $work->description }}</td>
                    <td>
                        @if($work->youtube_link)
                        @php
                        // استخراج معرف الفيديو
                        $youtubeId = getYoutubeId($work->youtube_link);
                        @endphp

                        @if($youtubeId)
                        <div>
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $youtubeId }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                        @else
                        <p>رابط يوتيوب غير صالح.</p>
                        @endif
                        @else
                        <p>لا يوجد رابط فيديو متاح.</p>
                        @endif
                    </td>
                    <td><img src="{{ Storage::url($work->thumbnail) }}" alt="Work Image"></td>
                    <td>
                        <form action="{{ route('Supplier.Edite.Myworks') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $work->id }}">
                            <button type="submit">Update</button>
                        </form>
                        <a href="{{ route('Supplier.Work.Info', $work->id) }}">
                            <button>View</button>
                        </a>
                        <form action="{{ route('Supplier.Delete.Work', $work->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color: red; margin-left: 0; margin-right:0;" class="btn1 btn custom-btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </div>
        </tbody>
    </table>

</body>

</html>