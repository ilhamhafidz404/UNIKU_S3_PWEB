<?php
require "./connection.php";

echo '
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
';

if (isset($_POST["submit"])) {
  extract($_POST);



  if ($password != $confirm_password) { // cek password & confirm password
    echo '
      <script type="text/javascript">
        $(document).ready(function(){
          swal({
            title: "Failed", 
            text: "Password and Confirm Password are not the same", 
            icon: "error",
          }).then((value) => {
            window.location.href = "http://localhost/quiz/pages/register.php";
          });
        });
        </script>
    ';

    exit();
  }


  $check = mysqli_query($connect, "SELECT * FROM accounts WHERE username='$username'");

  if (mysqli_num_rows($check)) { // cek username
    echo '
      <script type="text/javascript">
        $(document).ready(function(){
          swal({
            title: "Failed", 
            text: "Username is available", 
            icon: "error",
          }).then((value) => {
            window.location.href = "http://localhost/quiz/pages/register.php";
          });
        });
      </script>
    ';

    exit();
  }

  $date = date("Y-m-d");
  $result = mysqli_query($connect, "INSERT INTO accounts VALUES(null, '$username', '$name' ,'$password', 'user', 'avatar1.png', '$date')");

  echo '
    <script type="text/javascript">
      $(document).ready(function(){
        swal({
          title: "Success", 
          text: "You can now log in with a registered user", 
          icon: "success",
        }).then((value) => {
          window.location.href = "http://localhost/quiz/pages/login.php";
        });
      });
    </script>
  ';
}
