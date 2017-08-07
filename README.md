# recipedb
Introduction

The recipe database allows for searching for recipes by category or name. Links to the recipes appear below the search form after the form is submitted. When a link is selected, a page showing that recipe is displayed. Edit and Delete buttons are only shown when a user is logged in.

When a user logs in, the navigation bar shows links to add recipes and view users. When the logout link is activated, the links disappear. The users link shows all users in the database and the add recipe link loads a form to enter new recipes.

Functionality

This project makes use of MySQL SELECT, INSERT, UPDATE, and DELETE statements using stored procedures. A trigger is fired when a recipe is deleted that inserts that recipe’s data into a table call recipe_audit.


Recipe Search

Search for recipes by category or name. The name search uses % wildcards on the beginning and end of the search term.

Login

Login for admin functions.

Add Recipe

This page is only available when logged in. It contains a form for adding recipes to the database.

Edit Recipe

Accessed by clicking button under the recipe name while viewing a recipe when logged in. Allow for updating fields in the Recipe table.

Delete Recipe

Accessed by clicking button under the recipe name while viewing a recipe when logged in. A confirmation page appears to confirm that the recipe will be deleted. If confirmed, the recipe is deleted from the Recipe table and a trigger is fired to add information to the recipe_audit table.

Stored Procedures

All MySQL queries are executed by stored procedures.

Trigger

The before_recipe_delete trigger was created to store deleted recipes in the recipe_audit table.
