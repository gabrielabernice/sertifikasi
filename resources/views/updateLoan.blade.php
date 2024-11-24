<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Loan</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Loan</h2>

        {{-- form for updat eloan --}}
        <form action="/update_loan" method="POST">
            @csrf
            <input type="hidden" name="loan_id" value="{{ $loan->id }}">
            <input type="hidden" name="from_edit" value="yes">

            <div class="form-group">
                <label for="member_name">Member:</label>
                <input type="text" id="member_name" class="form-control" value="{{ $loan->member->name }}" disabled>
            </div>

            <div class="form-group">
                <label for="book_title">Book:</label>
                <input type="text" id="book_title" class="form-control" value="{{ $loan->book->title }}" disabled>
            </div>

            <div class="form-group">
                <label for="loan_date">Loan Date:</label>
                <input type="date" id="loan_date" class="form-control" value="{{ $loan->loan_date }}" disabled>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="is_returned" id="is_returned" value="1" {{ $loan->is_returned ? 'checked' : '' }}>
                <label class="form-check-label" for="is_returned">Is Returned</label>
            </div>

            <div class="d-flex justify-content-between">
                <a href="/loans" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Update Loan</button>
            </div>
        </form>
    </div>
</body>
</html>
