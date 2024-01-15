<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>


<section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">

          <?php
                        $user_id = $_SESSION['auth_user']['user_id'];
                        $users = "SELECT
                        user_accounts.user_id, 
                        user_accounts.firstname, 
                        user_accounts.middlename, 
                        user_accounts.lastname, 
                        user_accounts.suffix, 
                        user_accounts.email, 
                        user_accounts.phone_number, 
                        user_accounts.role, 
                        tutor.gender, 
                        tutor.address, 
                        tutor.barangay, 
                        tutor.municipality, 
                        tutor.zipcode, 
                        tutor.aboutme, 
                        tutor.profile_picture
                      FROM
                        user_accounts
                        INNER JOIN
                        tutor
                        ON 
                          user_accounts.user_id = tutor.user_id
                      WHERE
                        user_accounts.user_id = '$user_id'";
                        $users_run = mysqli_query($con, $users);
                        ?>
                        <?php
                        if (mysqli_num_rows($users_run) > 0) {
                            foreach ($users_run as $user) {
                        ?>
                                <form action="process.php" method="POST" enctype="multipart/form-data">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <?php 
                                               echo '<img class="rounded-circle" 
                                                   data-image="'.base64_encode($user['profile_picture']).'" 
                                                   src="data:image;base64,'.base64_encode($user['profile_picture']).'" 
                                                   alt="image" style="object-fit: cover;">'; 
                                           ?>

              <h2><?= $user['firstname']; ?> <?= $user['lastname']; ?></h2>
              <h3>Administrator</h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
          
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic"><?= $user['aboutme']; ?></p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?= $user['firstname']; ?> <?= $user['middlename']; ?> <?= $user['lastname']; ?> <?= $user['suffix']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8"><?= $user['gender']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?= $user['address']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?= $user['phone_number']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?= $user['email']; ?></div>
                  </div>

                </div>

    

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>

            </form>
                        <?php
                            }
                        } else {
                        ?>
                            <h4>No Record Found!</h4>
                        <?php
                        }
                       ?>

        </div>
      </div>
    </section>

<?php
 include("./include/footer.php");
?>