<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>

<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-title">
                    <h4 style="margin-left: 20px">Applicant Information
                        </h4>
                    </div>
                    <div class="card-body">

                    <?php
                        if(isset($_GET['id']))
                        {
                            $id = $_GET['id'];
                            $users = "SELECT
                            job_application.application_id, 
                            job_application.date_applied, 
                            job_application.`status`, 
                            job.job_id,
                            job.title, 
                            job.description, 
                            job.rate, 
                            job.rate_description, 
                            job.`day`, 
                            job.time_from, 
                            job.time_to, 
                            job.custome, 
                            job.`status`, 
                            job.date_posted, 
                            user_accounts.firstname, 
                            user_accounts.middlename, 
                            user_accounts.lastname, 
                            user_accounts.suffix, 
                            user_accounts.email, 
                            user_accounts.phone_number, 
                            tutee.gender, 
                            tutee.address, 
                            tutee.barangay, 
                            tutee.municipality, 
                            tutee.aboutme, 
                            tutee.zipcode, 
                            tutee.profile_picture
                        FROM
                            job
                            INNER JOIN
                            job_application
                            ON 
                                job.job_id = job_application.job_id
                            INNER JOIN
                            user_accounts
                            ON 
                                job_application.user_id = user_accounts.user_id
                            INNER JOIN
                            tutee
                            ON 
                                user_accounts.user_id = tutee.user_id
                        WHERE
                            job_application.application_id = '$id'
                        ORDER BY
                            job.date_posted DESC";
                            $users_run = mysqli_query($con, $users);

                            if(mysqli_num_rows($users_run) > 0)
                            {
                                foreach($users_run as $user)
                                {
                             ?>
                        <form action="process.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="application_id" value="<?=$user['application_id'];?>">

                     <div class="row">

                     <div class="col-md-4 mb-3">
                            <label for=""><strong>Full Name</strong></label>
                                <input  type="text" name="title" value="<?=$user['firstname'];?> <?=$user['middlename'];?> <?=$user['lastname'];?> <?=$user['suffix'];?>" class="form-control-plaintext" maxlength="80">
                            </div>

                            <div class="col-md-4 mb-3">
                            <label for=""><strong>Email Address</strong></label>
                                <input  type="text" name="title" value="<?=$user['email'];?>" class="form-control-plaintext" maxlength="80">
                            </div>

                            <div class="col-md-4 mb-3">
                            <label for=""><strong>Phone Number</strong></label>
                                <input  type="text" name="title" value="<?=$user['phone_number'];?>" class="form-control-plaintext" maxlength="80">
                            </div>

                            <div class="col-md-6 mb-3">
                            <label for=""><strong>Address</strong></label>
                                <input  type="text" name="title" value="<?=$user['address'];?>" class="form-control-plaintext">
                            </div>

                            <div class="col-md-6 mb-3">
                            <label for=""><strong>Gender</strong></label>
                                <input  type="text" name="title" value="<?=$user['gender'];?>" class="form-control-plaintext">
                            </div>

                <div class="row mt-4">
                <div class="col">
                  <hr class="my-4">
                </div>
                <div class="col-auto mt-2 mb-4">
                  <h4 class="text-primary">Tutor Information</h4c>
                </div>
                <div class="col">
                  <hr class="my-4">
                </div>
              </div>


                     <div class="col-md-12 mb-3">
                            <label for=""><strong>Job Title</strong></label>
                                <input  type="text" name="title" value="<?=$user['title'];?>" class="form-control-plaintext" maxlength="80">
                            </div>

                    <div class="col-md-12 mb-3">
                    <label for=""><strong>Description</strong></label>
                        <textarea class="form-control-plaintext" name="description" rows="4"  maxlength="200"><?=$user['description'];?></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                    <label for=""><strong>Rate</strong></label>
                    <input  type="text" value="<?=$user['rate'];?> / <?=$user['rate_description'];?>" name="rate" class="form-control-plaintext">
                    </div>

                    <div class="col-md-6 mb-3">
                    <label for=""><strong>Status</strong></label>
                    <input  type="text" value="<?=$user['status'];?>" name="status" class="form-control-plaintext">
                    </div>


    <div class="col-md-12">
    <form action="process.php" method="POST">

    <input type="hidden" name="job_id" value="<?= $user['job_id']; ?>">
    <input type="hidden" name="id" value="<?= $user['application_id']; ?>">
    <button type="submit" name="reject" class="btn btn-danger" style="float:right; margin-left: 10px;">Reject</button>


    <input type="hidden" name="job_id" value="<?= $user['job_id']; ?>">
    <input type="hidden" name="id" value="<?= $user['application_id']; ?>">
    <button type="submit" name="accept" class="btn btn-success" style="float:right; margin-left: 10px;">Accept</button>
    </form>




    <a class="btn btn-primary" href="applicants.php" role="button" style="float:right;">Back</a>

    </div>
                               </div>


                                </div>
                </form>
                <?php
                                }
                            }
                            else
                            {
                                ?>
                                <h4>No Record Found!</h4>
                                <?php
                            }
                        }
?>


                    </div>
                </div>
            </div>
        </div>

<?php
 include("./include/footer.php");
?>







