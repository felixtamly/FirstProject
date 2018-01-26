<head>
    <title>Welcome <?php echo $_POST["firstname"] . "!" ?></title>
</head>

<body>

<?php
$mysqli = new mysqli("localhost", "root", "", "FirstProject");

if(mysqli_connect_errno()) {
    echo "Connection failed: " . mysqli_connect_error();
}

$firstname = $mysqli->real_escape_string($_POST['firstname']);
$lastname = $mysqli->real_escape_string($_POST['lastname']);
$email = $mysqli->real_escape_string($_POST['email']);

if($mysqli->query("INSERT INTO People (firstname, lastname, email) VALUES ('" . $firstname . "','" . $lastname . "','" . $email . "')")) {
    echo "Welcome" . $_POST["firstname"] . " " . $_POST["lastname"] . "!";
} else {
    echo $mysqli->sqlstate;
}

?>
</body>