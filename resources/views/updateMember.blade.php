<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Member</title>
</head>
<body>
    <form action="/update_member" method="POST">
        @csrf
        <input type="hidden" name="member_id" value="{{ $member->id }}">

        {{-- name input --}}
        <div>
            <label for="name">Name : </label>
            <input type="text" id="name" name="name" value="{{$member->name}}" required>
        </div>
        
        <br>

        {{-- email input --}}
        <div>
            <label for="email">Email : </label>
            <input type="email" id="email" name="email" value="{{$member->email}}" required>
        </div>

        <br>

        {{-- phone number input --}}
        <div>
            <label for="phone_number">Phone Number : </label>
            <input type="tel" id="phone_number" name="phone_number" value="{{$member->phone_number}}" pattern="08[0-9]{10}" required>
        </div>

        <br>

        <button type="submit">Update Member</button>
    </form>
</body>
</html>