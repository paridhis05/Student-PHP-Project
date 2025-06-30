<html>
<head>
    <title>Table</title>
    <style>
        .btn-delete {
            background-color: #C80036;
            color: white;
            padding: 8px 14px;
            border: none;
            margin: 10px 5px;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
        }

        .btn-delete:hover {
            background-color: white;
            color: #C80036;
            border: 1px solid #C80036;
        }

        .search-box {
            margin-bottom: 10px;
            padding: 8px;
            width: 30%;
            border-radius: 5px;
            border: 1px solid #999;
            font-size: 16px;
        }
    </style>
</head>

<?php
include("connection.php");

// Collect search filters
$fname = isset($_GET['fname']) ? $_GET['fname']: '';
$lname = isset($_GET['lname']) ? $_GET['lname']: '';
$email = isset($_GET['email']) ? $_GET['email']: '';

// Build query with filters (partial match using LIKE)
$query = "SELECT * FROM form WHERE 1=1";

if (!empty($fname)) {
    $query .= " AND fname LIKE '%$fname%'";
}
if (!empty($lname)) {
    $query .= " AND lname LIKE '%$lname%'";
}
if (!empty($email)) {
    $query .= " AND email LIKE '%$email%'";
}

// $query = "SELECT * FROM form"; 
$data = mysqli_query($conn, $query);
$total = mysqli_num_rows($data);

if($total != 0){
?>

<h2>RECORDS</h2>

<!-- Live Search Box -->
<!-- <input type="text" id="searchInput" class="search-box" onkeyup="searchTable()" placeholder="Search here..."> -->

<!-- Search Form -->
<form action="table.php" method="GET" style="margin-bottom: 20px;">
<!-- 'value' is used for retain entered values -->
    <input type="text" name="fname" value="<?php echo htmlspecialchars($fname); ?>" placeholder="First Name" style="padding: 6px;">
    <input type="text" name="lname" value="<?php echo htmlspecialchars($lname); ?>" placeholder="Last Name" style="padding: 6px;">
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Email" style="padding: 6px;">

    <button type="submit" style="padding: 6px 12px;;">Search</button>
</form>


<!-- delete button -->
<button type="submit" name="delete_selected" class="btn-delete" onclick="return confirm('Are you sure you want to delete selected records?');">
    Delete Selected
</button>

<form method="POST" action="delete_table.php" id="deleteForm">
<table id="dataTable" border="2" cellspacing="7" width="100%">
    <tr>
        <!-- it will automatically toggle all the other checkboxes -->
        <th width="5%"><input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)"> Select All</th>
        <th width="2%">ID</th>
        <th width="6%">First name</th>
        <th width="6%">Last name</th>
        <th width="10%">State</th>
        <th width="15%">Email</th>
        <th width="8%">Phone No.</th>
        <th width="20%">Address</th>
    </tr>

<?php
    while($result = mysqli_fetch_assoc($data)){
        echo "<tr>
            <td><input type='checkbox' name='delete_ids[]' value='".$result["id"]."'></td>
            <td>".$result["id"]."</td>
            <td>".$result["fname"]."</td>
            <td>".$result['lname']."</td>
            <td>".$result["state"]."</td>
            <td>".$result["email"]."</td>
            <td>".$result["phoneno"]."</td>
            <td>".$result["address"]."</td>
        </tr>";
    }
?>
</table>
</form>

<?php

//If no records → display "No records found"
} else {
    echo "No records found";
}
?>

<script>
    function toggleSelectAll(source) {
        const checkboxes = document.querySelectorAll('input[name="delete_ids[]"]');
        checkboxes.forEach(cb => cb.checked = source.checked);
        // Set its checked state to match the "Select All" checkbox
    }

    function searchTable() {
        // Reads the text and convert into lowercase
        const input = document.getElementById("searchInput").value.toLowerCase();
        const table = document.getElementById("dataTable");
        const rows = table.getElementsByTagName("tr");

        // skip header row
        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td");
            let match = false;

            // search in all cells
            for (let j = 1; j < cells.length; j++) {
                const text = cells[j].innerText.toLowerCase();
                if (text.indexOf(input) > -1) {
                    match = true;
                    break;
                }
            }

            // show/hide rows
            rows[i].style.display = match ? "" : "none";
        }
    }
</script>
</html>
