<?php
include("conn.php");

session_start();

if(isset($_SESSION["log"])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Furniture</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="exportdate" value="<?php echo date("m-d-y")?>" placeholder="Export date"><br><br>
        <select name="id" >
            <option value="">Select Import Furniture</option>
            <?php
            $select = "SELECT import.furnitureid, furniture.furniturename, import.quantity as import_quantity
                       FROM import 
                       INNER JOIN furniture ON import.furnitureid = furniture.furnitureid";
      
      $selq = mysqli_query($conn, $select);
            if(mysqli_num_rows($selq) > 0){
                while($fetch = mysqli_fetch_array($selq)){
                    $furniture_id = $fetch['furnitureid'];
                    $furniture_name = $fetch['furniturename'];
                    $import_quantity = $fetch['import_quantity'];
            ?>
            <option value="<?php echo $furniture_id; ?>"><?php echo $furniture_name; ?></option>
            <?php
                }
            }
            ?>
        </select><br><br>
        <input type="text" name="quantity" placeholder="Export quantity"><br><br>
        <button type="submit" name="reco">Record</button>
        <button type="submit" name="view_export">View Export</button>
        <button type="submit" name="logout_export">Logout</button>
    </form>

    <?php
    if(isset($_POST['view_export'])){
        header("location:view_export.php");
    }

    if(isset($_POST['reco'])){
        $export_date = $_POST['exportdate'];
        $export_quantity = $_POST['quantity'];
        $furniture_id = $_POST['id'];

        // Check if requested quantity exceeds available import quantity
        $check_quantity_query = "SELECT quantity FROM import WHERE furnitureid = $furniture_id";
        $check_quantity_result = mysqli_query($conn, $check_quantity_query);
        $import_quantity_row = mysqli_fetch_assoc($check_quantity_result);
        $import_quantity = $import_quantity_row['quantity'];

        if($export_quantity > $import_quantity) {
            echo "<script>alert('Requested quantity exceeds available import quantity');</script>";
        } else {
            // Proceed with export process
            $insert_export = "INSERT INTO export (furnitureid, Exportdate, quqntity) VALUES ($furniture_id, '$export_date', '$export_quantity')";
            $insert_result = mysqli_query($conn, $insert_export);

            if($insert_result == 1){
                // Deduct exported quantity from import quantity
                $remaining_quantity = $import_quantity - $export_quantity;
                $update_import = "UPDATE import SET quantity = $remaining_quantity WHERE furnitureid = $furniture_id";
                $update_result = mysqli_query($conn, $update_import);

                if($update_result){
                    echo "<script>alert('Data recorded. Remaining quantity: $remaining_quantity');</script>";
                } else {
                    echo "<script>alert('Error updating import quantity');</script>";
                }
            } else {
                echo "<script>alert('Data not recorded');</script>";
            }
        }
    }
    ?>
</body>
</html>

<?php
if(isset($_POST['logout_export'])){
    session_destroy();
    header("location:form.php");
}
}
?>
