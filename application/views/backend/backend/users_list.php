<main class="main-content p-5" role="main">
    <div class="row mb-5">

            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <?php echo $title ?>
                    </div>
                    <div class="card-body">

                        <?php  $this->load->view('partials/messages');?>
                        <div class="table-responsive">
                            <table id="datatable-1" class="table table-datatable table-bordered table-hover">
                                <thead>

                                <tr><th>#ID</th><th>Username</th> <th>Fullname</th> <th>Email</th> <th>Phone</th>
                                    <th>Date</th> <th>Status</th>
                                </tr>
                                </thead>

                                <tbody>

                                <?php foreach ($get_trans->result() as $data): ?>

                                    <tr>

                                        <td><?php echo $data->user_id ?></td>

                                        <td><?php echo $data->username ?></td>

                                        <td><?php echo $data->fullname ?></td>

                                        <td><?php echo $data->email ?></td>

                                        <td><?php echo $data->phone ?></td>

                                        <td><?php echo $data->date_created ?></td>

                                        <td><?php  if ($data->is_enabled  == 0) { ?>
                                                <span class="label label-warning">Inactive</span>
                                            <?php } elseif ($data->is_enabled == 1)  {?>
                                                <span class="label label-success">Active</span>
                                            <?php } elseif ($data->is_enabled == 2)  {?>
                                                <span class="label label-danger">Deleted</span>
                                            <?php  }?>

                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                                </tbody>

                            </table>




                        </div>
                    </div>
                </div>

            </div>

        </div>
