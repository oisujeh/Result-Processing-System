 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Update Exchange Rate</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                       <?php  $this->load->view('partials/messages');?>
						<form action="<?php echo base_url().'myadmin/update_exchange' ?>" method="post">
							
							<div class="form-group">
								<label>sell amount</label>
								
								<input type="text" name="sell_amount" class="form-control" value="<?php echo $rec->row()->amount_ngn_sell ?>"/>
							</div>

							<div class="form-group">
								<label>buy amount</label>
								<input type="text" name="buy_amount" class="form-control" value="<?php echo $rec->row()->amount_ngn_buy ?>"/>
							</div>
							
                                    <button type="submit" name="send" class="btn btn-primary">Save</button>
                                </form>
                                    </div>
				
                        </div>