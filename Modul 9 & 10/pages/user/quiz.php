<?php
session_start();
require "./../../backend/connection.php";

if (!isset($_SESSION["id"]) && !isset($_SESSION["username"]) && !isset($_SESSION["role"])) {
  header("Location: ./../login.php");
}

$courseId;
$accountId = $_SESSION["id"];

if (isset($_GET["course_id"])) {
  $courseId = $_GET["course_id"];
  $questions = mysqli_query($connect, "SELECT * FROM questions WHERE course_id=$courseId");
}

if (isset($_POST["submit"])) {
  foreach ($_POST as $key => $answer) {
    if ($key != "submit") {
      mysqli_query($connect, "INSERT INTO answers VALUES(null, $accountId, $key, '$answer', $courseId)");
    }
  }
}

$courseAnswerCount = mysqli_query($connect, "SELECT * FROM answers WHERE course_id=$courseId AND account_id=$accountId");


$myAnswers = [];
// echo "myAnwer";
foreach ($courseAnswerCount as $myAnswer) {
  $myAnswers[] = $myAnswer["user_answer"];
}

$questionAnswers = [];
$courseQuestionCount = mysqli_query($connect, "SELECT * FROM questions WHERE course_id=$courseId");
foreach ($courseQuestionCount as $questionAnswer) {
  $questionAnswers[] = $questionAnswer["answer"];
}

$score = 0;

