<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>

<style>
.card {
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: 1rem;
}

.card-body {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.5rem 1.5rem;
}
.avatar-text {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    background: #000;
    color: #fff;
    font-weight: 700;
}

.avatar {
    width: 3rem;
    height: 3rem;
}
.rounded-3 {
    border-radius: 0.5rem!important;
}
.mb-2 {
    margin-bottom: 0.5rem!important;
}
.me-4 {
    margin-right: 1.5rem!important;
}
</style>

<div class="pagetitle">
      <h1>Tutorial Services</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Tutorial Services</li>
        </ol>
      </nav>
    </div>


<div class="container">
  <div class="mt-2">

  <?php
      require '../admin/config/config.php';

      $query = "SELECT
      job.job_id, 
      job.user_id, 
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
      tutor.skills, 
      user_accounts.firstname, 
      user_accounts.middlename, 
      user_accounts.lastname, 
      tutor.address
    FROM
      job
      INNER JOIN
      user_accounts
      ON 
        job.user_id = user_accounts.user_id
      INNER JOIN
      tutor
      ON 
        user_accounts.user_id = tutor.user_id
    ORDER BY
      job.date_posted DESC";
      $query_run = mysqli_query($con, $query);
      $check_job = mysqli_num_rows($query_run) > 0;

      if($check_job)
      {
        while($row = mysqli_fetch_array($query_run))
        {
          ?>
    <div class="card mb-3">
      <div class="card-body">
        <div class="d-flex flex-column flex-lg-row">
          <div class="row flex-fill">
            <div class="col-sm-5">
              <h4 class="h5"><?php echo $row['title']; ?></h4>
              <span class="badge bg-secondary"><?php echo $row['address']; ?></span> <span class="badge bg-success"><?php echo $row['status']; ?></span>
            </div>
            <div class="col-sm-4 py-2">
            <div class="mt-2 mt-lg-0 d-flex flex-wrap align-items-start gap-1">
                                    <?php
                                    $skills = explode(',', $row['skills']);
                                    foreach ($skills as $skills) {
                                        echo '<span class="badge bg-secondary">' . trim($skills) . '</span>';
                                    }
                                    ?>
                                </div>
            </div>
            <div class="col-sm-3 text-lg-end">
              <a href="search_view.php?id=<?=$row['job_id'];?>" class="btn btn-primary stretched-link">Apply</a>
            </div>
          </div>
        </div>
      </div>
    </div>
          <?php
        }
      }
      else{
        echo "No Job Posted";
      }

  ?>
  </div>
</div>






<?php
 include("./include/footer.php");
?>