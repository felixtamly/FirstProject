<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<?php
    include('header_logout.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $mysqli = new mysqli("localhost", "root", "", "FirstProject");
        $errors = array();

        if(mysqli_connect_errno()) {
            echo "Connection failed: " . mysqli_connect_error();
        }

        if($_POST['pw1'] != $_POST['pw2']) {
            $errors[] = "Passwords do not match.";
        } else {
            $pw = $mysqli->real_escape_string($_POST['pw1']);
        }
        $firstname = $mysqli->real_escape_string(trim($_POST['firstname']));
        $lastname = $mysqli->real_escape_string(trim($_POST['lastname']));
        $email = $mysqli->real_escape_string(trim($_POST['email']));

        if(empty($errors)) {
            $result = $mysqli->query("SELECT member_id FROM members WHERE email='$email'");
            if(mysqli_num_rows($result) != 0) {
                $errors[] = "Email address already registered. <a href=\"login.php\">Login now</a>";
            }
        }

        if(empty($errors)) {
            $result = $mysqli->query("INSERT INTO members (firstname, lastname, email, pw, reg_date) VALUES ('$firstname', '$lastname', '$email', '$pw', NOW())");

            if ($result) {
                echo '<h3>You are registered, ' . $firstname . '! <a href="login.php">Login now</a></h3>';
            }

            $mysqli->close();
            exit();
        } else {
            foreach($errors as $msg) {
                echo "<div class=\"container\"><div class=\"alert alert-warning\">$msg</div></div>";
            }
            $mysqli->close();
        }
    }
?>

    <div class="container">
        <h3>Register</h3>
            <form action="register.php" method="post">
                <div class="form-group">First Name: <input type="text" class="form-control" name="firstname" required></div>
                <div class="form-group">Last Name: <input type="text" class="form-control" name="lastname" required></div>
                <div class="form-group">Email: <input type="email" class="form-control" name="email" required></div>
                <div class="form-group">Password: <input type="password" class="form-control" name="pw1" required></div>
                <div class="form-group">Re-enter password: <input type="password" class="form-control" name="pw2" required></div>
                <button type="submit" class="btn btn-default">Register</button>
            </form>
    </div>

</body>
</html>