foreach ($myAnswers as $key => $row) {
  if ($row == $questionAnswers[$key]) {
    $score++;
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz</title>
  <link rel="stylesheet" href="./../../src/style.css">
  <style>
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>

<body class="bg-gray-100">

  <main class="grid grid-cols-12 px-20 gap-10 mt-10">
    <div class="col-span-3 relative">
      <section class="bg-white rounded overflow-hidden shadow sticky top-0">
        <div class="p-5">
          <span class="flex items-center gap-3">
            <img src="./../../images/logo.png" class="w-[40px]">
            <h1>ALOPE QUIZ</h1>
          </span>
          <hr class="my-5">
          <ul>
            <li class="mb-5">
              <a href="./../../index.php" class="flex gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 text-red-500">
                  <path fill-rule="evenodd" d="M12.963 2.286a.75.75 0 0 0-1.071-.136 9.742 9.742 0 0 0-3.539 6.176 7.547 7.547 0 0 1-1.705-1.715.75.75 0 0 0-1.152-.082A9 9 0 1 0 15.68 4.534a7.46 7.46 0 0 1-2.717-2.248ZM15.75 14.25a3.75 3.75 0 1 1-7.313-1.172c.628.465 1.35.81 2.133 1a5.99 5.99 0 0 1 1.925-3.546 3.75 3.75 0 0 1 3.255 3.718Z" clip-rule="evenodd" />
                </svg>
                Dashboard
              </a>
            </li>
            <li class="mb-5">
              <a href="./profile.php" class="flex gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 text-indigo-500">
                  <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                </svg>
                Profile
              </a>
            </li>
            <li>
              <a href="./courses.php" class="flex gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 text-emerald-500">
                  <path d="M11.25 4.533A9.707 9.707 0 0 0 6 3a9.735 9.735 0 0 0-3.25.555.75.75 0 0 0-.5.707v14.25a.75.75 0 0 0 1 .707A8.237 8.237 0 0 1 6 18.75c1.995 0 3.823.707 5.25 1.886V4.533ZM12.75 20.636A8.214 8.214 0 0 1 18 18.75c.966 0 1.89.166 2.75.47a.75.75 0 0 0 1-.708V4.262a.75.75 0 0 0-.5-.707A9.735 9.735 0 0 0 18 3a9.707 9.707 0 0 0-5.25 1.533v16.103Z" />
                </svg>
                Course
              </a>
            </li>
          </ul>
        </div>
        <a class="bg-red-500 hover:bg-red-400 text-white px-5 py-3 flex gap-2 text-sm items-center" href="./../../backend/logout.php">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4">
            <path fill-rule="evenodd" d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
          </svg>
          Logout
        </a>
      </section>
    </div>
    <div class="col-span-9">
      <div class="flex items-center justify-between mb-10">
        <h2 class="text-3xl font-semibold">
          <span class="bg-purple-500 w-[40px] h-[40px] inline-flex items-center justify-center text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path d="M11.25 4.533A9.707 9.707 0 0 0 6 3a9.735 9.735 0 0 0-3.25.555.75.75 0 0 0-.5.707v14.25a.75.75 0 0 0 1 .707A8.237 8.237 0 0 1 6 18.75c1.995 0 3.823.707 5.25 1.886V4.533ZM12.75 20.636A8.214 8.214 0 0 1 18 18.75c.966 0 1.89.166 2.75.47a.75.75 0 0 0 1-.708V4.262a.75.75 0 0 0-.5-.707A9.735 9.735 0 0 0 18 3a9.707 9.707 0 0 0-5.25 1.533v16.103Z" />
            </svg>
          </span>
          COURSES
        </h2>
        <a href="./courses.php" class="hover:bg-purple-500 hover:text-white border border-purple-500 px-5 py-2 text-sm text-purple-500 rounded mb-4">
          Back
        </a>
      </div>
      <div class="container mt-5">
        <div class="grid grid-cols-3 gap-10">

          <div class="col-span-2">
            <?php if ($score) : ?>
              <section class="bg-white p-5 rounded shadow-md">
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
              </section>
            <?php else : ?>
              <form action="" method="POST">
                <?php foreach ($questions as $index => $question) : ?>
                  <div class="bg-white border shadow p-5 mb-3" id="no<?= $index + 1 ?>">
                    <h5 class="text-purple-500 font-bold mb-3">No. <?= $index + 1 ?></h5>
                    <div class="card-body">
                      <h5 class="mb-3">
                        <p><?= $question["question"] ?></p>
                      </h5>
                      <p class="card-text">
                      <div class="me-2">
                        <input type="radio" class="form-check-input" id="<?= $question["id"] . "a" ?>" name="<?= $question["id"] ?>" value="<?= $question["a"] ?>">
                        <label for="<?= $question["id"] . "a" ?>">A. <?= $question["a"] ?></label>
                      </div>
                      <div class="me-2">
                        <input type="radio" class="form-check-input" id="<?= $question["id"] . "b" ?>" name="<?= $question["id"] ?>" value="<?= $question["b"] ?>">
                        <label for="<?= $question["id"] . "b" ?>">B. <?= $question["b"] ?></label>
                      </div>
                      <div class="me-2">
                        <input type="radio" class="form-check-input" id="<?= $question["id"] . "c" ?>" name="<?= $question["id"] ?>" value="<?= $question["c"] ?>">
                        <label for="<?= $question["id"] . "c" ?>">C. <?= $question["c"] ?></label>
                      </div>
                      <div class="me-2">
                        <input type="radio" class="form-check-input" id="<?= $question["id"] . "d" ?>" name="<?= $question["id"] ?>" value="<?= $question["d"] ?>">
                        <label for="<?= $question["id"] . "d" ?>">D. <?= $question["d"] ?></label>
                      </div>
                      </p>
                    </div>
                  </div>
                <?php endforeach; ?>

                <a href="./courses.php" class="bg-red-500 hover:bg-red-400 px-5 py-2 rounded text-white me-2">Kembali</a>
                <?php if (!$score) : ?>
                  <button onclick="return confirm('Are you sure?')" name="submit" class="bg-purple-500 px-5 py-2 rounded text-white hover:bg-purple-400">Submit</button>
                <?php endif; ?>
              </form>
            <?php endif; ?>
            <br><br>
          </div>
          <div class="">
            <div class="bg-white rounded p-5 shadow">
              <h5 class="font-semibold text-center mb-5 tex">Quick Access</h5>
              <div class="card-body">
                <div class="grid grid-cols-5 gap-5">
                  <?php foreach ($questions as $index => $question) : ?>
                    <div class="bg-white hover:bg-purple-500 hover:text-white rounded border border-purple-500 text-purple-500">
                      <a href="#no<?= $index + 1 ?>">
                        <div class="card text-center py-2 w-100">
                          <?= $index + 1 ?>
                        </div>
                      </a>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://cdn.canvasjs.com/ga/canvasjs.min.js"></script>
  <script src="./../../src/js/bootstrap.bundle.min.js"></script>

  <script>
    window.onload = function() {

      var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
          text: "Result Answer"
        },
        data: [{
          type: "pie",
          startAngle: 240,
          yValueFormatString: "##0",
          indexLabel: "{label} {y}",
          dataPoints: [{
              y: <?= $score ?>,
              label: "Correct"
            },
            {
              y: <?= count($myAnswers) - $score ?>,
              label: "Wrong"
            }
          ]
        }]
      });
      chart.render();

    }
  </script>
</body>