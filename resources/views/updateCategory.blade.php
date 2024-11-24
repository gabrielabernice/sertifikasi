<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Category</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Category</h2>

        {{-- form for update category --}}
        <form action="/update_category" method="POST">
            @csrf
            <input type="hidden" name="category_id" value="{{ $category->id }}">

            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" class="form-control" value="{{ $category->category }}" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="/categories" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Update Category</button>
            </div>
        </form>
    </div>
</body>
</html>
