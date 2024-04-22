<?php

session_start();

if(isset($_SESSION["log"])){
include("conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
            padding-top:100px;
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
    <title>Document</title>
</head>
<body>
    <h1>CARGO ltd REPORT</h1>
<table border="1">
        <tr>
            <th>furniture_name</th>
            <th>furnitureownername</th>
            <th>import_date</th>
            <th>quantity</th>
            <th>export_date</th>
            <th>quantity</th>
        </tr>
        <?php
        $xselect=" select * from furniture INNER JOIN export   ON furniture.furnitureid = export.furnitureid INNER JOIN import   ON furniture.furnitureid = import.furnitureid";
        $sel=mysqli_query($conn,$xselect);
        if(mysqli_num_rows($sel)>0){
            while($fec=mysqli_fetch_array($sel)){
            ?>
             <tr>
                <td><?php echo $fec['furniturename'] ?></td>
                <td><?php echo $fec['furnitureowner']?></td>
                <td><?php echo $fec['importdate']?></td>
                <td><?php echo $fec['quantity']?></td>
                <td><?php echo $fec['Exportdate']?></td>
                <td><?php echo $fec['quantity']?></td>
            </tr>
            <?php
            }}
          ?>
       </table> 
       <form action="" method="post">
        <button type="submit" name="loguot">logout</button>

       </form> 
       <a href="welcome.php">return back</a>  
       <?php
       }?>
       <?php
       if(isset($_POST['loguot'])){
        session_destroy();
        header("location:form.php");
    }
    ?> 
</body>
</html>