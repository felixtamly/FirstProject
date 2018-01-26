<html>
<head>
    <title>Cart</title>
</head>

<body>
<?php
session_start();
include('header.php');

if (!isset($_SESSION['member_id'])) {
    require('login_tools.php');
    load();
}

//calculating total
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach($_POST['qty'] as $item_id => $item_qty) {
        $id = (int) $item_id;
        $qty = (int) $item_qty;

        if($qty == 0) {
            unset($_SESSION['cart'][$id]);
        } elseif($qty > 0) {
            $_SESSION['cart'][$id]['quantity'] = $qty;
        }
    }
}

$total = 0;

if(!empty($_SESSION['cart'])) {
    $mysqli = new mysqli("localhost", "root", "", "FirstProject");
    $query = "SELECT * FROM items WHERE item_id IN (";

    foreach($_SESSION['cart'] as $id => $value) {
        $query .= $id . ',' ;
    }
    $query = substr($query, 0, -1) . ') ORDER BY item_id';
    $result = $mysqli->query($query);
}

?>
<div class="container">
    <h3><strong>YOUR CART</strong></h3>
    <form action="cart.php" method="post">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
            </tr>
            </thead>
            <tbody>
            <?php
                if(!empty($_SESSION['cart'])) {
                    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        $subtotal = $_SESSION['cart'][$row['item_id']]['quantity'] * $_SESSION['cart'][$row['item_id']]['price'];
                        $total += $subtotal;

                        echo "<tr><td>{$row['item_name']}</td>";
                        echo "<td>{$row['item_desc']}</td>";
                        echo "<td><input type=\"text\" size=\"3\" name=\"qty[{$row['item_id']}]\" value =\"{$_SESSION['cart'][$row['item_id']]['quantity']}\"></td>";
                        echo "<td>{$row['item_price']}</td>";
                        echo "<td>" . number_format($subtotal, 2) . "</td></tr>";
                    }
                    echo '<tr><td></td><td></td><td></td><td><strong>Total = </strong></td><td><strong> '. number_format($total, 2) . '</strong></td></tr>';
                    $mysqli->close();
                } else {
                    echo '<h4>Your cart is currently empty.</h4>';
                }

            ?>
            </tbody>
        </table>
        <?php
        if(!empty($_SESSION['cart']))
            echo '<button type="submit" class="btn btn-info">Update</button>';
        ?>
    </form>
    <?php
    if(!empty($_SESSION['cart']))
        echo '<button type="button" class="btn btn-success"><a href="checkout.php?total=' . $total . '">Checkout</a></button>';
    ?>
</div>

</body>
</html>