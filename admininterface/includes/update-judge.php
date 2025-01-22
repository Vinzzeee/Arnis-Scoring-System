<?php

include("../../login/includes/dbh-inc.php");

if (isset($_POST['savebtn'])) {
  $id = $_POST['id'];
  $role = $_POST['role'];
  $firstname = $_POST['firstname'];
  $middlename = $_POST['middlename'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $age = $_POST['age'];
  $street_name = $_POST['street_name'];
  $barangay = $_POST['barangay'];
  $contact_number = $_POST['contact_number'];
  

  // Update the user information in the database
  $sql = "UPDATE users SET role='$role', firstname='$firstname', middlename='$middlename', lastname='$lastname', email='$email', age='$age', street_name='$street_name', barangay='$barangay', contact_number='$contact_number' WHERE id='$id'";
  if (mysqli_query($conn, $sql)) {
   // Show a spinner while redirecting to the user list page
   echo '<div id="spinner" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
   <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
   <span class="sr-only">Saving Changes...</span>
</div>';

// Redirect back to the user list page after a delay and scroll down to table
echo '<script type="text/javascript">
   setTimeout(function() {
       window.location.href = "../../memberinformation/memberinfo.php#table1";
   }, 700);
</script>';
} else {
// Show an error message in a modal
echo '<script type="text/javascript">
   alert("Error saving changes");
</script>';
}
}
mysqli_close($conn);
?>