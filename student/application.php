<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>

<div class="pagetitle">
      <h1>My Application</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">All Application</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Application</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                        <?php
                        $user_id = $_SESSION['auth_user']['user_id'];
                        $query = "SELECT
                        job.title, 
                        job.job_id,
                        job.description, 
                        job_application.user_id, 
                        job_application.`status`, 
                        job_application.date_applied
                    FROM
                        job_application
                        INNER JOIN
                        job
                        ON 
                            job_application.job_id = job.job_id
                    WHERE
                        job_application.user_id = $user_id
                    ORDER BY
                        job_application.date_applied DESC";
                        $query_run = mysqli_query($con, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                        ?>
                                <tr>

                                      <td width="100px"><?= $row['title']; ?></td>
                                    <td width="100px"><?= $row['description']; ?></td>
                                    <td width="100px" style="color: <?= $row['status'] === 'Accepted' ? 'green' : ($row['status'] === 'Rejected' ? 'red' : ($row['status'] === 'Ongoing' ? 'orange' : 'black')) ?>; font-weight: bold;">
                                    <?= $row['status'] ?>
                                    </td>                   
                                    <td class="text-center">

                                    <a type="button" class="btn btn-primary" href="application_view.php?id=<?=$row['job_id'];?>"><i class="bi bi-eye"></i></a>
                                    
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

            </div>
          </div>

        </div>
      </div>
    </section>



<?php
 include("./include/footer.php");
?>