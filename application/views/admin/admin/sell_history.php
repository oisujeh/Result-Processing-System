  <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sell History</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
               
                     <?php  $this->load->view('partials/messages');?>

                        <div class="table-responsive">
                            <table class="table table-bordered responsive">
                            <tr><th>#id</th><th>Item</th> <th>Username</th><th>Pay to Wallet:</th><th>Amount (USD)</th> <th>Amount (Naira)</th> <th>We Pay to Bank:</th> <th>Hash ID</th> <th>Status</th> <th></th>
                            </tr>
                <?php foreach ($get_trans->result() as $data): ?>
                            
                                 <tr><td><?php echo $data->trans_id ?></td>

                                    <?php
                                        $id = $data->ecurrency_id_id;
                                     $get_u = $this->db->query("select * from ecurrencies where id=$id"); ?>
                                    <td><?php echo $get_u->row()->title ?></td>
                                     <td><?php $userid = $data->userid;
                                      echo $this->db->query("select * from userprofile where id = $userid")->row()->username;  ?>
                                          
                                      </td>
                                    <td><?php echo $data->wallet ?></a></td>

                                    <td>
                                      <?php echo number_format($data->amount_usd) ?>
                                    </td>

                                    <td>&#8358;<?php echo number_format($data->amount_ngn) ?></td>
                                    <td>

                                      <?php echo $data->bank_details ?>
                   </td>
                   <td><?php echo $data->hash_id ?></td>
                   
                                    

                                    <td><?php  if ($data->status  == 0) { ?>
                                            <span class="label label-warning">pending</span>
                                        <?php } elseif ($data->status == 1)  {?>
                                            <span class="label label-danger">cancelled</span>
                                         <?php } elseif ($data->status == 2)  {?>
                                            <span class="label label-info">notified</span>
                     <?php } elseif ($data->status == 3)  {?>
                                            <span class="label label-success">Completed</span>
                                            <?php  }?>
                    
                                    </td>

                                     <td> <?php  if ($data->status  == 0) { ?>

  
                                             <a href="<?php echo "confirm_user/".$data->trans_id ?>"
                                                         class="btn btn-info">Confirm</a> |
                                                 <a href="<?php echo "cancel_sell/".$data->trans_id ?>"
                                                    class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to cancel?')" >Cancel</a>

                                     <?php  } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                <div class="text-center pagination">
              
              <?php echo $this->pagination->create_links(); ?>
            </div>
            </table>


                        </div>

              </div>   
                                </div>
        </div>

    </div>