<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Category</title>
</head>
<body>
    <form action="/update_category" method="POST">
        @csrf
        <input type="hidden" name="category_id" value="{{ $category->id }}">

        {{-- category name input --}}
        <div>
            <label for="category">Category : </label>
            <input type="text" id="category" name="category" value="{{$category->category}}" required>
        </div>

        <br>

        <button type="submit">Update Category</button>
    </form>
</body>
</html>