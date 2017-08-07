<?php

session_start();
$page_title = 'Ingredient Search';
include('includes/header.html');
?>

    <div class="container">
        <div class="page-header">
            <h1>Ingredient Search <small>search the recipe database.</small></h1>
        </div>

        <!-- Start search form -->
        <div class="col-sm-6">
            <form action="ingredient_search.php" method="post">
                <div class="form-group">
                    <label for="category">Search by category</label>
                    <select class="form-control" name="drop_category">
                        <option value="0">-select category-</option>
                        <option value="1">Pasta and Noodles</option>
                        <option value="2">Plant Based Protein</option>
                        <option value="4">Sweeteners</option>
                        <option value="5">Tomato Products</option>
                        <option value="7">Fruits</option>
                        <option value="8">Oils and Vinegars</option>
                        <option value="9">Vegetables</option>
                        <option value="10">Nuts</option>
                        <option value="11">Herbs and Spices</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ingredient_name_search">Search by ingredient name</label>
                    <input type="text" class="form-control" id="ingredient_name_search" name="ingredient_name_search" placeholder="Enter ingredient name">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>

        <br>

        <?php

        function getIngredientsByCat($dbc, $cat) {
            require('../mysqli_connect/mysqli_connect.php');
            $q = "call searchIngCategory($cat);";
            $r = @mysqli_query($dbc, $q);
            echo '<div class="col-md-4 col-md-offset-4" align="center">';
            while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                echo '<h4><a href="ingredient.php?id=' . $row['ingredientID'] . '">' . $row['ingredientName'] . '</a></h4>';
            }
            echo '</div>';
            mysqli_free_result();
        }

        function searchIngredientName($dbc, $rName) {
            require('../mysqli_connect/mysqli_connect.php');
//    $q = "select recipeId, recipeName from Recipe where recipeName like '%Lasagna%';";
            $rName = '%'.$rName.'%';
            $q = "call searchIngredientName('$rName');";
            $r = @mysqli_query($dbc, $q);
            echo '<div class="col-md-4 col-md-offset-4" align="center">';
            while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                echo '<h4><a href="ingredient.php?id=' . $row['ingredientID'] . '">' . $row['ingredientName'] . '</a></h4>';
            }
            echo '</div>';
            mysqli_free_result();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $category = $_POST['drop_category'];
            getIngredientsByCat($dbc, $category);

            if ($_POST['drop_category'] == 0) {
                $ingredientName = $_POST['ingredient_name_search'];
                searchIngredientName($dbc, $ingredientName);
            }

            echo '</div>';

        };

        ?>

        <br><br>
    </div>
<?php
include('includes/footer.html')
?>