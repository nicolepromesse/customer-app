<?php
include("conn.php");

if(isset($_GET['up'])){
    $ke = $_GET['up'];
    $query_select = "SELECT * FROM import WHERE furnitureid = $ke";
    $result = mysqli_query($conn, $query_select);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $furnitureid = $row['furnitureid'];
            $furniture_name = $row['furniture_name']; // Assuming this field exists in your table
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Furniture</title>
</head>
<body>
    <form method="post">
        <input type="hidden" name="furnitureid" value="<?php echo $furnitureid; ?>">
        <input type="hidden" name="furniture_name" value="<?php echo $furniture_name; ?>">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required><br><br>
        <button type="submit" name="export">Export</button>
    </form>
</body>
</html>

<?php
        }
    }
}

if(isset($_POST['export'])){
    $furnitureid = $_POST['furnitureid'];
    $furniture_name = $_POST['furniture_name'];
    $quantity = $_POST['quantity'];

    // Check if the furniture already exists in the export table
    $check_query = "SELECT * FROM export WHERE furnitureid = '$furnitureid'";
    $check_result = mysqli_query($conn, $check_query);

    if(mysqli_num_rows($check_result) > 0){
        // Update the existing record
        $update_query = "UPDATE export SET quantity = quantity + $quantity WHERE furnitureid = '$furnitureid'";
        $update_result = mysqli_query($conn, $update_query);
        
        if($update_result){
            echo "<script>alert('Record updated successfully');</script>";
            echo "<script>window.location.href='view_export.php';</script>";
        } else {
            echo "<script>alert('Error updating record');</script>";
        }
    } else {
        // Insert a new record
        $insert_query = "INSERT INTO export (furnitureid, furniturename, quantity) VALUES ($furnitureid, '$furniturename', '$quantity')";
        $insert_result = mysqli_query($conn, $insert_query);

        if($insert_result){
            echo "<script>alert('Record exported successfully');</script>";
            echo "<script>window.location.href='view_export.php';</script>";
        } else {
            echo "<script>alert('Error exporting record');</script>";
        }
    }
}
?>
