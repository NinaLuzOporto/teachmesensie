<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>

<div class="pagetitle">
      <h1>Subscription</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Subscription</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <!-- <h5 class="card-title">Tutor's Information</h5> -->
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Mode of Payment</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                        <?php
                        $query = "SELECT
                        onlinetutorial.user_accounts.firstname, 
                        onlinetutorial.user_accounts.middlename, 
                        onlinetutorial.user_accounts.lastname, 
                        onlinetutorial.subscriptions.id, 
                        onlinetutorial.subscriptions.user_id, 
                        onlinetutorial.subscriptions.subscription_type, 
                        onlinetutorial.subscriptions.`status`, 
                        onlinetutorial.subscriptions.approved_date, 
                        onlinetutorial.subscriptions.expiration_date, 
                        onlinetutorial.subscriptions.reference, 
                        onlinetutorial.subscriptions.modeofpayment, 
                        onlinetutorial.subscriptions.stamp, 
                        onlinetutorial.subscriptions.receipt
                      FROM
                        onlinetutorial.subscriptions
                        INNER JOIN
                        onlinetutorial.user_accounts
                        ON 
                          onlinetutorial.subscriptions.user_id = onlinetutorial.user_accounts.user_id
                      ORDER BY
                        onlinetutorial.subscriptions.stamp DESC";
                        $query_run = mysqli_query($con, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                        ?>
                                <tr>

                                    <td><?= $row['firstname']; ?> <?= $row['lastname']; ?></td>
                                    <td><?= $row['status']; ?></td>   
                                    <td><?= $row['modeofpayment']; ?></td>   
                                            
                                    <td class="text-center">

                                    <a type="button" class="btn btn-primary" href="subscription_view.php?id=<?=$row['id'];?>"><i class="bi bi-eye"></i></a>

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