 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Users List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
    <?php  $this->load->view('partials/messages');?>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>

                                <th>username</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Doc Verified?</th>
                                 <th>Blocked</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            
                            <?php foreach($get_trans->result() as $entry): ?>
                            <tr>

                                <td><?php echo $entry->id ?></td>
                                <td><?php echo $entry->username ?></td>
                                <td><?php echo $entry->firstname ?></td>
                                <td><?php echo $entry->lastname ?></td>
                                <td><?php echo $entry->email ?></td>
                                <td><?php echo $entry->phone ?></td>

                                <td>
                                    <?php if($entry->is_doc_verified==0) { ?>
                                    <span class="label label-warning">pending</span>
                                    <?php } else {?>
                                    <span class="label label-success">approved</span>
                                    <?php }?>
                                </td>
                                <td>
                                     <?php if($entry->is_blocked==0) { ?>
                                    <span class="label label-warning">None</span>
                                    <?php } else {?>
                                    <span class="label label-success">blocked</span>
                                    <?php }?>
                                </td>
                                <td>
                                    <?php if($entry->is_blocked==0) {?>
                                    <a href="block_user/<?php echo $entry->id ?>" onclick="return confirm('Do you want to block?');" class="btn btn-danger">Block</a>
                                    <?php } else { ?> 
                                     <a href="unblock_user/<?php echo $entry->id ?>" onclick="return confirm('Do you want to unblock?');" class="btn btn-danger">Un-Block</a>
                                    <?php } ?>
                                    |
                                    <a href="send_email/<?php echo $entry->id ?>" class="btn btn-default"><i class="fa fa-envelope"></i></a>
                                </td>

                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <div class="text-center pagination">
                            
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
                        </table>
                    </div>
        </div>