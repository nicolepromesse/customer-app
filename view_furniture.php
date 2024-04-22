<?php
include("conn.php");
?>
<?php
session_start();

if(isset($_SESSION["log"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            flex-direction:column;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        form {
            text-align: center;
        }
    </style>
</head>
<body>
    <form method="post">
        <input type="text" name="n2">
        <button type="submit" name="search">search</button>
        <button type="submit" name="lo">logout</button>
    </form>
    <?php
    if(isset($_POST['search'])){
        echo "no data";
        $vali=$_POST['n2'];
        ?>
        <table>
            <tr>
                <th>furniture_id</th>
                <th>furniture_name</th>
                <th>furniture_ownername</th>
                <th colspan="2">action</th>
            </tr>
            <?php
            $qe_select="select * from furniture where furniturename='$vali'";
            $select=mysqli_query($conn,$qe_select);
            if(mysqli_num_rows($select)>0){
                while($fecth=mysqli_fetch_array($select)){
            ?>
            <tr>
                <td><?php echo $fecth['furnitureid']?></td>
                <td><?php echo $fecth['furniturename']?></td>
                <td><?php echo $fecth['furnitureowner']?></td>
                <td><a href="view_furniture.php?DEL=<?php echo $fecth['furnitureid']?>">delete</a></td>
                <td><a href="update_furniture.php?upd=<?php echo $fecth['furnitureid']?>" >update</a></td>
            </tr>
            <?php
                }
            }
            ?>
        </table>
    <?php
    } else {
    ?>
        <table>
            <tr>
                <th>furniture_id</th>
                <th>furniture_name</th>
                <th>furniture_ownername</th>
                <th colspan="2">action</th>
            </tr>
            <?php
            $qe_select="select * from furniture";
            $select=mysqli_query($conn,$qe_select);
            if(mysqli_num_rows($select)>0){
                while($fecth=mysqli_fetch_array($select)){
            ?>
            <tr>
                <td><?php echo $fecth['furnitureid']?></td>
                <td><?php echo $fecth['furniturename']?></td>
                <td><?php echo $fecth['furnitureowner']?></td>
                <td><a href="view_furniture.php?DEL=<?php echo $fecth['furnitureid']?>">delete</a></td>
                <td><a href="update_furniture.php?upd=<?php echo $fecth['furnitureid']?>" >update</a></td>
            </tr>
            <?php
                }
            }
            ?>
        </table>
    <?php
    }
    ?>
    
    <?php
    if(isset($_GET['DEL'])){
        $di=$_GET['DEL'];
        $delete="delete from furniture where furnitureid=$di";
        $dl=mysqli_query($conn,$delete);
        if($dl==1){
            echo "<script>alert('Data Deleted')</script>";
            echo "<script>location.href='view_furniture.php'</script>";
        } else {
            echo "failed to connect";
        }
    }
    ?>
    <a href="welcome.php">return back</a>
</body>
</html>
<?php
    
    if(isset($_POST['lo'])){
        session_destroy();
        header("location:form.php");
    }
    
    ?>


<?php
} else {
    header("location:form.php");
}
?>
