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
                    <h4 style="margin-left: 20px">Tutor's Information
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
                        <input type="hidden" name="tutor" value="<?= $user['user_id']; ?>">

                     <div class="row">

                     <div class="col-md-12 mb-3">
                            <label for=""><strong>Job Title</strong></label>
                            <p class="form-control-plaintext"><?=$user['title'];?></p>
                    </div>

                    <div class="col-md-12 mb-3">
                    <label for=""><strong>Description</strong></label>
                        <textarea class="form-control-plaintext" name="description" rows="4"  maxlength="200" disabled><?=$user['description'];?></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                    <label for=""><strong>Rate</strong></label>
                    <p class="form-control-plaintext"><?=$user['rate'];?> / <?=$user['rate_description'];?></p>
                    </div>

                   <div class="col-md-6 mb-3">
                    <label for=""><strong>Status</strong></label>
                    <p class="form-control-plaintext"><?=$user['status'];?></p>
                   </div>



                <div class="row mt-4">
                <div class="col">
                  <hr class="my-4">
                </div>
                <div class="col-auto mt-2 mb-4">
                  <h4 class="text-primary">SCHEDULING</h4c>
                </div>
                <div class="col">
                  <hr class="my-4">
                </div>
              </div>

              <div class="col-md-12 mb-3">
                            <p class="form-control-plaintext"><?=$user['day'];?> - <?=$user['time_from'];?> - <?=$user['time_to'];?></p>

                            <p class="form-control-plaintext"><?=$user['custome'];?></p>
              </div>

              <div class="row mt-4">
                <div class="col">
                  <hr class="my-4">
                </div>
                <div class="col-auto mt-2 mb-4">
                  <h4 class="text-primary">MODULES</h4c>
                </div>
                <div class="col">
                  <hr class="my-4">
                </div>
              </div>


              <div class="container">
                  <div class="col-md-12 mt-2">
                    
                  <?php
                  require '../admin/config/config.php';

                  $id = $_GET['id'];
                  $query = "SELECT
                  job_module.module_id, 
                  job_module.module_title, 
                  job_module.module_description, 
                  job_module.job_id
                FROM
                  job_module
                WHERE
                  job_module.job_id = '$id'";
                  $query_run = mysqli_query($con, $query);
                  $check_module = mysqli_num_rows($query_run) > 0;

                  if($check_module)
                  {
                    while($row = mysqli_fetch_array($query_run))
                    {
                      ?>
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $row['module_title'] ?></h5>
                      <?php echo $row['module_description'] ?>
                    </div> 
                  </div>
                      <?php
                    }
                  }
                  else
                  {
                    echo "No Module";
                  }

                  ?>
                  </div>
              </div>   

    <div class="col-md-12">

    <a class="btn btn-primary" href="application.php" role="button" style="float:right;">Back</a>

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







