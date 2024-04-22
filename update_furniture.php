<?php
include("conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <form  method="post">
    <?php
    if(isset($_GET['upd'])){
        $keep=$_GET['upd'];
        $qery_select="SELECT * from furniture where furnitureid= $keep";
        $connect=mysqli_query($conn,$qery_select);
        if(mysqli_num_rows($connect)>0){
            while($ing=mysqli_fetch_array($connect)){
                ?>
                <input type="text" name="furnitureid" readonly value="<?php echo $ing['furnitureid']?>"><br><br>
                <input type="text" name="furniturename" value="<?php echo $ing['furniturename']?>"><br><br>
                <input type="text" name="furnitureownername" value="<?php echo $ing['furnitureowner']?>"><br><br>
                <button type="submit" name="update">update</button>      
   </form>
                <?php
            }
        }
    }
    ?>
    <?php
    if(isset($_POST['update'])){
        $also=$_POST['furnitureid'];
        $als=$_POST['furniturename'];
       $al=$_POST['furnitureownername'];
        $updat="UPDATE  furniture SET furnitureid='$also',furniturename='$als',furnitureowner='$al' where furnitureid='$also'";
        $fg=mysqli_query($conn,$updat);
        if($fg==1){

        
        echo"<script>location.href='view_furniture.php'</script>";
    }
}
    ?>

</body>
</html>