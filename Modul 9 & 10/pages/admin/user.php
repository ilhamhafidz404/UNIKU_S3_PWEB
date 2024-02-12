<?php
require "./../../backend/connection.php";
require "./../../backend/User.php";

session_start(); // memulai sessiun

// jika tidak ada session id, username dan role (belum login) maka kembalikan ke login.php
if (!isset($_SESSION["id"]) && !isset($_SESSION["username"]) && !isset($_SESSION["role"])) {
  header("Location: ./pages/login.php");
}

// menjalankan fungsi userIndex
$users = UserIndex($connect);

// jika ada method get untuk deletedId maka jalankan query untuk delete data
if (isset($_GET["deletedId"])) {
  $id = $_GET["deletedId"];
  mysqli_query($connect, "DELETE FROM accounts WHERE id=$id");

  header("Location: ./user.php");
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User</title>
  <link rel="stylesheet" href="./../../src/style.css">
  <link rel="stylesheet" href="./../../src/fontawesome/css/all.css">
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
      </section>
    </div>
    <div class="col-span-9">
      <div class="flex items-center justify-between mb-10">
        <h2 class="text-3xl font-semibold">
          <span class="bg-indigo-500 w-[40px] h-[40px] inline-flex items-center justify-center text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6">
              <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
            </svg>
          </span>
          User
        </h2>
      </div>

      <div class="bg-white">
        <table class="w-full border">
          <tr class="bg-indigo-500 text-white">
            <th class="py-3 ">No</th>
            <th>Profile</th>
            <th>Name</th>
            <th>Username</th>
            <th>Password</th>
            <th>Action</th>
          </tr>
          <?php foreach ($users as $index => $user) : ?>
            <tr <?php if ($index % 2 == 0) : ?> class="bg-gray-100" <?php endif; ?>>
              <th class="py-5 "><?= $index + 1 ?></th>
              <td>
                <img src="./../../images/profiles/<?= $user["profile"] ?>" class="w-[50px] h-[50px] object-cover mx-auto" width="50" height="50">
              </td>
              <td>
                <?= $user["name"] ?>
              </td>
              <td>
                <?= $user["username"] ?>
              </td>
              <td>
                <?= $user["password"] ?>
              </td>
              <td>
                <div class="text-center">
                  <a href="./user.php?deletedId=<?= $user["id"] ?>" class="bg-red-500 text-white px-3 py-2 rounded text-sm hover:bg-red-400">Delete</a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>

    </div>
  </main>

  <script>
    const toggleEditAccount = () => {
      document.getElementById("editAccount").classList.toggle("hidden");
      document.getElementById("changeAvatar").classList.toggle("hidden");
    }
  </script>
</body>

</html>