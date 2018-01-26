<html>
<head>
    <title>Home</title>
</head>

<body>
<?php
    session_start();
    include('header.php');

    if(!isset($_SESSION['member_id'])) {
        require('login_tools.php');
        load();
    }

    echo "<h3>Welcome back, " . "{$_SESSION['firstname']}!</h3>";
?>

</body>
</html>