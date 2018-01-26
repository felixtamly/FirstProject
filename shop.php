<html>
<head>
    <title>Shop</title>
</head>

<body>
<?php
session_start();
include('header.php');

if (!isset($_SESSION['member_id'])) {
    require('login_tools.php');
    load();
}
?>
SHOP
</body>
</html>