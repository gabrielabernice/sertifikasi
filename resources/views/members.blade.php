<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Members</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Members</h2>

        {{-- view members table --}}
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                <tr>
                    <td>{{$member->id}}</td>
                    <td>{{$member->name}}</td>
                    <td>{{$member->email}}</td>
                    <td>{{$member->phone_number}}</td>
                    <td>
                        <form action="/update_member" method="POST">
                            @csrf
                            <input type="hidden" name="member_id" value="{{$member->id}}">
                            <button type="submit" class="btn btn-warning">Update</button>
                        </form>
                    </td>
                    <td>
                        <form action="/delete_member" method="POST">
                            @csrf
                            <input type="hidden" name="member_id" value="{{$member->id}}">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this member?');">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- create new member form --}}
        <h3>Create New Member</h3>
        <form action="/create_member" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="tel" id="phone_number" name="phone_number" class="form-control" pattern="08[0-9]{10}" required>
                <small class="form-text text-muted">Format: 08XXXXXXXXXX</small>
            </div>

            <button type="submit" class="btn btn-success">Create Member</button>
        </form>

        {{-- back buttin --}}
        <a href="/" class="btn btn-secondary mt-3">Back to Home</a>
    </div>
</body>
</html>
