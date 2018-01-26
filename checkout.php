<html>
<head>
    <title>Checkout</title>
</head>

<body>
<?php
session_start();
include('header.php');

if (!isset($_SESSION['member_id'])) {
    require('login_tools.php');
    load();
}

if (isset($_GET['total']) && ($_GET['total'] > 0) && (!empty($_SESSION['cart']))) {
    $mysqli = new mysqli("localhost", "root", "", "FirstProject");

    //create new order
    $result = $mysqli->query("INSERT INTO orders (member_id, total, order_date) VALUES (" . $_SESSION['member_id'] . ", " . $_GET['total'] . ", NOW())");
    $order_id = $mysqli->insert_id;

    //get item id
    $query = "SELECT * FROM items WHERE item_id IN (";
    foreach ($_SESSION['cart'] as $id => $value) {
        $query .= $id . ',';
    }
    $query = substr($query, 0, -1) . ") ORDER BY item_id";
    $result = $mysqli->query($query);

    //create new order details
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $q = "INSERT INTO order_contents (order_id, item_id, quantity, price) VALUES ($order_id, " . $row['item_id'] . ", " . $_SESSION['cart'][$row['item_id']]['quantity'] . ", " . $_SESSION['cart'][$row['item_id']]['price'] . ")";
        $mysqli->query($q);
    }
    $mysqli->close();
    echo "<p>Thank you for your order. Your order number is " . $order_id . "</p>";
    $_SESSION['cart'] = NULL;
} else {
    echo '<p>Your cart is empty.</p>';
}


?>

</body>
</html>