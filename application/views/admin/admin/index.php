  <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
           
            <?php  $this->load->view('partials/messages');?>
            

<div class="well well-sm warning text-warning">
    <?php 
    $userid = $this->session->userdata('user_id');
        $get_user = $this->db->query("select * from userprofile where id=$userid");
    if ($get_user->row()->is_doc_verified)
    {
       echo  "<b>Your Document is Verified</b>";
    }
    else{
        echo  "<b>Your Document is Not Verified <a href='edit_profile'>Click Here</a> </b>";
    }
    ?>
</div>

<div class="row">
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-usd fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php 
    $userid = $this->session->userdata('user_id');
        $get_trans = $this->db->query("select * from usertransaction where type='buy' ");
        $get_trans_usd = $this->db->query("select sum(amount_usd) as amount_usd_sum from usertransaction where type='buy'");
        $get_trans_ngn = $this->db->query("select sum(amount_ngn) as amount_ngn_sum from usertransaction where type='buy'");
   
    ?>

                        <div class="huge"> <?php echo $get_trans->num_rows() ?>  Buys</div>
                        <div>(&#8358;<?php echo $get_trans_ngn->row()->amount_ngn_sum ?>, $<?php echo $get_trans_usd->row()->amount_usd_sum ?>)   </div>
                        
                    </div>
                </div>
            </div>
            <a href="buy_history">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-bank fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                          <?php 
    $userid = $this->session->userdata('user_id');
        $get_trans2 = $this->db->query("select * from usertransaction where type='sell'");
        $get_trans_usd2 = $this->db->query("select sum(amount_usd) as amount_usd_sum from usertransaction where type='sell'");
        $get_trans_ngn2 = $this->db->query("select sum(amount_ngn) as amount_ngn_sum from usertransaction where type='sell'");
   
    ?>

                        <div class="huge"> <?php echo $get_trans2->num_rows() ?>  Sells</div>
                        <div>(&#8358;<?php echo $get_trans_ngn2->row()->amount_ngn_sum ?>, $<?php echo $get_trans_usd2->row()->amount_usd_sum ?>)   </div>
                        

                    </div>
                </div>
            </div>
            <a href="sell_history">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comment fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php 
                        $get_com = $this->db->query("select * from usercomment");
                        ?>

                        <div class="huge"><?php echo $get_com->num_rows() ?> Com</div>
                        
                    </div>
                </div>
            </div>
            <a href="sell_history">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
    </div>


           

            </div>


        </div>




