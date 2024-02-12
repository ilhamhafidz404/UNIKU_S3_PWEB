<?php

// fungsi untuk mengambil data user
function UserIndex($connect)
{
  $users = mysqli_query($connect, "SELECT * FROM accounts"); // query ambil data user (data usernya terdapat pada tabel accounts)

  return $users;
}

// fungsi untuk mengambil data user sesuai id
function UserShow($connect, $id)
{
  $user = mysqli_query($connect, "SELECT * FROM accounts WHERE id=$id");

  return $user;
}

// fungsi update data user
function UserUpdate($connect)
{
  extract($_POST);

  $id = $_SESSION["id"];

  mysqli_query($connect, "UPDATE accounts SET username='$username', name='$name', password='$password' WHERE id= $id");

  header("Location: ./profile.php");
}
