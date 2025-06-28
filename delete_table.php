<?php
include("connection.php");

// for selected checkboxes OR "Delete All"
if (isset($_POST['delete_ids'])) {
    // reads the ID values
    $delete_ids = $_POST['delete_ids'];

    foreach ($delete_ids as $id) {
        $query = "DELETE FROM form WHERE id = '$id' ";
        mysqli_query($conn, $query);
    }

    echo "<script>alert('Selected records deleted!');</script>";
    // redirect back to table.php
    echo "<meta http-equiv='refresh' content='0; url=table.php' />";
    exit();
}

// Single delete (Operation)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM form WHERE id = '$id' ";
    $data = mysqli_query($conn, $query);

    if($data){
        echo "<script>alert('Record Deleted!')</script>";
        echo "<meta http-equiv='refresh' content='0; url=table.php' />";
    } else {
        echo "<script>alert('Failed to delete!')</script>";
    }
    exit();
}
?>
