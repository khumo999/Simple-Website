<?php

include 'gbconnection.php';


if(isset($_POST['cart'])){

   $name = $_POST['name'];
   $price = $_POST['price'];
   $image = $_POST['image'];


   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$name' AND id = 'id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(id, name, price, image) VALUES('id', '$name', '$price', '$image')") or die('query failed');
      $message[] = 'product added to cart!';
	
   }

}
if(isset($message)){
   foreach($message as $message){
      echo '    
	 
	  <div  class="closebtn  ">
	  
  <span onclick="this.parentElement.remove();">&times;'.$message.'</span>
  
</div>
	  
	  
      ';
   }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
   h1{
    font-size: 56px;
   }
  </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="products.css">
  <title>GB Clothing Store</title>

  
</head>

<body >
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
          if ($result-> num_rows > 1){
             while ($row=$result-> fetch_assoc()) {
                  $count=$count+1;
             }
           }
          echo $count
      ?>)</a></li>
      <li ><a style="color: #fff;"href="view_orders.php">ORDERS</a></li>
		  
      <li><a style="color: #fff;" href="gblogin.php" class="fa fa-search" aria-hidden="true">LOGIN</a></li>
      <li ><a style="color: #fff;" href="index.php">LOGOUT</a></li>
       
      </ul>
    </div>
  </div>
          </nav>

<br><center><h1 style="font-size :65px;">Latest Products</h1 ></center>

<center> 
<div class=" content mt-5">
            <ul class="rig columns-4">

<?php 
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

  while($row = mysqli_fetch_assoc($result)) {
    
    ?> 
           <li>
				<form action="" method="post" >
            
                    <a href="#"><img class="product-image" src="images/<?php echo  $row["image"] ?>"></a>
                    <h1><?php echo  $row["brand"] ?></h1>
				          	<h4><?php echo  $row["name"] ?></h4>
                    <p><h4><?php echo  $row["description"] ?></h4></p>
                    <div ><h1> <b>R <?php echo  $row["price"] ?> </b></h1></div>
                    <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                    <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                    <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
                    <hr>
					<input type="submit" class="btn bd-ii btn-lg pull-right"  value="Add To Cart" name="cart" >                  
       
					</form>
                </li>


                <?php
                  }  
                  ?>
             
            </ul>
</div>

</center>

</body>

</html>