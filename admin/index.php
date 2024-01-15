<?php
 include('./include/authentication.php');
 include('./include/header.php');
 include('./include/topbar.php');
 include('./include/sidebar.php');

 // Fetch the total count of students and teachers
$queryStudentCount = "SELECT COUNT(*) as studentCount FROM `user_accounts` WHERE `role` = 1";
$queryTeacherCount = "SELECT COUNT(*) as teacherCount FROM `user_accounts` WHERE `role` = 2";

$resultStudentCount = mysqli_query($con, $queryStudentCount);
$resultTeacherCount = mysqli_query($con, $queryTeacherCount);

$rowStudentCount = mysqli_fetch_assoc($resultStudentCount);
$rowTeacherCount = mysqli_fetch_assoc($resultTeacherCount);

$studentCount = $rowStudentCount['studentCount'];
$teacherCount = $rowTeacherCount['teacherCount'];

// Job posted count
$queryJobPostedCount = "SELECT COUNT(*) as jobPostedCount FROM job";
$resultJobPostedCount = mysqli_query($con, $queryJobPostedCount);
$rowJobPostedCount = mysqli_fetch_assoc($resultJobPostedCount);
$jobPostedCount = $rowJobPostedCount['jobPostedCount'];

// Ongoing application count
$queryOngoingCount = "SELECT COUNT(*) as ongoingCount FROM job_application WHERE status = 'Ongoing'";
$resultOngoingCount = mysqli_query($con, $queryOngoingCount);
$rowOngoingCount = mysqli_fetch_assoc($resultOngoingCount);
$ongoingCount = $rowOngoingCount['ongoingCount'];

// Pending application count
$queryPendingCount = "SELECT COUNT(*) as pendingCount FROM job_application WHERE status = 'Pending'";
$resultPendingCount = mysqli_query($con, $queryPendingCount);
$rowPendingCount = mysqli_fetch_assoc($resultPendingCount);
$pendingCount = $rowPendingCount['pendingCount'];

?>

<section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Total Teacher</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person"></i>
                    </div>
                    <div class="ps-3">
                     
                                  <?php
                                   
                                    $ongoing_query = "SELECT
                                    user_accounts.*
                                  FROM
                                    user_accounts
                                  WHERE
                                    user_accounts.role = 2";
                                    $ongoing_query_run = mysqli_query($con, $ongoing_query);


                                    if($ongoing_total = mysqli_num_rows($ongoing_query_run))
                                    {
                                        echo '<h6 class="mb-0"> '.$ongoing_total.' </h6>';
                                    }else
                                    {
                                        echo '<h6 class="mb-0">0</h6>';
                                    }
                                    ?>


                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Total Student</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file-person"></i>
                    </div>
                    <div class="ps-3">
                    <?php
                                   
                                   $ongoing_query = "SELECT
                                   user_accounts.*
                                 FROM
                                   user_accounts
                                 WHERE
                                   user_accounts.role = 1";
                                   $ongoing_query_run = mysqli_query($con, $ongoing_query);


                                   if($ongoing_total = mysqli_num_rows($ongoing_query_run))
                                   {
                                       echo '<h6 class="mb-0"> '.$ongoing_total.' </h6>';
                                   }else
                                   {
                                       echo '<h6 class="mb-0">0</h6>';
                                   }
                                   ?>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <div class="col-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Reports <span>/Today</span></h5>

            <!-- Line Chart -->
            <div id="reportsChart"></div>

            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    // Update the data array with the total counts
                    var studentCount = <?php echo $studentCount; ?>;
                    var teacherCount = <?php echo $teacherCount; ?>;
                    new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                            name: 'Student',
                            data: [studentCount]
                        }, {
                            name: 'Teacher',
                            data: [teacherCount]
                        }],
                        chart: {
                            height: 350,
                            type: 'area',
                            toolbar: {
                                show: false
                            },
                        },
                        markers: {
                            size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                            type: "gradient",
                            gradient: {
                                shadeIntensity: 1,
                                opacityFrom: 0.3,
                                opacityTo: 0.4,
                                stops: [0, 90, 100]
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2
                        },
                        tooltip: {
                            x: {
                                format: 'dd/MM/yy HH:mm'
                            },
                        }
                    }).render();
                });
            </script>
            <!-- End Line Chart -->

        </div>
    </div>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-body pb-0">
            <h5 class="card-title">Job Posting Today</h5>

            <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    var jobPostedCount = <?php echo $jobPostedCount; ?>;
                    var ongoingCount = <?php echo $ongoingCount; ?>;
                    var pendingCount = <?php echo $pendingCount; ?>;

                    echarts.init(document.querySelector("#trafficChart")).setOption({
                        tooltip: {
                            trigger: 'item'
                        },
                        legend: {
                            top: '5%',
                            left: 'center'
                        },
                        series: [{
                            type: 'pie',
                            radius: ['40%', '70%'],
                            avoidLabelOverlap: false,
                            label: {
                                show: false,
                                position: 'center'
                            },
                            emphasis: {
                                label: {
                                    show: true,
                                    fontSize: '18',
                                    fontWeight: 'bold'
                                }
                            },
                            labelLine: {
                                show: false
                            },
                            data: [{
                                    value: <?php echo $jobPostedCount; ?>,
                                    name: 'Job Posted'
                                },
                                {
                                    value: <?php echo $ongoingCount; ?>,
                                    name: 'Ongoing Application'
                                },
                                {
                                    value: <?php echo $pendingCount; ?>,
                                    name: 'Pending Application'
                                }
                            ]
                        }]
                    });
                });
            </script>

        </div>
    </div>
</div>

          </div>
        </div><!-- End Left side columns -->


      </div>
    </section>


<?php
 include("./include/footer.php");
?>