
<?php include('gbconnection.php');
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:gblogin.php');
}
if(isset($_GET['id'])){
    $productid = $_GET['id'];
   $sql = "SELECT * FROM products  WHERE productid='$productid'";
   $result = mysqli_query($conn, $sql);
 
$row = mysqli_fetch_assoc($result);

$name  = $row['name'];
$price  = $row['price'];
$description  = $row['description'];
$image  = $row['image'];
}


if(isset($_POST['cart'])){

   $name = $_POST['name'];
   $brand = $_POST['brand'];
   $price = $_POST['price'];
   $image = $_POST['image'];
   $quantity = $_POST['quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$name' AND id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
   
	  echo"<script> alert('already added to cart!');  </script>";
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(id, name, brand, price,quantity, image) VALUES('$user_id', '$name','$brand', '$price','$quantity', '$image')") or die('query failed');
      
	  echo"<script> alert('product added to cart!');  </script>";
	  
   }

}








?>



 
 
 <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
   
<style>
.closebtn {
  float: top;
  font-size: 30px;
  font-weight: bold;
  cursor: pointer;
}

* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.lcolumn {
  float: left;
  width: 50%;
  padding: 10px;
  height: 300px; 
}
a{
	color:black;
	
}
/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}


@media screen and (max-width: 600px) {
  .lcolumn {
    width: 100%;
  }
}




  
.k{
    height: 50px;
    width: 100%;
    background-color: #1177ca;
    position: relative;
  }
  
  .k > .k-header {
    display: inline;
  }
  
  .k > .k-header > .k-title {
    display: inline-block;
    font-size: 22px;
    color: #fff;
    font-weight: 550;
    font-family: Arial, Helvetica, sans-serif;
    padding: 10px 10px 10px 10px;
  }
  
  .k > .k-btn {
    display: none;
  }
  
  .k > .k-links {
    display: inline;
    float: right;
    font-size: 18px;
  }
  .k > .k-links > ul li a{
    display: block;
    padding: 0 8px;
    color: #fff;
    line-height: 40px;
    font-size: 18px;
    text-decoration: none;

  }
  .k > .k-links > ul{
    padding: 0;
    margin-top: 5px;
    list-style: none;
    position: relative;
    
  }
  .k > .k-links > ul li{
    display: inline-block;
    background-color: #1177ca;
    
    
  }
  .k > .k-links > ul li:hover{
      background-color: #0b65af;
      border-radius: 5px;
  }
  
  .k > #k-check {
    display: none;
  }

 .k .k-links ul a.kicon{
 margin-left: 80px;
 margin-right: 10px;
 }

 .k .k-links ul a i{
    background-color: #fff;
    border-radius: 50px;
    padding: 7px;
    margin-left: 5px;
 }

  
  @media (max-width:750px) {
    .k > .k-btn {
      display: inline-block;
      position: absolute;
      right: 0px;
      top: 0px;
    }
    .k > .k-btn > label {
      display: inline-block;
      width: 50px;
      height: 50px;
      padding: 13px;
    }
    .k > .k-btn > label:hover,.k  #k-check:checked ~ .k-btn > label {
      background-color: rgba(0, 0, 0, 0.3);
    }
    .k > .k-btn > label > span {
      display: block;
      width: 25px;
      height: 10px;
      border-top: 2px solid #eee;
    }
    .k > .k-links {
      position: absolute;
      display: block;
      width: 100%;
      background-color: #333;
      height: 0px;
      transition: all 0.3s ease-in;
      overflow-y: hidden;
      top: 50px;
      left: 0px;
    }
    .k > .k-links > ul li a {
      display: block;
      width: 100%;
    }

    /*   */


    
      .k > .k-links > ul li{
        display: block;
        margin-bottom: 20px;
        padding: 0;
        background-color: #333;
         
      }
      .k > .k-links > ul li a{
          margin-left: 40%;
      }
      .k .k-links ul a.kicon{
        margin-left: 33%;
      }

    /*   */
    .k > #k-check:not(:checked) ~ .k-links {
      height: 0px;
    }
    .k > #k-check:checked ~ .k-links {
      height: calc(100vh - 50px);
      overflow-y: auto;
    }
  }

.bd-ii {
  color: #fff;
  background-color: #221e10  ; }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</head>

<body>
<nav class="navbar navbar-inverse bd-ii">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#" style="color: blue"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      
      <ul class="nav navbar-nav navbar-right">
	  <li ><a style="color: #fff;" href="index.php" >HOME</a></li>
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

          <li><a style="color: #fff;" href="hello.php">Hello, <?php echo $_SESSION['user_username']; ?></a></li>
          <li ><a style="color: #fff;" href="gblogin.php">LOGOUT</a></li>
       
      </ul>
    </div>
  </div>
</nav>
 <?php 


$sql = "SELECT * FROM products WHERE productid='id'";
$result = mysqli_query($conn, $sql);
 
  while($row = mysqli_fetch_assoc($result)) {
    ?> 
<br><br><br>
<div class="row">
<form action="" method="post" >
  <div class="lcolumn" style="background-color:white;">
    <h2></h2>
    <p><img src="images/<?php echo $row["image"] ?>" alt=""  style='height:200px;width:300px;'></p>
  </div>
  <div class="lcolumn" style="background-color:white;">
    <h2></h2>
    <p>      <h3><b><?php echo $row["brand"] ?></b></h3>  <h3><b><?php echo $row["name"] ?></b></h3>
        <h2><b>R <?php echo  $row["price"] ?> </b></h2>
<p>     <?php echo $row["description"] ?></p> <div class="row"> 
    <div class="col-md-2">
        <input type="number" class='form-control' min='1' name='quantity' value='1'> 
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-4"><br>
        <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
		<input type="hidden" name="brand" value="<?php echo $row['brand']; ?>">
        <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
		<input type="hidden" name="quantity" value="<?php echo $row['quantity']; ?>">
        <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
        <input type="hidden"  min='1' name='quantity' value='1'>           
		<input type="submit"  class="bd-ii btn-lg pull-left"  value="Add To Cart" name="cart" >
		
    </div>
</div>  </p>
  </div>
</div>
</form><br><br>

   <?php
}
?> 
</center>
</body>
</html>






















