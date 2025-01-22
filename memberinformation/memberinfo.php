<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" type="text/css" href="main.css" />
  </head>
  <body>
    <!-- ------------------------------NAVBAR---------------------- --->
    <nav class="navbar bg-body-tertiary fixed-top d-flex">
      <div class="container-fluid d-flex justify-content-between">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasNavbar"
          aria-controls="offcanvasNavbar"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="../admininterface/admin.html"
          ><img class="bastonlogo" src="img/logo.png" alt=""
        /></a>
        <div></div>
        <div
          class="offcanvas offcanvas-start"
          tabindex="-1"
          id="offcanvasNavbar"
          aria-labelledby="offcanvasNavbarLabel"
        >
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
              Welcome Admin
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="offcanvas"
              aria-label="Close"
            ></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="../admininterface/admin.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Settings</a>
              </li>
            </ul>
            <a id="logOut" class="btn link btn-danger mt-5 px-5" name="logout"  href="../Login/login.html">
              Log Out
            </a>
          </div>
        </div>
      </div>
    </nav>
    <!-- ------------------------------NAVBAR---------------------- --->
    <!-- ------------------------------ADMIN PANEL---------------------- --->

    <div
      style="max-width: 50rem"
      class="container bg-body-tertiary mt-5 p-5 rounded text-center"
      id="table1"
    >
      <h1>Members</h1>
      <div class="input-group input-group-sm mb-3 w-50" >
  <input type="text" class="form-control" placeholder="Search" id="search-input1">
  <button class="btn btn-outline-secondary" type="button" onclick="searchTable1()">Search</button>
</div>

