<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Expenses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('bg3.jpg'); /* Add your background image URL */
            background-size: cover; /* Cover the entire viewport */
            background-repeat: no-repeat; /* Do not repeat the background image */
            font-family: 'Times New Roman', Times, serif; /* Change font to Times New Roman */
        }
        .card {
            background-color: rgba(233, 236, 239, 0.6); /* Transparent Grey background */
            border: 1px solid #ced4da;
            border-radius: 10px;
        }
        .card-header {
            background-color: #343a40; /* Dark Grey background for header */
            color: #fff; /* White text for header */
            border-bottom: none; /* Remove border bottom from header */
        }
        .btn-primary {
            background-color: #6c757d; /* Dark Grey button */
            border-color: #6c757d; /* Dark Grey border */
        }
        .btn-primary:hover {
            background-color: #495057; /* Darken button on hover */
            border-color: #495057; /* Darken border on hover */
        }
        input[type="text"] {
            background-color: #fff; /* White background for text input */
            border: 1px solid #ced4da; /* Light Grey border for text input */
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
                <div class="alert alert">{{ session('status') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Add Expenses
                        <a href="{{ url('expenses') }}" class="btn btn-primary float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('expenses') }}" method="POST">
                        @csrf

                        <h4>Expenses</h4>
                        <div class="mb-3">
                            <label>Expense</label>
                            <input type="text" name="exp" value="{{ old('exp') }}" required>
                            @error('exp') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Price</label>
                            <input type="text" name="price" value="{{ old('price') }}" required>
                            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
