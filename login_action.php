<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $mysqli = new mysqli("localhost", "root", "", "FirstProject");
        require('login_tools.php');

        list($check, $data) = validate($mysqli, $_POST['email'], $_POST['pw']);

        if($check) {
            session_start();

            $_SESSION['member_id'] = $data['member_id'];
            $_SESSION['firstname'] = $data['firstname'];
            $_SESSION['lastname'] = $data['lastname'];

            load('home.php');
        } else {
            $errors = $data;
        }
        $mysqli->close();
    }
include('login.php');
?>