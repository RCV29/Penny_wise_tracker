<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("bg9.jpg"); /* Assuming bg1.jpg is your background image */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            padding-top: 120px; /* Adjusted padding */
            padding-bottom: 40px;
            font-family: 'Times New Roman', Times, serif; /* Change font to Times New Roman */
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 10px;
        }

        .card-header {
            background-color: rgba(108, 117, 125, 0.8);
            color: #fff;
            border-bottom: none;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-title {
            margin-bottom: 0;
            font-size: 1.5rem;
        }

        .form-label {
            color: #6c757d;
        }

        .form-control {
            border-color: #c4cacf;
        }

        .btn-primary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-primary:hover {
            background-color: #495057;
            border-color: #495057;
        }

        a {
            color: #6c757d;
        }

        a:hover {
            color: #495057;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title text-center">Login</h1> <!-- Centering the login text -->
                </div>
                <div class="card-body">
                    @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="registration" class="form-label text-center"><a href="{{route('registration')}}">Register</a></label> <!-- Centering the registration text -->
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
