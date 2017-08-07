<?php
/**
 * Created by PhpStorm.
 * User: seanfarber
 * Date: 3/2/17
 * Time: 2:54 PM
 */
session_start();
$page_title = 'Welcome to the Recipe Database';
include ('includes/header.html');
?>
<div class="container">
<div class="page-header">
    <h1>The Recipe Database <small>Recipes and ingredient info.</small></h1>
</div>
        <div class="col-sm-8 col-sm-offset-2">
            <h3>Introduction</h3>
            <p>The recipe database allows for searching for recipes by category or name.  Links to the recipes appear below the search form after the form is submitted.  When a link is selected, a page showing that recipe is displayed.  Edit and Delete buttons are only shown when a user is logged in.</p>
            <p>When a user logs in, the navigation bar shows links to add recipes and view users.  When the logout link is activated, the links disappear.  The users link shows all users in the database and the add recipe link loads a form to enter new recipes.</p>
            <h3>Functionality</h3>
            <p>This project makes use of MySQL SELECT, INSERT, UPDATE, and DELETE statements using stored procedures.  A trigger is fired when a recipe is deleted that inserts that recipe’s data into a table call recipe_audit.</p><br>
            <p><strong>Recipe Search</strong><br>
                Search for recipes by category or name.  The name search uses % wildcards on the beginning and end of the search term.
            </p>
            <p><strong>Login</strong><br>
                Login for admin functions.
            </p>
            <p><strong>Add Recipe</strong><br>
                This page is only available when logged in.  It contains a form for adding recipes to the database.
            </p>
            <p><strong>Edit Recipe</strong><br>
                Accessed by clicking button under the recipe name while viewing a recipe when logged in.  Allow for updating fields in the Recipe table.
            </p>
            <p><strong>Delete Recipe</strong><br>
                Accessed by clicking button under the recipe name while viewing a recipe when logged in.  A confirmation page appears to confirm that the recipe will be deleted.  If confirmed, the recipe is deleted from the Recipe table and a trigger is fired to add information to the recipe_audit table.
            </p>
            <p><strong>Stored Procedures</strong><br>
                All MySQL  queries are executed by stored procedures.
            </p>
            <p><strong>Trigger</strong><br>
                The before_recipe_delete trigger was created to store deleted recipes in the recipe_audit table.
            </p>
        </div>

</div>
<?php
include ('includes/footer.html')
?>
