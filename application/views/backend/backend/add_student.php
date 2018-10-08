<main class="main-content p-5" role="main">
    <div class="row">

        <div class="col-md-8 col-lg-8">
            <div class="card">
                <div class="card-header">
                    ADD STUDENT
                </div>
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-12">


                            <?php  $this->load->view('partials/messages');?>
                            <form action="" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="matno">MAT NO</label>
                                    <input type="text" class="form-control" name="matno"  placeholder="MAT NO" required="required">
                                </div>

                                <div class="form-group">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="firstname" required="required">
                                </div>

                                <div class="form-group">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="lastname" required="required">
                                </div>

                                <div class="form-group">
                                    <label for="middlename">Middle Name</label>
                                    <input type="text" class="form-control" name="middlename" id="middlename" placeholder="middlename">
                                </div>
                                <div class="form-group">
                                    <label for="division">Faculty</label>

                                    <select class="form-control" id="division" name="faculty">
                                        <option value="">Select Faculty</option>

                                        <?php foreach ($this->db->get('tblfaculty')->result_array() as $row):?>
                                            <option value="<?php echo $row['id']?>"><?php echo $row['title']?></option>

                                        <?php endforeach;?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select class="form-control" id="department" name="department">

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <select class="form-control" name="level">
                                        <?php foreach ($this->db->get('tbllevel')->result_array() as $row):?>
                                            <option value="<?php echo $row['id']?>"><?php echo $row['title']?></option>

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
                            <li>Make sure to have entered the correct matno.</li>
                            <li>Enter Matric Number like this: PSC0808900</li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

