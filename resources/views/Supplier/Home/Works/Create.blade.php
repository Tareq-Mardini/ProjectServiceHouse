<!DOCTYPE html>
<html lang="en">
<head>
    <title> Create Work </title>
</head>
<body>
            <div class="col-md-8">
                <h1>Create Work</h1>
            </div>
        <div class="row mt-4">
    <div class="col-md-12">
        <form action="{{ route('Works.Store.Supplier') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name" class="form-label">service</label>
                <select name="service_id" class="form-control">
                    @foreach ($data as $datas)
                        <option value="{{$datas->id}}" > {{$datas->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            
            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
        
            <div>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required>
            </div>
        
            <div>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>

            <div>
                <label for="attachmens">Attachment:</label>
                <input type="file" id="image" name="image" accept="image/*, video/*" required>
            </div>
        
            <button type="submit">Create Work</button>
        </form>
    </div>
</div>
    </div>
    </body>
</html>

