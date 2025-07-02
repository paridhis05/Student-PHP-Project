<?php
include("connection.php");

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
    $percentage = $total / 5;

    if ($percentage >= 90) $grade = 'A+';
    else if ($percentage >= 75) $grade = 'A';
    else if ($percentage >= 60) $grade = 'B';
    else if ($percentage >= 45) $grade = 'C';
    else $grade = 'F';

    $query = "INSERT INTO marks (student_id, english, hindi, science, math, history, computer, total_marks, percentage, grade) 
              VALUES ('$student_id', '$english', '$hindi', '$science', '$math', '$history', '$computer', '$total', '$percentage', '$grade')";

    $run = mysqli_query($conn, $query);

    if ($run) {
        echo "<script>alert('Marks entered successfully');</script>";
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

