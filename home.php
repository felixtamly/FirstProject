<html>
<head>
    <title>Home</title>
    <script>
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = checkTime(today.getMinutes());
            var s = checkTime(today.getSeconds());

            document.getElementById('clock').innerHTML = h + " : " + m + " : " + s;
            setTimeout(startTime, 500);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }
    </script>
</head>

<body onload="startTime()">
<?php
    session_start();
    include('header.php');

    if(!isset($_SESSION['member_id'])) {
        require('login_tools.php');
        load();
    }

    echo "
        <div class='container'><h2>Welcome back, " . "{$_SESSION['firstname']}!</h2></div>";
?>

<div class="container" id="clock"></div>

</body>
</html>