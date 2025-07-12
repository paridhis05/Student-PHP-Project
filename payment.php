<?php
include 'connection.php';

$student_id = $_POST['student_id'];
$amount = $_POST['amount'];

// Simulate payment success
$status = "Paid";

mysqli_query($conn, "INSERT INTO payments (student_id, amount, status) VALUES ($student_id, $amount, '$status')");

echo "<script>alert('Payment Successful!'); window.location.href='dashboard.php';</script>";