<div class="container-fluid">
  <div class="accordion mb-2" id="accordionFlush">
      
  <?php 
      include("../login/includes/dbh-inc.php");

      // Set the number of results to display per page
      $results_per_page = 4;

      // Get the total number of results
      $sql = "SELECT COUNT(*) FROM users WHERE status='approved'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_row($result);
      $total_results = $row[0];

      // Calculate the total number of pages
      $total_pages = ceil($total_results / $results_per_page);

      // Get the current page number, or default to 1 if none is specified
      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

      // Calculate the starting index of the results for the current page
      $start_index = ($current_page - 1) * $results_per_page;

      // Query the database to get a list of all unapproved users for the current page
      $sql = "SELECT * FROM users WHERE status='approved' LIMIT $start_index, $results_per_page";
      $result = mysqli_query($conn, $sql);

      // Start a table to display the user information
      echo "<table id='approved-table'>";
      echo "<tr><th>Role</th><th>Name</th><th>Gender</th><th>Barangay</th><th>Document</th><th>Action</th></tr>";
    
      // Loop through the results and display the user information
      while ($row = mysqli_fetch_assoc($result)) {
         // Retrieve the user's role from the session or request
$role = $row['role'];

// Retrieve the user's ID from the database query
$user_id = $row['id'];


        if ($role == "(PLAYER)") {
        
          echo "<tr class='player-row'>" ;
          echo "<td>" . $row["role"] . "</td>";
          echo "<td>" . $row["firstname"] . " " . $row["middlename"] . " " . $row["lastname"] .  "</td>";
          echo "<td>" . $row["gender"] . "</td>";
          echo "<td>" . $row["barangay"] . "</td>";
  
          // Check if the attachment exists
          if (!empty($row["attachment"])) {
            echo "<td><a href=\"../../uploads/" . $row["attachment"] . "\">View Attachment</a></td>";
          } else {
            echo "<td>No Attachment</td>";
          }
  
          echo '<td>
          <div class="btn-group" role="group" aria-label="Action buttons">
            <button type="button" class="btn btn-sm btn-info mx-1" data-bs-toggle="modal" data-bs-target="#editModal' . $row["id"] . '">
              <i class="bi bi-pencil-square"></i>
            </button>
            <a href="../admininterface/includes/delete-member.php?id=' . $row["id"] . '"><button type="button" class="btn btn-sm btn-danger mx-1">
              <i class="bi bi-trash"></i>
            </button></a>
          </div>
        </td>';  
      }

      if ($role == "(JUDGE)") {
        
        echo "<tr class='judge-row'>";
        echo "<td>" . $row["role"] . "</td>";
        echo "<td>" . $row["firstname"] . " " . $row["middlename"] . " " . $row["lastname"] .  "</td>";
        echo "<td>" . $row["gender"] . "</td>";
        echo "<td>" . $row["barangay"] . "</td>";

        // Check if the attachment exists
        if (!empty($row["attachment"])) {
          echo "<td><a href=\"../../uploads/" . $row["attachment"] . "\">View Attachment</a></td>";
        } else {
          echo "<td>No Attachment</td>";
        }

        echo '<td>
        <div class="btn-group" role="group" aria-label="Action buttons">
          <button type="button" class="btn btn-sm btn-info mx-1" data-bs-toggle="modal" data-bs-target="#editModal' . $row["id"] . '">
            <i class="bi bi-pencil-square"></i>
          </button>
          <a href="../admininterface/includes/delete-member.php?id=' . $row["id"] . '"><button type="button" class="btn btn-sm btn-danger mx-1">
            <i class="bi bi-trash"></i>
          </button></a>
        </div>
      </td>';  
      }
  // Retrieve the user's role from the session or request
$role = $row['role'];

// Retrieve the user's ID from the database query
$user_id = $row['id'];

// Define the modal content based on the user's role
if ($role == "(PLAYER)") {
  $modal_content =  '<form method="post" action="../admininterface/includes/update-player.php">
  <input type="hidden" name="id" value="'. $row['id'] .'">
  <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label"
        >Role</label
      >
      <input
        type="text"
        class="form-control"
        id="exampleInputEmail1"
        aria-describedby="emailHelp"
        name="role"
        value="' . $row["role"] . '"
      />
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label"
        >First Name</label
      >
      <input
        type="text"
        class="form-control"
        id="exampleInputEmail1"
        aria-describedby="emailHelp"
        name="firstname"
        value="' . $row["firstname"] . '"
      />
    </div>
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label"
      >Middle Name</label
    >
    <input
      type="text"
      class="form-control"
      id="exampleInputEmail1"
      aria-describedby="emailHelp"
      name="middlename"
      value="' . $row["middlename"] . '"
    />
  </div> <div class="mb-3">
  <label for="exampleInputEmail1" class="form-label"
    >Last Name</label
  >
  <input
    type="text"
    class="form-control"
    id="exampleInputEmail1"
    aria-describedby="emailHelp"
    name="lastname"
    value="' . $row["lastname"] . '"
  />
</div>
<div class="mb-3">
<label for="exampleInputPassword1" class="form-label"
  >Email</label
>
<input
  type="text"
  class="form-control"
  id="exampleInputPassword1"
  name="email"
value="' . $row["email"] . '"
/>
</div> 
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label"
        >Age</label
      >
      <input
        type="number"
        class="form-control"
        id="exampleInputPassword1"
        name="age"
    value="' . $row["age"] . '"
      />
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label"
        >Height & Weight</label
      >
      <div class="input-group mb-3">
        <span
          class="input-group-text"
          id="inputGroup-sizing-default"
          >FT</span
        >
        <input
          type="text"
          class="form-control"
          aria-label="Sizing example input"
          aria-describedby="inputGroup-sizing-default"
          name="height"
    value="' . $row["height"] . '"
        />
        <span
          class="input-group-text"
          id="inputGroup-sizing-default"
          >KG</span
        >
        <input
          type="text"
          class="form-control"
          aria-label="Sizing example input"
          aria-describedby="inputGroup-sizing-default"
          name="weight"
    value="' . $row["weight"] . '"
        />
      </div>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label"
        >Address</label
      >
      <input
        type="text"
        class="form-control"
        id="exampleInputPassword1"
        name="street_name"
       value="' . $row["street_name"] . '"
      />
    </div>
    <div class="mb-3">
    <select
      id="selectGender"
      class="form-select form-select-md"
      aria-label="selectGender"
       name="barangay"
       value="' . $row["barangay"] . '"
    >
    <option selected>' . $row["barangay"] . '</option>
    <option value="Brgy. Bagonbon">Bagonbon</option>
    <option value="Brgy. Buluangan">Buluangan</option>
    <option value="Brgy. Codcod">Codcod</option>
    <option value="Brgy. Ermita(Sipaway)">Ermita (Sipaway)</option>
    <option value="Brgy. Guadalupe">Guadalupe</option>
    <option value="Brgy. Nataban">Nataban</option>
    <option value="Brgy. Palampas">Palampas</option>
    <option value="Brgy. 1">Barangay 1</option>
    <option value="Brgy. 2">Barangay 2</option>
    <option value="Brgy. 3">Barangay 3</option>
    <option value="Brgy. 4">Barangay 4</option>
    <option value="Brgy. 5">Barangay 5</option>
    <option value="Brgy. 6">Barangay 6</option>
    <option value="Brgy. Prosperidad">Prosperidad</option>
    <option value="Brgy. Punao">Punao</option>
    <option value="Brgy. Quezon">Quezon</option>
    <option value="Brgy. Rizal">Rizal</option>
    <option value="Brgy. San Juan(Sipaway)">San Juan (Sipaway)</option>
    </select>
  </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label"
        >Name of Mother
      </label>
      <input
        type="text"
        class="form-control"
        id="exampleInputPassword1"
        name="mother_name"
        value="' . $row["mother_name"] . '"
      />
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label"
        >Name of Father</label
      >
      <input
        type="text"
        class="form-control"
        id="exampleInputPassword1"
        name="father_name"
        value="' . $row["father_name"] . '"
      />
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label"
        >Guardian</label
      >
      <input
        type="text"
        class="form-control"
        id="exampleInputPassword1"
        name="legal_guardian"
        value="' . $row["legal_guardian"] . '"
      />
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label"
        >Contact #</label
      >
      <input
        type="number"
        class="form-control"
        id="exampleInputPassword1"
        name="contact_number"
        value="' . $row["contact_number"] . '"
      />
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label"
        >Contact# In Case of Emergency</label
      >
      <input
        type="number"
        class="form-control"
        id="exampleInputPassword1"
        name="parentguardian_contact_number"
        value="' . $row["parentguardian_contact_number"] . '"
      />
    </div>
    <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="savebtn">Save changes</button>
        </div>
    </form> '; 
    echo "<tr class='player-info-row'>
         <td colspan='6' style='font-size: 14px;'>
            Birthday: " . $row["birthday"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Age: " . $row["age"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Email: " . $row["email"] . " <br><br> 
            Contact #: " . $row["contact_number"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Height: " . $row["height"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Weight: " . $row["weight"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Weight Class: " . $row["weight_class"] . " <br><br> 
            Address: " . $row["street_name"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Guardian: " . $row["legal_guardian"] . " <br><br>        
            Father: " . $row["father_name"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Mother: " . $row["mother_name"] . " <br><br>              
            Parent/Guardian Contact#:  " . $row["parentguardian_contact_number"] . "  
         </td>
      </tr>";

} else if ($role == "(JUDGE)") {
  $modal_content = '<form method="post" action="../admininterface/includes/update-judge.php">
  <input type="hidden" name="id" value="'. $row['id'] .'">
  <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label"
        >Role</label
      >
      <input
        type="text"
        class="form-control"
        id="exampleInputEmail1"
        aria-describedby="emailHelp"
        name="role"
        value="' . $row["role"] . '"
      />
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label"
        >First Name</label
      >
      <input
        type="text"
        class="form-control"
        id="exampleInputEmail1"
        aria-describedby="emailHelp"
        name="firstname"
        value="' . $row["firstname"] . '"
      />
    </div>
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label"
      >Middle Name</label
    >
    <input
      type="text"
      class="form-control"
      id="exampleInputEmail1"
      aria-describedby="emailHelp"
      name="middlename"
      value="' . $row["middlename"] . '"
    />
  </div> <div class="mb-3">
  <label for="exampleInputEmail1" class="form-label"
    >Last Name</label
  >
  <input
    type="text"
    class="form-control"
    id="exampleInputEmail1"
    aria-describedby="emailHelp"
    name="lastname"
    value="' . $row["lastname"] . '"
  />
</div>
<div class="mb-3">
<label for="exampleInputPassword1" class="form-label"
  >Email</label
>
<input
  type="text"
  class="form-control"
  id="exampleInputPassword1"
  name="email"
value="' . $row["email"] . '"
/>
</div> 
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label"
        >Age</label
      >
      <input
        type="number"
        class="form-control"
        id="exampleInputPassword1"
        name="age"
    value="' . $row["age"] . '"
      />
    </div>     
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label"
        >Address</label
      >
      <input
        type="text"
        class="form-control"
        id="exampleInputPassword1"
        name="street_name"
       value="' . $row["street_name"] . '"
      />
    </div>
    <div class="mb-3">
    <select
      id="selectGender"
      class="form-select form-select-md"
      aria-label="selectGender"
       name="barangay"
       value="' . $row["barangay"] . '"
    >
    <option selected>' . $row["barangay"] . '</option>
    <option value="Brgy. Bagonbon">Bagonbon</option>
    <option value="Brgy. Buluangan">Buluangan</option>
    <option value="Brgy. Codcod">Codcod</option>
    <option value="Brgy. Ermita(Sipaway)">Ermita (Sipaway)</option>
    <option value="Brgy. Guadalupe">Guadalupe</option>
    <option value="Brgy. Nataban">Nataban</option>
    <option value="Brgy. Palampas">Palampas</option>
    <option value="Brgy. 1">Barangay 1</option>
    <option value="Brgy. 2">Barangay 2</option>
    <option value="Brgy. 3">Barangay 3</option>
    <option value="Brgy. 4">Barangay 4</option>
    <option value="Brgy. 5">Barangay 5</option>
    <option value="Brgy. 6">Barangay 6</option>
    <option value="Brgy. Prosperidad">Prosperidad</option>
    <option value="Brgy. Punao">Punao</option>
    <option value="Brgy. Quezon">Quezon</option>
    <option value="Brgy. Rizal">Rizal</option>
    <option value="Brgy. San Juan(Sipaway)">San Juan (Sipaway)</option>
    </select>
  </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label"
        >Contact #</label
      >
      <input
        type="number"
        class="form-control"
        id="exampleInputPassword1"
        name="contact_number"
        value="' . $row["contact_number"] . '"
      />
    </div>
    <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="savebtn">Save changes</button>
        </div>
     </form> ' ;

     echo "<tr class='judge-info-row'>
         <td colspan='6' style='font-size: 14px;'>
            Age: " . $row["age"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Email: " . $row["email"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Contact #: " . $row["contact_number"] . "  <br><br> 
            Address: " . $row["street_name"] . "
         </td>
      </tr>";

} 

echo "</tr>";

  //Modal
echo '<div class="modal fade" id="editModal' . $row["id"] . '" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content" style="text-align: left;">
  <div class="modal-header">
    <h5 class="modal-title" id="editModalLabel">Edit Information</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>      
   <div class="modal-body">
              ' . $modal_content . '
    </div>
  </div>
</div>';


echo "</tr>";

}

// Close the table and the database connection
echo "</table>";
echo '<p id="no-results1" style="display: none;">No results found.</p>';
mysqli_close($conn);

// Generate the pagination links
echo '<nav aria-label="Page navigation example">';
echo '<ul class="pagination pagination-sm justify-content-end">';

// Display the "Previous" link if the current page is not the first page
if ($current_page > 1) {
  echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '#table1">Previous</a></li>';
} else {
  echo '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
}

// Display the page links
for ($i = 1; $i <= $total_pages; $i++) {
  if ($i == $current_page) {
    echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
  } else {
    echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '#table1">' . $i . '</a></li>';
  }
}

// Display the "Next" link if the current page is not the last page
if ($current_page < $total_pages) {
  echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '#table1">Next</a></li>';
} else {
  echo '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
}

echo '</ul>';
echo '</nav>';

?>

<script>
  $(document).ready(function() {
    // Hide all user info rows initially
    $('.player-info-row').hide();
    $('.judge-info-row').hide();
    
    // Add click event listener to each user row
    $('.player-row').click(function() {
      // Get the next row, which is the user info row
      var userInfoRow = $(this).next('.player-info-row');
      
      // Toggle the visibility of the user info row
      userInfoRow.slideToggle();
    });
    $('.judge-row').click(function() {
      // Get the next row, which is the user info row
      var userInfoRow = $(this).next('.judge-info-row');
      
      // Toggle the visibility of the user info row
      userInfoRow.slideToggle();
    });
  });

  function searchTable1() {
    var input, filter, table, tr, td, i, txtValue, noResults;
    input = document.getElementById("search-input1");
    filter = input.value.toUpperCase();
    table = document.getElementById("approved-table");
    tr = table.getElementsByTagName("tr");
    noResults = document.getElementById("no-results1");

    var found = false; // set to true if any search results are found

    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1]; // Search by name column
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          found = true;
        } else {
          tr[i].style.display = "none";
        }
      }
    }

    if (!found) {
      noResults.style.display = "block";
    } else {
      noResults.style.display = "none";
    }
  }
