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

    <input type="text" id="searchbar" onkeyup="search()" placeholder="Search by name">
    <table class="table table-hover" id="catalogue">
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
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
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

<script>
    function search() {
        var input = document.getElementById("searchbar").value.toUpperCase();
        var tr = document.getElementById("catalogue").getElementsByTagName("tr");

        for (var i = 0; i < tr.length; i++) {
            var td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(input) > -1) { //indeoxOf() return -1 if the value to search for never occurs
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

</body>
</html>