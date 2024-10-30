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

    <!-- اختيار الخدمة -->
    <div>
        <label for="name" class="form-label">Service</label>
        <select name="service_id" class="form-control">
            @foreach ($data as $datas)
                <option value="{{ $datas->id }}">{{ $datas->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- العنوان -->
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
    </div>
    
    <!-- الوصف -->
    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
    </div>

    <!-- السعر -->
    <div>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>
    </div>

    <!-- تحميل الصور المتعددة -->
    <div>
        <label >thumbnail:</label>
        <input type="file" id="thumbnail" name="thumbnail" required>
    </div>
    <label for="youtube_link">YouTube Link:</label>
    <input type="url" name="youtube_link" placeholder="https://www.youtube.com/watch?v=example" > <!-- حقل رابط اليوتيوب -->
    <!-- زر الإنشاء -->
    <button type="submit">Create Work</button>
</form>

    </div>
</div>
    </div>
    </body>
</html>

