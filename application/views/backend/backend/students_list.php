<main class="main-content p-5" role="main">
    <div class="row mb-5">




        <div class="col-md-12">
            <div class="col-md-12 col-lg-12">


                <div class="col-md-12">
                    <form class="form-inline" method="get" action="">
                        <div class="form-group">
                            <label for="level">Select Level</label>
                            <select class="form-control col-md-12" name="level">
                                <?php foreach ($this->db->get('tbllevel')->result_array() as $row):?>
                                    <option value="<?php echo $row['id']?>" <?php if($this->session->userdata('level') == $row['id']) { echo 'selected'; } ?>><?php echo $row['title']?></option>

                                <?php endforeach;?>
                            </select>
                        </div>

                        <input type="submit" name="Load" value="Load" class="btn btn-success">
                    </form>





                </div>
                <hr class="section_padding_60">
                <div class="card">
                    <div class="card-header">
                        Student List
                    </div>
                    <div class="card-body">

                        <?php  $this->load->view('partials/messages');?>
                        <div class="table-responsive">

                            <table id="datatable-1" class="table table-datatable table-bordered table-hover">

                            <thead>
                                <tr><th>Fullname</th><th>Matno</th> <th>Faculty</th>
                                    <th>Department</th> <th>Level</th><th>Action</th>
                                </tr>
                                </thead>
                               <tbody>
                               <?php if(isset($get_trans)) { foreach ($get_trans->result() as $data): ?>

                                   <tr>


                                       
                                       <td><?php echo $data->firstname. ' '.$data->middlename. ' '. $data->lastname ?></a></td>

                                       <td>
                                           <?php echo $data->mat_no ?>
                                       </td>

                                       <td><?php echo $this->db->get_where('tblfaculty', array('id' =>$data->faculty ))->row()->title  ?></td>
                                       <td><?php echo $this->db->get_where('tbldepartment', array('id' =>$data->department ))->row()->title  ?></td>
                                       <td><?php echo $this->db->get_where('tbllevel', array('id' =>$data->leve ))->row()->title  ?></td>

                                       <td>

                                           <div class="btn-group" role="group">
                                               <button id="btnGroupVerticalDrop2" type="button" class="btn btn-success dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                               </button>
                                               <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">

                                                   <a class="dropdown-item" href="<?php echo base_url().'dashboard/edit_student/'.$data->id ?>">Edit Student</a>
                                                   <a class="dropdown-item" href="<?php echo base_url().'dashboard/student_info/'.$data->id ?>">Student Info</a>

                                                   <a class="dropdown-item" href="<?php echo base_url().'dashboard/id_card/'.$data->id ?>" target="_blank">ID Card</a>

                                                   <a class="dropdown-item" href="<?php echo base_url().'dashboard/register_course/'.$data->id ?>">Register Course</a>


                                                   <a class="dropdown-item" onclick="return confirm('Are you sure you want to cancel?')" href="<?php echo base_url().'dashboard/remove_student/'.$data->id ?>">Delete</a>
                                               </div>
                                           </div>


                                       </td>
                                   </tr>
                               <?php endforeach; } ?>


                               </tbody>

                            </table>


                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
