<html>
<head>
    <title>Table</title>
    <style>
        *{
            text-align:center;
        }
        table {
            width: 85%;
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
            border: 1px solid #005cbf;
            color: #005cbf;
            text-decoration: none;
            border-radius: 4px;
        }

        .pagination span {
            padding: 8px 12px;
            color: #888;
            font-weight: bold;
        }

        .pagination a.disabled {
            color: #aaa;
            border-color: #aaa;
            pointer-events: none;
        }

        .pagination a.active {
            background-color:#005cbf;
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

<h2 style="font-size: 40px; padding-top: 10px;">Student Records</h2>

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

<table id="dataTable" border="2" >
    <tr>
        <!-- it will automatically toggle all the other checkboxes -->
        <th><input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)"> Select All</th>
        <th>ID</th>
        <th>First name</th>
        <th>Last name</th>
        <th>State</th>
        <th>Email</th>
        <th>Phone No.</th>
        <th>Address</th>
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
    $getParams = $_GET;

    // remove page parameter
    unset($getParams['page']);

    // Build base URL
    $baseURL = '?' . http_build_query($getParams);

    $prevPage = $page - 1;
    $nextPage = $page + 1;

    // how many pages to show
    $visiblePages = [$page];

    if($page + 1 <= $total_pages){
        $visiblePages[] = $page + 1;
    }
    ?>

    <a href="<?= $baseURL ?>&page=1" class="<?= $page == 1 ? 'disabled' : '' ?>">First</a>

    <a href="<?= $baseURL ?>&page=<?= $prevPage ?>" class="<?= $page <= 1 ? 'disabled' : '' ?>">Prev</a>

    <?php

    if($page > 1){
        echo'<span>...<span>';
    }

    //Show current and next page only
    foreach($visiblePages as $i){
        if($i <= $total_pages){
            $activePage = ($i == $page) ? 'active' : '';
            echo "<a href='{$baseURL}&page={$i}' class='{$activePage}'>{$i}</a>";
        }
    }

    //if next page is not the last one
    if($page + 1 < $total_pages){
        echo '<span>...</span>';
    }

    ?>

    <a href="<?= $baseURL ?>&page=<?= $nextPage ?>" class="<?= $page >= $total_pages ? 'disabled' : '' ?>">Next</a>

    <a href="<?= $baseURL ?>&page=<?= $total_pages ?>" class="<?= $page == $toatal_pages ? 'disabled' : '' ?>">Last</a>
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
