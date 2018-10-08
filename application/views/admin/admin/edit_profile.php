 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> My Profile</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                       <?php  $this->load->view('partials/messages');?>
						<form action="<?php echo base_url().'dashboard/edit_profile' ?>" method="post">
							
							<div class="form-group">
								<label>Username</label>
								<label class="form-control"><?php echo $get_user->username ?></label>

							</div>

							<div class="form-group">
								<label>Email Address</label>
								<label class="form-control"><?php echo $get_user->email ?></label>
							</div>

							<div class="form-group">
								<label>Mobile</label>
								<label class="form-control"><?php echo $get_user->phone ?></label>
							</div>

							<div class="form-group">
								<label>Firstname</label>
								<input type="text" class="form-control" value="<?php echo $get_user->firstname ?>">
							</div>

							<div class="form-group">
								<label>Lastname</label>
								<input type="text" class="form-control" value="<?php echo $get_user->lastname ?>">
							</div>

							<!--<div class="form-group">-->

								<!--<label>Your City</label>-->
								<!--<select class="form-control">-->
									<!--<option value="#">Los Angeles, USA</option>-->
									<!--<option value="#">Dhaka, BD</option>-->
									<!--<option value="#">Shanghai</option>-->
									<!--<option value="#">Karachi</option>-->
									<!--<option value="#">Beijing</option>-->
									<!--<option value="#">Lagos</option>-->
									<!--<option value="#">Delhi</option>-->
									<!--<option value="#">Tianjin</option>-->
									<!--<option value="#">Rio de Janeiro</option>-->
								<!--</select>-->
							<!--</div>-->
							<button type="submit" class="btn btn-primary">Save</button>
						</form>
					</div><!-- profile-details -->


					 <div class="panel panel-default">
                        <div class="panel panel-heading">Upload Documents</div>
                        <div class="panel panel-body">
                        <div class="col-md-12">
                        	<?php if($get_doc->num_rows() > 0) {  ?>

							<?php foreach($get_doc->result() as $doc): ?>
									<img class="img-square" src="<?php echo base_url().'assets/docs/'.$doc->user_doc ?>" width="400" height="100" alt="<?php echo $doc->document_type ?>">
                                    <br>
                                    <span>Document Verified? 
                                    	<?php if($get_user->is_doc_verified){ echo "Yes";} else{echo "No";}  ?>
                                    </span>
                           

                            <?php endforeach; ?>

							<?php } else { ?>
                                 <div class="col-md-12">
                                <!-- form -->
                                <form action="<?php echo base_url().'dashboard/doc_upload' ?>" method="post" enctype="multipart/form-data">
                                    

                                    <div class="form-group">
                                        <label>Document Type</label>
                                        <select name="doctype" class="form-control">
                                            <option value="0">Select Document Type</option>
                                            <option value="International Passport">International Passport</option>
                                            <option value="National ID Card">National ID Card</option>
                                            <option value="Voter's Card">Voter's Card</option>
                                            <option value="Driver's License">Driver's License</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Upload Image</label>
                                        <input type="file" name="file">
                                    </div>

                                    <button type="submit" name="send" class="btn btn-primary">Save</button>
                                </form>
                                    </div>
							<?php }?>
                        </div>

							<hr>


                        </div>
					</div><!-- change-password -->

                    
					 <div class="panel panel-default">
                        <div class="panel panel-heading">Upload Photo</div>
                        <div class="panel panel-body">

						<!-- form -->
						<form action="<?php echo base_url().'dashboard/upload_photo' ?>" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label>Upload Image</label>
								<input type="file" name="file">
							</div>
							<button type="submit" name="send" class="btn btn-primary">Save</button>
						</form>
                        </div>
					</div><!-- change-password -->


					<!-- change-password -->
					 <div class="panel panel-default">
                        <div class="panel panel-heading">Change Password</div>
                        <div class="panel panel-body">

						<!-- form -->
						<form action="<?php echo base_url().'dashboard/change_password' ?>" method="post">
							
							<div class="form-group">
								<label>Old Password</label>
								<input type="password" name="password1" class="form-control" >
							</div>

							<div class="form-group">
								<label>New password</label>
								<input type="password" name="password" class="form-control">
							</div>

							<div class="form-group">
								<label>Confirm password</label>
								<input type="password" name="password2" class="form-control">
							</div>
							<button type="submit" class="btn btn-primary">Save</button>
						</form>
                        </div>
					</div><!-- change-password -->


				</div><!-- user-pro-edit -->
			