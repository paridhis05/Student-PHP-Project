<?php
session_start();
// echo "Welcome ".$_SESSION['user_name'];
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
    <style>
        *{
            text-align:center;
        }

        .table-container {  
            overflow-x: auto;
            width: 100%;
            margin: auto;
        }

        table { 
            width: 100%;
            border-collapse: collapse;
        }

        th, td {    
            padding: 8px;
            font-size: 16px;
        }

        .search-form {
            margin: 20px auto;
            width: 50%;
            max-width: 500px;
        }

        .search-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }

        .search-grid input, .search-grid select {
            flex: 0 0 48%;
            padding: 8px;
            font-size: 14px;
        }

        .search-btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .search-btn {
            padding: 8px 18px;
            font-size: 16px;
            background-color: #005cbf;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-btn:hover {
            background-color:rgb(0, 40, 100);
        }

        .delete-btn-container {
            text-align: left;
            margin: 20px 8%;
        }

        .btn-delete {
            background-color: #C80036;
            color: white;
            padding: 8px 18px;
            border: none;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            border: 1px solid #C80036;
        }

        .btn-delete:hover {
            background-color: white;
            color: #C80036;
        }

        .btn-logout{
            background-color:rgb(55, 96, 216);
            color: white;
            padding: 10px 18px;
            border: none;
            margin: 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
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

        @media screen and (max-width: 768px) {
        .search-grid {
            flex-direction: column;
        }

        .search-grid input, .search-grid select {
            width: 100%;
        }

        .btn-delete, .search-btn {
            width: 100%;
            margin: 10px 0;
        }

        .pagination a, .pagination span {
            padding: 6px 10px;
            font-size: 14px;
        }

        table, thead, tbody, th, td, tr {
            font-size: 12px;
        }
}
    </style>
</head>

<?php
include("connection.php");

$userprofile = $_SESSION['user_name'];

if($userprofile == true){

} else{
    echo "<meta http-equiv='refresh' content='0; url=login.php'>";
}

$records_limit = 5;

// Get search filters
$fname = isset($_GET['fname']) ? $_GET['fname'] : '';
$lname = isset($_GET['lname']) ? $_GET['lname'] : '';
$gender = isset($_GET['gender']) ? $_GET['gender'] : '';
$state = isset($_GET['state']) ? $_GET['state'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$phone = isset($_GET['phone']) ? $_GET['phone'] : '';

// Build query with filters
$filter_query = "FROM form WHERE 1=1";

if (!empty($fname)) {
    $filter_query .= " AND fname LIKE '%$fname%'";
}
if (!empty($lname)) {
    $filter_query .= " AND lname LIKE '%$lname%'";
}
if (!empty($gender)) {
    $filter_query .= " AND gender = '$gender'";
}
if (!empty($state)) {
    $filter_query .= " AND state LIKE '%$state%'";
}
if (!empty($email)) {
    $filter_query .= " AND email LIKE '%$email%'";
}
if (!empty($phone)) {
    $filter_query .= " AND phoneno LIKE '%$phone%'";
}

// Find number of records stored
$record = mysqli_query($conn, "SELECT COUNT(*) as total $filter_query");
$row = mysqli_fetch_assoc($record);
$total_records = $row['total'];

// Get Current page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$total_pages = max(1, ceil($total_records / $records_limit));
$page = max(1, min($page, $total_pages));

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
<form action="table.php" method="GET" class="search-form">
    <div class="search-grid">
        <input type="text" name="fname" value="<?= htmlspecialchars($fname); ?>" placeholder="First Name">
        <input type="text" name="lname" value="<?= htmlspecialchars($lname); ?>" placeholder="Last Name">

        <select name="gender">
            <option value="">Gender</option>
            <option value="Male" <?= $gender == 'Male' ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= $gender == 'Female' ? 'selected' : '' ?>>Female</option>
            <option value="Other" <?= $gender == 'Other' ? 'selected' : '' ?>>Other</option>
        </select>

        <input type="text" name="state" value="<?= htmlspecialchars($state); ?>" placeholder="State">
        <input type="email" name="email" value="<?= htmlspecialchars($email); ?>" placeholder="Email">
        <input type="text" name="phone" value="<?= htmlspecialchars($phone); ?>" placeholder="Phone No.">
    </div>

    <div class="search-btn-container">
        <button type="submit" class="search-btn">Search</button>
    </div>
</form>


<form method="POST" action="delete_table.php" id="deleteForm">

<!-- delete button -->
<div class="delete-btn-container">
    <button type="submit" name="delete_selected" class="btn-delete" onclick="return confirm('Are you sure you want to delete selected records?');">
        Delete Selected
    </button>
</div>

<div class="table-container">
<table id="dataTable" border="2" >
    <tr>
        <!-- it will automatically toggle all the other checkboxes -->
        <th><input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)"> Select All</th>
        <th>ID</th>
        <th>Photo</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Gender</th>
        <th>State</th>
        <th>Email</th>
        <th>Phone No.</th>
        <th>Address</th>
        
    </tr>

<?php
    while($result = mysqli_fetch_assoc($data)){
        echo "<tr>
            <td><input type='checkbox' name='delete_ids[]' value='".$result["id"]."'></td>
            <td><a href='update_table.php?id=$result[id]' style='text-decoration: none; color: #005cbf; font-weight: bold;'>
                ".$result["id"]."
    </a></td>
            <td>
                <a href='uploads/image2_". htmlspecialchars($result['photo']) ."' target='_blank'>
                    <img src='uploads/image1_". htmlspecialchars($result['photo']) ."' width='60' height='60' style='object-fit:cover; border-radius:4px;' />
                </a>
            </td>
            <td>".$result["fname"]."</td>
            <td>".$result['lname']."</td>
            <td>".$result['gender']."</td>
            <td>".$result["state"]."</td>
            <td>".$result["email"]."</td>
            <td>".$result["phoneno"]."</td>
            <td>".$result["address"]."</td>
            

        </tr>";
    }
?>
<!-- <img src='uploads/".$result['photo']."' alt='Photo' width='60' height='60' style='object-fit: cover; border-radius: 4px;'> -->
</table>
</div>
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
        echo'<span>...</span>';
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

    <a href="<?= $baseURL ?>&page=<?= $total_pages ?>" class="<?= $page == $total_pages ? 'disabled' : '' ?>">Last</a>
</div>

<a href="logout.php"><input type="submit" class="btn-logout" name="" value="Logout"></a>

<!-- <div>
    <?php 
        $res = mysqli_query($con, "SELECT * FROM form");
        while($rowss = mysqli_fetch_assoc($res)){
    ?>
    <img src="Uploads/<?php ?>" />
    <?php 
        }
    ?>
</div> -->

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
