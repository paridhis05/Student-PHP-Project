<?php
session_start();
include 'connection.php';

// Example: Assume student is already logged in and session has student_id
$student_id = $_SESSION['student_id'] ?? 1; // fallback to 1 if not set

// Fetch student details
$student_query = mysqli_query($conn, "SELECT * FROM form WHERE id = $student_id");
$student = mysqli_fetch_assoc($student_query);

// Fetch payment status (assume there's a 'payments' table)
$payment_query = mysqli_query($conn, "SELECT * FROM payments WHERE student_id = $student_id");
$payments = mysqli_fetch_all($payment_query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="styleform.css">
    <style>
        .dashboard-container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }
        .info-section {
            margin-bottom: 30px;
        }
        .info-section h2 {
            margin-bottom: 10px;
            color: #04497a;
        }
        table {
            width: 100%;
            border-collapse: collapse;
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
        }
        .pay-btn:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="info-section">
            <h2>Welcome, <?php echo $student['name']; ?></h2>
            <p><strong>Roll No:</strong> <?php echo $student['rollno']; ?></p>
            <p><strong>Class:</strong> <?php echo $student['class']; ?></p>
        </div>

        <h3>📄 Payment History</h3>
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
            <input type="hidden" name="amount" value="500"> <!-- Default fee -->
            <button type="submit" class="pay-btn">💳 Pay Now</button>
        </form>
    </div>
</body>
</html>
