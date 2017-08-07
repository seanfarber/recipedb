<?php
/**
 * User: seanfarber
 * Date: 3/20/17
 * Time: 6:42 PM
 * Displays recipe from link in recipe_search.php
 */

require ('../mysqli_connect/mysqli_connect.php');

$id = $_GET['id'];

$q = "call getRecipeIngredients($id);";
$r = @mysqli_query($dbc, $q);

while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
    echo '<p>' . $row['ingredient'] . '</p>';
}

?>

