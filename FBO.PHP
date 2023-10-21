<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "Fbo";

$con = mysqli_connect($server, $username, $password);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$createDBQuery = "CREATE DATABASE IF NOT EXISTS Fbo";
mysqli_query($con, $createDBQuery);

$con = mysqli_connect($server, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$createTableQuery = "CREATE TABLE IF NOT EXISTS S_S_info (
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    fbo_name varchar(250), 
    fbo_id varchar(250),
    product varchar(250),
    price varchar(250), 
    upline varchar(250),
    senior_upline varchar(250)
)";

mysqli_query($con, $createTableQuery);

if(isset($_POST['admin_password'])) {
    $admin_password = $_POST['admin_password'];
    if($admin_password == 'sssj') {
        // Admin password is correct, proceed to perform admin actions
        echo "Admin login successful!";
    } else {
        echo "Invalid password! Please try again.";
    }
}

if(isset($_POST['member_password'])) {
    $member_password = $_POST['member_password'];
    if($member_password == '123') {
        // Member password is correct, proceed to perform member actions
        echo "Member login successful!";
    } else {
        echo "Invalid password! Please try again.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FBO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">FBO</a>
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
                        <a class="nav-link " href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <h2>Admin Login</h2>
                <form method="post" action="admin.php">
                    <div class="mb-3">
                        <label for="admin_password" class="form-label">Admin Password</label>
                        <input type="password" class="form-control" name="admin_password" id="admin_password" aria-describedby="passwordHelp">
                    </div>
                    <button class="btn btn-primary" type="submit">Login as Admin</button>
                </form>
            </div>

            <div class="col">
                <h2>Member Login</h2>
                <form method="post" action="member.php">
                    <div class="mb-3">
                        <label for="member_password" class="form-label">Member Password</label>
                        <input type="password" class="form-control" name="member_password" id="member_password" aria-describedby="passwordHelp">
                    </div>
                    <button class="btn btn-primary" type="submit">Login as Member</button>
                </form>
            </div>
        </div>

        <div class="mt-5">
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
    </div>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#mytable').DataTable();
        });
    </script>

</body>
</html>
