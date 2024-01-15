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
                    <h4 style="margin-left: 20px">Personal Information
                        </h4>
                    </div>
                    <div class="card-body">

                    <?php
                        if(isset($_GET['id']))
                        {
                            $id = $_GET['id'];
                            $users = "SELECT
                            onlinetutorial.user_accounts.user_id, 
                            onlinetutorial.user_accounts.firstname, 
                            onlinetutorial.user_accounts.middlename, 
                            onlinetutorial.user_accounts.lastname, 
                            onlinetutorial.user_accounts.suffix, 
                            onlinetutorial.user_accounts.email, 
                            onlinetutorial.user_accounts.phone_number, 
                            onlinetutorial.tutee.*
                        FROM
                            onlinetutorial.user_accounts
                            INNER JOIN
                            onlinetutorial.tutee
                            ON 
                                onlinetutorial.user_accounts.user_id = onlinetutorial.tutee.user_id
                        WHERE
                            onlinetutorial.user_accounts.user_id = '$id'";
                            $users_run = mysqli_query($con, $users);

                            if(mysqli_num_rows($users_run) > 0)
                            {
                                foreach($users_run as $user)
                                {
                             ?>
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="user_id" value="<?=$user['user_id'];?>">

                     <div class="row">

                     <div class="col-md-4 mb-3">
                     <label for=""><strong>Full Name</strong></label>
                      <p class="form-control-plaintext"><?=$user['firstname'];?> <?=$user['middlename'];?> <?=$user['lastname'];?> <?=$user['suffix'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Email</strong></label>
                    <p class="form-control-plaintext"><?=$user['email'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Phone Number</strong></label>
                    <p class="form-control-plaintext"><?=$user['phone_number'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Gender</strong></label>
                    <p class="form-control-plaintext"><?=$user['gender'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Address</strong></label>
                    <p class="form-control-plaintext"><?=$user['address'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Zip Code</strong></label>
                    <p class="form-control-plaintext"><?=$user['zipcode'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Barangay</strong></label>
                    <p class="form-control-plaintext"><?=$user['barangay'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Municipality</strong></label>
                    <p class="form-control-plaintext"><?=$user['municipality'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Province</strong></label>
                    <p class="form-control-plaintext">Misamis Occidental</p>
                    </div>

                    <div class="col-md-6 mb-3">
                    <label for=""><strong>About Me</strong></label>
                    <textarea class="form-control-plaintext" disabled><?=$user['aboutme'];?></textarea>
                    </div>

                               <!-- <div class="col-md-6 text-center">
                               
                               <?php 
                                       echo '<img class="img-fluid img-bordered-sm" src = "data:image;base64,'.base64_encode($user['profile_picture']).'" 
                                       alt="image" style="max-height; max-width: 310px; object-fit: cover;">';
                                       ?>
                               </div>

                               <div class="col-md-6 text-center">
                               
                               <?php 
                                       echo '<img class="img-fluid img-bordered-sm" src = "data:image;base64,'.base64_encode($user['back']).'" 
                                       alt="image" style="max-height; max-width: 310px; object-fit: cover;">';
                                       ?>
                               </div>         -->
                       

                               <div class="col-md-12">
    <a class="btn btn-danger" href="" role="button" style="float:right; margin-left: 10px;">Delete</a>

    <a class="btn btn-primary" href="teacher.php" role="button" style="float:right;">Back</a>
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







