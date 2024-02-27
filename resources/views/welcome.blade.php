<!DOCTYPE html>
<html lang="en">
<head>
  <base href="/public">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'PennyWise')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('bg8.jpg'); /* Add a background image with money-related elements */
      background-size: cover; /* Cover the entire background */
      background-repeat: no-repeat; /* Prevent the image from repeating */
      height: 100vh; /* Set the height of the body to full viewport height */
      margin: 0; /* Remove default margin */
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif; /* Set a fallback font */
    }
    .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 800px;
      padding: 20px;
      background: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
    }
    .left-content {
      width: 45%;
      color: #333; /* Set text color */
      padding: 20px;
      border-right: 1px solid #ccc; /* Add a border to separate left and right content */
    }
    .right-content {
      width: 45%;
      padding: 20px;
    }
    h2, p {
      margin-bottom: 20px; /* Add some spacing between headings and paragraphs */
    }
    .form-link {
      color: #007bff;
      text-decoration: none;
    }
    .form-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="left-content">
      <h2>Welcome to PennyWise</h2>
      <p>Start managing your finances easily with PennyWise. Our intuitive interface helps you keep track of your expenses and savings effectively.</p>
      <p>Features:</p>
      <ul>
        <li>Track expenses and income</li>
        <li>Create budgets and savings goals</li>
        <li>Visualize your spending with graphs and charts</li>
        <li>Access your finances anywhere, anytime</li>
      </ul>
    </div>
    <div class="right-content">
      <div class="mb-3 text-center">
        
      </div>
      <div class="mb-3">
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg d-block mb-3">Login</a>
        <a href="{{ route('registration') }}" class="btn btn-secondary btn-lg d-block">Register</a>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
