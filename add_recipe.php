<?php
/**
 * Created by PhpStorm.
 * User: seanfarber
 * Date: 3/2/17
 * Time: 2:54 PM
 */
session_start();

if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

    // Need the functions:
    require ('includes/login_functions.inc.php');
    redirect_user();

}
$page_title = 'Add Recipes';
include('includes/header.html');
?>

<div class="container">
    <div class="page-header"><h1>Add Recipes</h1>
    </div>

    <form action="add_recipe.php" method="post">
        <div class="col-sm-5">
            <div class="form-group">
                <label for="recipe_name">Recipe Name</label>
                <input type="text" class="form-control" id="recipe_name" name="recipe_name" placeholder="Enter new recipe name">
            </div>

            <div class="form-group">
                <label for="short_description">Short Description <em>Max 250 Characters</em></label>
                <textarea class="form-control" id="short_description" name="short_description" placeholder="Enter a brief description" maxlength="250" rows="2"></textarea>
            </div>

            <div class="form-group">
                <label for="category">Select New Recipe's Category</label>
                <select class="form-control" name="category">
                    <option value="0">-select category-</option>
                    <option value="1">Main</option>
                    <option value="2">Appetizers</option>
                    <option value="3">Desserts</option>
                    <option value="4">Soups</option>
                    <option value="5">Marinades</option>
                </select>
            </div>


            <div class="form-group">
                <label for="ingredient">Ingredient Name</label>
                <input type="text" class="form-control" name="ingredient" id="ingredient" placeholder="Add ingredient name">
            </div>
            <div class="form-group">
                <label for="ingredient_amount">Ingredient Amount</label>
                <input type="text" class="form-control" name="ingredient_amount" id="ingredient_amount" placeholder="Add ingredient amount">
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-default" name="add_ingredient" id="add_ingredient">Add Ingredient</button>
            </div>

        </div>
        <div class="col-sm-6 col-sm-offset-1">
            <div class="form-group">
                <label for="cooking_time">Cooking Time</label>
                <input type="text" class="form-control" id="cooking_time" name="cooking_time" placeholder="Enter cooking time">
            </div>
            <label for="ingredient_panel">Ingredients</label>
            <div class="panel panel-default" style="min-height: 275px; max-height: 275px; overflow-y: scroll;" id="ingredient_panel">
                <div class="panel-body">
                    <table class="table" name="ingredient_list" id="ingredient_list">

                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
            <label for="recipe_instructions">Recipe Instructions</label>
            <textarea class="form-control" name="recipe_instructions" id="recipe_instructions" placeholder="Add ingredient instructions" rows="10">
            </textarea>
            </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="reset" class="btn btn-default">Clear</button>
        </div>
        </div>

        <input type="hidden" id="num" name="num" value="">
    </form>


</div>

<script>

    var ingButton = document.getElementById("add_ingredient");
    var ingList = document.getElementById("ingredient_list");
    var i = 0;

    ingButton.onclick = function ingDisplay() {
        var ingName = document.getElementById("ingredient").value;
        var ingAmount = document.getElementById("ingredient_amount").value;

        ingList.innerHTML = ingList.innerHTML + "<tr><td><input type='hidden' value='" + ingName + "' name='ingredientid" + i + "'>" + ingName + "</td><td><input type='hidden' name='ingamount" + i + "' value='" + ingAmount + "'>" + ingAmount +"</td></tr>";

        setNumIng();
        i++;

        document.getElementById("ingredient").value = "";
        document.getElementById("ingredient_amount").value = "";
    }
    
    function setNumIng() {
        document.getElementById("num").value = i;
    }

</script>

<?php

function insertRecipe($dbc, $rName, $rShortDesc, $rInstructions, $rCookTime, $cId, $uid) {
    require ('../mysqli_connect/mysqli_connect.php');
    $q = "call add_recipe('$rName', '$rShortDesc', '$rInstructions', '$rCookTime', '$cId', '$uid');";
    mysqli_query($dbc, $q);
    echo "In function $rName";
    mysqli_free_result();
}

function getRecipeId($dbc, $uid) {
    require ('../mysqli_connect/mysqli_connect.php');
    $q = "call getRecipeId('$uid');";
    $r = mysqli_query($dbc, $q);
    $row = mysqli_fetch_assoc($r);
    $rid = $row['recipeId'];
    return $rid;
    mysqli_free_result();

}

function insertIngredients($dbc, $rId, $ing, $ingAmt) {
    require ('../mysqli_connect/mysqli_connect.php');

    for ($i = 0; $i < count($ing); $i++) {
        $j = $i + 1;
        $q = "call add_recipe_ingredients('$rId', '$j', '$ing[$i]', '$ingAmt[$i]');";
        mysqli_query($dbc, $q);
    }
    mysqli_free_result();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $uniqueId = uniqid();
    $recipeName = $_POST['recipe_name'];
    $recipeShortDescription = $_POST['short_description'];
    $recipeCookingTime = $_POST['cooking_time'];
    $recipeCategory = $_POST['category'];
    $recipeInstructions = $_POST['recipe_instructions'];
    $ingNum = intval($_POST['num']);

    for ($i = 0; $i <= $ingNum; $i++) {
        $ingredient[$i] = $_POST["ingredientid$i"];
        $ingAmount[$i] = $_POST["ingamount$i"];
        echo $ingredient[$i] . "<br>";
        echo $ingAmount[$i] . "<br>";
    }
    echo $recipeName . "<br>" . $ingNum . "<br>" . $recipeCategory . "<br>" . $recipeInstructions . "<br>" . $uniqueId . "<br>";

    insertRecipe($dbc, $recipeName, $recipeShortDescription, $recipeInstructions, $recipeCookingTime, $recipeCategory, $uniqueId);

    $recipeId = getRecipeId($dbc, $uniqueId);
    echo "<h3>" . $recipeId . "</h3>";

    insertIngredients($dbc, $recipeId, $ingredient, $ingAmount);


}

?>

<?php
include('includes/footer.html')
?>