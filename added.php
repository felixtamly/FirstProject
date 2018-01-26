<html>
<head>
    <title>Item Added</title>
</head>

<body>
<?php
session_start();
include('header.php');
?>
<div class="container">
<?php
if (!isset($_SESSION['member_id'])) {
    require('login_tools.php');
    load();
}

if(isset($_GET['id']))
    $id = $_GET['id'];

$mysqli = new mysqli("localhost", "root", "", "FirstProject");

$result = $mysqli->query("SELECT * FROM Items WHERE item_id = $id");
if($result->num_rows == 1) {
    $row = $result->fetch_array(MYSQLI_ASSOC);

    if(isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
        echo '<p>Another ' . $row['item_name'] . ' has been added to your cart.</p>';
    } else {
        $_SESSION['cart'][$id] = array('quantity' => 1, 'price' => $row['item_price']);
        echo '<p>' . $row["item_name"] . ' has been added to your cart.</p>';
    }
    $mysqli->close();
}

?>
</div>
</body>
</html>