<main class="main-content p-5" role="main">
    <div class="row mb-5">




        <div class="col-md-12">
            <div class="col-md-12 col-lg-12">


                <div class="col-md-8">
                    <form class="form-inline" method="get" action="">
                        <div class="form-group">
                            <label for="level">Select Level</label>
                            <select class="form-control col-md-12" name="level">
                                <?php foreach ($this->db->get('tbllevel')->result_array() as $row):?>
                                    <option value="<?php echo $row['id']?>" <?php if($this->session->userdata('level') == $row['id']) { echo 'selected'; } ?>><?php echo $row['title']?></option>

                                <?php endforeach;?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="level">Select Session</label>
                            <select class="form-control col-md-12" name="session">
                                <?php foreach ($this->db->get('tblsession')->result_array() as $row):?>
                                    <option value="<?php echo $row['id']?>" <?php if($this->session->userdata('session') == $row['id']) { echo 'selected'; } ?>><?php echo $row['session']?></option>

                                <?php endforeach;?>
                            </select>
                        </div>

                        <input type="submit" name="Load" value="Load" class="btn btn-success">
                    </form>


                    <form class="form-inline" method="post" enctype="multipart/form-data" action="importcsv">
                        <div class="form-group">
                            <label for="level">Upload Result</label>
                            <input type="file" name="userfile">
                        </div>

                        <input type="submit" value="upload" class="btn btn-success">
                    </form>


                </div>
                <hr class="section_padding_60">
                <div class="card">
                    <div class="card-header">
                      generate report
                    </div>
                    <div class="card-body">

                        <?php  $this->load->view('partials/messages');?>
                        <div class="table-responsive">
                            <a href="<?php echo  base_url('dashboard/export_result') ?>"  class="btn btn-primary">Export Result</a>
                            <a href="<?php echo  base_url('dashboard/success_result') ?>"  class="btn btn-success">Success Students</a>
                            <a href="<?php echo  base_url('dashboard/senate_report') ?>"  class="btn btn-success">Generate Senate Report</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
