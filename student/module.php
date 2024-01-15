<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>

<div class="pagetitle">
      <h1>My Module</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">My Module</li>
        </ol>
      </nav>
    </div>



    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Module</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Module</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                        <?php
                        $user_id = $_SESSION['auth_user']['user_id'];
                        $query = "SELECT
                        job_module.module_title, 
                        job_module.module_description, 
                        job.title, 
                        job_application.`status`, 
                        job_application.user_id, 
                        job_module.module_id
                    FROM
                        job_module
                        INNER JOIN
                        job
                        ON 
                            job_module.job_id = job.job_id
                        INNER JOIN
                        job_application
                        ON 
                            job.job_id = job_application.job_id
                    WHERE
                        job_application.user_id = '$user_id' AND
                        job_application.`status` = 'Ongoing'";
                        $query_run = mysqli_query($con, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                        ?>
                                <tr>

                                     <td><b><?= $row['title']; ?></b></td>
                                    <td><?= $row['module_title']; ?></td>
                                    <td><?= $row['module_description']; ?></td>   
                                    <td width="100px">
                                    <form action="process.php" method="POST">  
                                    <div class="btn-group" rolez="group" aria-label="Basic outlined example">
                                    <a type="button" class="btn btn-outline-primary" href="module_files.php?id=<?=$row['module_id'];?>">View</a>
                                    </div>
                                    </form>
                                    </td>

                        
                                </tr>
                        <?php
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="4">No Record Found</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>










<?php
 include("./include/footer.php");
?>