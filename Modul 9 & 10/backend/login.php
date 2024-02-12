<?php
require "./connection.php";

session_start();

if (isset($_POST["submit"])) {

  extract($_POST);

  $result = mysqli_query($connect, "SELECT * FROM accounts WHERE username='$username' AND password='$password'");

  if (mysqli_num_rows($result)) {

    foreach ($result as $account) {

      $_SESSION["id"] = $account["id"];
      $_SESSION["username"] = $account["username"];
      $_SESSION["role"] = $account["role"];

      if ($account["role"] == "admin") {
        header("Location: ./../pages/admin/index.php");
      } else {
        header("Location: ./../index.php");
      }
    }
  } else {
    echo '
      <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>                              
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function(){
          swal({
            title: "Failed", 
            text: "Incorrect email or password", 
            icon: "error",
            buttons: false
          }).then((value) => {
            window.location.href = "http://localhost/quiz/pages/login.php";
          });
        });
      </script>
    ';
  }
}
