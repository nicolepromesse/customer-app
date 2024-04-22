<?php
include('conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="codea" placeholder="enter first code"><br><br>
        <button type="submit" name="co">continue</button>
    </form>
    <?php
    if(isset($_POST['co'])){
        $fg=$_POST['codea'];
        $select="select * from manager where code='$fg'";
        $jion=mysqli_query($conn,$select);
        if(mysqli_num_rows($jion)>0){
            header("location:upd.php");
        }
    }
    ?>
</body>
</html>