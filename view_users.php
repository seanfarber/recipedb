<?php

session_start();
$page_title = 'View the Current Users';
include('includes/header.html');

echo '<div class="container">
    <div class="page-header">
        <h1>Registered Users</h1>
    </div>';


require ('../mysqli_connect/mysqli_connect.php');

$q = "call listUsers();";
$r = @mysqli_query($dbc, $q);

if ($r) {
    echo '<div class="col-sm-8 col-sm-offset-2"><table class="table">
    <thead>
    <tr>
    <th>User Id</th>
    <th>Name</th>
    <th>Email</th>
    <th>Date Registered</th>
    </tr>
    </thead>
    <tbody>';

    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '<tr>
        <td>' . $row['user_id'] . '</td>
        <td>' . $row['name'] . '</td>
        <td>' . $row['email'] .  '</td>
        <td>' . $row['dr'] . '</td>
        <td>
        </tr>';
    }
    
    echo '</tbody>
         </table></div>';

    mysqli_free_result($r);  // Frees up resources
} else {
    echo '<p class="error">Error!! The current users could not be retrieved.</p>';
}

echo '</div>';
mysqli_close($dbc);
?>

<?php
include('includes/footer.html')
?>


