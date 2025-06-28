<html>
<head>
    <title>Table</title>
    <style>
.update, .delete {
    display: inline-block;
    text-decoration: none;
    text-align: center;
    background-color: rgb(4, 73, 122);
    color: white;
    border: 1px solid rgb(4, 73, 122);
    border-radius: 5px;
    padding: 6px 12px;
    font-weight: bold;
    cursor: pointer;
    margin: 3px;
}

.update:hover {
    background-color: white;
    color: rgb(4, 73, 122);
}

.delete {
    background-color: #C80036;
    border-color: #C80036;
}

.delete:hover {
    background-color: white;
    color: #C80036;
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

    </style>
</head>

<?php
include("connection.php");

$query = "SELECT * FROM form"; 
$data = mysqli_query($conn, $query);
$total = mysqli_num_rows($data);

// If table has records - show table
if($total != 0){
?>

<h2>RECORDS</h2>

<!-- Live Search Box -->
<input type="text" id="searchInput" class="search-box" onkeyup="searchTable()" placeholder="Search here...">

<form method="POST" action="delete_table.php" id="deleteForm">
<table id="dataTable" border="2" cellspacing="7" width="100%">
    <tr>
    <th width="2%">Select</th>
    <th width="2%">ID</th>
    <th width="6%">First name</th>
    <th width="6%">Last name</th>
    <th width="10%">State</th>
    <th width="15%">Email</th>
    <th width="8%">Phone No.</th>
    <th width="20%">Address</th>
    <th width="18%">Operation</th>
</tr>

<?php
    while($result = mysqli_fetch_assoc($data)){
        // Each row has a checkbox
        echo "<tr>
        <td><input type='checkbox' name='delete_ids[]' value='".$result["id"]."'></td>
        <td>".$result["id"]."</td>
        <td>".$result["fname"]."</td>
        <td>".$result['lname']."</td>
        <td>".$result["state"]."</td>
        <td>".$result["email"]."</td>
        <td>".$result["phoneno"]."</td>
        <td>".$result["address"]."</td>
        <td>
            <a href='update_table.php?id=" . $result['id'] . "' class='update'>Update</a>
            <a href='delete_table.php?id=" . $result['id'] . "' class='delete' onclick='return checkdelete()'>Delete</a>
        </td>
        </tr>";
    }
?>
</table>

<!-- Buttons -->
<button type="submit" name="delete_selected" class="btn-delete" onclick="return confirm('Are you sure you want to delete selected records?');">Delete</button>
<button type="button" class="btn-delete" onclick="deleteAll()">Delete All</button>

</form>

<?php
//If no records → display "No records found"
} else {
    echo "No records found";
}
?>

<script>
    function checkdelete(){
        return confirm('Are you sure you want to delete this record?');
    }

    function deleteAll() {
        // finds all checkboxes
        const checkboxes = document.querySelectorAll('input[name="delete_ids[]"]');
        // selects them
        checkboxes.forEach(cb => cb.checked = true);
        if(confirm('Are you sure you want to delete ALL records?')) {
            document.getElementById('deleteForm').submit();
        }
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
