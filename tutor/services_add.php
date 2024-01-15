<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>


<div class="container-fluid px-4">
  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-title">
                    <h4 style="margin-left: 20px">New Tutorial Service
                        </h4>
                    </div>
                <div class="card-body">

                    <form action="process.php" method="post" autocomplete="off" enctype="multipart/form-data">

                        <div class="row">

                            <div class="col-md-12 mb-3">
                            <label for=""><strong>Job Title </strong></label>
                                <input required type="text" Placeholder="Eg. Math Tutorial" name="title" class="form-control" maxlength="80">
                            </div>

                            <div class="col-md-12 mb-3">
                            <label for=""><strong>Description</strong></label>
                                <textarea class="form-control" name="description" rows="7"  maxlength="200"></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <input required type="text" Placeholder="Rate *" name="rate" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <select name="rate_description" required class="form-control">
                                    <option value="" disabled selected>-- Select Rate Description--</option>
                                    <option value="Hour">Hour</option>
                                    <option value="Day">Day</option>
                                    <option value="Session">Session</option>
                                </select>
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


                <div class="container">
                <label for=""><strong>Specific Date</strong></label>
                    <div class="row" id="timeFields1">
                        <div class="col-md-4">
                            <div class="form-group">
                               <select name="day" required class="form-control">
                                    <option value="" selected disabled>--Select Day--</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Start Time</span>
                                </div>
                                <input type="time" class="form-control" name="starttime" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">End Time</span>
                                </div>
                                <input type="time" class="form-control" name="endtime" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                            <label for=""><strong>Custom</strong>  <small>(Example. Saturday - 8:00 AM to 10:00 AM)</small></label>
                                <input required type="text" Placeholder="Eg. Monday, Wednesday and Friday - 1:00 PM to 4:30 PM" name="custom" class="form-control" maxlength="80">
                            </div>

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
                        
                            <div class="module-container">
                                <div class="col-md-12 mb-3 module" data-task-number="1">
                                    <label for="module_1"><b>Learning Task 1</b></label>
                                    <input required type="text" Placeholder="Module Name *" name="module[1]" class="form-control">
                                    <br>
                                    <textarea class="form-control" name="moduledesc[1]" rows="5" placeholder="Module Description *" maxlength="200"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="button" id="addModule" class="btn btn-link">Add More</button>
                            </div>

                        </div>

                        <div class="text-right">
                            <a href="my_tutoring_services.php" class="btn btn-danger">Back</a>
                            <button type="submit" name="create_tutoring_services" class="btn btn-primary">Create</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>

    document.addEventListener('DOMContentLoaded', function () {
        const addModuleButton = document.getElementById('addModule');
        const moduleContainer = document.querySelector('.module-container');

        let taskNumber = 1;

        function addModule() {
            taskNumber++;

            const newModule = document.createElement('div');
            newModule.classList.add('col-md-12', 'mb-3', 'module');
            newModule.dataset.taskNumber = taskNumber;

            newModule.innerHTML = `
                <label for="module_${taskNumber}"><strong>Learning Task ${taskNumber}</strong></label>
                <input required type="text" Placeholder="Module Name *" name="module[${taskNumber}]" class="form-control">
                <br>
                <textarea class="form-control" name="moduledesc[${taskNumber}]" rows="5" placeholder="Module Description *" maxlength="200"></textarea>
            `;

            moduleContainer.appendChild(newModule);
        }

        addModuleButton.addEventListener('click', addModule);
    });

</script>




<?php
 include('./include/footer.php');
 ?>
