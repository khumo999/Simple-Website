<?php include('gbconnection.php');
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:gblogin.php');
}



?>


<!DOCTYPE html>
<html>
<head>

<style>

</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="view.css">



</head>
<body >



<nav class="navbar navbar-inverse bd-ii">
  <div class="container-fluid">
    <div class="navbar-header" style="color: #fff; background-color:blue;">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#" style="color: #fff; background-color:blue; font-family:Times New Roman;">GB CLOTHING OUTLET</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar" style="color: #fff; background-color:blue; font-family:Times New Roman;">
      
      <ul class="nav navbar-nav navbar-right" style="color: #fff; background-color:blue">
	  <li ><a style="color: #fff;" href="index.php" >HOME</a></li>
   
		  <li ><a style="color: #fff;" href="cart.php">CART(<?php
          $sql="SELECT * from cart where id = '$user_id'";
          $result=$conn-> query($sql);
          $count=0;
          if ($result-> num_rows > 0){
             while ($row=$result-> fetch_assoc()) {
                  $count=$count+1;
             }
           }
          echo $count
      ?>)</a></li>
          <li ><a style="color: #fff;" href="checkout.php">CHECKOUT</a></li>
          <li><a style="color: #fff;" herf ="gblogout.php">LOGOUT</a></li>
          
       
      </ul>
    </div>
  </div>
</nav>

<center><b>Order Details</b></center><br>
<?php 
 $sql = "SELECT * FROM orders WHERE id = '$user_id'";
   
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table'><tr><th>Invoice</th><th>Client</th><th>Email</th><th>Mobile</th><th>Payment</th><th>Address</th><th>Products Name</th><th>Purchase Date</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["orderid"]. "</td><td>" . $row["bname"]. " </td><td>" . $row["email"]. " </td><td>0" . $row["mobile"]. " </td><td>R" . $row["total"]. " </td><td>" . $row["address"]. " </td><td>" . $row["name"]. " </td><td>" . $row["odate"]. " </td></tr>";
    }
    echo "</table>";
}
?> 
<a href="proceed_to_checkout.php" ><button class="b1">PROCEED TO THE BACK </button></a>

</body>
</html>

