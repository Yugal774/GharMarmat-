<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Professional Dashboard</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f4f6f8;
        padding: 20px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .header h1 {
        font-size: 24px;
        color: #111827;
    }

    .header button {
        padding: 10px 15px;
        background: #ef4444;
        color: #fff;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
    }

    .header button:hover {
        background: #b91c1c;
    }

    h2 {
        margin-bottom: 15px;
        color: #111827;
    }

    .table-container {
        overflow-x: auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 15px;
        text-align: left;
    }

    th {
        background: #f3f4f6;
        color: #374151;
    }

    tr:nth-child(even) {
        background: #f9fafb;
    }

    tr:hover {
        background: #e5e7eb;
    }

    .status-pending {
        color: orange;
        font-weight: bold;
    }

    .status-confirmed {
        color: green;
        font-weight: bold;
    }

    .status-cancelled {
        color: red;
        font-weight: bold;
    }

    .action-btn {
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        color: #fff;
        margin-right: 5px;
        transition: 0.3s;
    }

    .confirm-btn {
        background: #10b981;
    }

    .confirm-btn:hover {
        background: #047857;
    }

    .cancel-btn {
        background: #f59e0b;
    }

    .cancel-btn:hover {
        background: #b45309;
    }
</style>
</head>
<body>

<div class="header">
    <h1 id="welcomeMessage">Welcome, Professional</h1>
    <button onclick="logout()">Logout</button>
</div>

<h2>Booking Requests</h2>

<div class="table-container">
    <table id="bookingTable">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>User Name</th>
                <th>Service</th>
                <th>Price</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>001</td>
                <td>Yugal Rai</td>
                <td>Basic Service</td>
                <td>$50</td>
                <td>2025-12-25</td>
                <td>10:00 - 11:00</td>
                <td class="status-pending">Pending</td>
                <td>
                    <button class="action-btn confirm-btn" onclick="confirmBooking(this)">Confirm</button>
                    <button class="action-btn cancel-btn" onclick="cancelBooking(this)">Cancel</button>
                </td>
            </tr>
            <tr>
                <td>002</td>
                <td>John Doe</td>
                <td>Premium Service</td>
                <td>$80</td>
                <td>2025-12-26</td>
                <td>12:00 - 13:00</td>
                <td class="status-pending">Pending</td>
                <td>
                    <button class="action-btn confirm-btn" onclick="confirmBooking(this)">Confirm</button>
                    <button class="action-btn cancel-btn" onclick="cancelBooking(this)">Cancel</button>
                </td>
            </tr>
            <tr>
                <td>003</td>
                <td>Jane Smith</td>
                <td>Emergency Service</td>
                <td>$100</td>
                <td>2025-12-27</td>
                <td>15:00 - 16:00</td>
                <td class="status-confirmed">Confirmed</td>
                <td>-</td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    const professionalName = "Alex"; // Replace dynamically from login
    document.getElementById('welcomeMessage').textContent = `Welcome, ${professionalName}`;

    function logout() {
        alert("You are logged out!");
        // Example redirect to login page
        // window.location.href = "login.html";
    }

    function confirmBooking(button) {
        const row = button.parentElement.parentElement;
        const statusCell = row.querySelector('td:nth-child(7)');
        if(statusCell.classList.contains('status-cancelled') || statusCell.classList.contains('status-confirmed')){
            alert("Cannot confirm this booking!");
            return;
        }
        if(confirm("Are you sure you want to confirm this booking?")){
            statusCell.textContent = "Confirmed";
            statusCell.className = "status-confirmed";
            row.querySelector('td:nth-child(8)').innerHTML = "-"; // Remove action buttons
        }
    }

    function cancelBooking(button) {
        const row = button.parentElement.parentElement;
        const statusCell = row.querySelector('td:nth-child(7)');
        if(statusCell.classList.contains('status-cancelled') || statusCell.classList.contains('status-confirmed')){
            alert("Cannot cancel this booking!");
            return;
        }
        if(confirm("Are you sure you want to cancel this booking?")){
            statusCell.textContent = "Cancelled";
            statusCell.className = "status-cancelled";
            row.querySelector('td:nth-child(8)').innerHTML = "-"; // Remove action buttons
        }
    }
</script>

</body>
</html>
