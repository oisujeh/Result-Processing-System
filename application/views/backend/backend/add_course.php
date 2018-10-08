<main class="main-content p-5" role="main">
    <div class="row mb-5">

            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Add Session
                    </div>
                    <div class="card-body">


            <div class="row">
                       <?php  $this->load->view('partials/messages');?>
						<form action="<?php echo base_url().'dashboard/add_new_course' ?>" method="post">
							
							<div class="form-group">
								<label>Title</label>
								
								<input type="text" name="title" class="form-control" placeholder="Title"/>
							</div>

                            <div class="form-group">
                                <label>Code</label>

                                <input type="text" name="code" class="form-control" placeholder="e.g CSC 110"/>
                            </div>

                            <div class="form-group">
                                <label>Credit Load</label>

                                <input type="number" name="load" class="form-control" placeholder="Credit Load"/>
                            </div>


                            <div class="form-group">
                                <label for="level">Level</label>
                                <select class="form-control" name="level">
                                    <?php foreach ($this->db->get('tbllevel')->result_array() as $row):?>
                                        <option value="<?php echo $row['id']?>"><?php echo $row['title']?></option>

                                    <?php endforeach;?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <select class="form-control" name="semester">
                                    <option value="1">First Semester</option>
                                    <option value="2">Second Semester</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" name="type">
                                    <option value="Core">Core</option>
                                    <option value="Elective">Elective</option>
                                    <option value="Mandatory">Mandatory</option>
                                </select>
                            </div>


                                    <button type="submit" name="send" class="btn btn-primary">Save</button>
                                </form>
                                    </div>
				
                        </div>
                </div>
            </div>
        </div>