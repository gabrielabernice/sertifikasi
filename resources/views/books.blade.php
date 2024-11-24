<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Books</h2>
        
        {{-- filter Form --}}
        <form action="/books" method="POST" class="form-inline mb-3">
            @csrf
            <label for="categories" class="mr-2">Filter by Categories:</label>
            <select name="category_id" id="categories" class="form-control mr-2" required>
                <option value="0">All</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                            {{ isset($_POST['category_id']) && $_POST['category_id'] == $category->id ? 'selected' : '' }}>
                        {{ $category->category }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        {{-- view books Table --}}
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Description</th>
                    <th>Published Date</th>
                    <th>Category</th>
                    <th>Is Available</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($filteredBooks as $book)
                <tr>
                    <td>{{$book->id}}</td>
                    <td>{{$book->title}}</td>
                    <td>{{$book->author}}</td>
                    <td>{{$book->description}}</td>
                    <td>{{$book->published_date}}</td>
                    <td>
                        @foreach ($book->category as $category)
                            {{ $category->category }}<br>
                        @endforeach
                    </td>
                    <td>{{$book->is_available ? 'Yes' : 'No'}}</td>
                    <td>
                        <form action="/update_book" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{$book->id}}">
                            <button type="submit" class="btn btn-warning">Update</button>
                        </form>
                    </td>
                    <td>
                        <form action="/delete_book" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{$book->id}}">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- create new book form --}}
        <h3>Create New Book</h3>
        <form action="/create_book" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="publish">Published Date:</label>
                <input type="date" id="publish" name="publish" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="categories">Categories:</label>
                <select name="category_id[]" id="categories" class="form-control" multiple required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Hold 'Ctrl' (Windows) or 'Command' (Mac) to select multiple categories.</small>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" id="available" name="available" class="form-check-input" value="1">
                <label for="available" class="form-check-label">Is Available</label>
            </div>
            <button type="submit" class="btn btn-success">Create Book</button>
        </form>

        {{-- button for go back --}}
        <a href="/" class="btn btn-secondary mt-3">Back to Home</a>
    </div>
</body>
</html>
