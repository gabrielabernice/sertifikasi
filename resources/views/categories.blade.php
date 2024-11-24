<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Categories</h2>
        
        {{-- view categories table --}}
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->category}}</td>
                    <td>
                        <form action="/update_category" method="POST">
                            @csrf
                            <input type="hidden" name="category_id" value="{{$category->id}}">
                            <button type="submit" class="btn btn-warning">Update</button>
                        </form>
                    </td>
                    <td>
                        <form action="/delete_category" method="POST">
                            @csrf
                            <input type="hidden" name="category_id" value="{{$category->id}}">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- create new category form --}}
        <h3>Create New Category</h3>
        <form action="/create_category" method="POST">
            @csrf
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Create Category</button>
        </form>

        {{-- back button  --}}
        <a href="/" class="btn btn-secondary mt-3">Back to Home</a>
    </div>
</body>
</html>
