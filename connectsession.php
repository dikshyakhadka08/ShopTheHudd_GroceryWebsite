<?php 
session_start();
$conn = oci_connect('Dikshya','Password123#','//localhost/xe');  
if (!$conn) {
      $m = oci_error();
      echo $m['message'], "\n";
      exit; 
   } else {
   //  print "Connected to Oracle!"; 
   }
?>