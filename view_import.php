<?php
include("conn.php");

// Function to sanitize input data
function sanitizeData($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}

// Update record
if(isset($_POST['update'])) {
    $furnitureid =$_POST['furnitureid'];
    $importdate = $_POST['importdate'];
    $quantity =$_POST['quantity'];

    $update_query = "UPDATE import SET importdate='$importdate', quantity='$quantity' WHERE furnitureid='$furnitureid'";
    $update_result = mysqli_query($conn, $update_query);

    if($update_result) {
        echo "<script>alert('Record updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating record');</script>";
    }
}

// Delete record
if(isset($_GET['delete'])) {
    $furnitureid = sanitizeData($_GET['delete']);

    $delete_query = "DELETE FROM import WHERE furnitureid='$furnitureid'";
    $delete_result = mysqli_query($conn, $delete_query);

    if($delete_result) {
        echo "<script>alert('Record deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting record');</script>";
    }
}

// Select all records from the import table
$select_query = "SELECT * FROM import";
$result = mysqli_query($conn, $select_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            flex-direction:column;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        input[type="text"] {
            width: 80px;
        }

        button {
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Import Records</h2>
    <table>
        <tr>
            <th>Furniture ID</th>
            <th>Import Date</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        <?php
        // Check if there are any records
        if(mysqli_num_rows($result) > 0){
            // Fetch and display each record
            while($row = mysqli_fetch_assoc($result)){
                echo "<form method='post'>";
                echo "<tr>";
                echo "<td>".$row['furnitureid']."</td>";
                echo "<td><input type='text' name='importdate' value='".$row['importdate']."'></td>";
                echo "<td><input type='text' name='quantity' readonly value='".$row['quantity']."'></td>";
                echo "<td>";
               
                echo "<input type='hidden' name='furnitureid' value='".$row['furnitureid']."'>";
                echo "<button type='submit' name='update'>Update</button>";
                echo "</form>";
                echo "<a href='?delete=".$row['furnitureid']."' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            // No records found
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        ?>
    </table>
    <a href="welcome.php">return back</a>
</body>
</html>
