<?php
include("connection.php");

// Delete selected checkboxes
if (isset($_POST['delete_ids']) && is_array($_POST['delete_ids'])) {
    $delete_ids = $_POST['delete_ids'];

    foreach ($delete_ids as $id) {
        $query = "DELETE FROM form WHERE id = '$id'";
        mysqli_query($conn, $query);
    }

    echo "<script>alert('Selected records deleted!');</script>";
    echo "<meta http-equiv='refresh' content='0; url=table.php' />"; // redirect back to table.php
    exit();
} else {
    echo "<script>alert('No records selected.');</script>";
    echo "<meta http-equiv='refresh' content='0; url=table.php' />";
    exit();
}
?>



