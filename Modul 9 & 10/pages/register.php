<?
session_start();
if (isset($_SESSION["id"]) && isset($_SESSION["username"]) && isset($_SESSION["role"])) {
  if ($_SESSION["role"] == "admin") {
    header("Location: ./admin/index.php");
  } else {
    header("Location: ./../index.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="./../src/style.css">
</head>

<body>

  <section class="grid grid-cols-2 min-h-screen">
    <div class="relative">
      <img src="./../images/bgLogin.jpg" class="w-full h-full object-cover">
      <div class="absolute inset-0 bg-black/40"></div>
      <div class="absolute bottom-[50px] left-0 pl-10 py-5 border-l-[5px] bg-black/60 border-indigo-500 max-w-[500px]">
        <h2 class="text-2xl font-semibold text-white">ALOPE QUIZ APP</h2>
        <p class="text-gray-200 text-sm mt-2">
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum debitis minus inventore! Id quibusdam animi ipsam sunt, perspiciatis iure veniam quae porro ipsum rem iste architecto. Sequi ab a voluptas!
        </p>
      </div>
    </div>

    <div class="bg-white flex items-center justify-center relative">

      <div class="w-[80%] text-center">

        <img src="./../images/logo.png" width="50px" class="mx-auto mb-2">
        <h1 class="text-2xl font-semibold mb-10">REGISTER ALOPE QUIZ</h1>

        <form action="./../backend/register.php" method="POST">
          <div class="grid grid-cols-2 gap-5">
            <div class="relative">
              <input type="text" id="name" name="name" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer border" placeholder=" " />
              <label for="name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                Name
              </label>
            </div>
            <div class="relative">
              <input type="text" id="username" name="username" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer border" placeholder=" " />
              <label for="username" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                Username
              </label>
            </div>
            <div class="relative">
              <div class="relative">
                <input type="password" id="password" name="password" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer border" placeholder=" " />
                <label for="password" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                  Password
                </label>
              </div>
            </div>
            <div class="relative">
              <div class="relative">
                <input type="password" id="password_confirm" name="confirm_password" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer border" placeholder=" " />
                <label for="password_confirm" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                  Confirm Password
                </label>
              </div>
            </div>
          </div>

          <div class="mt-16 grid grid-cols-5 gap-3">
            <button name="submit" class="col-span-4 bg-indigo-500 hover:bg-indigo-400 w-full py-2 rounded-md text-white">Registrasi</button>
            <button type="reset" class="border border-red-500 hover:bg-red-400 w-full py-2 rounded-md hover:text-white text-red-500">
              Reset
            </button>
          </div>
        </form>

        <div class="my-10 relative">
          <hr class="border-gray-300">
          <span class="text-sm bg-white text-gray-600 px-3 absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2">Sudah punya akun?</span>
        </div>

        <a href="./login.php" class="border-2 border-indigo-500 hover:bg-indigo-500 w-full block py-2 rounded-md text-indigo-500 hover:text-white">Login</a>

        <footer class="absolute bottom-[25px] text-sm text-gray-600 text-center w-full left-0">
          Copyright &copy; 2023
        </footer>
      </div>
    </div>


  </section>

</body>

</html>