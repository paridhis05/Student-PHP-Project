<html>
<head>
    <title>Table</title>
    <style>
        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #aaa;
            text-align: center;
        }

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

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 12px;
            margin: 0 4px;
            border: 1px solid #007BFF;
            color: #007BFF;
            text-decoration: none;
            border-radius: 4px;
        }

        .pagination a.disabled {
            color: #aaa;
            border-color: #aaa;
            pointer-events: none;
        }

        .pagination a.active {
            background-color: #007BFF;
            color: white;
        }
    </style>
</head>

<?php
include("connection.php");

$records_limit = 5;

// Get search filters
$fname = isset($_GET['fname']) ? $_GET['fname'] : '';
$lname = isset($_GET['lname']) ? $_GET['lname'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';

// Build query with filters
// $filter_query = "SELECT * FROM form WHERE 1=1";
$filter_query = "FROM form WHERE 1=1";

if (!empty($fname)) {
    $filter_query .= " AND fname LIKE '%$fname%'";
}
if (!empty($lname)) {
    $filter_query .= " AND lname LIKE '%$lname%'";
}
if (!empty($email)) {
    $filter_query .= " AND email LIKE '%$email%'";
}

// Find number of records stored
// $record = mysqli_query($conn, "SELECT COUNT(*) as total $filter_query");
$record = mysqli_query($conn, "SELECT COUNT(*) as total $filter_query");
$row = mysqli_fetch_assoc($record);
$total_records = $row['total'];

$total_pages = ceil($total_records / $records_limit);

// Get Current page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1)
    $page = 1;
if($page > $total_pages)
    $page = $total_pages;

$starting_limit = ($page - 1) * $records_limit;

// Find records with limit
$query = "SELECT * $filter_query LIMIT $starting_limit, $records_limit";
$data = mysqli_query($conn, $query);

if(mysqli_num_rows($data) != 0){
?>

<h2>Student Records</h2>

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

<form method="POST" action="delete_table.php" id="deleteForm">

<!-- delete button -->
<button type="submit" name="delete_selected" class="btn-delete" onclick="return confirm('Are you sure you want to delete selected records?');">
    Delete Selected
</button>

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

<!-- PAGINATION -->
<div class="pagination">
    <?php
    $queryParams = $_GET;
    unset($queryParams['page']);
    $baseURL = '?' . http_build_query($queryParams);

    $prevPage = $page - 1;
    $nextPage = $page + 1;
    ?>
    <a href="<?= $baseURL ?>&page=<?= $prevPage ?>" class="<?= $page <= 1 ? 'disabled' : '' ?>">Prev</a>

    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="<?= $baseURL ?>&page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
    <?php } ?>

    <a href="<?= $baseURL ?>&page=<?= $nextPage ?>" class="<?= $page >= $total_pages ? 'disabled' : '' ?>">Next</a>
</div>

<?php

//If no records → display "No records found"
} else {
    echo "<h3 style='text-align:center;'>No records found</h3>";
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
