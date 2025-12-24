<?php
include "config.php"; // koneksi ke DB

$username = $_POST['username'];
$phone = $_POST['userphone'];
$email = $_POST['useremail'];
$vaccine_id = $_POST['vaccine'];
$schedule = $_POST['schedule'];

$result = mysqli_query($conn, "SELECT vaccine_name FROM vaccines WHERE id = $vaccine_id");
$row = mysqli_fetch_assoc($result);
$vaccine_name = $row['vaccine_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Result</title>
</head>
<body>

<h2>Order Result</h2>

<p><strong>User:</strong> <?php echo $username; ?></p>
<p><strong>Phone:</strong> <?php echo $phone; ?></p>
<p><strong>Email:</strong> <?php echo $email; ?></p>
<p><strong>Vaccine:</strong> <?php echo $vaccine_name; ?></p>
<p><strong>Schedule:</strong> <?php echo $schedule; ?></p>

<br>
<a href="index.php">Back to Booking</a>

</body>
</html>
