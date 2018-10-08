<main class="main-content p-5" role="main">
    <div class="row mb-5">

            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Edit Session
                    </div>
                    <div class="card-body">


            <div class="row">
                       <?php  $this->load->view('partials/messages');?>
						<form action="<?php echo base_url().'dashboard/edit_session/'.$id ?>" method="post">
							
							<div class="form-group">
								<label>Session</label>
								
								<input type="text" name="session" class="form-control" value="<?php echo $rec->row()->session ?>"/>
							</div>

                                    <button type="submit" name="send" class="btn btn-primary">Save</button>
                                </form>
                                    </div>
				
                        </div>
                </div>
            </div>
        </div>