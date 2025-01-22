<?php

// Get the email and password from the form
$_POST ["email"];
$_POST["password"];

  // Check if the user is an admin
  if ($_POST["email"] == "vincetzy@gmail.com" && $_POST["password"] == "qwerty") {

    header("Location: ../../admininterface/admin.html");
    exit();
  } else {
      // User is not an admin, display an error message
      echo "Invalid email or password";
    }

?>