<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<?php
    include('header_logout.php');
//
//    if(isset($_SESSION['member_id'])) {
//        session_destroy();
//    }

    if(isset($errors) && !empty($errors)) {
        foreach($errors as $msg) {
            echo "$msg<br>";
        }
    }
?>

    <div class="container">
    <h3>Login</h3>
    <form action="login_action.php" method="post">
        <div class="form-group">Email: <input type="email" class="form-control" name="email" required></div>
        <div class="form-group">Password: <input type="password" class="form-control" name="pw" required></div>
        <button type="submit" class="btn btn-default">Log in</button>
    </form>
    </div>
</body>

</html>
