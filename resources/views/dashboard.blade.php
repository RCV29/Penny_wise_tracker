<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Tracking Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom CSS styles */
        body {
            /* Specify the URL of your background image here */
            background-image: url('bg7.jpg');
            background-size: cover; /* Cover the entire viewport */
            background-repeat: no-repeat; /* Do not repeat the background image */
            padding-bottom: 20px;
            font-family: 'Times New Roman', Times, serif; /* Change font to Times New Roman */
        }

        .container {
            padding: 20px;
        }

        .card-container {
            display: flex;
            flex-direction: column;
            gap: 30px;
            width: 80%; /* Adjust width to 80% */
            align-items: flex-start; /* Align items to the left */
        }

        .card, .reminder .card {
            background-color: rgba(255, 255, 255, 0.9); /* White with 90% opacity */
            color: black; /* Text color */
            border: none;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer; /* Add cursor pointer */
            text-decoration: none; /* Remove underline */
            text-align: center; /* Center align text */
            width: 100%; /* Make cards take up full width */
        }

        .card:hover, .reminder .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-size: 20px; /* Increase font size */
        }

        #myChart {
            width: 100%;
            max-width: 800px;
        }

        /* Calendar and Net Worth styles */
        .calendar {
            background-color: #e0e5eb;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        /* Net Worth Entry Form Styles */
        .net-worth-form {
            margin-top: 20px;
        }

        .net-worth-form input[type="text"] {
            margin-right: 10px;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .net-worth-form input[type="submit"] {
            background-color: #6c757d;
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .net-worth-form input[type="submit"]:hover {
            background-color: #495057;
        }

        /* Reminder Styles */
        .reminder {
            margin-top: 20px;
        }

        .reminder .card {
            margin-top: 20px;
        }

        .reminder form {
            margin-bottom: 20px;
        }

        .reminder ul {
            list-style-type: none;
            padding-left: 0;
        }

        .reminder ul li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
@include('include.header')
<!-- Header -->
<!-- @include('include.header') -->

<!-- Main Content -->
<div class="container">
    <div class="row">
        <!-- Card Section -->
        <div class="col-md-4">
            <div class="card-container">
                <!-- Make Savings card clickable -->
                <a href="{{ url('savings') }}" class="card">
                    <h5 class="card-title text-center" style="text-decoration: none;">Savings</h5>
                </a>
                <!-- Make Expenses card clickable -->
                <a href="{{ url('expenses') }}" class="card">
                    <h5 class="card-title text-center" style="text-decoration: none;">Expenses</h5>
                </a>
                <!-- New Card for "More" -->
                <div class="card">
                    <h5 class="card-title">About Us</h5>
                </div>
            </div>
        </div>
        <!-- Chart Section -->
        <div class="col-md-8">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <!-- Reminder Section -->
    <div class="reminder mt-5">
        <div class="card">
            <h5 class="card-title">Reminders</h5>
            <form id="reminderForm">
                <div class="mb-3">
                    <label for="reminderInput" class="form-label">Set a Reminder</label>
                    <input type="text" class="form-control" id="reminderInput" placeholder="Enter your reminder">
                </div>
                <button type="button" class="btn btn-primary" onclick="saveReminder()">Save Reminder</button>
                <button type="button" class="btn btn-secondary" onclick="resetReminders()">Reset Reminders</button> <!-- New reset button -->
            </form>
            <div id="remindersContainer" class="mt-3"></div>
        </div>
    </div>
</div>

<!-- JavaScript for reminders -->
<script>
    // Function to save reminder to localStorage for the logged-in user
    function saveReminder() {
        const reminderInput = document.getElementById('reminderInput').value.trim();
        if (reminderInput !== '') {
            // Assuming you have a way to get the user ID, replace 'userId' with the actual user ID
            const userId = getUserId(); // You need to implement this function
            let userReminders = JSON.parse(localStorage.getItem(`reminders_${userId}`)) || [];
            userReminders.push(reminderInput);
            localStorage.setItem(`reminders_${userId}`, JSON.stringify(userReminders));
            document.getElementById('reminderInput').value = ''; // Clear input field
            displayReminders();
        } else {
            alert('Please enter a reminder!');
        }
    }

    // Function to reset reminders for the logged-in user
    function resetReminders() {
        // Assuming you have a way to get the user ID, replace 'userId' with the actual user ID
        const userId = getUserId(); // You need to implement this function
        localStorage.removeItem(`reminders_${userId}`);
        displayReminders();
    }

    // Function to display reminders for the logged-in user
    function displayReminders() {
        const remindersContainer = document.getElementById('remindersContainer');
        remindersContainer.innerHTML = ''; // Clear previous reminders
        // Assuming you have a way to get the user ID, replace 'userId' with the actual user ID
        const userId = getUserId(); // You need to implement this function
        let userReminders = JSON.parse(localStorage.getItem(`reminders_${userId}`)) || [];
        if (userReminders.length > 0) {
            const ul = document.createElement('ul');
            userReminders.forEach(reminder => {
                const li = document.createElement('li');
                li.textContent = reminder;
                ul.appendChild(li);
            });
            remindersContainer.appendChild(ul);
        } else {
            remindersContainer.textContent = 'No reminders set.';
        }
    }

    // Display reminders when the page loads
    window.onload = function () {
        displayReminders();
    };

    // Mock function to get user ID (replace this with your actual implementation)
    function getUserId() {
        // Here you can use any method to get the user ID, like session, cookie, or user input
        // For demonstration purposes, I'll just return a fixed user ID
        return 'user123';
    }
</script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0"></script>
<script>
    // Data for the bar chart
    const labels = ['January', 'February', 'March', 'April', 'May', 'June'];
    const initialData = [1000, 1500, 1200, 1800, 2000, 1700]; // Example data, replace with your actual data

    // Configuration options
    const config = {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Budget Expenditure',
                backgroundColor: 'rgba(123, 255, 155, 0.7)', // Mint Green with 70% opacity
                borderColor: 'rgba(136, 138, 133, 1)', // Smokey Grey border color
                borderWidth: 1,
                data: initialData
            }]
        },
        options: {
            scales: {
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.5)' // White with 50% opacity
                    }
                },
                y: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.5)' // White with 50% opacity
                    },
                    beginAtZero: true
                }
            }
        }
    };

    // Create the chart
    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

    // Function to update chart data
    function updateChartData() {
        const newData = myChart.data.datasets[0].data.map(value => value * Math.random()); // Randomize data
        myChart.data.datasets[0].data = newData;
        myChart.update();
    }

    // Update chart data every 2 seconds
    setInterval(updateChartData, 2000);
</script>

<!-- Bootstrap JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
