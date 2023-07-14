<?php 
include('gbconnection.php');
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:gblogin.php');
}

if (isset($_POST['submit'])) {
    $cardname = $_POST['cardname'];
    $cardnumber = $_POST['cardnumber'];
    $expmonth = $_POST['expmonth'];
    $cvv = $_POST['cvv'];
	$expyear = $_POST['expyear'];
    $bname = $_POST['bname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
	$city = $_POST['city'];
    $zip = $_POST['zip'];
    $province = $_POST['province'];
	$mobile = $_POST['mobile'];
	$odate = $_POST['odate'];
   
   $total = 0;
   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $j[] = $cart_item['name'].'('.$cart_item['quantity'].')';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $total += $sub_total;
		  
      }
   }
  $name = implode(',',$j);
	$result = mysqli_query($conn, "INSERT INTO orders(name,cardname,cardnumber,expmonth,cvv,expyear,bname,email,address,city,zip,province,mobile,total,id,odate) VALUES('$name','$cardname','$cardnumber','$expmonth','$cvv','$expyear','$bname','$email','$address','$city','$zip','$province','$mobile','$total','$user_id','$odate')");
        if ($result) {
			
		//	 echo " Worker";
            mysqli_query($conn, "DELETE FROM `cart` ");
            //header('location:vieworders.php');
        } else {
            echo " Please try again." . mysqli_error($conn);
        }
    
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript">
      function validateForm() {
        var bname = document.getElementById("bname").value;
        var email = document.getElementById("email").value;
        var mobile = document.getElementById("mobile").value;
        var address = document.getElementById("address").value;
		var province = document.getElementById("province").value;
		var city = document.getElementById("city").value;
		var zip = document.getElementById("zip").value;
		var cardname = document.getElementById("cardname").value;
		var cardnumber = document.getElementById("cardnumber").value;
		var expmonth = document.getElementById("expmonth").value;
		var expyear = document.getElementById("expyear").value;
		var cvv = document.getElementById("cvv").value;
		
		var bnameregex = /^[A-Za-z]+([\s][A-Za-z]+)*$/;
        var eregex =  /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        var pregex = /^[0-9][A-Za-z]$/;
		var mobileregex = /^[0]{1}[0-8]{2}[0-9]{7}$/;
		var zipregex = /^[0-9]{5}$/;

        
			
		if (!mobileregex.test(mobile)) {
          alert("Enter a mobile number.");
          return false;
        } 
        if (mobile =="") {
            alert("Please enter mobile");
            return false;
          }
		  
		if (!eregex.test(email)) {
          alert("Enter a email like uggug@gmail.com.");
          return false;
        } 
         
		 
        if (email =="") {
            alert("Please enter an email like uggug@gmail.com");
            return false;
          }
         
        if (address =="") {
            alert("Enter address");
            return false;
          }
		  
        
        if (city =="") {
            alert("Please enter city");
            return false;
          }
        if (!zipregex.test(zip)) {
          alert("Enter a zip code");
          return false;
        } 
        if (zip =="") {
            alert("Please enter zip code");
            return false;
          }
		  
		 if (!bnameregex.test(province)) {
          alert("Enter a province");
          return false;
        } 
		   
		 if (province =="") {
            alert("Enter a province");
            return false;
          }
		  
        if (cardname =="") {
            alert("Enter a cardname");
            return false;
          }
		  if (cardnumber =="") {
            alert("Enter a cardnumber");
            return false;
          }
 
        if (expmonth =="") {
            alert("Please enter an expiry month");
            return false;
          }
 
        if (expyear =="") {
            alert("Please enter expiry year");
            return false;
          }
        if (cvv =="") {
            alert("Enter cvv");
            return false;
          }

        alert(
            "Correct inputs!"
          );
        return true;
      }
    </script>
<style>


