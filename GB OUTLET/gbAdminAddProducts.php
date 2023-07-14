<?php

include 'gbconnection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:gblogin.php');
};

if(isset($_POST['add_product'])){
   $brand = $_POST['brand'];
   $product_name = $_POST['product_name'];
   $description = $_POST['description'];
   $quantity = $_POST['quantity'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($brand) ||empty($quantity) || empty($product_price) || empty($description) || empty($product_image)){
      $message[] = 'Please Add Something';
   }else{
      $insert = "INSERT INTO products(brand,name,description,quantity, price, image) VALUES('$brand','$product_name','$description','$quantity',  '$product_price', '$product_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }

};

if(isset($_GET['delete'])){
   $productid = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM products WHERE productid = $productid");
   header('location:gbAdminAddProducts.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="AdminAddProducts.css">
   <title>products</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

  
</head>
<body>
   
<nav class="navbar navbar-inverse bd-ii style  ">
  <div class="container-fluid">
    <div class="navbar-header">
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#" style="color: #fff;">ADMIN DASHBOARD</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
   
      <ul class="nav navbar-nav navbar-right ">
	  <li ><a style="color: #fff;" href="gbAdminDashboard.php" >HOME</a></li>
          <li ><a style="color: #fff;" href="gbAdminAddProducts.php"> PRODUCTS </a> </li>
		  
          <li ><a style="color: #fff;" href="gbAdminManagingOrders.php">ORDERS</a></li>
          <li><a style="color: #fff;" href="">Hello,<?php echo $_SESSION['admin_username']; ?></a></li>
          <li ><a style="color: #fff;" href="gblogin.php">LOGOUT</a></li>
       
      </ul>
    </div>
  </div>
</nav>


<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
         <form  action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data"> 
		   <center><h1 >New Products</h1></center>
			<div>
            <label for="brand" font ="arizl">Brand</label>
            <input type="text" class="form-control"  name="brand" placeholder="enter brand name" >
		    <label for="name">Name</label>
            <input type="text"class="form-control"  placeholder="enter product name" name="product_name"  >
			<label for="description">Description</label>
            <input type="text" class="form-control" placeholder="enter description" name="description" >
		    <label for="quantity">Quantity</label><br>
            <input type="text" class="form-control" placeholder="enter quantity" name="quantity" ><br>
			<label for="price">Price</label><br>
            <input type="text" class="form-control" placeholder="enter product price" name="product_price" ><br>
		    <label for="image">Image</label><br><br>
            <input type="file" class="form-control" accept="image/png, image/jpeg, image/jpg" name="product_image" ><br>
			<center><input type="submit"  class="bd-ii btn" name="add_product" value="Add Product"></center>
	
	
            </div>
			</form>


<center>
   <?php

   $select = mysqli_query($conn, "SELECT * FROM products");
   
   ?>
 
<table class="table">
  <thead >
    <tr>
      <th scope="col" >Product Image</th>
      <th scope="col" >Brand</th>
      <th scope="col" >Product Name</th>
      <th scope="col" >Description</th>
      <th scope="col" >Quantity</th>
      <th scope="col" >Product Price</th>
      <th scope="col" >Action</th>
    </tr>
  </thead>
   <?php while($row = mysqli_fetch_assoc($select)){ ?>
  <tbody >
    <tr style="background-color:lightgray" >
      <td role="cell"><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
      <td role="cell"><?php echo $row['brand']; ?></td>
      <td role="cell"><?php echo $row['name']; ?></td>
      <td role="cell"><?php echo $row['description']; ?></td>
      <td role="cell"><?php echo $row['quantity']; ?></td>
      <td role="cell">R<?php echo $row['price']; ?></td>
      <td role="cell">
      <a style="background-color:black" href="gbAdminAddProducts.php?delete=<?php echo $row['productid']; ?>" class="btn bd-ii"> delete </a></td>
    </tr>
 
  </tbody>
   <?php } ?>
</table>
</center>
</body>
</html>