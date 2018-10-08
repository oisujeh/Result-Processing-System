 <div class="wrapper wrapper-content">
        <div class="row">
              <div class="ibox-content">
    <?php  $this->load->view('partials/messages');?>

<div class="row">
<div class="col-md-8">
						<form action="sell_order" method="post">
                            <?php  $this->load->view('partials/messages');?>
							<fieldset>
								<div class="section postdetails">

									<div class="row form-group">
										<label class="col-sm-3 label-title">Select Crypto-Currency<span class="required">*</span></label>
										<select name="bank" class="form-control">
											<option value="">Select Bank</option>
											<?php foreach($get_ecurrency as  $data):  ?>
												<option value="<?php echo $data->id ?>"><?php echo $data->title ?></option>
											<?php endforeach; ?>

										</select>
									</div>


                                    <div class="row form-group">
										<label class="col-sm-3 label-title">Select Bank<span class="required">*</span></label>
										<div class="col-sm-9">
										 <select name="bank" class="form-control">
											<option value="">Select Bank</option>
											<?php foreach($get_bank as  $data):  ?>
												<option value="<?php echo $data->id ?>"><?php echo $data->bank_name ?></option>
										<?php endforeach; ?>

										</select>
										</div>
									</div>

									<div class="row form-group">
										<label class="col-sm-3 label-title">Amount in USD<span class="required">*</span></label>
										<div class="col-sm-9">
											<input type="number" class="form-control" id="amount_usd" name="amount_usd" placeholder="Amount in USD">
										</div>
									</div>

									<div class="row form-group">
										<label class="col-sm-3 label-title">Naira Amount<span class="required">*</span></label>
										<div class="col-sm-9">
                                            <input type="number" class="form-control" id="ngn_amount" name="ngn_amount" placeholder="Naira Amount">
										</div>
									</div>

								</div><!-- postdetails -->


								<div class="checkbox section agreement">

									<button type="submit" name="send" class="btn btn-primary">Submit Order</button>
								</div><!-- section -->
							</fieldset>
						</form><!-- form -->
					</div>

					<div class="col-md-4">
						<div class="section quick-rules">
							<h4>Quick rules</h4>
							<p class="lead">Transactions are fulfilled within minutes</p>

							<ul>
								<li>Make sure to send the BTC to the specified wallet</li>
								<li>Due to the volatile nature of BTC, All transaction should be processed within 30 mins</li>

							</ul>
						</div>
					</div><!-- quick-rules -->
				</div><!-- photos-ad -->
</div>


					            </div>
        </div>

    </div>