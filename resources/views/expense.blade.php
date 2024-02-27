<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Expenses</title>
    <style>
        /* Custom Styles */
        body {
            background-image: url('bg4.jpg'); /* Set the background image */
            background-size: cover; /* Cover the entire viewport */
            background-repeat: no-repeat; /* Do not repeat the background image */
            font-family: 'Times New Roman', Times, serif; /* Change font to Times New Roman */
        }
        .expense-card {
            background-color: rgba(0, 0, 0, 0.5); /* Transparent black background */
            color: #fff; /* White text color */
            border: 1px solid #c4cacf; /* Lighter Grey border */
            border-radius: 10px;
            margin-right: 15px; /* Add margin between cards */
            margin-bottom: 15px;
            padding: 15px;
            transition: transform 0.3s;
            flex: 1; /* Make card flex to fit container */
            max-width: calc(25% - 15px); /* Adjust for 4 cards in a row */
        }
        .expense-card:last-child {
            margin-right: 0; /* Remove margin from the last card */
        }
        .expense-card:hover {
            transform: translateY(-5px);
        }
        .expense-header {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #fff; /* White text color */
        }
        .expense-icon {
            margin-right: 5px;
        }
        .edit-btn, .delete-btn {
            padding: 5px 10px;
            font-size: 0.9rem;
            margin-right: 5px;
        }
        .edit-btn {
            background-color: #6c757d; /* Dark Grey button */
            color: #fff;
            border: none;
        }
        .edit-btn:hover {
            background-color: #495057; /* Darken button on hover */
        }
        .delete-btn {
            background-color: #6c757d; /* Dark Grey button */
            color: #fff;
            border: none;
        }
        .delete-btn:hover {
            background-color: #dc3545; /* Darken button on hover */
        }
        #graph-container {
            width: calc(100% - 40px); /* Adjust width and add some space on the sides */
            height: 300px; /* Adjust height as needed */
            margin: 15px auto; /* Center the graph container and add some space below */
            background-color: rgba(0, 0, 0, 0.5); /* Transparent black background for the graph */
            padding: 15px; /* Match padding with expense card */
            border-radius: 10px; /* Match border-radius with expense card */
        }
        .add-expenses-btn {
            position: absolute;
            top: 50px;
            left: 50%;
            transform: translateX(-50%);
        }
        .expenses-container {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px; /* Counteract the margin added to expense cards */
            flex-direction: row; /* Initial direction */
        }
        @media (max-width: 992px) {
            .expenses-container {
                flex-direction: column; /* Change direction to column on smaller screens */
            }
        }
        .badge-price {
            color: #fff; /* Set the color to white */
        }
    </style>
</head>
<body>
@include('include.header')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <h4 class="alert alert-success">{{ session('message') }}</h4>
            @endif
            <div class="expenses-container"> <!-- Changed id to class -->
                @foreach ($expenses as $index => $expense)
                    <div class="expense-card">
                        <div class="expense-header">
                            {{ $expense->exp }}
                            <span class="badge badge-price">₱ {{ $expense->price }}</span>
                        </div>
                        <div class="expense-actions">
                            <a href="{{ route('expenses.edit', $expense->id) }}" class="edit-btn">
                                <i class="fas fa-edit expense-icon"></i> Edit
                            </a>
                            <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('Are you Sure?')">
                                    <i class="fas fa-trash expense-icon"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    @if (($index + 1) % 5 === 0)
                        <div class="w-100"></div> <!-- Add a new row after every 5th card -->
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
<div id="graph-container"></div>
<a href="{{ route('expenses.create') }}" class="btn btn-light add-expenses-btn">Add Expenses</a>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    var chart; // Declare chart variable

// Render the graph initially
renderGraph();

// Update the graph data periodically
setInterval(renderGraph, 10000); // Update every 10 seconds

function renderGraph() {
    // Simulated data for the graph
    var data = [];
    for (var i = 0; i < 10; i++) {
        data.push(Math.random() * 100);
    }

    // If chart is already initialized, update the series data
    if (chart) {
        chart.series[0].setData(data);
    } else {
        // Otherwise, initialize the chart
        chart = Highcharts.chart('graph-container', {
            chart: {
                backgroundColor: 'rgba(0, 0, 0, 0.5)' // Transparent black background for the chart
            },
            title: {
                text: 'Real-time Stock Graph',
                style: {
                    color: '#fff' // White text color for the title
                }
            },
            series: [{
                name: 'Stock Price',
                data: data
            }]
        });
    }
}
</script>
</body>
</html>
