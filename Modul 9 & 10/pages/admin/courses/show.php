<?php
require "./../../../backend/connection.php";
require "./../../../backend/Course.php";
require "./../../../backend/Question.php";
require "./../../../backend/User.php";

session_start();
if (!isset($_SESSION["id"]) && !isset($_SESSION["username"]) && !isset($_SESSION["role"])) {
  header("Location: ./../../login.php");
}

$resCourse = show($connect, $_GET["id"]);
$questions = QuestionIndex($connect, $_GET["id"]);

$course = mysqli_fetch_assoc($resCourse);

if (isset($_POST["submitQuestion"])) {
  QuestionInsert($connect, $_GET["id"]);
}

if (isset($_POST["updateQuestion"])) {
  QuestionUpdate($connect, $_GET["editedId"]);
}

$editQuestion;
if (isset($_GET["editedId"])) {
  $editQuestion = QuestionShow($connect, $_GET["editedId"]);
}

if (isset($_GET["deletedId"])) {
  $deletedId = $_GET["deletedId"];

  QuestionConfirmDelete();

  if (isset($_GET["yesDeleted"])) {
    QuestionDelete($connect, $deletedId);
  }
}

$users = UserIndex($connect);

function getScore($accountId)
{
  global $connect;

  $courseId = $_GET["id"];
  $answersUser = mysqli_query(
    $connect,
    "SELECT * FROM answers 
    INNER JOIN questions ON questions.id = answers.question_id
    WHERE answers.course_id=$courseId AND account_id=$accountId 
    "
  );

  $score = 0;
  foreach ($answersUser as $answerUser) {
    if ($answerUser["user_answer"] == $answerUser["answer"]) {
      $score++;
    }
  }

  return $score;
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Question</title>
  <link rel="stylesheet" href="./../../../src/style.css">
  <link rel="stylesheet" href="./../../src/fontawesome/css/all.css">
</head>

<body class="bg-gray-100">

  <main class="grid grid-cols-12 px-20 gap-10 mt-10">
    <div class="col-span-3 relative">
      <section class="bg-white rounded overflow-hidden shadow sticky top-0">
        <div class="p-5">
          <span class="flex items-center gap-3">
            <img src="./../../../images/logo.png" class="w-[40px]">
            <h1>ALOPE QUIZ</h1>
          </span>
          <hr class="my-5">
          <ul>
            <li class="mb-5">
              <a href="./../index.php" class="flex gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 text-red-500">
                  <path fill-rule="evenodd" d="M12.963 2.286a.75.75 0 0 0-1.071-.136 9.742 9.742 0 0 0-3.539 6.176 7.547 7.547 0 0 1-1.705-1.715.75.75 0 0 0-1.152-.082A9 9 0 1 0 15.68 4.534a7.46 7.46 0 0 1-2.717-2.248ZM15.75 14.25a3.75 3.75 0 1 1-7.313-1.172c.628.465 1.35.81 2.133 1a5.99 5.99 0 0 1 1.925-3.546 3.75 3.75 0 0 1 3.255 3.718Z" clip-rule="evenodd" />
                </svg>
                Dashboard
              </a>
            </li>
            <li class="mb-5">
              <a href="./../user.php" class="flex gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 text-indigo-500">
                  <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                </svg>
                User
              </a>
            </li>
            <li>
              <a href="./index.php" class="flex gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 text-emerald-500">
                  <path d="M11.25 4.533A9.707 9.707 0 0 0 6 3a9.735 9.735 0 0 0-3.25.555.75.75 0 0 0-.5.707v14.25a.75.75 0 0 0 1 .707A8.237 8.237 0 0 1 6 18.75c1.995 0 3.823.707 5.25 1.886V4.533ZM12.75 20.636A8.214 8.214 0 0 1 18 18.75c.966 0 1.89.166 2.75.47a.75.75 0 0 0 1-.708V4.262a.75.75 0 0 0-.5-.707A9.735 9.735 0 0 0 18 3a9.707 9.707 0 0 0-5.25 1.533v16.103Z" />
                </svg>
                Course
              </a>
            </li>
          </ul>
        </div>
        <a class="bg-red-500 hover:bg-red-400 text-white px-5 py-3 flex gap-2 text-sm items-center" href="./../../../backend/logout.php">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4">
            <path fill-rule="evenodd" d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
          </svg>
          Logout
        </a>
      </section>
    </div>
    <div class="col-span-9">
      <div class="flex items-center justify-between mb-10">
        <h2 class="text-3xl font-semibold uppercase">
          <span class="bg-purple-500 w-[40px] h-[40px] inline-flex items-center justify-center text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path d="M11.25 4.533A9.707 9.707 0 0 0 6 3a9.735 9.735 0 0 0-3.25.555.75.75 0 0 0-.5.707v14.25a.75.75 0 0 0 1 .707A8.237 8.237 0 0 1 6 18.75c1.995 0 3.823.707 5.25 1.886V4.533ZM12.75 20.636A8.214 8.214 0 0 1 18 18.75c.966 0 1.89.166 2.75.47a.75.75 0 0 0 1-.708V4.262a.75.75 0 0 0-.5-.707A9.735 9.735 0 0 0 18 3a9.707 9.707 0 0 0-5.25 1.533v16.103Z" />
            </svg>
          </span>
          <?= $course["name"] ?>
        </h2>
        <div class="flex gap-2">
          <button onclick="toggleModalSelectOptionExport()" class="border border-purple-500 hover:bg-purple-500 px-3 py-2 rounded text-purple-500 hover:text-white text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
            </svg>
          </button>
          <button id="buttonToggle" class="bg-purple-500 px-5 py-2 rounded text-white text-sm hover:bg-purple-400" onclick="toggleShow()">
            See User Scores
          </button>
          <a href="./index.php" class="border border-purple-500 hover:bg-purple-500 px-5 py-2 rounded text-purple-500 hover:text-white text-sm">
            Back
          </a>
        </div>
      </div>

      <section class="mb-5 bg-white hidden" id="usersScore">
        <table class="border w-full">
          <tr class="bg-gray-900 text-white">
            <th class="py-3">#</th>
            <th>Name</th>
            <th>Score</th>
          </tr>
          <?php foreach ($users as $index => $user) : ?>
            <tr class="<?php if ($index % 2 == 0) : ?> bg-gray-100 <?php endif; ?>">
              <th class="py-3">
                <?= $index + 1 ?>
              </th>
              <td>
                <?= $user["name"] . " (" . $user["username"] . ")" ?>
              </td>
              <td>
                <center>
                  <?= getScore($user["id"]) ?>
                </center>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      </section>

      <section id="questions">
        <?php if (isset($_GET["editedId"])) : ?>
          <form action="" method="POST">
            <div class="grid grid-cols-4 gap-5 bg-white p-5 rounded shadow">

              <div class="mb-3 col-span-4">
                <label for="question" class="block font-semibold">Question</label>
                <input type="text" name="question" class="w-full px-5 py-2 rounded border bg-gray-50" id="question" value="<?= $editQuestion["question"] ?>">
              </div>

              <div class="mb-3">
                <label for="a" class="form-label">Option A</label>
                <input type="text" name="a" id="a" class="w-full px-5 py-2 rounded border bg-gray-50" value="<?= $editQuestion["a"] ?>">
              </div>

              <div class="mb-3">
                <label for="b" class="form-label">Option B</label>
                <input type="text" name="b" id="b" class="w-full px-5 py-2 rounded border bg-gray-50" value="<?= $editQuestion["b"] ?>">
              </div>

              <div class="mb-3">
                <label for="" id="c" class="form-label">Option C</label>
                <input type="text" name="c" class="w-full px-5 py-2 rounded border bg-gray-50" id="c" value="<?= $editQuestion["c"] ?>">
              </div>

              <div class="mb-3">
                <label for="d" class="form-label">Option D</label>
                <input type="text" name="d" id="d" class="w-full px-5 py-2 rounded border bg-gray-50" value="<?= $editQuestion["d"] ?>">
              </div>

              <div class="col-span-4 bg-gray-50">
                <div class="row mb-3 bg-light border py-3 rounded">
                  <div class="col-12">
                    <p class="text-center fw-bold">Answer</p>
                  </div>

                  <div class="flex justify-center gap-10 mt-5 mb-5">
                    <div>
                      <input type="radio" value="a" id="answerA" name="answer" class="form-check-input" <?php if ($editQuestion["answer"] == $editQuestion["a"]) : ?> checked <?php endif; ?>>
                      <label for="answerA">A</label>
                    </div>
                    <div>
                      <input type="radio" value="b" id="answerB" name="answer" class="form-check-input" <?php if ($editQuestion["answer"] == $editQuestion["b"]) : ?> checked <?php endif; ?>>
                      <label for="answerB">B</label>
                    </div>
                    <div>
                      <input type="radio" value="c" id="answerC" name="answer" class="form-check-input" <?php if ($editQuestion["answer"] == $editQuestion["c"]) : ?> checked <?php endif; ?>>
                      <label for="answerC">C</label>
                    </div>
                    <div>
                      <input type="radio" value="d" id="answerD" name="answer" class="form-check-input" <?php if ($editQuestion["answer"] == $editQuestion["d"]) : ?> checked <?php endif; ?>>
                      <label for="answerD">D</label>
                    </div>
                  </div>

                </div>
              </div>

              <div class="col-span-4 text-center">
                <hr>
                <a href="./show.php?id=<?= $_GET['id'] ?>" class="px-5 py-2 rounded bg-red-500 text-white my-5">Cancel</a>
                <button name="updateQuestion" class="px-5 py-2 rounded bg-purple-500 text-white my-5">Update</button>
              </div>
            </div>
          </form>

        <?php else : ?>
          <form action="" method="POST">
            <div class="grid grid-cols-4 gap-5 bg-white p-5 rounded shadow">

              <div class="mb-3 col-span-4">
                <label for="question" class="block font-semibold">Question</label>
                <input type="text" name="question" class="w-full px-5 py-2 rounded border bg-gray-50" id="question">
              </div>

              <div class="mb-3">
                <label for="a" class="form-label">Option A</label>
                <input type="text" name="a" id="a" class="w-full px-5 py-2 rounded border bg-gray-50">
              </div>

              <div class="mb-3">
                <label for="b" class="form-label">Option B</label>
                <input type="text" name="b" id="b" class="w-full px-5 py-2 rounded border bg-gray-50">
              </div>

              <div class="mb-3">
                <label for="" id="c" class="form-label">Option C</label>
                <input type="text" name="c" class="w-full px-5 py-2 rounded border bg-gray-50" id="c">
              </div>

              <div class="mb-3">
                <label for="d" class="form-label">Option D</label>
                <input type="text" name="d" id="d" class="w-full px-5 py-2 rounded border bg-gray-50">
              </div>

              <div class="col-span-4 bg-gray-50">
                <div class="row mb-3 bg-light border py-3 rounded">
                  <div class="col-12">
                    <p class="text-center fw-bold">Answer</p>
                  </div>

                  <div class="flex justify-center gap-10 mt-5 mb-5">
                    <div>
                      <input type="radio" value="a" id="answerA" name="answer" class="form-check-input">
                      <label for="answerA">A</label>
                    </div>
                    <div>
                      <input type="radio" value="b" id="answerB" name="answer" class="form-check-input">
                      <label for="answerB">B</label>
                    </div>
                    <div>
                      <input type="radio" value="c" id="answerC" name="answer" class="form-check-input">
                      <label for="answerC">C</label>
                    </div>
                    <div>
                      <input type="radio" value="d" id="answerD" name="answer" class="form-check-input">
                      <label for="answerD">D</label>
                    </div>
                  </div>

                </div>
              </div>

              <div class="col-span-4 text-center">
                <hr>
                <button name="submitQuestion" class="px-5 py-2 rounded bg-purple-500 text-white my-5">Submit</button>
              </div>
            </div>
          </form>
        <?php endif; ?>

        <?php foreach ($questions as $index => $question) : ?>
          <div class="bg-white shadow p-5 mb-3 rounded relative overflow-hidden">

            <div class="absolute top-0 right-0 py-3 rounded-bl">
              <a href="./show.php?id=<?= $course["id"] ?>&editedId=<?= $question["id"] ?>" class="bg-cyan-500 text-white px-5 py-3">
                <i class="fa-solid fa-pen-to-square"></i>
              </a>
              <a href="./show.php?id=<?= $course["id"] ?>&deletedId=<?= $question["id"] ?>" class="bg-red-500 text-white px-5 py-3 mt-3">
                <i class="fa-solid fa-trash"></i>
              </a>
            </div>

            <span class="text-purple-500 font-semibold block">Question No. <?= $index + 1 ?> :</span>
            <?= $question["question"] ?>
            <ul style="list-style: upper-alpha;" class="pl-5 mt-3">
              <li><?= $question["a"] ?></li>
              <li><?= $question["b"] ?></li>
              <li><?= $question["c"] ?></li>
              <li><?= $question["d"] ?></li>
            </ul>
          </div>
        <?php endforeach; ?>
      </section>
    </div>
  </main>


  <section id="modalOptionExport" class="hidden fixed inset-0 bg-black/80 items-center justify-center" onclick="toggleModalSelectOptionExport()" style="position: fixed; background-color: rgba(0,0,0,0.5);">
    <div class="bg-white p-5 rounded shadow">
      <h4 class="text-center mb-4 flex justify-center gap-3 items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
        </svg>
        Select Export
      </h4>
      <div class="flex gap-20" style="gap: 10px;">
        <a target="_blank" href="./../../../backend/export/exportQuestions.php?id=<?= $_GET['id'] ?>" class="border border-purple-500 hover:bg-purple-500 px-3 py-2 rounded text-purple-500 hover:text-white text-sm">
          Export Questions
        </a>
        <a target="_blank" href="./../../../backend/export/exportUserScore.php?id=<?= $_GET['id'] ?>" class="border border-purple-500 hover:bg-purple-500 px-3 py-2 rounded text-purple-500 hover:text-white text-sm">
          Export Data Score
        </a>
      </div>
    </div>
  </section>


  <script src="https://kit.fontawesome.com/4b990370bb.js" crossorigin="anonymous"></script>
  <script>
    const toggleShow = () => {
      const questionSection = document.getElementById("questions")
      questionSection.classList.toggle("hidden")

      document.getElementById("usersScore").classList.toggle("hidden")

      const buttonToggle = document.getElementById("buttonToggle")
      questionSection.classList.contains("hidden") ? buttonToggle.innerHTML = "See Questions" : buttonToggle.innerHTML = "See User Score"
    }

    const toggleModalSelectOptionExport = () => {
      const modalOptionExport = document.getElementById("modalOptionExport")
      modalOptionExport.classList.toggle("hidden")
      modalOptionExport.classList.toggle("flex")
    }
  </script>
</body>

</html>