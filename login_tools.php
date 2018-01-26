<?php



function load($page = 'login.php') {
    $url = 'http://' . $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
    $url = rtrim($url, '/\\');
    $url .= '/' . $page;
    header("Location: $url");
    exit();
}

function validate($mysqli, $email = "", $pw="") {
    $errors = array();
    $email = $mysqli->real_escape_string(trim($email));
    $pw = $mysqli->real_escape_string(trim($pw));

    if(empty($errors)) {
        $result = $mysqli->query("SELECT member_id, firstname, lastname 
                                         FROM members
                                         WHERE email = '$email' AND pw = '$pw'");

        if(mysqli_num_rows($result) == 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            return array(true, $row);
        } else {
            $errors[] = "Email address and/or password not found.";
        }
        return array(false, $errors);
    }
}