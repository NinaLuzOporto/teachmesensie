<?php
 include("./include/authentication.php");


 if (isset($_POST['create_tutoring_services'])) {
    $tutor_id = $_SESSION['auth_user']['user_id'];
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $rate = mysqli_real_escape_string($con, $_POST['rate']);
    $rate_description = mysqli_real_escape_string($con, $_POST['rate_description']);

    $currentDateTime = date('Y-m-d H:i:s');
    $day = $_POST['day'];
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];

    $custom = $_POST['custom'];

    // Insert data into the job table
    $queryJob = "INSERT INTO `job`(`user_id`, `title`, `description`, `rate`, `rate_description`, `day`, `time_from`, `time_to`, `custome`, `date_posted`) VALUES ('$tutor_id','$title','$description','$rate','$rate_description','$day','$starttime','$endtime','$custom','$currentDateTime')";
    $query_run_job = mysqli_query($con, $queryJob);

    if ($query_run_job) {
        $jobId = $con->insert_id;  // Get the ID of the inserted row (assumes `id` is the primary key in `job`)

        // Insert data into the job_module table
        if (isset($_POST["module"]) && is_array($_POST["module"])) {
            foreach ($_POST["module"] as $key => $moduleName) {
                $moduleDesc = mysqli_real_escape_string($con, $_POST["moduledesc"][$key]);
                $queryModule = "INSERT INTO `job_module` (`job_id`, `module_title`, `module_description`) VALUES ('$jobId', '$moduleName', '$moduleDesc')";
                $query_run_module = mysqli_query($con, $queryModule);
            }
        }

        $_SESSION['status'] = "Your job has been posted!";
        $_SESSION['status_code'] = "success";
        header('Location: services.php');
        exit(0);
    } else {
        $_SESSION['status'] = "Failed to insert job data.";
        $_SESSION['status_code'] = "error";
        header('Location: services.php');
        exit(0);
    }
}




if(isset($_POST['update_services']))
{
    $job_id= $_POST['job_id'];
    $title= $_POST['title'];
    $description= $_POST['description'];
    $rate= $_POST['rate'];
    $rate_description= $_POST['rate_description'];
    $status= $_POST['status'];

    $query = "UPDATE `job` SET `title`='$title',`description`='$description',`rate`='$rate',`rate_description`='$rate',`status`='$status' WHERE `job_id` = '$job_id'";
    $query_run = mysqli_query($con, $query);
    
    if($query_run)
    {
        $_SESSION['status'] = "Tutorial Information Updated";
        $_SESSION['status_code'] = "success";
        header('Location: services.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Something is wrong!";
        $_SESSION['status_code'] = "error";
        header('Location: services.php');
        exit(0);
    }
}

if(isset($_POST['delete_services']))
{
    $job_id= $_POST['job_id'];

    $query = "DELETE FROM `job` WHERE `job_id` = '$job_id'";
    $query_run = mysqli_query($con, $query);
    
    if($query_run)
    {
        $_SESSION['status'] = "Tutorial Service Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: services.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Something went wrong!";
        $_SESSION['status_code'] = "error";
        header('Location: services.php.php');
        exit(0);
    }
}


if (isset($_POST['add_file'])) {
    // Retrieve form data
    $module_id = $_POST['module_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // File upload handling
    $uploadDir = '../uploads/'; // Directory to store uploaded files
    $fileName = $_FILES['fileInput']['name'];
    $fileTmpName = $_FILES['fileInput']['tmp_name'];
    $fileType = $_FILES['fileInput']['type'];

    // Move the uploaded file to the server
    $filePath = $uploadDir . $fileName;

    // Check if the directory exists, if not, create it
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($fileTmpName, $filePath)) {
        // File has been moved successfully
        $query = "INSERT INTO `job_module_files`(`module_id`, `title`, `description`, `file_name`, `file_type`, `file_path`) VALUES ('$module_id','$title','$description','$fileName','$fileType','$filePath')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $_SESSION['status'] = "File has been added successfully";
            $_SESSION['status_code'] = "success";
            header('Location: module.php');
            exit(0);
        } else {
            $_SESSION['status'] = "Error adding file to the database";
            $_SESSION['status_code'] = "error";
            header('Location: module.php');
            exit(0);
        }
    } else {
        // File move failed
        $_SESSION['status'] = "Error moving the file to the server";
        $_SESSION['status_code'] = "error";
        header('Location: learning_resources.php');
        exit(0);
    }
}

