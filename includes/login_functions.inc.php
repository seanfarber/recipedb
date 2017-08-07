<?php

/*  This function determines a url and sends the user there
    when not logged in.
*/
function redirect_user ($page = 'index.php') {

    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

    // remove trailing slashes
    $url = rtrim($url, '/\\');

    // Add the page
    $url .= '/' . $page;

    // Redirect the user:
    header("Location: $url");
        exit();
}

/*
    Function to validate from data
*/
function check_login($dbc, $email = '', $pass = '') {

    $errors = array();

    // Validate email address
    if (empty($email)) {
        $errors[] = 'You forgot to enter your email address.' . $pass;
    } else {
        $e = mysqli_real_escape_string($dbc, trim($email));
    }

    // Validate Password
    if (empty($pass)) {
        $errors[] = 'You forgot to enter your password';
    } else {
        $p = mysqli_real_escape_string($dbc, trim($pass));
    }

    // if no errors
    if (empty($errors)) {
        // Retrieve the user_id and first_name
        $q = "call login('$e', SHA1('$p'));";
        $r = @mysqli_query($dbc, $q);

        if (mysqli_num_rows($r) == 1) {

            // Fetch the record:
            $row = mysqli_fetch_array ($r, MYSQLI_ASSOC);

            // Return true and the record:
            return array(true, $row);

        } else { // Not a match!
            $errors[] = 'The email address and password entered do not match those on file.';
        }
    }

    return array(false, $errors);

}