<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books</title>
</head>
<body>
    <table>
        {{-- tr itu yang ke kanan
        td itu yang ke bawah --}}
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

        @foreach ($books as $book)
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
                    <button type="submit">Update</button>
                </form>
            </td>
            <td>
                <form action="/delete_book" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{$book->id}}">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
   
    <br>

    <form action="/create_book" method="POST">
        @csrf
        <div>
            <label for="title">Title : </label>
            <input type="text" id="title" name="title" required>
        </div>

        <br>

        <div>
            <label for="author">Author : </label>
            <input type="text" id="author" name="author" required>
        </div>

        <br>

        <div>
            <label for="description">Description : </label>
            <input type="text" id="description" name="description" required>
        </div>

        <br>

        <div>
            <label for="publish">Published Date : </label>
            <input type="date" id="publish" name="publish" required>
        </div>

        <br>

        <div>
            <label for="categories">Categories: </label>
            <select name="category_id[]" id="categories" multiple required>
                <option disabled>Select categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                @endforeach
            </select>
            <p style="color: red">*Hold 'Ctrl' (Windows) or 'Command' (Mac) to select multiple categories.</p>
        </div>

        <br>

        <div>
            <label for="available">Is Available : </label>
            <input type="checkbox" id="available" name="available" value="1">
        </div>

        <button type="submit">Create Book</button>
    </form>
</body>
</html>