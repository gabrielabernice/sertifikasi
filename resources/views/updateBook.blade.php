<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Book</title>
</head>
<body>
    <form action="/update_book" method="POST">
        @csrf
        <input type="hidden" name="book_id" value="{{ $book->id }}">

        {{-- title input --}}
        <div>
            <label for="title">Title : </label>
            <input type="text" id="title" name="title" value="{{$book->title}}" required>
        </div>

        <br>

        {{-- author input --}}
        <div>
            <label for="author">Author : </label>
            <input type="text" id="author" name="author" value="{{$book->author}}" required>
        </div>

        <br>

        {{-- description input --}}
        <div>
            <label for="description">Description : </label>
            <input type="text" id="description" name="description" value="{{$book->description}}" required>
        </div>

        <br>

        {{-- published date input --}}
        <div>
            <label for="publish">Published Date : </label>
            <input type="date" id="publish" name="publish" value="{{$book->published_date}}" required>
        </div>

        <br>

        {{-- categories selection --}}
        <div>
            <label for="categories">Categories: </label>
            <select name="category_id[]" id="categories" multiple required>
                <option disabled>Select categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ $book->category->contains('id', $category->id) ? 'selected' : '' }}>
                        {{ $category->category }}
                    </option>
                @endforeach
            </select>
            <p style="color: red">*Hold 'Ctrl' (Windows) or 'Command' (Mac) to select multiple categories.</p>
        </div>

        <br>

        {{-- is available checkbox --}}
        <div>
            <label for="available">Is Available : </label>
            <input type="checkbox" id="available" name="available" value="1" 
                   {{ $book->is_available ? 'checked' : '' }}>
        </div>

        <br>

        <button type="submit">Update Book</button>
    </form>
</body>
</html>