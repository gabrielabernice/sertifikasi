<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Book</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Book</h2>

        {{-- form for updat ebook --}}
        <form action="/update_book" method="POST">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ $book->title }}" required>
            </div>

            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" class="form-control" value="{{ $book->author }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" class="form-control" value="{{ $book->description }}" required>
            </div>

            <div class="form-group">
                <label for="publish">Published Date:</label>
                <input type="date" id="publish" name="publish" class="form-control" value="{{ $book->published_date }}" required>
            </div>

            <div class="form-group">
                <label for="categories">Categories:</label>
                <select name="category_id[]" id="categories" class="form-control" multiple required>
                    <option disabled>Select categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" 
                                {{ $book->category->contains('id', $category->id) ? 'selected' : '' }}>
                            {{ $category->category }}
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">*Hold 'Ctrl' (Windows) or 'Command' (Mac) to select multiple categories.</small>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="available" name="available" value="1" 
                       {{ $book->is_available ? 'checked' : '' }}>
                <label class="form-check-label" for="available">Is Available</label>
            </div>

            <div class="d-flex justify-content-between">
                <a href="/books" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Update Book</button>
            </div>
        </form>
    </div>
</body>
</html>
