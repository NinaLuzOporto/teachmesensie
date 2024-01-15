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
                    <h4 style="margin-left: 20px">Tutorial Information
                        </h4>
                    </div>
                    <div class="card-body">

                    <?php
                        if(isset($_GET['id']))
                        {
                            $id = $_GET['id'];
                            $users = "SELECT
                            onlinetutorial.job.*
                        FROM
                            onlinetutorial.job
                        WHERE
                            onlinetutorial.job.job_id = '$id'";
                            $users_run = mysqli_query($con, $users);

                            if(mysqli_num_rows($users_run) > 0)
                            {
                                foreach($users_run as $user)
                                {
                             ?>
                        <form action="process.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="job_id" value="<?=$user['job_id'];?>">

                     <div class="row">

                     <div class="col-md-12 mb-3">
                            <label for=""><strong>Job Title</strong></label>
                                <input required type="text" name="title" value="<?=$user['title'];?>" class="form-control" maxlength="80">
                            </div>

                    <div class="col-md-12 mb-3">
                    <label for=""><strong>Description</strong></label>
                        <textarea class="form-control" name="description" rows="7"  maxlength="200"><?=$user['description'];?></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                    <label for=""><strong>Rate</strong></label>
                    <input required type="text" value="<?=$user['rate'];?>" name="rate" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                    <label for=""><strong>Rate Description</strong></label>
                    <select name="rate_description" required class="form-control">
                        <option value="Hour">Hour</option>
                        <option value="Day">Day</option>
                        <option value="Session">Session</option>
                    </select>
                   </div>

                   <div class="col-md-12 mb-3">
                    <label for=""><strong>Status</strong></label>
                    <select name="status" required class="form-control">
                        <option value="Active">Active</option>
                        <option value="Ongoing">Ongoing</option>
                    </select>
                   </div>


    <div class="col-md-12">

    <button type="submit" name="update_services" class="btn btn-secondary" style="float:right; margin-left: 10px;">Save Changes</button>

    <button type="submit" name="delete_services" class="btn btn-danger" style="float:right; margin-left: 10px;">Delete</button>

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







