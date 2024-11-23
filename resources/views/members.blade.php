<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Members</title>
</head>
<body>

    {{-- table to read members --}}
    <table>
        {{-- tr itu yang ke kanan
        td itu yang ke bawah --}}
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>

        @foreach ($members as $member)
        <tr>
            <td>{{$member->id}}</td>
            <td>{{$member->name}}</td>
            <td>{{$member->email}}</td>
            <td>{{$member->phone_number}}</td>
            {{-- button to edit member --}}
            <td>
                <form action="/update_member" method="POST">
                    @csrf
                    <input type="hidden" name="member_id" value="{{$member->id}}">
                    <button type="submit">Update</button>
                </form>
            </td>
            {{-- button to delete member --}}
            <td>
                <form action="/delete_member" method="POST">
                    @csrf
                    <input type="hidden" name="member_id" value="{{$member->id}}">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this member?');">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
   
    <br>

    {{-- form to create new member --}}
    <form action="/create_member" method="POST">
        @csrf
        {{-- name input --}}
        <div>
            <label for="name">Name : </label>
            <input type="text" id="name" name="name" required>
        </div>

        <br>

        {{-- email input --}}
        <div>
            <label for="email">Email : </label>
            <input type="email" id="email" name="email" required>
        </div>

        <br>

        {{-- phone number input --}}
        <div>
            <label for="phone_number">Phone Number : </label>
            <input type="tel" id="phone_number" name="phone_number" pattern="08[0-9]{10}" required>
        </div>

        <br>

        <button type="submit">Create Member</button>
    </form>
</body>
</html>