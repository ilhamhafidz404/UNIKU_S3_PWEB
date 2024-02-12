<?php
require "./../../backend/connection.php";
require "./../../backend/User.php";

session_start(); //memulai session

// jika tidak ada session id, username dan role (belum login) maka kembalikan ke login.php
if (!isset($_SESSION["id"]) && !isset($_SESSION["username"]) && !isset($_SESSION["role"])) {
  header("Location: ./pages/login.php");
}

// menjalankan fungsi userShow
$users = UserShow($connect, $_SESSION["id"]);

// jika terdapat request post avatar maka update accounts avatarnya
if (isset($_POST["avatar"])) {
  $profile = $_POST["avatar"];
  $id = $_SESSION["id"];

  mysqli_query($connect, "UPDATE accounts SET profile='$profile' WHERE id=$id");

  header("Location: ./profile.php");
}

// jika ada request update, maka jalankan user update
if (isset($_POST["update"])) {
  UserUpdate($connect);
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile</title>
  <!-- <link rel="stylesheet" href="./../../src/style.css"> -->
  <!-- <link rel="stylesheet" href="./../../src/css/bootstrap.min.css"> -->
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
          <span class="bg-indigo-500 w-[40px] h-[40px] inline-flex items-center justify-center text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6">
              <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
            </svg>
          </span>
          PROFILE
        </h2>
      </div>

      <!--  -->
      <?php foreach ($users as $user) : ?>
        <section class="grid grid-cols-2 gap-10">
          <div>
            <div class="bg-white p-5 rounded shadow text-center">
              <img src="./../../images/profiles/<?= $user["profile"] ?>" class="w-[150px] h-[150px] object-cover mx-auto mb-3">
              <h3 class="font-semibold text-3xl"><?= $user["name"] ?></h3>
              <small class="text-base -mt-5 text-gray-800 italic"><?= $user["username"] ?></small>
              <button onclick="toggleEditAccount()" class="w-full bg-indigo-500 py-2 rounded text-white hover:bg-indigo-400 mt-10 text-sm">EDIT ACCOUNT</button>
              <button class="w-full border border-red-500 py-2 rounded text-red-500 hover:bg-red-500 hover:text-white mt-3 text-sm">DELETE ACCOUNT</button>
            </div>
          </div>

          <div id="changeAvatar">
            <form action="" method="POST">
              <div class="grid grid-cols-3 bg-white py-5 rounded">
                <div class="col-span-3 text-center">
                  <h5 class="mb-10 font-semibold">CHANGE AVATAR</h5>
                </div>
                <div class="text-center mb-5">
                  <label class="mb-4" for="avatar1">
                    <img src="./../../images/profiles/avatar1.png" class="w-[100px] h-[100px] object-cover mx-auto">
                  </label>
                  <input type="radio" name="avatar" value="avatar1.png" id="avatar1">
                </div>
                <div class="text-center mb-5">
                  <label class="mb-4" for="avatar2">
                    <img src="./../../images/profiles/avatar2.png" class="w-[100px] h-[100px] object-cover mx-auto">
                  </label>
                  <input type="radio" name="avatar" value="avatar2.png" id="avatar2">
                </div>
                <div class="text-center mb-5">
                  <label class="mb-4" for="avatar3">
                    <img src="./../../images/profiles/avatar3.png" class="w-[100px] h-[100px] object-cover mx-auto">
                  </label>
                  <input type="radio" name="avatar" value="avatar3.png" id="avatar3">
                </div>
                <div class="text-center mb-5">
                  <label class="mb-4" for="avatar4">
                    <img src="./../../images/profiles/avatar4.png" class="w-[100px] h-[100px] object-cover mx-auto">
                  </label>
                  <input type="radio" name="avatar" value="avatar4.png" id="avatar4">
                </div>
                <div class="text-center mb-5">
                  <label class="mb-4" for="avatar5">
                    <img src="./../../images/profiles/avatar5.png" class="w-[100px] h-[100px] object-cover mx-auto">
                  </label>
                  <input type="radio" name="avatar" value="avatar5.png" id="avatar5">
                </div>
                <div class="text-center mb-5">
                  <label class="mb-4" for="avatar6">
                    <img src="./../../images/profiles/avatar6.png" class="w-[100px] h-[100px] object-cover mx-auto">
                  </label>
                  <input type="radio" name="avatar" value="avatar6.png" id="avatar6">
                </div>
                <div type="submit" name="change" class="col-span-3 mt-10 px-10">
                  <button class="bg-indigo-500 text-white w-full rounded py-2 hover:bg-indigo-400">
                    CHANGE
                  </button>
                </div>
              </div>
            </form>
          </div>

          <div id="editAccount" class="hidden">
            <div class="bg-white p-5 rounded shadow">
              <form action="" method="POST">
                <div class="mb-3">
                  <label for="" class="font-semibold">Name</label>
                  <input type="text" name="name" class="bg-gray-50 border px-3 py-2 rounded w-full" value="<?= $user["name"] ?>">
                </div>
                <div class="mb-3">
                  <label for="" class="font-semibold">Username</label>
                  <input type="text" name="username" class="bg-gray-50 border px-3 py-2 rounded w-full" value="<?= $user["username"] ?>">
                </div>
                <div class="mb-3">
                  <label for="" class="font-semibold">Password</label>
                  <input type="password" name="password" class="bg-gray-50 border px-3 py-2 rounded w-full" value=<?= $user["password"] ?>>
                </div>
                <!-- <div class="mb-3">
                <label for="" class="font-semibold">Confirm New Password</label>
                <input type="text" class="bg-gray-50 border px-3 py-2 rounded w-full">
              </div> -->
                <div class="grid grid-cols-3 gap-5 mt-10">
                  <button type="button" class="bg-red-500 text-white py-2 rounded hover:bg-red-400">CANCEL</button>
                  <button type="submit" name="update" class="col-span-2 bg-indigo-500 text-white py-2 rounded hover:bg-indigo-400">UPDATE</button>
                </div>
              </form>
            </div>
          </div>
        </section>
      <?php endforeach; ?>

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