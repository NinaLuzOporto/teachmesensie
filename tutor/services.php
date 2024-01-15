<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>

<div class="pagetitle">
      <h1>My Tutorial Services</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">My Services</li>
        </ol>
      </nav>
    </div>



    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tutorial Information</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date Posted</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                        <?php
                        $user_id = $_SESSION['auth_user']['user_id'];
                        $query = "SELECT
                        onlinetutorial.job.job_id, 
                        onlinetutorial.job.user_id, 
                        onlinetutorial.job.title, 
                        onlinetutorial.job.description, 
                        onlinetutorial.job.rate, 
                        onlinetutorial.job.rate_description, 
                        onlinetutorial.job.`status`, 
                        onlinetutorial.job.date_posted
                      FROM
                        onlinetutorial.job
                      WHERE
                        onlinetutorial.job.user_id = '$user_id'
                      ORDER BY
                        onlinetutorial.job.date_posted ASC";
                        $query_run = mysqli_query($con, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                        ?>
                                <tr>

                                    <td><?= $row['title']; ?></td>
                                    <td><?= $row['description']; ?></td>     
                                    <td><?= $row['rate']; ?> / <?= $row['rate_description']; ?></td> 
                                    <td><?= $row['status']; ?></td>     
                                    <td><?= $row['date_posted']; ?></td>           
                                    <td class="text-center">

                                    <a type="button" class="btn btn-primary" href="services_view.php?id=<?=$row['job_id'];?>"><i class="bi bi-eye"></i></a>
                                    
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