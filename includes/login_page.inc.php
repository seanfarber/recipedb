<?php

$page_title = 'Login Page';
include('includes/header.html');


// Print error messages if they exist
if (isset($errors) && !empty($errors)) {
    echo '<div class="container">
    <div class="page-header">
        <h1>Error <small>The following error(s) occurred:</small></h1><br>
    </div>';
    echo '<div class="col-md-4 col-md-offset-4" align="center"><p>';
    foreach ($errors as $msg) {
        echo " - $msg<br>\n";
    }
    echo "</p><p>Please try again.</p>
          </div>";
    echo '</div>';
}
?>

<div class="container">
    <div class="page-header">
    <h1>Login</h1>
    </div>
    <div class="col-md-4 col-md-offset-4">
     <form action="login.php" method="post">
         <div class="form-group">
             <label for="email">Email Address</label>
             <input type="text" name="email"  id="email" class="form-control" size="20" maxlength="60">
         </div>
         <div class="form-group">
             <label for="pass">Password</label>
             <input type="password" name="pass" id="pass" class="form-control" size="20" maxlength="20">
         </div>
         <div class="form-group">
             <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
         </div>
     </form>
    </div>

</div>

<?php
include('includes/footer.html')
?>