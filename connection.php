<?php 
$conn = oci_connect('Dikshya','Password123#','//localhost/xe');

if (!$conn) {
   $m = oci_error();
   echo "Connection failed: " . $e['message'];
   exit; 
}
?>

