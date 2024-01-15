<?php
 include("./include/authentication.php");



 if(isset($_POST['apply']))
 {
     $user_id = $_SESSION['auth_user']['user_id'];
     $job_id = $_POST['job_id'];
     $tutor = $_POST['tutor'];
     $status = "Pending";
 
     $query = "INSERT INTO `job_application`(`job_id`, `tutor_id`, `user_id`) VALUES ('$job_id','$tutor','$user_id')";
     $query_run = mysqli_query($con, $query);
     
     if($query_run)
     {
         $_SESSION['status'] = "Applied!";
         $_SESSION['status_code'] = "success";
         header("Location: index.php");
         exit(0);
     }
     else
     {
         $_SESSION['status'] = "There is an error!";
         $_SESSION['status_code'] = "danger";
         header("Location: index.php");
         exit(0);
     }
 }

 if(isset($_POST['submit_payment']))
 {
     $user_id = $_SESSION['auth_user']['user_id'];
    //  $reference = $_POST['reference'];
    //  $subs = $_POST['subscriptiontype'];
    //  $mop = $_POST['mop'];
    //  $receipt = $_FILES['receipt'];
     $gender = $_POST['gender'];
     $address = $_POST['address'];
     $barangay = $_POST['barangay'];
     $municipality = $_POST['municipality'];
     $zipcode = $_POST['zipcode'];
     $aboutme = $_POST['aboutme'];
 
    //  $query = "INSERT INTO `subscriptions`(`user_id`, `subscription_type`, `reference`, `modeofpayment`, `receipt`) VALUES ('$user_id','$subs','$reference','$mop','$receipt')";
    //  $query_run = mysqli_query($con, $query);
     
     $profile_picture = ''; // Set a default value
     if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
         $profile_picture = addslashes(file_get_contents($_FILES['profile_picture']['tmp_name']));
     }
 
     // Use prepared statements to prevent SQL injection
     $query1 = "INSERT INTO `tutee`(`user_id`, `gender`, `address`, `barangay`, `municipality`, `zipcode`, `aboutme`, `profile_picture`) VALUES ('$user_id','$gender','$address','$barangay','$municipality','$zipcode','$aboutme','$profile_picture')";
     
     $query_run1 = mysqli_query($con, $query1);
     if($query_run1)
     {
       header('Location: process_subscription.php');
         exit(0);
     }
     else
     {
        echo "Error: " . mysqli_error($con);
     }
 }










?>