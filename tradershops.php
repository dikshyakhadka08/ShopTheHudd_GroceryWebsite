<?php

require('connectsession.php');
error_reporting(0);
$iduser = $_SESSION['id'];

// Check if the enable button is pressed
if (isset($_POST['enable'])) {
    $shopId = $_POST['enable']; // Get the SHOP_ID from the button value

    // Update the shop status to 1 (enable)
    $updateQuery = "UPDATE SHOP SET SHOP_STATUS = 1 WHERE SHOP_ID = $shopId";
    $updateStatement = oci_parse($conn, $updateQuery);
    oci_execute($updateStatement);
}

// Check if the disable button is pressed
if (isset($_POST['disable'])) {
    $shopId = $_POST['disable']; // Get the SHOP_ID from the button value

    // Update the shop status to 0 (disable)
    $updateQuery = "UPDATE SHOP SET SHOP_STATUS = 0 WHERE SHOP_ID = $shopId";
    $updateStatement = oci_parse($conn, $updateQuery);
    oci_execute($updateStatement);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Trader Shops</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../dist/main.css" />
    <style>
        .status-enable {
            background-color: #c3e6cb; /* Green color */
            box-shadow: 0 0 10px #c3e6cb; /* Green glow */
        }

        .status-disable {
            background-color: #f5c6cb; /* Red color */
            box-shadow: 0 0 10px #f5c6cb; /* Red glow */
        }

        /* Hide the default checkbox style */
        .status-checkbox input[type="checkbox"] {
            display: none;
        }

        /* Style the custom checkbox */
        .status-checkbox span {
            display: inline-block;
            width: 16px;
            height: 16px;
            border-radius: 3px;
            border: 1px solid #ccc;
            cursor: pointer;
        }

        /* Style the custom checkbox when checked (green color) */
        .status-checkbox input[type="checkbox"]:checked + span {
            background-color: #c3e6cb;
        }

        /* Style the custom checkbox when checked and disabled (red color) */
        .status-checkbox input[type="checkbox"]:checked:disabled + span {
            background-color: #f5c6cb;
        }

        /* Style the custom checkbox when disabled (red color) */
        .status-checkbox input[type="checkbox"]:disabled + span {
            background-color: #f5c6cb;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>
    <?php require('includes/header.php'); ?>
    <div class="container">
        <h1>Trader Shops</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>SHOP ID</th>
                    <th>SHOP NAME</th>
                    <th>TRADER TYPE</th>
                    <th></th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Assuming you have established a database connection using OCI

                // Query to fetch the trader shop data from the SHOP table
                $query = "SELECT SHOP_ID, SHOP_NAME, TRADER_TYPE, SHOP_STATUS FROM SHOP WHERE USER_ID = $iduser";

                // Prepare the statement
                $statement = oci_parse($conn, $query);

                // Bind the user ID parameter


                // Execute the query
                oci_execute($statement);

                // Check if any rows are returned
                if (($row = oci_fetch_assoc($statement)) !== false) {
                    do {
                        $rowColorClass = ($row['SHOP_STATUS'] == 1) ? 'status-enable' : 'status-disable';
                        $statusText = ($row['SHOP_STATUS'] == 1) ? 'Enabled' : 'Disabled';

                        echo '<tr class="' . $rowColorClass . '">';
                        echo '<td>' . $row['SHOP_ID'] . '</td>';
                        echo '<td>' . $row['SHOP_NAME'] . '</td>';
                        echo '<td>' . $row['TRADER_TYPE'] . '</td>';
                        echo '<td class="status-checkbox">';
                        echo '<label>';
                        echo '<input type="checkbox" disabled="disabled" checked="checked">';
                        echo '<span></span>';
                        echo '</label>';
                        echo '</td>';
                        echo '<td>';
                        echo '<form method="post" style="display: inline-block;">';
                        echo '<input type="hidden" name="enable" value="' . $row['SHOP_ID'] . '">';
                        echo '<button type="submit" class="btn btn-primary">Enable</button>';
                        echo '</form>';
                        echo '<form method="post" style="display: inline-block;">';
                        echo '<input type="hidden" name="disable" value="' . $row['SHOP_ID'] . '">';
                        echo '<button type="submit" class="btn btn-danger">Disable</button>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    } while (($row = oci_fetch_assoc($statement)) !== false);
                } else {
                    echo '<tr>';
                    echo '<td colspan="5">No trader shops found.</td>';
                    echo '</tr>';
                }

                // Close the statement and the database connection

                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <button id="alertButton" class="btn btn-primary">Add New Shop</button>

    <script>
        $(document).ready(function() {
            $('#alertButton').click(function() {
                alert('Limit Exceeded');
            });
        });
    </script>
</body>
</html>

