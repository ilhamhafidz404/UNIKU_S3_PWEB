<?php
require "./../../backend/connection.php";

session_start();
if (!isset($_SESSION["id"]) && !isset($_SESSION["username"]) && !isset($_SESSION["role"])) {
  header("Location: ./../login.php");
}


$userCount = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM accounts WHERE role='user'"));
$courseCount = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM courses"));
$questionCount = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM questions"));
$answerCount = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM answers"));


$usersCountPerMonth = array_fill_keys(
  ["january", "february", "march", "april", "mey", "june", "july", "august", "september", "october", "november", "desember"],
  0
);

$accounts = mysqli_query($connect, "SELECT * FROM accounts ORDER BY id DESC");
$newestAccounts = mysqli_query($connect, "SELECT * FROM accounts ORDER BY id DESC LIMIT 5");
$newestCourses = mysqli_query($connect, "SELECT * FROM courses ORDER BY id DESC LIMIT 5");

foreach ($accounts as $account) {
  $month = substr($account["date"], 5, 2);

  $monthName = date("F", mktime(0, 0, 0, $month, 1));
  $usersCountPerMonth[strtolower($monthName)]++;
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <link rel="stylesheet" href="./../../src/style.css">
</head>

<body class="bg-gray-100">

  <main class="grid grid-cols-12 px-20 gap-10 mt-10">
    <div class="col-span-3">
      <div class="bg-white rounded overflow-hidden shadow">
        <div class="p-5">
          <span class="flex items-center gap-3">
            <img src="./../../images/logo.png" class="w-[40px]">
            <h1>ALOPE QUIZ</h1>
          </span>
          <hr class="my-5">
          <ul>
            <li class="mb-5">
              <a href="./index.php" class="flex gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 text-red-500">
                  <path fill-rule="evenodd" d="M12.963 2.286a.75.75 0 0 0-1.071-.136 9.742 9.742 0 0 0-3.539 6.176 7.547 7.547 0 0 1-1.705-1.715.75.75 0 0 0-1.152-.082A9 9 0 1 0 15.68 4.534a7.46 7.46 0 0 1-2.717-2.248ZM15.75 14.25a3.75 3.75 0 1 1-7.313-1.172c.628.465 1.35.81 2.133 1a5.99 5.99 0 0 1 1.925-3.546 3.75 3.75 0 0 1 3.255 3.718Z" clip-rule="evenodd" />
                </svg>
                Dashboard
              </a>
            </li>
            <li class="mb-5">
              <a href="./user.php" class="flex gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 text-indigo-500">
                  <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                </svg>
                User
              </a>
            </li>
            <li>
              <a href="./courses/index.php" class="flex gap-3">
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
      </div>
    </div>
    <div class="col-span-9">
      <div class="grid grid-cols-4 gap-5">
        <div class="bg-white rounded shadow relative overflow-hidden">
          <div class="p-3">
            <small class="text-gray-800">Total User</small>
            <p class="text-2xl font-bold"><?= $userCount ?></p>
          </div>
          <span class="absolute bottom-[13px] right-[-24px]">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-24 text-indigo-500">
              <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
            </svg>
          </span>
          <div class="bg-indigo-500 text-sm py-2 px-2 text-white">
            <a href="" class="flex items-center gap-1 hover:gap-5 transition-all">
              See Data
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4">
                <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
              </svg>
            </a>
          </div>
        </div>
        <div class="bg-white rounded shadow relative overflow-hidden">
          <div class="p-3">
            <small class="text-gray-800">Active User</small>
            <p class="text-2xl font-bold"><?= $userCount ?></p>
          </div>
          <span class="absolute bottom-[13px] right-[-24px]">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-24 text-emerald-500">
              <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
            </svg>

          </span>
          <div class="bg-emerald-500 text-sm py-2 px-2 text-white">
            <p class="flex items-center gap-1 hover:gap-5 transition-all">
              See Data
            </p>
          </div>
        </div>
        <div class="bg-white rounded shadow relative overflow-hidden">
          <div class="p-3">
            <small class="text-gray-800">Total Course</small>
            <p class="text-2xl font-bold"><?= $courseCount ?></p>
          </div>
          <span class="absolute bottom-[13px] right-[-24px]">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-24 text-purple-500">
              <path fill-rule="evenodd" d="M6 3a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3H6Zm1.5 1.5a.75.75 0 0 0-.75.75V16.5a.75.75 0 0 0 1.085.67L12 15.089l4.165 2.083a.75.75 0 0 0 1.085-.671V5.25a.75.75 0 0 0-.75-.75h-9Z" clip-rule="evenodd" />
            </svg>
          </span>
          <div class="bg-purple-500 text-sm py-2 px-2 text-white">
            <a href="./courses/index.php" class="flex items-center gap-1 hover:gap-5 transition-all">
              See Data
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4">
                <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
              </svg>
            </a>
          </div>
        </div>
        <div class="bg-white rounded shadow relative overflow-hidden">
          <div class="p-3">
            <small class="text-gray-800">Total Question</small>
            <p class="text-2xl font-bold"><?= $questionCount ?></p>
          </div>
          <span class="absolute bottom-[13px] right-[-24px]">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-24 text-yellow-500">
              <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm11.378-3.917c-.89-.777-2.366-.777-3.255 0a.75.75 0 0 1-.988-1.129c1.454-1.272 3.776-1.272 5.23 0 1.513 1.324 1.513 3.518 0 4.842a3.75 3.75 0 0 1-.837.552c-.676.328-1.028.774-1.028 1.152v.75a.75.75 0 0 1-1.5 0v-.75c0-1.279 1.06-2.107 1.875-2.502.182-.088.351-.199.503-.331.83-.727.83-1.857 0-2.584ZM12 18a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
            </svg>

          </span>
          <div class="bg-yellow-500 text-sm py-2 px-2 text-white">
            <a href="./courses/index.php" class="flex items-center gap-1 hover:gap-5 transition-all">
              See Data
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4">
                <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
              </svg>
            </a>
          </div>
        </div>
        <div class="bg-white col-span-2 p-5 rounded">
          <h4 class="mb-2 font-semibold">Newest Accounts</h4>
          <table class="w-full">
            <tr class="bg-indigo-500 text-white">
              <th class="py-2">#</th>
              <td class="font-semibold">Username</td>
              <td class="font-semibold">Name</td>
            </tr>
            <?php foreach ($newestAccounts as $index => $account) : ?>
              <tr class="<?php if ($index % 2) : ?> bg-gray-100 <?php endif ?>">
                <td class="px-2 py-1"><?= $index + 1 ?></td>
                <td><?= $account["username"] ?></td>
                <td><?= $account["name"] ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
        <div class="bg-white col-span-2 p-5 rounded">
          <h4 class="mb-2 font-semibold">Newest Courses</h4>
          <table class="w-full">
            <tr class="bg-purple-500 text-white">
              <th class="py-2">#</th>
              <td class="font-semibold">Name</td>
            </tr>
            <?php foreach ($newestCourses as $index => $course) : ?>
              <tr class="<?php if ($index % 2) : ?> bg-gray-100 <?php endif ?>">
                <td class="px-2 py-1"><?= $index + 1 ?></td>
                <td><?= $course["name"] ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
        <section class="col-span-4 bg-white p-5 rounded shadow-md">
          <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </section>
      </div>
    </div>
  </main>


  <script src="https://kit.fontawesome.com/4b990370bb.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://cdn.canvasjs.com/ga/canvasjs.min.js"></script>

  <script>
    window.onload = function() {

      var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title: {
          text: "users every month"
        },
        data: [{
          type: "column",
          dataPoints: [{
              y: <?= $usersCountPerMonth["january"]  ?>,
              label: "Januari"
            },
            {
              y: <?= $usersCountPerMonth["february"]  ?>,
              label: "Februari"
            },
            {
              y: <?= $usersCountPerMonth["march"]  ?>,
              label: "Maret"
            },
            {
              y: <?= $usersCountPerMonth["april"]  ?>,
              label: "April"
            },
            {
              y: <?= $usersCountPerMonth["mey"]  ?>,
              label: "Mei"
            },
            {
              y: <?= $usersCountPerMonth["june"]  ?>,
              label: "Juni"
            },
            {
              y: <?= $usersCountPerMonth["july"]  ?>,
              label: "Juli"
            },
            {
              y: <?= $usersCountPerMonth["august"]  ?>,
              label: "Agustus"
            },
            {
              y: <?= $usersCountPerMonth["september"]  ?>,
              label: "September"
            },
            {
              y: <?= $usersCountPerMonth["october"]  ?>,
              label: "Oktober"
            },
            {
              y: <?= $usersCountPerMonth["november"]  ?>,
              label: "November"
            },
            {
              y: <?= $usersCountPerMonth["desember"]  ?>,
              label: "Desember"
            }
          ]
        }]
      });
      chart.render();

    }
  </script>
</body>

</html>