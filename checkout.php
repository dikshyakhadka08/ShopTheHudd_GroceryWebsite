<?php
require('connection.php'); // Include your database connection file

if (isset($_SESSION['collection_date']) && isset($_SESSION['collection_time'])) {
    $selectedDate = $_SESSION['collection_date'];
    $selectedTime = $_SESSION['collection_time'];
    
    // Get the current date and time
    $currentDate = date('d-m-Y');
    $currentTime = date('H:i');

    // Calculate the next available collection date and time
    $nextAvailableDateTime = date('d-m-Y H:i', strtotime('+1 day'));
    $nextAvailableDate = date('d-m-Y', strtotime('+1 day'));

    // Determine the next available collection day
    while (date('D', strtotime($nextAvailableDate)) !== 'Wed' && date('D', strtotime($nextAvailableDate)) !== 'Thu' && date('D', strtotime($nextAvailableDate)) !== 'Fri') {
        $nextAvailableDateTime = date('d-m-Y H:i', strtotime($nextAvailableDate.' +1 day'));
        $nextAvailableDate = date('d-m-Y', strtotime($nextAvailableDate.' +1 day'));
    }

    // Determine the next available time slot
    $nextAvailableTime = '';
    if ($nextAvailableDate === $currentDate) {
        if ($currentTime < '10:00') {
            $nextAvailableTime = date('D', strtotime($nextAvailableDate)).' 10-13';
        } elseif ($currentTime < '13:00') {
            $nextAvailableTime = date('D', strtotime($nextAvailableDate)).' 13-16';
        } elseif ($currentTime < '16:00') {
            $nextAvailableTime = date('D', strtotime($nextAvailableDate)).' 16-19';
        } elseif ($currentTime < '19:00') {
            $nextAvailableDate = date('d-m-Y', strtotime($nextAvailableDate.' +1 day'));
            while (date('D', strtotime($nextAvailableDate)) !== 'Wed' && date('D', strtotime($nextAvailableDate)) !== 'Thu' && date('D', strtotime($nextAvailableDate)) !== 'Fri') {
                $nextAvailableDateTime = date('d-m-Y H:i', strtotime($nextAvailableDate.' +1 day'));
                $nextAvailableDate = date('d-m-Y', strtotime($nextAvailableDate.' +1 day'));
            }
            $nextAvailableTime = date('D', strtotime($nextAvailableDate)).' 10-13';
        }
    } else {
        $nextAvailableTime = date('D', strtotime($nextAvailableDate)).' 10-13';
    }

    // Compare the selected date and time with the next available date and time
    if ($selectedDate === $nextAvailableDate && $selectedTime >= $nextAvailableTime) {
        $_SESSION['slotfortime'] = $selectedDate.'-'.$selectedTime;
        echo "<script>window.location.href = 'form.php';</script>";
        exit;
    } else {
        $_SESSION['collection_date'] = $nextAvailableDate;
        $_SESSION['collection_time'] = $nextAvailableTime;
        echo "<script>window.location.href = 'form.php';</script>";
        exit;
    }
} else {
    // Redirect to the cart page if the required session data is not set
    echo "<script>window.location.href = 'cartpage.php';</script>";
    exit;
}
?>
