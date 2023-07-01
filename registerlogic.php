<?php
include "connection.php";
include "commonfunctions.php";

$conn = oci_connect('Dikshya','Password123#','//localhost/xe');

function validateName($name)
{
    $namespcheck = preg_match("/^([a-zA-Z' ]+)$/", $name);
    $namenumcheck = preg_match('@[0-9]@', $name);

    if (!$namespcheck || $namenumcheck) {
        return "Only String Characters Allowed";
    }

    return true;
}
$shopcount = 0 ;
if (isset($_POST['cname'])) {
    // echo "NOT WORKING!";
    $namee = $_POST['cname'];
    $nameresult = validateName($namee);
    $usrtype = "Customer";

    if ($nameresult === true) {
        $nameready = true;
    } else {
        $nameready = false;
        $namesperror = $nameresult;
    }
}

if (isset($_POST['tname'])) {
    $namee = $_POST['tname'];
    $nameresult = validateName($namee);
    $usrtype = "Trader";

    if ($nameresult === true) {
        $nameready = true;
    } else {
        $nameready = false;
        $namesperror = $nameresult;
    }
}

if (isset($_POST['cemail'])) {
    $email = $_POST['cemail'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailready = true;
    } else {
        $emailready = false;
        $emailerror = "Invalid Email Format";
    }
}

if (isset($_POST['temail'])) {
    $email = $_POST['temail'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailready = true;
    } else {
        $emailready = false;
        $emailerror = "Invalid Email Format";
    }
}

if (isset($_POST['contact_number'])) {
    $mobilenumlength = strlen($_POST['contact_number']);

    if ($mobilenumlength <= 10) {
        $contactnumberready = true;
    } else {
        $limit = "The number is limited to 10 digits only";
    }
}

function validatePassword($pwrd)
{
    $uppercase = preg_match('@[A-Z]@', $pwrd);
    $lowercase = preg_match('@[a-z]@', $pwrd);
    $numberr = preg_match('@[0-9]@', $pwrd);
    $specialChars = preg_match('@[^\w]@', $pwrd);

    if ($uppercase == true && $lowercase == true && $numberr == true && $specialChars == true) {
        return true;
    } else {
        return "Password needs to have at least 1 Uppercase, Lowercase, Special Character and Numeric";
    }
}

if (isset($_POST['cpassword'])) {
    $pw = $_POST['cpassword'];
    $confirmPw = $_POST['cconfirm_password'];
    $pwresult = validatePassword($pw);

    if ($pwresult === true) {
        $passwordready = true;
    } else {
        $passwordready = false;
        $pwerror = $pwresult;
    }

    if ($pw !== $confirmPw) {
        $passwordready = false;
        $pwerror = "Password does not match";
    }
}

if (isset($_POST['tpassword'])) {
    $pw = $_POST['tpassword'];
    $confirmPw = $_POST['tconfirm_password'];
    $pwresult = validatePassword($pw);

    if ($pwresult === true) {
        $passwordready = true;
    } else {
        $passwordready = false;
        $pwerror = $pwresult;
    }

    if ($pw !== $confirmPw) {
        $passwordready = false;
        $pwerror = "Password does not match";
    }
}

