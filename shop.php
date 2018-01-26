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

$mysqli = new mysqli("localhost", "root", "", "FirstProject");

$result = $mysqli->query("SELECT * FROM Items");

?>
<div class="container">
    <h3><strong>THE SHOP</strong></h3>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
                <?php
                if($result->num_rows > 0) {
                    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . $row['item_name'] . '</td>';
                        echo '<td>' . $row['item_desc'] . '</td>';
                        echo '<td>£' . $row['item_price'] . '</td>';
                        echo '<td><button type="button" class="btn btn-info"><a href="added.php?id=' . $row['item_id'] . '">Add to Cart</a></button></td>';
                        echo '</tr>';
                    }
                }
                $mysqli->close();
                ?>
        </tbody>
    </table>
</div>

</body>
</html>