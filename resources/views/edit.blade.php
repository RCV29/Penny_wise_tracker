<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Expenses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <style>
        body {
            background-image: url('bg3.jpg'); /* Add your background image URL */
            background-size: cover; /* Cover the entire viewport */
            background-repeat: no-repeat;
            font-family: 'Times New Roman', Times, serif; /* Change font to Times New Roman */
        }
        .card {
            background-color: rgba(224, 229, 235, 0.8); /* Transparent Grey card background */
            border: 1px solid #c4cacf; /* Lighter Grey border */
            border-radius: 10px;
        }
        .card-header {
            background-color: #6c757d; /* Dark Grey header background */
            color: #fff; /* White text color */
            border-bottom: none; /* Remove bottom border */
            border-top-left-radius: 10px; /* Adjust border radius */
            border-top-right-radius: 10px; /* Adjust border radius */
        }
        .card-body {
            padding: 20px; /* Add padding */
        }
        label {
            color: #333; /* Dark Grey text color */
            font-weight: bold; /* Bold text */
        }
        input[type="text"] {
            background-color: #f8f9fa; /* Light Grey input background */
            border: 1px solid #c4cacf; /* Lighter Grey border */
            border-radius: 5px; /* Rounded border */
            padding: 8px; /* Add padding */
        }
        .btn-primary {
            background-color: #6c757d; /* Dark Grey button */
            border: none; /* Remove button border */
        }
        .btn-primary:hover {
            background-color: #495057; /* Darken button on hover */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert">{{session('status')}}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4 class="m-0">Edit Expenses
                            <a href="{{ url('expenses')}}" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('expenses/'.$expense->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label>Expense</label>
                                <input type="text" name="exp" value="{{$expense->exp}}" required>
                                @error('exp') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label>Price</label>
                                <input type="text" name="price" value="{{$expense->price}}" required>
                                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
