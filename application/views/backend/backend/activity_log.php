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

                                <tr><th>Username</th>
                                    <th>IP Address</th> <th>Computer Name</th>
                                    <th>Page</th>
                                    <th>Date</th>
                                </tr>
                                </thead>

                                <tbody>

                                <?php foreach ($get_trans->result() as $data): ?>

                                    <tr>


                                        <td>
                                            <?php echo $data->username ?>

                                        </td>

                                        <td> <?php echo $data->ipaddress ?></td>
                                        <td>
                                            <?php echo $data->computername ?>
                                         </td>

                                        <td>
                                            <?php echo $data->page ?>
                                        </td>

                                        <td><?php echo $data->date ?></td>

                                    </tr>
                                <?php endforeach; ?>
                                </tbody>

                            </table>




                        </div>
                    </div>
                </div>

            </div>

        </div>
