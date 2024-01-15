<?php
include('include/authentication.php');


if (isset($_POST['delete_subscription'])) {
    $id = $_POST['delete_subscription'];

    // Use prepared statements to prevent SQL injection
    $query = "UPDATE `subscriptions` SET `status`='Pending' WHERE `id` = $id";
    
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "Subscription has been rejected";
        $_SESSION['status_code'] = "error";
        header('Location: subscription.php');
        exit(0);
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}


if (isset($_POST['approve_subscription'])) {
    $id = $_POST['approve_subscription'];

    // Use prepared statements to prevent SQL injection
    $query = "UPDATE `subscriptions` SET `status`='Ongoing' WHERE `id` = $id";
    
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "Subscription has been aprroved";
        $_SESSION['status_code'] = "success";
        header('Location: subscription.php');
        exit(0);
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}

?>