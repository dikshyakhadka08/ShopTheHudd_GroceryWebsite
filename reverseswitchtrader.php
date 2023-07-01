<?php
require('connectsession.php');
function inputdata($data) {  
    $data = trim($data);  
    $data = stripslashes($data);  
    $data = htmlspecialchars($data);  
    return $data;  
  }  
$newValuee = intval(inputdata($_GET['id']));

$sqll = "UPDATE USERR SET STATUS = '0' WHERE USER_ID = :new_valuee ";

// Create a statement handle
$stmtt = oci_parse($conn, $sqll);
if (!$stmtt) {
    $error = oci_error($conn);
    die("Statement preparation failed: " . $error['message']);
}

// Bind the new value to the placeholder

oci_bind_by_name($stmtt, ":new_valuee", $newValuee);

// Execute the statement
$result = oci_execute($stmtt);

if (!$result) {
    $error = oci_error($stmtt);
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