</script>
      
    </div>
    </div>
    </div>
    <!----------------------------------------------------- PENDING USERS----------------------------------------------------------------------->
    <div
      style="max-width: 50rem"
      class="container bg-body-tertiary mt-5 p-5 rounded text-center"
      id="table2"
    >
      <h1>Pending Members</h1>
      <div class="input-group input-group-sm mb-3 w-50" >
  <input type="text" class="form-control" placeholder="Search" id="search-input2">
  <button class="btn btn-outline-secondary" type="button" onclick="searchTable2()">Search</button>
</div>

<div class="container-fluid">
  <div class="accordion mb-2" id="accordionFlush">
    <?php 
      include("../login/includes/dbh-inc.php");

      // Set the number of results to display per page
      $results_per_page = 7;

      // Get the total number of results
      $sql = "SELECT COUNT(*) FROM users WHERE status='pending'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_row($result);
      $total_results = $row[0];

      // Calculate the total number of pages
      $total_pages = ceil($total_results / $results_per_page);

      // Get the current page number, or default to 1 if none is specified
      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

      // Calculate the starting index of the results for the current page
      $start_index = ($current_page - 1) * $results_per_page;

      // Query the database to get a list of all unapproved users for the current page
      $sql = "SELECT * FROM users WHERE status='pending' LIMIT $start_index, $results_per_page";
      $result = mysqli_query($conn, $sql);

      // Start a table to display the user information
      echo "<table id='pending-table'>";
      echo "<tr><th>Role</th><th>Name</th><th>Gender</th><th>Barangay</th><th>Document</th><th>Action</th></tr>";

      // Loop through the results and display the user information
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["role"] . "</td>";
        echo "<td>" . $row["firstname"] . " " . $row["middlename"] . " " . $row["lastname"] .  "</td>";
        echo "<td>" . $row["gender"] . "</td>";
        echo "<td>" . $row["barangay"] . "</td>";

        // Check if the attachment exists
        if (!empty($row["attachment"])) {
          echo "<td><a href=\"../../uploads/" . $row["attachment"] . "\">View Attachment</a></td>";
        } else {
          echo "<td>No Attachment</td>";
        }

        echo '<td>
                <div class="btn-group" role="group" aria-label="Action buttons">
                  <a href="../admininterface/includes/approve-user.php?id=' . $row["id"] . '"><button type="button" class="btn btn-sm btn-success approve-button mx-1">
                    <i class="bi bi-check"></i>
                  </button></a>
                  <a href="../admininterface/includes/delete-user.php?id=' . $row["id"] . '"><button type="button" class="btn btn-sm btn-danger mx-1">
                    <i class="bi bi-trash"></i>
                  </button></a>
                </div>
              </td>';
        echo "</tr>";
        
      }

      // Close the table and the database connection
      echo "</table>";
      echo '<p id="no-results2" style="display: none;">No results found.</p>';

      mysqli_close($conn);

      // Generate the pagination links
      echo '<nav aria-label="Page navigation example">';
      echo '<ul class="pagination pagination-sm justify-content-end">';
      
      // Display the "Previous" link if the current page is not the first page
      if ($current_page > 1) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '#table2">Previous</a></li>';
      } else {
        echo '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
      }
      
      // Display the page links
      for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
          echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
        } else {
          echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '#table2">' . $i . '</a></li>';
        }
      }
      
      // Display the "Next" link if the current page is not the last page
      if ($current_page < $total_pages) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '#table2">Next</a></li>';
      } else {
        echo '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
      }
      
      echo '</ul>';
      echo '</nav>';

    ?>
    <script>
  function searchTable2() {
    var input, filter, table, tr, td, i, txtValue, noResults;
    input = document.getElementById("search-input2");
    filter = input.value.toUpperCase();
    table = document.getElementById("pending-table");
    tr = table.getElementsByTagName("tr");
    noResults = document.getElementById("no-results2");

    var found = false; // set to true if any search results are found

    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1]; // Search by name,barangay column
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          found = true;
        } else {
          tr[i].style.display = "none";
        }
      }
    }

    if (!found) {
      noResults.style.display = "block";
    } else {
      noResults.style.display = "none";
    }
  }
</script>

<style>
table {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid black;
}

th, td {
  text-align: left;
  padding: 8px;
  border-bottom: 1px solid black;
}

th {
  background-color: #f2f2f2;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

.button {
  display: inline-block;
  padding: 8px;
  border-radius: 4px;
  text-decoration: none;
  color: #fff;
  font-weight: bold;
}

.deny {
  background-color: #f44336;
}

.approve {
  background-color: #4CAF50;
}
</style>
        </div>
    </div>
    </div>
    </div>
    <!-- ------------------------------FOOTER---------------------- --->

    <!-- <div class="container-fluid p-3 text-center bg-body-tertiary fixed-bottom">© Copyright Baston 2023</div> -->
    <footer class="p-5">
      <div
        class="footer container-fluid p-3 mt-5 text-center bg-body-tertiary fixed-bottom"
      >
        © Copyright Baston 2023
      </div>
    </footer>
  </body>
</html>