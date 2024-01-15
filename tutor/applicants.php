<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>

<div class="pagetitle">
      <h1>Applicants</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">My Applicants</li>
        </ol>
      </nav>
    </div>



    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Applicant's Information</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                  <th scope="col">Applicant Name</th>
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date Applied</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>


                <?php

                $user_id = $_SESSION['auth_user']['user_id'];
                $query = "SELECT
                user_accounts.firstname, 
                user_accounts.middlename, 
                user_accounts.lastname, 
                job_application.user_id, 
                job_application.tutor_id, 
                job_application.job_id, 
                job_application.date_applied, 
                job_application.application_id, 
                job_application.`status`, 
                job.title, 
                job.description, 
                job.rate, 
                job.rate_description, 
                job.`day`, 
                job.time_from, 
                job.time_to, 
                job.custome, 
                user_accounts.email, 
                user_accounts.phone_number, 
                tutee.profile_picture
              FROM
                job_application
                INNER JOIN
                user_accounts
                ON 
                  job_application.user_id = user_accounts.user_id
                INNER JOIN
                job
                ON 
                  job_application.job_id = job.job_id
                INNER JOIN
                tutee
                ON 
                  user_accounts.user_id = tutee.user_id
              WHERE
                job_application.tutor_id = '$user_id'
              ORDER BY
                job_application.date_applied DESC";
                $query_run = mysqli_query($con, $query);
                if(mysqli_num_rows($query_run) > 0)
                {
                foreach($query_run as $row)
                {
                ?>
                    <tr>
                <td><b><?= $row['firstname']; ?> <?= $row['middlename']; ?> <?= $row['lastname']; ?></b></td>
                <td><?= $row['title']; ?></td>
                <td><?= $row['status']; ?></td>
                <td><?= date('Y-m-d', strtotime($row['date_applied'])); ?></td>



                <td class="text-center">

                <a type="button" class="btn btn-primary" href="applicant_view.php?id=<?=$row['application_id'];?>"><i class="bi bi-eye"></i></a>
              </td>
                    </tr>

                    <?php
                }
                } else
                {
                ?>
                <tr>
                <td colspan="6">No Record Found</td>
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