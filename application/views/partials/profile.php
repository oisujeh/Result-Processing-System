<div class="job-profile section">
<div class="user-profile">
					<div class="user-images">

						<img src="<?php echo "https://ecxhub.s3.amazonaws.com/media/". $get_user->user_image ?>" width="72" height="72" alt="User Images" class="img-circle">
					</div>
					<div class="user">
						<h2>Hello, <a href="https://www.ecxhub.com/user/<?php echo $this->session->userdata('username') ?>"><?php echo $this->session->userdata('username') ?></a></h2>
						<h5>Profile Url: https://www.ecxhub.com/user/<?php echo $this->session->userdata('username') ?></h5>
						<br>
						<h5>Referral Link: https://www.ecxhub.com/signup?ref=<?php echo $this->session->userdata('user_id') ?></h5>
					</div>

					<div class="favorites-user">
						<div class="my-ads">

							<?php 

							 $get_sales = $this->db->get_where('usertransaction', array('seller_id'=>$this->session->userdata('user_id')))->num_rows();

							 $get_buys = $this->db->get_where('usertransaction', array('buyer_id'=>$this->session->userdata('user_id')))->num_rows();
							 $get_fav = $this->db->get_where('userfavourite', array('user_id'=>$this->session->userdata('user_id')))->num_rows();
							?>
							<?php if ($get_sales > 0){ ?>
								<a href="<?php echo base_url().'dashboard/sales_info'?>"><?php echo $get_sales ?><small>Sale(s)</small></a>
							<?php } ?>
						</div>
						<div class="my-ads">
							<?php if ($get_buys > 0){ ?>
								<a href="<?php echo base_url().'dashboard/order_info'?>"><?php echo $get_buys ?><small>Buy(s)</small></a>
							<?php } ?>
						</div>
						<div class="favorites">
							<?php if ($get_fav > 0){ ?>
								<a href="<?php echo base_url().'dashboard/favorites'?>"><?php echo $get_fav ?><small>Favourite(s)</small></a>
							<?php } ?>
						</div>
					</div>
</div><!-- user-profile -->
<ul class="user-menu">
					<li <?php  if ($currentUrl == 'myprofile') {?> class="active"<?php }?>><a href="<?php echo base_url().'dashboard/myprofile'?>">Account Info </a></li>
                    <li <?php  if ($currentUrl == 'edit_profile') {?> class="active"<?php }?>><a href="<?php echo base_url().'dashboard/edit_profile'?>">Edit Profile</a></li>
					<li <?php if ($currentUrl == 'inbox') {?>class="active"<?php }?>><a href="<?php echo base_url().'dashboard/inbox'?>">My Inbox</a></li>
                    <li <?php if ($currentUrl == 'favourites') {?>class="active"<?php }?>><a href="<?php echo base_url().'dashboard/favourites'?>">My Favourite</a></li><!-- 
                    <li <?php  //if ($currentUrl == 'dispute_box') {?>class="active"<?php// }?>><a href="<?php //echo base_url().'dashboard/dispute_box'?>">My Dispute Box</a></li> -->
</ul>
    </div><!-- ad-profile -->

