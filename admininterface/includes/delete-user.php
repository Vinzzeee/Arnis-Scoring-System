<?php
session_start();

include("../../login/includes/dbh-inc.php");

// Get the user ID from the URL parameter
$id = $_GET["id"];

// Delete the user from the database
$sql = "DELETE FROM users WHERE id = '$id'";
if (mysqli_query($conn, $sql)) {

  // Show a spinner while redirecting to the user list page
  echo '<div id="spinner" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
  <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
  <span class="sr-only">Deleting...</span>
</div>';

// Redirect back to the user list page after a delay and scroll down to table
echo '<script type="text/javascript">
  setTimeout(function() {
      window.location.href = "../../memberinformation/memberinfo.php#table2";
  }, 700);
</script>';
} else {
// Show an error message in a modal
echo '<script type="text/javascript">
  alert("Error deleting user");
</script>';
}
mysqli_close($conn);
?>