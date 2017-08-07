<?php
/**
 * Created by PhpStorm.
 * User: seanfarber
 * Date: 3/2/17
 * Time: 2:54 PM
 */
session_start();
$page_title = 'Recipe Search';
include('includes/header.html');
?>

    <div class="container">
    <div class="page-header">
        <h1>Recipe Search <small>search the recipe database.</small></h1>
    </div>

    <!-- Start search form -->
        <div class="col-sm-6">
        <form action="recipe_search.php" method="post">
            <div class="form-group">
                <label for="category">Search by category</label>
                <select class="form-control" name="drop_category">
                    <option value="0">-select category-</option>
                    <option value="1">Main</option>
                    <option value="2">Appetizers</option>
                    <option value="3">Desserts</option>
                    <option value="4">Soups</option>
                    <option value="5">Marinades</option>
                </select>
            </div>
            <div class="form-group">
                <label for="recipe_name_search">Search by recipe name</label>
                <input type="text" class="form-control" id="recipe_name_search" name="recipe_name_search" placeholder="Enter recipe name">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        </div>





<br>

<?php

function getRecipesByCat($dbc, $cat) {
    require('../mysqli_connect/mysqli_connect.php');
    $q = "call searchCategory($cat);";
    $r = @mysqli_query($dbc, $q);
    echo '<div class="col-md-4 col-md-offset-4" align="center">';
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '<h4><a href="recipe.php?id=' . $row['recipeId'] . '">' . $row['recipeName'] . '</a></h4>';
    }
    echo '</div>';
    mysqli_free_result();
}

function searchRecipeName($dbc, $rName) {
    require('../mysqli_connect/mysqli_connect.php');
    $rName = '%'.$rName.'%';
    $q = "call searchRecipeName('$rName');";
    $r = @mysqli_query($dbc, $q);
    echo '<div class="col-md-4 col-md-offset-4" align="center">';
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '<h4><a href="recipe.php?id=' . $row['recipeId'] . '">' . $row['recipeName'] . '</a></h4>';
    }
    echo '</div>';
    mysqli_free_result();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $category = $_POST['drop_category'];
        getRecipesByCat($dbc, $category);

        if ($_POST['drop_category'] == 0) {
            $recipeName = $_POST['recipe_name_search'];
            searchRecipeName($dbc, $recipeName);
        }

    echo '</div>';

};

?>

<br><br>
    </div>
<?php
include('includes/footer.html')
?>