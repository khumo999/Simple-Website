<?php
include("gbconnection.php");
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
   
    $users = mysqli_query($conn, "select * from users where email='$email' and password='$password'");
    $matched = mysqli_num_rows($users);
    if ($matched > 0) {
        echo "<br/><br/><strong>Error: </strong> already exists '$email'.";
    } else {
        $result = mysqli_query($conn, "INSERT INTO users(username,email,password) VALUES('$username','$email','$password')");
        if ($result) {
            echo "<br/><br/> Registering successfully.";
            header('location:gblogin.php');
        } else {
            echo "Registration failed, Please try again." . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style1.css">
  <title>Register</title>
  <script type="text/javascript">
      function validateForm() {
        var username = document.getElementById("username").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
       
        var usernameregex = /^[A-Za-z]+([\s][A-Za-z]+)*$/;
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
     
        alert(
            "Correct inputs!"
          );
        return true;
      }
    </script>
</head>

<body>
<center>
  <div class="content">
  <h1 style="text-align: center;">Register</h1>
    <form action="gbregister.php" method="post" name="form" onsubmit="return validateForm()">
      <br>
	    <label for="username">Username : </label><br>
      <input type="username" id="username" name="username" placeholder="Please enter Name " ><br>
      <label for="email">Email: </label><br>
      <input type="email" id="email" name="email" placeholder="Please enter email" ><br>
      <label for="password">Password: </label><br>
      <input type="password" id="password" name="password" placeholder="Please enter password" ><br>
      <input type="submit" id="submit" name="submit" value="Register"><br>
      Already have a account sign in?<a href="gblogin.php">Login</a>
    </form>
  </div>
 </center> 
  
</body>

</html>