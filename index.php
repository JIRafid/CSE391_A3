<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_workshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch mechanics
$sql = "SELECT id, name FROM mechanics";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Workshop Appointment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Car Workshop Appointment System</h1>
    
    <!-- User Panel -->
    <div id="user-panel">
        <h2>User Panel</h2>
        <form id="appointment-form" action="submit_appointment.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="car_license">Car License Number:</label>
            <input type="text" id="car_license" name="car_license" required>

            <label for="car_engine">Car Engine Number:</label>
            <input type="text" id="car_engine" name="car_engine" required>

            <label for="appointment_date">Appointment Date:</label>
            <input type="date" id="appointment_date" name="appointment_date" required>

            <label for="mechanic">Select Mechanic:</label>
            <select id="mechanic" name="mechanic" required>
                <option value="">-- Select Mechanic --</option>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                    }
                } else {
                    echo "<option value=''>No mechanics available</option>";
                }
                ?>
            </select>

            <button type="submit">Submit Appointment</button>
        </form>
    </div>

    <!-- Admin Panel -->
    <div id="admin-panel">
        <h2>Admin Panel</h2>
        <a href="login.php">Go to Admin Panel</a>
    </div>

    <script src="script.js"></script>
</body>
</html>
