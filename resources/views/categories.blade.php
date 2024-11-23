<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories</title>
</head>
<body>
    {{-- table to read category --}}
    <table>
        {{-- tr itu yang ke kanan
        td itu yang ke bawah --}}
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>

        @foreach ($categories as $category)
        <tr>
            <td>{{$category->id}}</td>
            <td>{{$category->category}}</td>
            {{-- button to update category --}}
            <td>
                <form action="/update_category" method="POST">
                    @csrf
                    <input type="hidden" name="category_id" value="{{$category->id}}">
                    <button type="submit">Update</button>
                </form>
            </td>
            {{-- button to delete category --}}
            <td>
                <form action="/delete_category" method="POST">
                    @csrf
                    <input type="hidden" name="category_id" value="{{$category->id}}">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
   
    <br>

    {{-- form to create new category --}}
    <form action="/create_category" method="POST">
        @csrf
        <div>
            <label for="category">Category : </label>
            <input type="text" id="category" name="category" required>
        </div>

        <button type="submit">Create Category</button>
    </form>
</body>
</html>