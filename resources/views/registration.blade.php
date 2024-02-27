<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        body {
            background-image: url('bg9.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-color: #f3f4f6;
            height: 100vh; /* Set the body height to viewport height */
            margin: 0; /* Remove default body margin */
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Times New Roman', Times, serif; /* Change font to Times New Roman */
        }
        .card-container {
            max-width: 600px; /* Adjust the maximum width of the card container */
            width: 80%; /* Set the width of the card container */
        }
        .card {
            background-color: transparent; /* Set background color to transparent */
            border: none; /* Remove border */
            box-shadow: none; /* Remove box shadow */
        }
        .card-header {
            background-color: rgba(108, 117, 125, 0.7); /* Semi-transparent background color */
            color: #fff;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 20px;
            text-align: center; /* Center-align the text */
        }
        .card-body {
            padding: 20px;
            background-color: rgba(224, 229, 235, 0.7); /* Semi-transparent background color */
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            height: 40px; /* Set the height of the form controls */
        }
        .btn-primary {
            height: 40px; /* Set the height of the button */
        }
    </style>
</head>
<body>
<div class="card-container">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Register</h1> <!-- Center-aligned register text -->
        </div>
        <div class="card-body">
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <form action="{{ route('registration.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="mb-3">
                    <div class="d-grid">
                        <button class="btn btn-primary">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
