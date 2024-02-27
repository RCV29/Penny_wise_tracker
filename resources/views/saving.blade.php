<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Savings</title>
    <style>
        /* Custom Styles */
        body {
            background-image: url('bg3.jpg'); /* Background image path */
            background-size: cover; /* Cover the entire viewport */
            background-repeat: no-repeat; /* Do not repeat the background image */
            background-position: center center; /* Center the background image */
            background-attachment: fixed; /* Fix the background image */
            background-color: rgba(0, 0, 0, 0.5); /* Fallback color */
        }
        .content-container {
            background-color: rgba(255, 255, 255, 0.8); /* Container background color with opacity */
            padding: 20px;
            border-radius: 10px;
        }
        .saving-card {
            background-color: rgba(0, 0, 0, 0.5); /* Transparent black card background */
            color: #fff; /* White text color */
            border-radius: 10px;
            margin-bottom: 15px;
            padding: 15px;
            transition: all 0.3s ease;
        }
        .saving-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: translateY(-3px);
        }
        .saving-header {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        .saving-icon {
            margin-right: 5px;
        }
        .edit-btn, .delete-btn {
            padding: 5px 10px;
            font-size: 0.9rem;
            margin-right: 5px;
            background-color: #6c757d; /* Dark Grey button */
            color: #fff;
            border: none;
            transition: background-color 0.3s ease;
        }
        .edit-btn:hover, .delete-btn:hover {
            background-color: #495057; /* Darken button on hover */
        }
        .edit-form {
            display: none;
        }
    </style>
</head>
<body>
@include('include.header')
<div class="container mt-5 content-container">
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <h4 class="alert alert-success">{{ session('message') }}</h4>
            @endif
            <div id="savingsInputContainer">
                <form action="{{ route('savings.store') }}" method="POST">
                    @csrf
                    <label for="amount">Enter Amount:</label>
                    <input type="number" id="amount" name="amount" class="form-control" required>
                    <button type="submit" class="btn btn-primary mt-2">Save</button>
                </form>
            </div>
            <div class="row">
                @foreach ($savings as $saving)
                    <div class="col-md-4">
                        <div class="card saving-card">
                            <div class="card-body">
                                <h5 class="card-title saving-header">₱{{ $saving->amount }}</h5>
                                <div class="saving-actions">
                                    <a href="javascript:void(0)" onclick="showEditForm('{{ $saving->id }}')" class="edit-btn">
                                        <i class="fas fa-edit saving-icon"></i> Edit
                                    </a>
                                    <form action="{{ route('savings.destroy', $saving->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn" onclick="return confirm('Are you Sure?')">
                                            <i class="fas fa-trash saving-icon"></i> Delete
                                        </button>
                                    </form>
                                </div>
                                <div id="edit-form-{{ $saving->id }}" class="edit-form">
                                    <form action="{{ route('savings.update', $saving->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <label for="edit-amount">Edit Amount:</label>
                                        <input type="number" id="edit-amount" name="amount" class="form-control" required>
                                        <button type="submit" class="btn btn-primary mt-2">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
    function showEditForm(id) {
        var editForm = document.getElementById('edit-form-' + id);
        if (editForm.style.display === 'none') {
            editForm.style.display = 'block';
        } else {
            editForm.style.display = 'none';
        }
    }
</script>
</body>
</html>
