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

// Fetch appointments
$sql = "SELECT appointments.id, appointments.name, appointments.phone, appointments.car_license, 
        appointments.appointment_date, mechanics.name AS mechanic_name 
        FROM appointments 
        JOIN mechanics ON appointments.mechanic_id = mechanics.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="admin-container">
        <h1>Admin Panel - Appointments</h1>
        <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Car License</th>
                <th>Appointment Date</th>
                <th>Mechanic</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['car_license']; ?></td>
                <td><?php echo $row['appointment_date']; ?></td>
                <td><?php echo $row['mechanic_name']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <?php else: ?>
            <p>No appointments available.</p>
        <?php endif; ?>
        <a href="index.php">Back to Home</a>
        <a href="logout.php">Logout</a>
    </form>
    </div>

</body>
</html>

<?php
$conn->close();
?>
