 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Send Email</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                     <?php  $this->load->view('partials/messages');?>

<?php echo form_open('myadmin/send_email', array('class' => 'form-horizontal'))?>
     

     <div class="form-group">
    <label for="subject" class="col-sm-2 control-label">Email Address</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  value="<?php  echo isset($email) ? $email: '' ?>" name="email">
    </div>
  </div>

  <div class="form-group">
    <label for="subject" class="col-sm-2 control-label">Subject</label>
    <div class="col-sm-10">
      <input type="text" required class="form-control" name="subject"  placeholder="Subject">
    </div>
  </div>


<div class="form-group" style="display:block">
	<label for="message" class="col-sm-2 control-label">Message</label>
    <div  class="col-sm-10">
	<textarea required name="message" rows="9" class="form-control" id="message"></textarea>
	
    </div>
</div>
    <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="send" class="btn btn-primary">Send Mail</button>
    </div>
  </div>
</form>

 </div>   
                                </div>
        </div>