<?php

include 'gbconnection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> 
<link rel="stylesheet" href="gbAdminDashboard.css">
</head>
<body>
<nav class="navbar navbar-inverse bd-ii">
  <div class="container-fluid"  style="color: white ;background-color:blue;">
    <div class="navbar-header"style="color: white ;background-color:blue;>
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#" style="color: white ;background-color:blue;">ADMIN DASHABOARD</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar" style="color: white ;background-color:blue;">
      <ul class="nav navbar-nav navbar-right">
	    <li ><a href="gbAdminDashboard.php" >HOME</a></li>
          <li ><a style="color: #fff;" href="gbAdminAddProducts.php"> PRODUCTS </a> </li>
          <li ><a style="color: #fff;" href="gbAdminManagingOrders.php">ORDERS</a></li>
          <li><a style="color: #fff;" href="hello.php">Hello,<?php echo $_SESSION['admin_username']; ?></a></li>
          <li ><a style="color: #fff;" href="index.php">LOGOUT</a></li>
       
      </ul>
    </div>
  </div>
</nav>

  <div class="content">
  <h1 style="text-align:center;">ADMIN DASHBOARD</h1>   

 </div>
<table class="table">
  <thead>
  <tr  style="color: white ;background-color:blue;">
    <th scope="col" class="bd-ii"><b><center>NUMBER OF USERS</center></b></th>
    <th scope="col" class="bd-ii"><b><center>NUMBER OF ADMINS</center></b></th>
    <th scope="col" class="bd-ii"><b><center>NUMBER OF PRODUCTS</center></b></th>
    <th scope="col" class="bd-ii"><b><center>GRAND TOTAL</center></b></th>
  </tr>
  
  </thead>
  <tbody>
  <tr>
    <td class= "12"><center><?php
             $sql="SELECT * from users where utype = 'user'";
             $result=$conn-> query($sql);
             $count=0;
             if ($result-> num_rows > 0){
                while ($row=$result-> fetch_assoc()) {
                     $count=$count+1;
                }
              }
             echo $count;
     ?></center></td>
    <td><center><?php
          $sql="SELECT * from users where utype = 'admin'";
          $result=$conn-> query($sql);
          $count=0;
          if ($result-> num_rows > 0){
             while ($row=$result-> fetch_assoc()) {
                  $count=$count+1;
             }
           }
          echo $count
      ?></center> </td>
    <td ><center><?php
          $sql="SELECT productid from products ";
          $result=$conn-> query($sql);
          $count=0;
          if ($result-> num_rows > 0){
             while ($row=$result-> fetch_assoc()) {
                  $count=$count+1;
             }
           }
          echo $count
      ?></center> </td>
	<td><center>
	  <?php
$sql = "SELECT  SUM(total) from orders";
$result = $conn->query($sql);
while($row = mysqli_fetch_array($result)){
    echo $row['SUM(total)']; 
}
?>
</center></td>
  </tr>
    </tbody>
</table>
</body>
</html>