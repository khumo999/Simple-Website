<?php 
include 'gbconnection.php';
session_start();




if(isset($_POST['update'])){
   $cartid = $_POST['cartid'];
   $quantity = $_POST['quantity'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$quantity' WHERE cartid = '$cartid'") or die('query failed');
   $message[] = 'cart quantity updated!';
   
}



if(isset($_GET['delete'])){
   $cartid = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE cartid = $cartid");
   header('location: add_to_cart.php');
};




?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="add_to_cartstyle.css">

</head>
<style>

body{
  background-color: lightgrey;
}
h1{
  font-size: 89px;
  align-items: center;
  
}
</style>
<body>
<nav class="navbar navbar-inverse bd-ii">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#" style="color: #fff;"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      
      <ul class="nav navbar-nav navbar-right">
	  <li ><a style="color: #fff;" href="index.php" >HOME</a></li>
    
		  <li ><a style="color: #fff;" href="add_to_cart.php">CART(<?php
          $sql="SELECT * from cart where id = 'id'";
          $result=$conn-> query($sql);
          $count=0;
          if ($result-> num_rows > 0){
             while ($row=$result-> fetch_assoc()) {
                  $count=$count+1;
             }
           }
          echo $count
      ?>)</a></li>
          <li ><a style="color: #fff;" href="gblogout.php">LOGOUT</a></li>
       
      </ul>
    </div>
  </div>
</nav>

<center><h1>Welcome to my Cart Page</h1></center>

<center>
   <?php

   $select = mysqli_query($conn, "SELECT * FROM cart  ");
   
   ?>
 
<table  class="table">
  <thead >
    <tr >
      <th>Item</th>
      <th > Name</th>
      <th >Quantity</th>
      <th > Price</th>
      <th >Action</th>
    </tr>
  </thead>
   <?php while($row = mysqli_fetch_assoc($select)){ ?>
  <tbody >
    <tr >
      <td role="cell"><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
      <td role="cell"><?php echo $row['name']; ?></td>
      <td role="cell"><form action="" method="post">
            <input type="hidden" name="cartid" value="<?php echo $row['cartid']; ?>">
            <input type="number" min="1"  name="quantity" value="<?php echo $row['quantity']; ?>">
			<input type="hidden" name="name" value="<?php echo $row['name']; ?>">
            <input style="background-color:blue;color:white;" type="submit" name="update" value="update" class="btn">
         </form></td>
      <td role="cell">R<?php echo $row['price']; ?></td>	  
      <td role="cell">       
               <a style="background-color:blue;color:white;" href="add_to_cart.php?delete=<?php echo $row['cartid']; ?>" class="btn">  delete </a></td>
	</tr>
  </tbody>
   <?php } ?>
</table>

 <?php
   $total = 0;
   $select = mysqli_query($conn, "SELECT * FROM cart where id = 'id'");

   if(mysqli_num_rows($select) > 0){
            while($row = mysqli_fetch_assoc($select)){ 
   ?>
      <?php  $sub_total = ($row["quantity"] * $row["price"]); ?>	  
	  <?php
	  $total += $sub_total;
   }}
	  ?>
	  <p><b>Total <span class="price">R<?php echo $total; ?></span></b></p>	 
    <br>
<a href="proceed_to_checkout.php"><button  class="bd-ii btn-lg pull-right"  style="background-color:blue;color:white;" >PROCEED TO CHECKOUT</button ></a>
</body>
</html>