<?php
include("db.php");

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $users = mysqli_query($conn, "select * from customer where email='$email'");
    if(mysqli_num_rows($users) > 0){

           header('location:reset_password.php');
  
     } 
     else 
     {
        echo "No user is registered with this email address";
     }  
   
}

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Forgot Password</title>
  <script type="text/javascript">
      function validateForm() {
        var email = document.getElementById("email").value;

        var eregex =  /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
  
        if (!eregex.test(email)) {
          alert("Please enter an email like uggug@gmail.com");
          return false;
        }
        if (email =="") {
            alert("Please enter an email like uggug@gmail.com");
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
  
  <h1 style="text-align: center;">Forgot Password</h1>
    <form method="POST" action="" name="form" onsubmit="return validateForm()">
      <br>
      <label for="email">Email: </label><br>
      <input type="email" id="email" name="email" placeholder="Please enter email" ><br>

      <input type="submit" id="submit" name="submit" value="Check Email"><br>
      
    </form>
  </div>
</center>
</body>

</html>