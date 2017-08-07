<?php
session_start();

if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

    // Need the functions:
    require ('includes/login_functions.inc.php');
    redirect_user();

}
$page_title = 'Delete Recipe';
include('includes/header.html');

$id = $_GET['id'];
?>

<div class="container">

    <div class="col-sm-8 col-sm-offset-2">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="panel-title"><h4>Confirm Delete</h4></div>
            </div>
            <div class="panel-body">
                <h4>Are you sure you want to delete the <strong><em><?php echo getRecipeName($dbc, $id) ?></em></strong> recipe?</h4>
                <form action="recipe_deleted.php" method="post">
                <div class="form-group">
                <input type="hidden" name="r_id" id="r_id" value="<?php echo getRecipeId($id) ?>">
                <button type="submit" class="btn btn-danger" >Delete</button>
                <a class="btn btn-default" href="recipe.php?id=<?php echo $id ?>" role="button">Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?php

function getRecipeId($id) {
    return $id;
}

function getRecipeName($dbc, $id) {
    require ('../mysqli_connect/mysqli_connect.php');
    $q = "call getRecipe($id);";
    $r = @mysqli_query($dbc, $q);
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    $rName = $row['recipeName'];
    mysqli_free_result();
    return $rName;
}

include ('includes/footer.html');
?>
