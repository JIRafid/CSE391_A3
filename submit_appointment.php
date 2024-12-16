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

// Gather form data
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$car_license = $_POST['car_license'];
$car_engine = $_POST['car_engine'];
$appointment_date = $_POST['appointment_date'];
$mechanic_id = $_POST['mechanic'];

// Check for duplicate appointment
$sql = "SELECT * FROM appointments WHERE phone='$phone' AND appointment_date='$appointment_date'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "You already have an appointment on this date.";
} else {
    // Insert appointment
    $sql = "INSERT INTO appointments (name, address, phone, car_license, car_engine, appointment_date, mechanic_id)
            VALUES ('$name', '$address', '$phone', '$car_license', '$car_engine', '$appointment_date', '$mechanic_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
