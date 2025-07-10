<?php
include("connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

$students = mysqli_query($conn, "SELECT id, fname, lname FROM form");

if (isset($_POST['submit'])) {
    $student_id = $_POST['student_id'];
    $english = $_POST['english'];
    $hindi = $_POST['hindi'];
    $science = $_POST['science'];
    $math = $_POST['math'];
    $history = $_POST['history'];
    $computer = $_POST['computer'];

    $total = $english + $hindi + $science + $math + $history + $computer;
    $percentage = $total / 6;

    if ($percentage >= 90){ 
        $grade = 'A+';
        $reward = 'Gold Medal';
    } else if ($percentage >= 75) {
        $grade = 'A';
        $reward = '';
    } 
    else if ($percentage >= 60)  {
        $grade = 'B';
        $reward = '';
    } 
    else if ($percentage >= 45) {
        $grade = 'C';
        $reward = '';
    } 
    else  {
        $grade = 'F';
        $reward = '';
    } 

    $query = "INSERT INTO marks (student_id, english, hindi, science, math, history, computer, total_marks, percentage, grade, reward) 
              VALUES ('$student_id', '$english', '$hindi', '$science', '$math', '$history', '$computer', '$total', '$percentage', '$grade', '$reward')";

    $run = mysqli_query($conn, $query);

    if ($run) {

        if (!empty($reward)) {

            $studentQuery = mysqli_query($conn, "SELECT email, fname FROM form WHERE id = '$student_id'");
            $studentData = mysqli_fetch_assoc($studentQuery);
            $studentEmail = $studentData['email'];
            $studentName = $studentData['fname'];

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = '@gmail.com'; // Sender email
                $mail->Password = '';    // Use App Password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('paridhis004@gmail.com', 'Student Portal');
                $mail->addAddress($studentEmail, $studentName);
                $mail->isHTML(true);
                $mail->Subject = "Congratulations $studentName!";
                $mail->Body = "Dear $studentName,<br><br>
                               You have achieved <strong>Grade: $grade</strong>.<br>
                               You are awarded: <strong>$reward</strong>!<br><br>
                               Regards,<br>Student Portal";

                $mail->send();
                echo "<script>alert('Marks submitted and reward email sent!');</script>";
            } catch (Exception $e) {
                echo "<script>alert('Marks saved, but email not sent.');</script>";
            }
        } else {
            echo "<script>alert('Marks Submitted! Grade: $grade');</script>";
        }
    } else {
        echo "<script>alert('Failed to enter marks');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enter Marks</title>
</head>
<body>
    <h2>Enter Marks for Student </h2>
    <form method="POST">
        <label>Select Student:</label>
        <select name="student_id" required>
            <option value="">-- Select --</option>
            <?php while ($row = mysqli_fetch_assoc($students)) { ?>
                <option value="<?= $row['id'] ?>">
                    <?= $row['id'] . " - " . $row['fname'] . " " . $row['lname'] ?>
                </option>
            <?php } ?>
        </select><br><br>

        <label>English:</label>
        <input type="number" name="english" required><br><br>

        <label>Hindi:</label>
        <input type="number" name="hindi" required><br><br>

        <label>Science:</label>
        <input type="number" name="science" required><br><br>

        <label>Math:</label>
        <input type="number" name="math" required><br><br>

        <label>History:</label>
        <input type="number" name="history" required><br><br>

        <label>Computer:</label>
        <input type="number" name="computer" required><br><br>

        <input type="submit" name="submit" value="Submit Marks">
    </form>
</body>
</html>