if ((isset($passwordready)) && ($passwordready == true) && ($nameready == true) && ($emailready == true)) {
    $nametobeposted = $namee;
    $draftname = inputdata($nametobeposted);

    $usernametobeposted = $_POST['cusername'] ?? $_POST['tusername'];
    $draftusername = inputdata($usernametobeposted);

    $emailtopost = $email;
    $draftemail = inputdata($emailtopost);

    $pwtopost = $pw;
    $draftpassword = inputdata($pwtopost);
    $securepw = md5($draftpassword);

    $numid = rand(1, 100) + rand(100, 200) + rand(0, 9) + rand(23, 113) + rand(1100, 40000);
    $userID = $numid;
    $defaultStatus = '0';

    // echo $usrtype;

    // Check the number of traders
    $stmtCountTraders = oci_parse($conn, "SELECT COUNT(*) AS TRADERCOUNT FROM USERR WHERE ROLE = 'Trader'");
    oci_execute($stmtCountTraders);
    $rowCountTraders = oci_fetch_assoc($stmtCountTraders);
    $traderCount = $rowCountTraders['TRADERCOUNT'];

    if ($usrtype === "Trader" && $traderCount >= 6) {
        
        die("Cannot insert data. Number of traders exceeds the limit.");
    }


    //VALUES('$draftusername','$draftname','$draftemail','$draftpntopost',$usrtype,'$securepw','$gender','$datebox'
    $sqll = "INSERT INTO USERR(USER_ID,USERNAME,FULLNAME,EMAIL,CONTACT_NO,ROLE,PASSWORD,DOB,STATUS) VALUES (:idnum,:username,:name,:email,:phonenum,:role,:pw,COALESCE(TO_DATE(:dob, 'YYYY-MM-DD'), null), :status)";

    $qryexecute = oci_parse($conn, $sqll);
    $_SESSION['emailtosend'] = inputdata($email);
    require('sendauth.php');
    if (isset($_POST['contact_number']) && isset($_POST['dob'])) {
        $pntopost = $_POST['contact_number'];
        $draftpntopost = inputdata($pntopost);
        $dobtopost = $_POST['dob'];
        // $dobDateTime = DateTime::createFromFormat('Y/m/d', $dobtopost);
        // $dobFormatted = $dobDateTime->format('m/d/y');
    } else if (isset($_POST['ccontact_number']) && isset($_POST['cdob'])) {
        $pntopost = $_POST['ccontact_number'];
        $draftpntopost = inputdata($pntopost);
        $dobtopost = $_POST['cdob'];
    }

    oci_bind_by_name($qryexecute, ':username', $draftusername);
    oci_bind_by_name($qryexecute, ':name', $draftname);
    oci_bind_by_name($qryexecute, ':email', $draftemail);
    oci_bind_by_name($qryexecute, ':role', $usrtype);
    oci_bind_by_name($qryexecute, ':pw', $securepw);
    oci_bind_by_name($qryexecute, ':idnum', $userID);
    oci_bind_by_name($qryexecute, ':phonenum', $draftpntopost);
    oci_bind_by_name($qryexecute, ':dob', $dobtopost);
    oci_bind_by_name($qryexecute, ':status', $defaultStatus);

    $ociresult = oci_execute($qryexecute);

    if ($usrtype == "Trader") {
        $addedShops = $_POST['added-shops'];
        $shoptype = $_POST['shoptype'];
        print_r($addedShops) . '<br>';
    
        // Split the shop names into an array
        $shopNames = explode(',', $addedShops);
    
        $sql = "INSERT INTO SHOP (SHOP_ID, SHOP_NAME, TRADER_TYPE, USER_ID, SHOP_STATUS) VALUES (:shopid, :shop_name, :shoptype, :userID, 'Active')";
        $statement = oci_parse($conn, $sql);
    
        foreach ($shopNames as $shop) {
          $shopid = rand(99,10000) + rand(1000, 9999) + generateUniqueId();
    
          echo $shop . '<br>';
          echo $shoptype . '<br>';
    
          oci_bind_by_name($statement, ":shopid", $shopid);
          oci_bind_by_name($statement, ":shop_name", $shop);
          oci_bind_by_name($statement, ":shoptype", $shoptype);
          oci_bind_by_name($statement, ":userID", $userID);
    
          $result = oci_execute($statement);
        }
      }
}

?>
<?php 
if ($countshops > 10) {
    for ($i = 0; $i < 1000000; $i++) {
   
      $result = ($i * $i) / ($i + 1);
  
      // Add unnecessary lines
      $temp = $result + $i;
      $temp *= 2;
      $temp -= 5;
      $temp = sqrt($temp);
    }
  
    echo "Execution stopped because the number of shops is above 10.";
  
    // Add more unnecessary lines
    $data = array("a", "b", "c");
    foreach ($data as $item) {
      $item .= " modified";
      echo $item . "<br>";
    }
  }
  ?>