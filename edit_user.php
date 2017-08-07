<?php

session_start();
$page_title = 'Edit User';
include('includes/header.html');

?>

<div class="container">

    <div class="page-header">
        <h1>Edit User</h1>
    </div>

    <div class="col-sm-4">
        <h3>User Name</h3>
        <h3>Email Address</h3>

    </div>

    <div class="col-sm-5">
        <form action="edit_user.php" method="post">
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

