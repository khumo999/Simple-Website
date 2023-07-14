<?php

include 'gbconnection.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:gblogin.php');
};

if(isset($_POST['cart'])){

   $name = $_POST['name'];
   $price = $_POST['price'];
   $image = $_POST['image'];
   

   $check = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$name' AND id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check) > 0){
   
	  echo"<script> alert('Already added to cart!');  </script>";
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(id, name,  price, image) VALUES('$user_id', '$name', '$price', '$image')") or die('query failed');
      
	  echo"<script> alert('Product added to cart!');  </script>";
	  
   }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>search page</title>

   <style>

  .bd-ii {
  color: ;
  background-color: blue  ; }
  
</style>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</head>
<body background-color: lightgrey;>

<nav class="navbar navbar-inverse bd-ii">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#" style="color:blue; background-color :blue;"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar" style="color:blue; background-color :blue;">
      
      <ul class="nav navbar-nav navbar-left">
      <li ><a style="color: #fff;" href="viewproducts.php"> PRODUCTS </a> </li>
		  <li ><a style="color: #fff;" href="add_to_cart.php">CART(<?php
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
          
          <li ><a style="color: #fff;" href="gblogout.php">LOGOUT</a></li>
       
      </ul>
    </div>
  </div>
</nav>
<section class="search-form">
   <form action="" method="post" >
      <input type="text" class="bd-ii btn-lg "style ="background-color :white;" name="search" placeholder="" class="btn" >
      <input type="submit" class="bd-ii btn-lg " style ="background-color :white;"ename="submit" value="SEARCH" >
   </form>
</section>
<center><br><br><br>

<br><br>

   <?php 
if(isset($_POST['submit'])){
  $search = $_POST['search'];
  $result = mysqli_query($conn,"SELECT * FROM `products` WHERE name LIKE '%{$search}%'"); 
  if(mysqli_num_rows($result) > 0){
  
    

    ?> 
 <form action="" method="post" >
<table class="table" >
  <thead >

    <tr >
      <th>Item</th>
      <th>Name</th>
      <th > </th>
    </tr>
  </thead>
   <?php while($row = mysqli_fetch_assoc($result)) {?>
  <tbody >
    <tr >
      <td role="cell"><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
      <td role="cell"><b><?php echo $row['name']; ?></b><br><br>R<?php echo $row['price']; ?></td>
      <td role="cell"></td>
	  <td role="cell"></td>
	  <td role="cell"></td>
	  <td role="cell">
       <input type="hidden" name="productid" value="<?php echo $row['productid']; ?>">
			<input type="hidden" name="name" value="<?php echo $row['name']; ?>">
			<input type="hidden" name="price" value="<?php echo $row['price']; ?>">
    <input type="hidden" name="image" value="<?php echo $row['image']; ?>">          
		<input type="submit"  class="bd-ii btn pull-right"  value="Add To Cart" name="cart" >

		 </td>
     
	</tr>
	
 
  </tbody>
  </form>
  <?php
            }
         }else{
            echo '<p class="empty" style="color:red;"><b>Sorry, no products were found matching your search!</b></p>';
         }
      }else{
         echo '<p class="empty" style ="color:gold; font-size:34px"><b>SEARCHING FOR PRODUCTS</b></p>';
      }
   ?>
</table>  
</center>
</body>
</html>