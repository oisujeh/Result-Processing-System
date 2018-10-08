 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Docs List</h1>
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
                                <th>Document Type</th>
                                <th>User Document</th>
                                <th>Status</th>
                               
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            
                            <?php foreach($get_trans->result() as $entry): ?>
                            <tr>

                                <td><?php echo $entry->id ?></td>
                                
                                <td><?php  $userid = $entry->user_id; echo $this->db->query("select * from userprofile where id = $userid")->row()->username; ?></td>
                                <td><?php echo $entry->document_type ?></td>
                                <td>
                                    <img class="img-square" src="<?php echo base_url().'assets/docs/'.$entry->user_doc ?>" width="400" height="100" alt="<?php echo $entry->document_type ?>">
                                </td>
                                <td><?php if($entry->status==0) { ?>
                                    <span class="label label-warning">pending</span>
                                    <?php } else {?>
                                    <span class="label label-success">approved</span>
                                    <?php }?>
                                </td>
                                <td>
                                    <a href="<?php echo base_url().'myadmin/approve_doc/$entry->id' ?>" class="btn btn-success">Approve</a>
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

    