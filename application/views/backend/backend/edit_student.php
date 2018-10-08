<main class="main-content p-5" role="main">
    <div class="row">

        <div class="col-md-8 col-lg-8">
            <div class="card">
                <div class="card-header">
                    EDIT STUDENT
                </div>
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-12">


                            <?php  $this->load->view('partials/messages');?>
                            <form action="" method="post" enctype="multipart/form-data">

                                <input type="hidden" name="id" value="<?php echo $get_student->firstname ?>">
                                <div class="form-group">
                                    <label for="matno">MAT NO</label>
                                    <input type="text" class="form-control"  name="matno"  value="<?php echo $get_student->mat_no ?>">
                                </div>

                                <div class="form-group">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" class="form-control" value="<?php echo $get_student->firstname ?>" name="firstname" id="firstname">
                                </div>

                                <div class="form-group">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $get_student->lastname ?>">
                                </div>

                                <div class="form-group">
                                    <label for="middlename">Middle Name</label>
                                    <input type="text" class="form-control" name="middlename" id="middlename" value="<?php echo $get_student->middlename ?>">
                                </div>



                                <div class="form-group">
                                    <label for="division">Faculty</label>

                                    <select class="form-control" id="division" name="faculty">
                                        <option value="">Select Faculty</option>

                                        <?php foreach ($this->db->get('tblfaculty')->result_array() as $row):?>
                                            <option value="<?php echo $row['id']?>" <?php if($row['id'] == $get_student->faculty ) {echo "selected";} ?> ><?php echo $row['title']?></option>

                                        <?php endforeach;?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select class="form-control" id="department" name="department">
                                        <?php foreach ($this->db->get('tbldepartment')->result_array() as $row):?>
                                            <option value="<?php echo $row['id']?>" <?php if($row['id'] == $get_student->department ) {echo "selected";} ?>><?php echo $row['title']?></option>

                                        <?php endforeach;?>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <select class="form-control" name="level">
                                        <?php foreach ($this->db->get('tbllevel')->result_array() as $row):?>
                                            <option value="<?php echo $row['id']?>" <?php if($row['id'] == $get_student->leve ) {echo "selected";} ?>><?php echo $row['title']?></option>

                                        <?php endforeach;?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Upload Image</label>
                                    <input type="file" name="userfile">
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-success" name="send" value="Submit" type="submit">
                                </div>
                            </form>



                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-4 col-lg-4">
            <div class="card card-md">
                <div class="card-header">
                    STUDENT DETAILS

                </div>
                <div class="card-body text-center">
                    <div class="section quick-rules">
                        <h4>Quick Tips</h4>
                        <p class="lead">Enter data carefully and crosscheck properly before submitting</p>

                        <ul>
                            <li>Captialize words properly</li>
                            <li>Make sure to have entered the correct matno/li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

