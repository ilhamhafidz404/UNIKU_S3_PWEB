<?php

echo '
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>                              
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
';


function QuestionIndex($connect, $id)
{
  $questions = mysqli_query($connect, "SELECT * FROM questions WHERE course_id=$id");

  return $questions;
}

function QuestionShow($connect, $id)
{
  $question = mysqli_query($connect, "SELECT * FROM questions WHERE id=$id");

  return mysqli_fetch_assoc($question);
}


function QuestionInsert($connect, $id)
{
  extract($_POST);

  $answerForCol;

  if ($answer == 'a') {
    $answerForCol = $a;
  } else if ($answer == 'b') {
    $answerForCol = $b;
  } else if ($answer == 'c') {
    $answerForCol = $c;
  } else if ($answer == 'd') {
    $answerForCol = $d;
  }

  mysqli_query($connect, "INSERT INTO questions VALUES(null, '$id', '$question', '$a', '$b', '$c', '$d', '$answerForCol')");

  echo '
  <script type="text/javascript">
  $(document).ready(function(){
      swal({
        title: "Success", 
        text: "Question Created Successfully", 
        icon: "success", 
        buttons: false,
      }).then((value) => {
          window.location.href = window.location.href;
        });
    });
    </script>
    ';
}

function QuestionUpdate($connect, $id)
{
  extract($_POST);

  $answerForCol;

  if ($answer == 'a') {
    $answerForCol = $a;
  } else if ($answer == 'b') {
    $answerForCol = $b;
  } else if ($answer == 'c') {
    $answerForCol = $c;
  } else if ($answer == 'd') {
    $answerForCol = $d;
  }

  mysqli_query($connect, "UPDATE questions SET question='$question', a='$a', b='$b', c='$c', d='$d', answer='$answerForCol' WHERE id=$id");

  echo '
  <script type="text/javascript">
  $(document).ready(function(){
      swal({
        title: "Success", 
        text: "Question Edited Successfully", 
        icon: "success", 
        buttons: false,
      }).then((value) => {
        var currentUrl = window.location.href;

        var urlParams = new URLSearchParams(window.location.search);

        urlParams.delete("editedId");

        var newUrl = currentUrl.split("?")[0] + "?" + urlParams.toString();

        window.location.href = newUrl;
        });
    });
    </script>
    ';
}

function QuestionConfirmDelete()
{
  echo '
  <script type="text/javascript">
      $(document).ready(function(){
        swal({
          title: "Are You Sure?", 
          text: "Question will be deleted permanently", 
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
                title: "Canceled", 
                text: "Question was not deleted", 
                icon: "error",
              }).then((value) => {
                var currentUrl = window.location.href;

                var urlParams = new URLSearchParams(window.location.search);

                urlParams.delete("deletedId");

                var newUrl = currentUrl.split("?")[0] + "?" + urlParams.toString();

                window.location.href = newUrl;
              });
            }
          });
        });
      </script>
    ';
}

function QuestionDelete($connect, $deletedId)
{
  mysqli_query($connect, "DELETE FROM questions WHERE id=$deletedId");

  echo '
    <script type="text/javascript">
      $(document).ready(function(){
        swal({
          title: "Success", 
          text: "Question Deleted Successfully", 
          icon: "success",
        }).then((value) => {
          var currentUrl = window.location.href;
          var urlParams = new URLSearchParams(window.location.search);

          urlParams.delete("deletedId");
          var newUrl = currentUrl.split("?")[0] + "?" + urlParams.toString();

          window.location.href = newUrl;
        });
      });
    </script>
  ';
}
