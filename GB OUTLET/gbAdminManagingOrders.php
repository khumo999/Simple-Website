<?php include('gbconnection.php');
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

?>
<!DOCTYPE html>
<html>
<head>
<style>
.bd-ii {
  color: #fff;
  background-color: #221e10  ; }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body style="background-color:lightgray;">
<nav class="navbar navbar-inverse bd-ii">
  <div class="container-fluid"style="color: #fff; background-color:blue;">
    <div class="navbar-header"style="color: #fff; background-color:blue;">
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#" style="color: #fff; background-color:blue;">ADMIN</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar"style="color: #fff; background-color:blue;">
      
      <ul class="nav navbar-nav navbar-right">
	         <li ><a style="color: #fff;" href="gbAdminDashboard.php" >HOME</a></li>
           <li ><a style="color: #fff;" href="gbAdminAddProducts.php" >PRODUCTS</a></li>  
                           
          <li><a style="color: #fff;" href="hello.php">Hello, <?php echo $_SESSION['admin_username']; ?></a></li>
          <li ><a style="color: #fff;" href="gblogin.php">LOGOUT</a></li>
       
      </ul>
    </div>
  </div>
</nav>
<center><h2 style="font-size:75px; color:blue;">Order Details</h2></center><br>
<?php 
 $sql = "SELECT * FROM orders";
   
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
<a href="gbAdminDashboard.php" ><button class="bd-ii btn-lg pull-left" style="color: #fff; background-color:blue;"> BACK</button></a>
<center>
</body>
</html>