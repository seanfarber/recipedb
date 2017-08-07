<?php
/**
 * User: seanfarber
 * Date: 3/20/17
 * Time: 6:42 PM
 * Displays recipe from link in recipe_search.php
 */
session_start();
$page_title = 'Recipe';
include ('includes/header.html');

$id = $_GET['id'];

function getRecipeName($dbc, $id) {
    require ('../mysqli_connect/mysqli_connect.php');
    $q = "call getRecipe($id);";
    $r = @mysqli_query($dbc, $q);
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    $rName = $row['recipeName'];
    mysqli_free_result();
    return $rName;
}

function checkIfSections($dbc, $id) {
    require ('../mysqli_connect/mysqli_connect.php');
    $q = "call checkSections($id);";
    $r = @mysqli_query($dbc, $q);
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    $hasSection = $row['recipe_section_id'];
    return $hasSection;
    mysqli_free_result();
}

function getIngredientsWSections($dbc, $id) {
    $sections = getNumberOfSections($dbc, $id) + 1;
    for ($i = 1; $i <= $sections; $i++) {
        $sectionName = getRecipeSectionName($dbc, $id, $i);
        echo '<div class="col-sm-12"><h3>For the ' . $sectionName . '</h3></div>';
        getRecipeIngWSections($dbc, $id, $i);
        echo '<br>';
    }
}

function getNumberOfSections($dbc, $id) {
    require ('../mysqli_connect/mysqli_connect.php');
    $q = "call numberOfSections($id);";
    $r = @mysqli_query($dbc, $q);
    return $r;
}

function getRecipeSectionName($dbc, $id, $sectionNumber) {
    require ('../mysqli_connect/mysqli_connect.php');
    $q = "call recipeSectionName($id, $sectionNumber);";
    $r = @mysqli_query($dbc, $q);
    $row = mysqli_fetch_assoc($r);
    return $row['recipe_section_name'];
}

function getRecipeIngWSections($dbc, $id, $section) {
    require ('../mysqli_connect/mysqli_connect.php');
    $q = "call recipeIngWSections($id, $section);";
    $r = @mysqli_query($dbc, $q);
    while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '<div class="col-sm-4"><h5>' . $row['ingredientName'] . ' &nbsp ' . $row['amount'] . '</h5></div>';
    }
    mysqli_free_result();
}

function getRecipeCookingTime($dbc, $id) {
    require ('../mysqli_connect/mysqli_connect.php');
    $q = "call recipeCookingTime($id);";
    $r = @mysqli_query($dbc, $q);
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC) ;
    $recipeTime = $row['recipeCookingTime'];
    return $recipeTime;

    mysqli_free_result();
}

function getRecipeIngredient($dbc, $id) {
    require ('../mysqli_connect/mysqli_connect.php');
    $q = "call getRecipeIngredients($id);";
    $r = @mysqli_query($dbc, $q);
    while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '<div class="col-sm-4"><h5>' . $row['ingredientName'] . ' &nbsp ' . $row['amount'] . '</h5></div>';
    }
    mysqli_free_result();
}

function getRecipeInstructions($dbc, $id) {
    require ('../mysqli_connect/mysqli_connect.php');
    $q = "call getRecipe($id);";
    $r = @mysqli_query($dbc, $q);
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    $rInstructions = $row['recipeCookingInstructions'];
    mysqli_free_result();
    return $rInstructions;
}
?>

<div class="container">
<div class="page-header">
<?php $recipeName = getRecipeName($dbc, $id);
echo '<h1>' . $recipeName . '</h1>';
if (isset($_SESSION['user_id'])) {
    echo '<div class="btn-group btn-group-xs" role="group">
    <a class="btn btn-default btn-xs" href="edit_recipe.php?id=' . $id . '">Edit</a>
    <a class="btn btn-default btn-xs" href="delete_recipe.php?id=' . $id . '">Delete</a>
    </div>';
}
?>
</div>
    <div class="col-sm-12">
        <h4><em>Cooking Time <?php echo getRecipeCookingTime($dbc, $id) ?></em></h4>

    </div>

<?php
// Check if there are multiple sections of ingredients
$hasSections = checkIfSections($dbc, $id);
// if not
if (!$hasSections) {
    getRecipeIngredient($dbc, $id);
}
// else display recipe with ingredient sections
else {
    getIngredientsWSections($dbc, $id);
}

?>
</div>
<br>
<div class="container">

<?php
$cookingInstructions = getRecipeInstructions($dbc, $id);
echo '<p>' . $cookingInstructions . '</p>';
?>
</div>

<?php
include ('includes/footer.html');
?>

