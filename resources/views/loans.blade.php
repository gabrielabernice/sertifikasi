<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Loans</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Loans</h2>

        {{-- filter form --}}
        <form action="/loans" method="GET" class="form-inline mb-3">
            <label for="member_id" class="mr-2">Filter by Member:</label>
            <select name="member_id" id="member_id" class="form-control mr-2" onchange="this.form.submit()">
                <option value="">-- All Members --</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}" {{ request('member_id') == $member->id ? 'selected' : '' }}>
                        {{ $member->name }}
                    </option>
                @endforeach
            </select>
            <noscript>
                <button type="submit" class="btn btn-primary">Filter</button>
            </noscript>
        </form>

        {{-- view loans table --}}
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Member</th>
                    <th>Book</th>
                    <th>Loan Date</th>
                    <th>Return Date</th>
                    <th>Is Returned</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                <tr>
                    <td>{{$loan->id}}</td>
                    <td>{{$loan->member->name}}</td>
                    <td>{{$loan->book->title }}</td>
                    <td>{{$loan->loan_date}}</td>
                    <td>{{$loan->return_date}}</td>
                    <td>{{$loan->is_returned ? 'Yes' : 'No'}}</td>
                    <td>
                        <form action="/update_loan" method="POST">
                            @csrf
                            <input type="hidden" name="loan_id" value="{{$loan->id}}">
                            <button type="submit" class="btn btn-warning">Update</button>
                        </form>
                    </td>
                    <td>
                        <form action="/delete_loan" method="POST">
                            @csrf
                            <input type="hidden" name="loan_id" value="{{$loan->id}}">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this loan?');">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- create new loan formm --}}
        <h3>Create New Loan</h3>
        <form action="/create_loan" method="post">
            @csrf
            <div class="form-group">
                <label for="member_id">Select Member:</label>
                <select name="member_id" id="member_id" class="form-control" required>
                    <option value="">-- Select a Member --</option>
                    @foreach ($members as $member)
                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group">
                <label for="books">Select Books:</label>
                <select name="books[]" id="books" class="form-control" multiple required>
                    <option disabled>Select books</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                    @endforeach
                </select>
                <small class="text-danger">*Hold 'Ctrl' (Windows) or 'Command' (Mac) to select multiple books.</small>
            </div>
    
            <button type="submit" class="btn btn-success">Record Borrow</button>
        </form>

        {{-- button back --}}
        <a href="/" class="btn btn-secondary mt-3">Back to Home</a>
    </div>
</body>
</html>
