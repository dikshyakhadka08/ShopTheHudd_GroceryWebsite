<?php
require('connect.php');
// $codess = [142,321,123,561,456,987,123,653];
$codess =[142223,32111,123743,561111,456111,987000,123670,653232];
function inputdata($data) {  
    $data = trim($data);  
    $data = stripslashes($data);  
    $data = htmlspecialchars($data);  
    return $data;  
  }  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<body>
    <?php
    $loginstat = "0";
    $userid = $_SESSION['sessionid'];
    $extractedusers = oci_parse($conn, "SELECT * FROM USERR WHERE STATUS = :loginstat AND USER_ID = :userid ");
    oci_bind_by_name($extractedusers, ":userid", $userid);
    oci_bind_by_name($extractedusers, ":loginstat", $loginstat);
    oci_execute($extractedusers);


    ?>
    <?php $row = oci_fetch_array($extractedusers, OCI_ASSOC);

    if ($row['STATUS'] == "0") {
        ?>
        <form action="customerpath.php" method = "post">

            <div class="form-group">
                <label for="exampleInputPassword1">Access Code:</label>
                <input type="number" class="form-control" id="" name = "accesscode" placeholder="Access Code">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>

        <?php

        if (isset($_POST['accesscode'])){


            if (in_array($_POST['accesscode'],$codess)){
                
                $useridd = $_SESSION['sessionid'];
                $stringcode = "1";
                $extracteduserss = oci_parse($conn, "UPDATE USERR SET STATUS = :stat WHERE USER_ID = :useridd");
                oci_bind_by_name($extracteduserss, ":stat", $stringcode);
                oci_bind_by_name($extracteduserss, ":useridd", $useridd);
                oci_execute($extracteduserss);
                echo '<script>window.location.href = "customer.php";</script>';

            }

            else{
                echo "Wrong Code";
               
            }

        }

    }

    // else if ($row['STATUS'] == "1"){

    //     echo '<script>window.location.href = "customer.php";</script>';

    // }
    else{
        echo '<script>window.location.href = "customer.php";</script>';
    }



    ?>

</body>

</html>