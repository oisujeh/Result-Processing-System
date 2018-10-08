<main class="main-content p-5" role="main">
    <div class="row">

        <div class="col-md-8 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <?php echo $title ?>
                </div>
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-12">


                            <?php  $this->load->view('partials/messages');?>
                            <form action="" method="post">

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username"  placeholder="Username">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" name="password"  placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email"  placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <label for="fullname">Fullname</label>
                                    <input type="text" class="form-control" name="fullname"  placeholder="Fullname">
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" name="phone"  placeholder="Phone">
                                </div>


                                <div class="form-group">
                                    <label for="role">Role </label>

                                    <select class="form-control" id="role" name="role">

                                        <?php foreach ($this->db->get('tblroles')->result_array() as $row):?>
                                            <option value="<?php echo $row['id']?>"><?php echo $row['role']?></option>

                                        <?php endforeach;?>
                                    </select>
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
                   Create User
                </div>
                <div class="card-body text-center">
                    <div class="section quick-rules">
                        <h4>Quick Tips</h4>
                        <p class="lead">Enter data carefully and crosscheck properly before submitting</p>

                        <ul>
                            <li>Captialize words properly</li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>

