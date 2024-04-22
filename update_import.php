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
        $kee=$_GET['upd'];
        $qery_selec="select * from import where furnitureid= $kee";
        $connec=mysqli_query($conn,$qery_selec);
        if(mysqli_num_rows($connec)>0){
            while($in=mysqli_fetch_array($connec)){
                ?>
                <input type="text" name="furnitureid" readonly value="<?php echo $in['furnitureid']?>"><br><br>
                <input type="text" name="importdate" required value="<?php echo $in['importdate']?>"><br><br>
                <input type="text" name="quantity" required value="<?php echo $in['quantity'];?>"><br><br>
                <button type="submit" name="updat">update</button>      
   </form>
                <?php
            }
        }
    }
    ?>
    <?php
    if(isset($_POST['updat'])){
        $d=$_POST['furnitureid'];
        $e=$_POST['importdate'];
        $f=$_POST['quantity'];
        $update="UPDATE  import SET furnitureid='$d',importdate='$e',quantity='$f' where furnitureid='$d'";
        $fgu=mysqli_query($conn,$update);
        if($fgu==1){
        echo"<script>location.href='view_import.php'</script>";
    }}
    ?>


</body>
</html>