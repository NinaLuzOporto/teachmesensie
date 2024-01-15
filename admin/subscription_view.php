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
                            onlinetutorial.subscriptions.*, 
                            onlinetutorial.user_accounts.firstname, 
                            onlinetutorial.user_accounts.middlename, 
                            onlinetutorial.user_accounts.lastname
                        FROM
                            onlinetutorial.subscriptions
                            INNER JOIN
                            onlinetutorial.user_accounts
                            ON 
                                onlinetutorial.subscriptions.user_id = onlinetutorial.user_accounts.user_id
                        WHERE
                            onlinetutorial.subscriptions.id = '$id'";
                            $users_run = mysqli_query($con, $users);

                            if(mysqli_num_rows($users_run) > 0)
                            {
                                foreach($users_run as $user)
                                {
                             ?>
                    <input type="hidden" name="user_id" value="<?=$user['user_id'];?>">

                     <div class="row">

                     <div class="col-md-12 mb-3">
                     <label for=""><strong>Full Name</strong></label>
                      <p class="form-control-plaintext"><?=$user['firstname'];?> <?=$user['middlename'];?> <?=$user['lastname'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Status</strong></label>
                    <p class="form-control-plaintext"><?=$user['status'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Subscription</strong></label>
                    <p class="form-control-plaintext"><?=$user['subscription_type'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Approved Date</strong></label>
                    <p class="form-control-plaintext"><?=$user['approved_date'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Expiration Date</strong></label>
                    <p class="form-control-plaintext"><?=$user['expiration_date'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Reference</strong></label>
                    <p class="form-control-plaintext"><?=$user['reference'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Mode of Payment</strong></label>
                    <p class="form-control-plaintext"><?=$user['modeofpayment'];?></p>
                    </div>

                    <label for=""><strong>Receipt</strong></label>
                             <div class="col-md-4 mb-3 text-center">
                               <?php 
                                       echo '<img class="img-fluid img-bordered-sm" src = "data:image;base64,'.base64_encode($user['receipt']).'" 
                                       alt="image" style="max-height: 350px; max-width: 350px; object-fit: cover;">';
                                       ?>
                               </div>

                             
                       

                               <div class="col-md-12">

                               <form action="process.php" method="POST">
    <input type="hidden" name="user_id" value="<?=$user['user_id'];?>">

    <button class="btn btn-danger" type="submit" name="delete_subscription" value="<?=$user['id'];?>" style="float:right; margin-left: 10px;">Reject</button>

    <button class="btn btn-success" type="submit" name="approve_subscription" value="<?=$user['id'];?>" style="float:right; margin-left: 10px;">Approve</button>

    <a class="btn btn-primary" href="subscription.php" role="button" style="float:right;">Back</a>
</form>
    </div>
                               </div>


                                </div>
             
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