if(isset($_POST['submit_payment']))
{
    $user_id = $_SESSION['auth_user']['user_id'];
    $reference = $_POST['reference'];
    $subs = $_POST['subscriptiontype'];
    $mop = $_POST['mop'];
    $receipt = $_FILES['receipt'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $barangay = $_POST['barangay'];
    $municipality = $_POST['municipality'];
    $zipcode = $_POST['zipcode'];
    $aboutme = $_POST['aboutme'];
    $skills_string = implode(', ', $_POST['skills']);

      // Handle file uploads
      $resume_file_path = ''; // Set a default value
      if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
          $resume_file_path = 'uploads/' . basename($_FILES['resume']['name']);
          move_uploaded_file($_FILES['resume']['tmp_name'], $resume_file_path);
      }
  
      $profile_picture = ''; // Set a default value
      if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
          $profile_picture = addslashes(file_get_contents($_FILES['profile_picture']['tmp_name']));
      }
  
      // Use prepared statements to prevent SQL injection
      $query1 = "INSERT INTO `tutor`(`user_id`, `gender`, `address`, `barangay`, `municipality`, `zipcode`, `aboutme`, `skills`, `resume_file_path`, `profile_picture`) VALUES ('$user_id','$gender','$address','$barangay','$municipality','$zipcode','$aboutme','$skills_string','$resume_file_path','$profile_picture')";
      
      $query_run1 = mysqli_query($con, $query1);

    $query = "INSERT INTO `subscriptions`(`user_id`, `subscription_type`, `reference`, `modeofpayment`, `receipt`) VALUES ('$user_id','$subs','$reference','$mop','$receipt')";
    $query_run = mysqli_query($con, $query);
    
    if($query_run || $query_run1)
    {
      header('Location: process_subscription.php');
        exit(0);
    }
    else
    {
      header('Location: student_manage.php');
        exit(0);
    }
}


if (isset($_POST['accept'])) {
    $applicationId = $_POST['id'];
    $status1 = "Accept";
    $job = $_POST['job_id'];
    $status = "Ongoing";
    
    $query = "UPDATE `job_application` SET `status`='$status1' WHERE `application_id`= $applicationId";
    $query_run = mysqli_query($con, $query);

    $query1 = "UPDATE `job` SET `status`='$status' WHERE `job_id` = $job";
    $query_run1 = mysqli_query($con, $query1);
    
    if($query_run && $query_run1)
    {
        $_SESSION['status'] = "Application Accepted";
        $_SESSION['status_code'] = "success";
      header('Location: applicants.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Something went wrong!";
        $_SESSION['status_code'] = "error";
      header('Location: applicants.php');
        exit(0);
    }

} 


if (isset($_POST['reject'])) {
    $applicationId = $_POST['id'];
    $job = $_POST['job_id'];
    $status1 = "Rejected";
    $status = "Pending";
    
    $query1 = "UPDATE `job_application` SET `status`='$status1' WHERE `application_id`= $applicationId";
    $query_run = mysqli_query($con, $query1);
    
    $query1 = "UPDATE `job` SET `status`='$status' WHERE `job_id` = $job";
    $query_run1 = mysqli_query($con, $query1);
    if($query_run || $query_run1)
    {
        $_SESSION['status'] = "Application Rejected";
        $_SESSION['status_code'] = "error";
      header('Location: applicants.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Something went wrong!";
        $_SESSION['status_code'] = "error";
      header('Location: applicants.php');
        exit(0);
    }

}



?>