<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "Fbo";

$insert = false;

$con = mysqli_connect($server, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
// $meraSql = "Create database Fbo";
// $res = mysqli_query($con, $meraSql);

// if ($res) {
//     echo "database is created ";
// }


// $table = "
//  create table S_S_info 
//  ( id int primary key  not null auto_increment , 
//  fbo_name varchar(250), 
//  fbo_id varchar(250),
//  product varchar(250),
//  price varchar(250), 
//  upline varchar(250),
//  senior_upline varchar(250)
//  )
// ";

// $res = mysqli_query($con, $table);

// if ($res) {
//     echo "table is created ";
// }



if (isset($_POST["fbo_name"])) {
    $fboNameValue = $_POST["fbo_name"];
    $fboIdValue = $_POST["fbo_id"];
    $productValue = $_POST["product"];
    $priceValue = $_POST["price"];
    $uplineValue = $_POST["upline"];
    $seniorUplineValue = $_POST["senior_upline"];

    $sql = "INSERT INTO S_S_info(fbo_name, fbo_id, product, price, upline, senior_upline) VALUES ('$fboNameValue', '$fboIdValue', '$productValue', '$priceValue', '$uplineValue', '$seniorUplineValue')";

    $res =  mysqli_query($con, $sql);

    if ($res) {
        $insert = true;
    } else {
        echo "Failed to insert data.";
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Form</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <?php
    if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Submitted successfully</strong> no submit.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    ?>

    <div class="container">
        <form method="post" action="1.PHP">
          <div class="mb-3">
              <label for="fbo_name" class="form-label">FBO Name</label>
              <input type="text" class="form-control" name="fbo_name" id="fbo_name" aria-describedby="fboHelp">
          </div>
          <div class="mb-3">
              <label for="fbo_id" class="form-label">FBO ID</label>
              <input type="text" class="form-control" name="fbo_id" id="fbo_id" aria-describedby="fboIdHelp">
          </div>
          <div class="mb-3">
              <label for="product" class="form-label">Product</label>
              <input type="text" class="form-control" name="product" id="product" aria-describedby="productHelp">
          </div>
          <div class="mb-3">
              <label for="price" class="form-label">Price</label>
              <input type="text" class="form-control" name="price" id="price">
          </div>
          <div class="mb-3">
              <label for="upline" class="form-label">Upline</label>
              <input type="text" class="form-control" name="upline" id="upline">
          </div>
          <div class="mb-3">
              <label for="senior_upline" class="form-label">Senior Upline</label>
              <input type="text" class="form-control" name="senior_upline" id="senior_upline">
          </div>
          <div class="d-grid gap-2">
              <button class="btn btn-success" type="submit">Add</button>
              <button class="btn btn-danger" type="submit">Delete</button>
          </div>
        </form>
    </div>

    <div class="container">
        <h1>Table Data</h1>
        <table id="mytable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">FBO Name</th>
                    <th scope="col">FBO ID</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Upline</th>
                    <th scope="col">Senior Upline</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $showsql = "SELECT * FROM S_S_info";
                $result = mysqli_query($con, $showsql);
                $totalcount = mysqli_num_rows($result);

                if ($totalcount > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["fbo_name"] . "</td>";
                        echo "<td>" . $row["fbo_id"] . "</td>";
                        echo "<td>" . $row["product"] . "</td>";
                        echo "<td>" . $row["price"] . "</td>";
                        echo "<td>" . $row["upline"] . "</td>";
                        echo "<td>" . $row["senior_upline"] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">
    </script>
    <script>
    $(document).ready(function() {
        $('#mytable').DataTable();
    });
    
    </body>
</html>