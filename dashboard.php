<?php
session_start();
include 'connection.php';

$student_id = $_SESSION['student_id'] ?? 1; 

// Fetch student details
$student_query = mysqli_query($conn, "SELECT * FROM form WHERE id = $student_id");
$student = mysqli_fetch_assoc($student_query);

// Fetch payment status
$payment_query = mysqli_query($conn, "SELECT * FROM payments WHERE student_id = $student_id");
$payments = mysqli_fetch_all($payment_query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <!-- <link rel="stylesheet" href="styleform.css"> -->
    <style>
        body {
            background-color: #04497a;
            font-family: sans-serif;
        }
        .dashboard-container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
        }
        .info-section {
            margin-bottom: 30px;
        }
        .info-section h2 {
            color: #04497a;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table th, table td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: center;
        }
        .pay-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            font-size: 16px;
        }
        .pay-btn:hover {
            background-color: darkgreen;
        }
        img {
            border-radius: 15px;
            border: 1px solid #04497a;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="info-section">
            <h2>Welcome, <?php echo $student['fname']; ?></h2>
            <img src="uploads/<?= htmlspecialchars($student['photo']) ?>" alt="Student Photo" height="100px">
            <p><strong>Student ID:</strong> <?php echo $student['id']; ?></p>
            <p><strong>Email Address:</strong> <?php echo $student['email']; ?></p>
        </div>

        <h3>Payment History</h3>
        <?php if ($payments): ?>
        <table>
            <tr>
                <th>Payment ID</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
            <?php foreach ($payments as $payment): ?>
            <tr>
                <td><?php echo $payment['id']; ?></td>
                <td>₹<?php echo $payment['amount']; ?></td>
                <td><?php echo $payment['status']; ?></td>
                <td><?php echo $payment['date']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
            <p>No payments found.</p>
        <?php endif; ?>

        <form action="payment.php" method="post">
            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
            <input type="hidden" name="amount" value="500">
            <button type="submit" class="pay-btn">Pay Now</button>
        </form>
    </div>
</body>
</html>
