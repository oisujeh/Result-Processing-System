<main class="main-content p-5" role="main">
    <div class="row mb-5">

            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Edit Course
                    </div>
                    <div class="card-body">


            <div class="row">
                       <?php  $this->load->view('partials/messages');?>
						<form action="<?php echo base_url().'dashboard/edit_course/'.$id ?>" method="post">



                            <div class="form-group">
                                <label>Title</label>

                                <input type="text" name="title" class="form-control" value="<?php echo $rec->row()->title ?>"/>
                            </div>

                            <div class="form-group">
                                <label>Code</label>

                                <input type="text" name="code" class="form-control" value="<?php echo $rec->row()->code ?>"/>
                            </div>

                            <div class="form-group">
                                <label>Credit Load</label>

                                <input type="text" name="load" class="form-control" value="<?php echo $rec->row()->load ?>"/>
                            </div>


                            <div class="form-group">
                                <label for="level">Level</label>
                                <select class="form-control" name="level">
                                    <?php foreach ($this->db->get('tbllevel')->result_array() as $row):?>
                                        <option value="<?php echo $row['id']?>" <?php if($row['id'] == $rec->row()->level ) {echo "selected";} ?>><?php echo $row['title']?></option>

                                    <?php endforeach;?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <select class="form-control" name="semester">
                                    <option value="1"  <?php if(1 == $rec->row()->semester ) {echo "selected";} ?>>First Semester</option>
                                    <option value="2" <?php if(2 == $rec->row()->semester ) {echo "selected";} ?>>Second Semester</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" name="type">
                                    <option value="Core" <?php if("Core" == $rec->row()->type ) {echo "selected";} ?>>Core</option>
                                    <option value="Elective" <?php if("Elective" == $rec->row()->type ) {echo "selected";} ?>>Elective</option>
                                    <option value="Mandatory" <?php if("Mandatory" == $rec->row()->type ) {echo "selected";} ?>>Mandatory</option>
                                </select>
                            </div>
                                    <button type="submit" name="send" class="btn btn-primary">Save</button>
                                </form>
                                    </div>
				
                        </div>
                </div>
            </div>
        </div>