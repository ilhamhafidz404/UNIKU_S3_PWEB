/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./pages/login.php",
    "./pages/register.php",
    "./pages/admin/index.php",
    "./pages/admin/user.php",
    "./pages/admin/courses/show.php",
    "./pages/admin/courses/index.php",
    "./pages/admin/courses/add.php",
    "./pages/admin/courses/edit.php",
    "./pages/user/quiz.php",
    "./pages/user/profile.php",
    "./index.php",
  ],
  theme: {
    extend: {},
  },
  darkMode: "class",
};
