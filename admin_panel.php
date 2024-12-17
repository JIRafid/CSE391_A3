<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_workshop";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_appointment'])) {
    $appointment_id = $_POST['appointment_id'];
    $new_date = $_POST['appointment_date'];
    $new_mechanic = $_POST['mechanic_id'];

    $update_sql = "UPDATE appointments SET appointment_date = ?, mechanic_id = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sii", $new_date, $new_mechanic, $appointment_id);

    if ($stmt->execute()) {
        $message = "Appointment updated successfully!";
    } else {
        $message = "Failed to update appointment: " . $conn->error;
    }
    $stmt->close();
}

$sql = "SELECT appointments.id, appointments.appointment_date, appointments.name AS client_name, 
               mechanics.name AS mechanic_name, mechanics.id AS mechanic_id
        FROM appointments
        LEFT JOIN mechanics ON appointments.mechanic_id = mechanics.id";
$appointments = $conn->query($sql);

$mechanics_sql = "SELECT id, name FROM mechanics";
$mechanics_result = $conn->query($mechanics_sql);
$mechanics = [];
while ($row = $mechanics_result->fetch_assoc()) {
    $mechanics[] = $row;
}
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
    <h2>Welcome to the Admin Panel</h2>

    <?php if (isset($message)) { echo "<p style='color: green;'>$message</p>"; } ?>

    <h3>Appointments List</h3>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Client Name</th>
            <th>Appointment Date</th>
            <th>Current Mechanic</th>
            <th>Actions</th>
        </tr>
        <?php if ($appointments->num_rows > 0): ?>
            <?php while ($row = $appointments->fetch_assoc()): ?>
                <tr>
                    <form method="POST" action="admin_panel.php">
                        <input type="hidden" name="appointment_id" value="<?php echo $row['id']; ?>">
                        <td><?php echo htmlspecialchars($row['client_name']); ?></td>
                        <td>
                            <input type="date" name="appointment_date" value="<?php echo $row['appointment_date']; ?>" required>
                        </td>
                        <td>
                            <select name="mechanic_id" required>
                                <?php foreach ($mechanics as $mechanic): ?>
                                    <option value="<?php echo $mechanic['id']; ?>"
                                        <?php echo $mechanic['id'] == $row['mechanic_id'] ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($mechanic['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <button type="submit" name="update_appointment">Update</button>
                        </td>
                    </form>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No appointments available.</td>
            </tr>
        <?php endif; ?>
    </table>

    <form action="logout.php" method="POST">
        <button type="submit">Logout</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
