<?php
session_start();
$page_title = 'Ingredient';
include('includes/header.html');

$id = $_GET['id'];
?>

<div class="container">
    <div class="page-header">
        <h1><?php echo getIngredientName($dbc, $id) ?></h1>
    </div>

    <div class="col-sm-8 col-sm-offset-2">
        <?php getIngredientInfo($dbc, $id); ?>
    </div>

    <br>

<?php

function getIngredientName($dbc, $id) {
    require ('../mysqli_connect/mysqli_connect.php');
    $q = "call getIngredientName($id);";
    $r = @mysqli_query($dbc, $q);
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    $ingredientName = $row['ingredientName'];
    return $ingredientName;

}

function getIngredientInfo($dbc, $id) {
    require ('../mysqli_connect/mysqli_connect.php');
    $q = "call getIngredientInfo($id);";
    $r = @mysqli_query($dbc, $q);
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    $ingredient[0] = $row['servingSize'];
    $ingredient[1] = $row['nutritionInfo'];
    $ingredient[2] = $row['additionalInfo'];
    echo "<h4>Serving Size</h4>
          <p>$ingredient[0]</p>
          <h4>Nutrition Info</h4>
          <p>$ingredient[1]</p>
          <h4>Additional Info</h4>
          <p>$ingredient[2]</p>";
    mysqli_free_result();

}



include('includes/footer.html')
?>