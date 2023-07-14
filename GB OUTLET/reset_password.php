<?php
include("gbconnection.php");

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password =$_POST['password'];

    $users = mysqli_query($conn, "update users set password='$password' where email= '$email'");
    if($users > 0){
           echo "Password is sucessfully changed";
           header('location:gblogin.php');
  
     } 
     else 
     {
        echo "Not updated !";
     } 
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="reset_password.css">
  <title>Reset Password</title>
  </head>
  <script type="text/javascript">
      function validateForm() {
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;

        var eregex =  /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        var pregex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;


        if (!eregex.test(email)) {
          alert("Please enter an email like tj1@gmail.com");
          return false;
        }
        if (email =="") {
            alert("Please enter an email like th12g@gmail.com");
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

        alert(
            "Correct inputs!"
          );
        return true;
      }
    </script>


<body>
<center>
  <div class="content">
  <h1 style="text-align: center;">Reset Password</h1>
    <form method="POST" action="" name="form" onsubmit="return validateForm()">
    <br>
	<label for="email">Email: </label><br>
    <input type="email" id="email" name="email" placeholder="Please enter email" ><br><br>

    <label for="password">New Password: </label><br>
    <input type="password" id="password" name="password" placeholder="Please enter new password" ><br><br>
    <input type="submit" id="submit" name="submit" value="Reset Password"><br>
    </form>
  </div>
</center>
</body>

</html>