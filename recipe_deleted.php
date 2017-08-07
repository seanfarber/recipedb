<?php
session_start();

if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

    // Need the functions:
    require ('includes/login_functions.inc.php');
    redirect_user();

}
$page_title = 'Recipe Deleted';
include('includes/header.html');

$id = $_POST['r_id'];

function deleteRecipe($dbc, $id) {
    require ('../mysqli_connect/mysqli_connect.php');
    $q = "call deleteRecipe($id);";
    mysqli_query($dbc,$q);
    mysqli_free_result();
}

deleteRecipe($dbc, $id);

?>

<div class="container">

    <div class="col-sm-8 col-sm-offset-2">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="panel-title"><h4>Recipe Deleted</h4></div>
            </div>
            <div class="panel-body">
                <h4>The recipe is deleted but a trigger has stored its contents
                    in the <em>recipe_audit table</em>.</h4>
            </div>
        </div>
    </div>

</div>

<?php

include ('includes/footer.html');
?>