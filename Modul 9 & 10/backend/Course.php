<?php
echo '
  <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>                              
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
';


function index($connect)
{
  $courses = mysqli_query($connect, "SELECT * FROM courses ORDER BY id DESC");

  return $courses;
}

function show($connect, $id)
{
  $course = mysqli_query($connect, "SELECT * FROM courses WHERE id=$id");

  return $course;
}

function insert($connect)
{
  extract($_POST);

  $uniqueFilename;
  if ($_FILES["file"]["name"]) {

    $targetDirectory = "C:/laragon/www/quiz/images/courses/";
    $uniqueFilename = uniqid() . '_' . basename($_FILES["file"]["name"]);
    $targetFile = $targetDirectory . $uniqueFilename;

    move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile);
  } else {
    $uniqueFilename = "course.svg";
  }

  mysqli_query($connect, "INSERT INTO courses VALUES(null, '$name', '$description', '$uniqueFilename')");

  echo '
    <script type="text/javascript">
      $(document).ready(function(){
        swal({
          title: "SUCCESS", 
          text: "Course Created Successfully", 
          icon: "success",
        }).then((value) => {
          window.location.href = "http://localhost/quiz/pages/admin/courses/index.php";
        });
      });
    </script>
  ';
}

function update($connect, $id)
{

  extract($_POST);

  mysqli_query($connect, "UPDATE courses SET name='$name', description='$description' WHERE id=$id");

  echo '
  <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>                              
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      swal({
        title: "SUCCESS", 
        text: "Course Edited Successfully", 
        icon: "success",
      }).then((value) => {
        window.location.href = "http://localhost/quiz/pages/admin/courses/index.php";
      });
    });
  </script>
';
}

function confirmDelete()
{
  echo '
  <script type="text/javascript">
      $(document).ready(function(){
        swal({
          title: "CONFIRM?", 
          text: "The course will be deleted permanently", 
          icon: "warning",
          buttons: true,
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            var currentUrl = window.location.href;

            var newUrl = currentUrl + (currentUrl.indexOf("?") === -1 ? "?" : "&") + "yesDeleted=1";

            window.location.href = newUrl;
          } else {
              swal({
                title: "CANCELED", 
                text: "The course is not deleted", 
                icon: "error",
              }).then((value) => {
                window.location.href = "http://localhost/quiz/pages/admin/courses/index.php";
              });
            }
          });
        });
      </script>
      ';
  // mysqli_query($connect, "DELETE FROM courses WHERE id=$deletedId");
}

function delete($connect, $deletedId)
{
  mysqli_query($connect, "DELETE FROM courses WHERE id=$deletedId");

  echo '
    <script type="text/javascript">
      $(document).ready(function(){
        swal({
          title: "SUCCESS", 
          text: "Course Successfully Deleted", 
          icon: "success",
        }).then((value) => {
          window.location.href = "http://localhost/quiz/pages/admin/courses/index.php";
        });
      });
    </script>
  ';
}
