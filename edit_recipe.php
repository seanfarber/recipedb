<?php
session_start();

if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

    // Need the functions:
    require ('includes/login_functions.inc.php');
    redirect_user();

}
$page_title = 'Edit Recipes';
include('includes/header.html');

$id = $_GET['id'];
?>

<div class="container">
    <div class="page-header">
       <h1>Edit Recipe <small><?php echo getRecipeName($dbc, $id) ?></small></h1>
        <h4>Change one of the following</h4>
    </div>

    <div class="col-sm-5">
        <form action="recipe_updated.php" method="post">
            <div class="form-group">
                <label for="new_recipe_name">Change Recipe Name</label>
                <input type="text" class="form-control" id="new_recipe_name" name="new_recipe_name" placeholder="Enter new recipe name">
                <input type="hidden" name="r_id" id="r_id" value="<?php echo getRecipeId($id) ?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-default">Clear</button>
            </div>
        </form>
        <hr>
        <form action="recipe_updated.php" method="post">
            <div class="form-group">
                <label for="new_recipe_category">Change Recipe Category</label>
                <select class="form-control" name="new_recipe_category" id="new_recipe_category">
                    <option value="">-select category-</option>
                    <option value="1">Main</option>
                    <option value="2">Appetizers</option>
                    <option value="3">Desserts</option>
                    <option value="4">Soups</option>
                    <option value="5">Marinades</option>
                </select>
                <input type="hidden" name="r_id" id="r_id" value="<?php echo getRecipeId($id) ?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-default">Clear</button>
            </div>
        </form>
    </div>
    <div class="col-sm-5">
        <form action="recipe_updated.php" method="post">
            <div class="form-group">
                <label for="new_recipe_time">Change Recipe Cooking Time</label>
                <input type="text" class="form-control" id="new_recipe_time" name="new_recipe_time" placeholder="Enter new recipe cooking time">
                <input type="hidden" name="r_id" id="r_id" value="<?php echo getRecipeId($id) ?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-default">Clear</button>
            </div>
        </form>
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