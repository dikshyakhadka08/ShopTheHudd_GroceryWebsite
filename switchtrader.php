<?php
require('connectsession.php');
function inputdata($data) {  
    $data = trim($data);  
    $data = stripslashes($data);  
    $data = htmlspecialchars($data);  
    return $data;  
  }  
$newValue = intval(inputdata($_GET['id']));

$sql = "UPDATE USERR SET STATUS = '1' WHERE USER_ID = :new_value ";

// Create a statement handle
$stmt = oci_parse($conn, $sql);
if (!$stmt) {
    $error = oci_error($conn);
    die("Statement preparation failed: " . $error['message']);
}

// Bind the new value to the placeholder

oci_bind_by_name($stmt, ":new_value", $newValue);

// Execute the statement
$result = oci_execute($stmt);

if (!$result) {
    $error = oci_error($stmt);
    die("Statement execution failed: " . $error['message']);
    
}
else{
    session_destroy();
    session_abort();
    
    echo "<script>window.location.replace('admin.php');</script>";
}

// // Commit the changes
// oci_commit($conn);

// // Free the statement handle
// oci_free_statement($stmt);

// // Close the database connection
// oci_close($conn);
?>