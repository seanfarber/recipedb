<?php
session_start();

if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

    // Need the functions:
    require ('includes/login_functions.inc.php');
    redirect_user();

}
$page_title = 'Recipe Updated';
include('includes/header.html');

$id = $_POST['r_id'];
?>

<div class="container">

    <div class="col-sm-8 col-sm-offset-2">
        <h1>Recipe Updated</h1>
        <a class="btn btn-default btn-lg" href="recipe.php?id=<?php echo $id ?>" role="button">Go to Recipe</a>

    </div>

</div>

<?php

function updateRecipeName($dbc, $nName, $id) {
    require ('../mysqli_connect/mysqli_connect.php');
    $q = "call updateRecipeName('$nName', '$id');";
    mysqli_query($dbc, $q);
    mysqli_free_result();
}

function updateRecipeCat($dbc, $nCat, $id) {
    require ('../mysqli_connect/mysqli_connect.php');
    $q = "call updateRecipeCategory('$nCat', '$id');";
    mysqli_query($dbc, $q);
    mysqli_free_result();
}

function updateRecipeTime($dbc, $nTime, $id) {
    require ('../mysqli_connect/mysqli_connect.php');
    $q = "call updateCookingTime('$nTime', '$id');";
    mysqli_query($dbc, $q);
    mysqli_free_result();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $rid = intval($_POST['r_id']);
    $newTime = $_POST['new_recipe_time'];

    if (strlen($_POST['new_recipe_name']) > 0) {
        $newName = $_POST['new_recipe_name'];
        updateRecipeName($dbc, $newName, $rid);
    }

    if (strlen($_POST['new_recipe_category']) > 0) {
        $newCat = intval($_POST['new_recipe_category']);
        updateRecipeCat($dbc, $newCat, $rid);
    }

    if (strlen($_POST['new_recipe_time']) > 0) {
        $newTime = $_POST['new_recipe_time'];
        updateRecipeTime($dbc, $newTime, $rid);
    }

}
include ('includes/footer.html');
?>