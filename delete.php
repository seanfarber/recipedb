<?php

// connect to the database
include('includes/header.html');
require('includes/functions.php');


// confirm that the 'pId' variable has been set
if (isset($_GET['pId']) && is_numeric($_GET['pId']))
{
// get the 'id' variable from the URL
$id = $_GET['pId'];

// delete record from database
if ($stmt = $dbc->prepare("DELETE FROM products WHERE pId = ? LIMIT 1"))
{
$stmt->bind_param("i",$id);
$stmt->execute();
$stmt->close();
}
else
{
echo "ERROR: could not prepare SQL statement.";
}
$dbc->close();

// redirect user after delete is successful
header("Location: view.php");
}
else
// if the 'id' variable isn't set, redirect the user
{
header("Location: view.php");
}

?>