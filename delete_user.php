<?php
require('connectsession.php');
$user_id = $_SESSION['id'];
// Assuming you have established the database connection in this file or included the necessary connection file

if (isset($_POST['delete_user'])) {
    // Retrieve the user_id from the POST data
    $user_id = $_POST['user_id'];

    // Prepare the delete statement
    $delete_query = oci_parse($conn, "DELETE FROM USERR WHERE USER_ID = $user_id");


    // Execute the delete statement
    if (oci_execute($delete_query)) {
        echo "User deleted successfully.";
        require('logout.php');
    } else {
        echo "Error deleting user.";
    }
} else {
    echo "Invalid request.";
}