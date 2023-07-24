<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "contact_us";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // echo "Successfully connected to the MySQL server.<br>";
}

$sql = "SELECT * FROM contact_us";
$result = mysqli_query($conn, $sql);

function deleteRecord($conn, $id) {
    $sql = "DELETE FROM contact_us WHERE id = $id";
    if(mysqli_query($conn, $sql)){
        return true;
    } else {
        return false;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recordId = $_POST['delete'];
    if (deleteRecord($conn, $recordId)) {
        echo '<div class="alert alert-success" role="alert">Record deleted successfully.</div>';

    } else {
        echo '<div class="alert alert-danger" role="alert">Error deleting the record.</div>';
    }
}

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    
// }

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>List Contact Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-12 mt-5 pd-5">
        <h3>List</h3>
      </div>
      <div class="col-12 mb-5">
        <a href="index.php">Home Page</a> </br>
        <a href="list_contact.php">List Page</a>
      </div>
      <div class="col-12">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Email</th>
              <th scope="col">Gender</th>
              <th scope="col">Eligible</th>
              <th scope="col">Description</th>
            </tr>
          </thead>
          <tbody>
            <?php
                        while ($data = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $data['id'] . "</td>";
                            echo "<td>" . $data['first_name'] . "</td>";
                            echo "<td>" . $data['last_name'] . "</td>";
                            echo "<td>" . $data['email'] . "</td>";
                            echo "<td>" . $data['gender'] . "</td>";
                            echo "<td>" . $data['eligible'] . "</td>";
                            echo "<td>" . $data['description'] . "</td>";

                            echo "<td>";
                            echo '<form method="post">';
                            echo '<button type="button" name="update" class="btn btn-primary"  value="' . $data['id'] . '" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Update
                          </button>';
                            echo '</form>';
                            echo "</td>";

                            echo "<td>";
                            echo '<form method="post">';
                            echo '<button type="submit" name="delete" value="' . $data['id'] . '" class="btn btn-danger">Delete</button>';
                            echo '</form>';
                            echo "</td>";
                            
                            echo "</tr>";
                        }
                        ?>
          </tbody>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
          aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="list_contact.php" method="post">
                  <div class="row">
                    <div class="col-6">
                      <div class="mb-3">
                        <label for="fname" class="form-label">First Name </label>
                        <input type="fname" value="<?php echo $data['first_name']; ?>" class="form-control" name="fname" id="fname" aria-describedby="fnameHelp">
                        <div id="fnameHelp" class="form-text">We'll never share your first name with anyone else.</div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="mb-3">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="lname" class="form-control" name="lname" id="lname" aria-describedby="lnameHelp">
                        <div id="lnameHelp" class="form-text">We'll never share your last name with anyone else.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3">
                        <label for="email" class="form-label">Email addresh</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                      </div>
                    </div>
                    <div class="col-12 mb-3">
                      <label for="eligible" class="form-label">Eligible</label>
                      <div class="row">
                        <div class="col-6">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="eligible" value="Yes" id="eligibleYes">
                            <label class="form-check-label" for="eligibleYes">
                              Yes, I am eligible.
                            </label>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="eligible" value="No" id="eligibleNo">
                            <label class="form-check-label" for="eligibleNo">
                              No, I am not eligible.
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <select class="form-select mb-3" name="gender" aria-label="Default select example">
                        <option selected>Select you gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                      </select>
                    </div>
                    <div class="col-12">
                      <div class="mb-3">
                        <label for="description" class="form-label">Descripstion</label>
                        <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                      </div>
                    </div>
                    <div class="col-12 mt-3">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
</body>

</html>