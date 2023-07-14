<?php
include("gbconnection.php");
session_start();
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $users = mysqli_query($conn, "select * from users where email='$email' and password='$password'");
    if(mysqli_num_rows($users) > 0){
         
       while( $fetch = mysqli_fetch_assoc($users))
	   {
        if($fetch['utype'] == 'admin'){
           $_SESSION['admin_username'] = $fetch['username'];
           $_SESSION['admin_id'] = $fetch['id'];
           header('location:gbAdminDashboard.php');
  
        }
        elseif($fetch['utype'] == 'user'){
           $_SESSION['user_username'] = $fetch['username'];
           $_SESSION['user_id'] = $fetch['id'];
           header('location:index.php');
  
        }
       }
     } 
     else 
     {
        echo "wrong email or password!";
     }  
   
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style12.css">
  <title>Login</title>
  <script type="text/javascript">
      function validateForm() {
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;

        var eregex =  /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        var pregex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;


        if (!eregex.test(email)) {
          alert("Please enter an email like uggug@gmail.com");
          return false;
        }
        if (email =="") {
            alert("Please enter an email like uggug@gmail.com");
            return false;
          }
        if (!pregex.test(password)) {
          alert("Please enter a password with atleast one number and one uppercase and lowercase letter  and  6 or more characters");
          return false;
        }
        if (password =="") {
            alert("Please enter a password with atleast one number and one uppercase and lowercase letter  and  6 or more characters");
            return false;
          }
        return true;
      }
    </script>
</head>
<body>
<center>
  <div class="content">
  <h1 style="text-align: center; font-size: 85px;">Login Page</h1>
    <form method="POST" action="" name="form" onsubmit="return validateForm()">
      <br>
      <label for="email">Email: </label><br>
      <input type="email" id="email" name="email" placeholder="Please enter email" ><br>

      <label for="password">Password: </label><br>
      <input type="password" id="password" name="password" placeholder="Please enter password" ><br><br>
      <a href="reset_password.php" >Forgot password?</a><br><br>

      <input type="submit" id="submit" name="submit" value="Login"><br>
      not interested ?<a href="index.php">Back</a>
      Become a member?<a href="gbregister.php">Register</a>
    </form>
  </div>
  </center>

</body>

</html>