.bd-ii {
  color: #fff;
  background-color: #221e10  ; }
  
 
  body{
    background-color: grey;
  }
  
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
      <a class="navbar-brand" href="#" style="color: black; background-color: blue;"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar "style="color: black; background-color: blue;">
      
      <ul class="nav navbar-nav navbar-right">
	  
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
          <li ><a style="color: #fff;" href="gblogout.php">LOGOUT</a></li>
       
      </ul>
    </div>
  </div>
</nav>


   
    

<div class="container">
<form action="" method="post" name="form" onsubmit="return validateForm()">
  <div class="py-5 text-center">
    
    <h2><b>FINAL STEP TO MAKE A PURCHASE</b></h2>
     
    </div>
  
 <div class="col-md-8 order-md-1">

 <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <h4 class="mb-3"><b>Billing Address</b></h4>
    
      
          <div class="mb-3">
          <label for="bname">Full Name</label>
          <input type="text"  class="form-control" id="bname" name="bname" placeholder="Mike Montego">
    </div>
    <div class="mb-3">
    <label for="mobile"> Mobile</label>
          <input type="text"  class="form-control" id="mobile" name="mobile" maxlength="10" placeholder="0821121218">
          </div>
       

      <div class="mb-3">
        <label for="email">Email </label>
        <input type="text" class="form-control" id="email" name="email" placeholder="SamHolding@gmai.com">
      </div>

      <div class="mb-3">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Gippy Street">
      </div>

       <div class="mb-3">
   <label for="city"><i ></i> City</label>
       <input type="text" class="form-control" id="city" name="city" placeholder="Robakala">
   </div>

      <div class="row">
        <div class="col-md-5 mb-3">
          <label for="odate"> Date Of Purchase</label><br>
          <input type="date" id="odate" name="odate" placeholder="Date of Purchase">
        </div>
        <div class="col-md-4 mb-3">
          <label for="province">Province</label>
          <input type="text" class="form-control" id="province" name="province" placeholder="">
        </div>
        <div class="col-md-3 mb-3">
          <label for="zip">Zip</label>
          <input type="text" class="form-control" name="zip" id="zip" maxlength="5" placeholder="" >
         
        </div>
      </div>
      

      <h4 class="mb-3"><b>Payment</b></h4>
       <label for="fname">Accepted Cards</label>
      <div class="d-block my-3">
            <i class="fab fa-cc-visa fa-6x" style="color:navy;" ></i>
            <i class="fab fa-cc-mastercard fa-6x" style="color:red;"></i>
      <i class="fab fa-paypal fa-6x" style="color:blue;"></i>
      <i class="fab fa-cc-apple-pay fa-6x" style="color:black;"></i>
      
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="cardname">Name on Card</label>
          <input type="text" class="form-control" id="cardname" name="cardname" placeholder="Alew Smith">
        </div>
        <div class="col-md-6 mb-3">
          <label for="cardnumber">Credit card number</label>
          <input type="text" class="form-control" id="cardnumber" name="cardnumber" maxlength="16" placeholder="1111 2222 3333 4444">
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 mb-3">
          <label for="expmonth">Exp Month</label>
          <input type="text" class="form-control" id="expmonth" name="expmonth" placeholder="September">
        </div>
    <div class="col-md-3 mb-3">
        <label for="expyear">Exp Year</label>
        <input type="text" class="form-control" id="expyear" name="expyear" maxlength="4" placeholder="2028">
    </div>
        <div class="col-md-3 mb-3">
          <label for="cvv">CVV</label>
          <input type="text" class="form-control" id="cvv" name="cvv" placeholder="112" maxlength="3">
        </div>
      </div>
      <hr class="mb-4">
      <button type="submit" id="submit" name="submit" style="background-color:blue;color:white;" class="btn  btn-lg btn-block bd-ii" > PROCEED TO CHECKOUT</button>
      
      
    
    </form>
  </div>

   <div class="row " >
    <div class="col-md-4 order-md-2 mb-4 ">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
      <span class="text-muted" style="color:black"><b>CART</b></span>
      <span class="badge badge-secondary badge-pill" style="background-color:black"><?php
  
        $sql="SELECT * from cart where id = '$user_id'";
        $result=$conn-> query($sql);
        $count=0;
        if ($result-> num_rows > 0){
           while ($row=$result-> fetch_assoc()) {
                $count=$count+1;
           }
         }
        echo $count
    ?></span>
    </h4>
  
    <ul class="list-group mb-3"><?php
 $total = 0;
 $select = mysqli_query($conn, "SELECT * FROM cart where id = '$user_id'");
 
 
 
 
 if(mysqli_num_rows($select) > 0){
          while($row = mysqli_fetch_assoc($select)){ 
 
 
 ?>
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h4 class="my-0"><strong><?php echo  $row["name"] ?> (x<?php echo  $row["quantity"] ?>)</strong></h4>
          <strong>R<?php echo $sub_total = ($row["quantity"] * $row["price"]); ?></strong>
        <?php
  $total += $sub_total;
 }}
  ?></div>
       
      </li>
     
      <li class="list-group-item d-flex justify-content-between">
        <span><b>Total </b></span>
    <hr>
        <strong>R <?php echo $total; ?></strong>
      </li>
    </ul>
 
 </div>
 </div>
 </div>

</div>


</body>
</html>