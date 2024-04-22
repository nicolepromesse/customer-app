<?php


session_start();
include("conn.php");    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <form method="post">
        <input type="text" name="n1">
        <button type="submit" name="search">search</button>
        <button type="submit" name="lt">logout</button>
    </form>
    <?php
        if(isset($_POST['search'])){
  echo"no data";
  $vali=$_POST['n1'];
  ?>
<table border="2">
        <tr>
            <th>furniture_id</th>
            <th>export_date</th>
            <th>quantity</th>
            <th colspan="2">action</th>
        </tr>
     
      <?php
      $df="select * from export where furnitureid=$vali ";
      $de=mysqli_query($conn,$df);
      if(mysqli_num_rows($de)>0){
          while($gt=mysqli_fetch_array($de)){
              ?>
              <tr>
                  <td><?php echo $gt['furnitureid']?></td>
                  <td><?php echo $gt['Exportdate']?></td>
                  <td><?php echo $gt['quqntity']?></td>
                  <td><a href="view_export.php ?del=<?php echo $gt['furnitureid']?>">delete</td>
                  <td><a href="export.php ?up=<?php echo $gt['furnitureid']?>">update</td>
              </tr>
              <?php
          }
      }
      ?>
    </table>
    <?php
        }
        else{?>
            <table border="2">
            <tr>
                <th>furniture_id</th>
                <th>export_date</th>
                <th>quantity</th>
                <th colspan="2">action</th>
            </tr>
         
          <?php
          $df="select * from export";
          $de=mysqli_query($conn,$df);
          if(mysqli_num_rows($de)>0){
              while($gt=mysqli_fetch_array($de)){
                  ?>
                  <tr>
                      <td><?php echo $gt['furnitureid']?></td>
                      <td><?php echo $gt['Exportdate']?></td>
                      <td><?php echo $gt['quqntity']?></td>
                      <td><a href="view_export.php ?del=<?php echo $gt['furnitureid']?>">delete</td>
                      <td><a href="export.php ?up=<?php echo $gt['furnitureid']?>">update</td>
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
    if(isset($_GET['del'])){
        $gy=$_GET['del'];
        $rt="delete from export where furnitureid=$gy";
        $mysql=mysqli_query($conn,$rt);
        if($mysql==1){
            echo"<script>alert('data deleted')</script>";
            echo"<script>location.href='view_export.php'</script>";
        }
    }
 
    ?>
    <a href="welcome.php">return back</a>

<?php
    
    if(isset($_POST['lt'])){

        session_destroy();
        header("location:form.php");
    }

?>
</body>
</html>