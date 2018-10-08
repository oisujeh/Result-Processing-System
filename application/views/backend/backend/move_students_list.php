<main class="main-content p-5" role="main">
    <div class="row mb-5">

        <div class="col-md-12">
            <div class="col-md-12 col-lg-12">


                <div class="col-md-12">
                    <form class="form-inline" method="get" action="">
                        <div class="form-group">
                            <label for="level">From Level</label>
                            <select class="form-control col-md-12" name="level">
                                <?php foreach ($this->db->get('tbllevel')->result_array() as $row):?>
                                    <option value="<?php echo $row['id']?>" <?php if($this->session->userdata('level') == $row['id']) { echo 'selected'; } ?> ><?php echo $row['title']?></option>

                                <?php endforeach;?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="level">From Session</label>
                            <select class="form-control col-md-12" name="session">
                                <?php foreach ($this->db->get('tblsession')->result_array() as $row):?>
                                    <option value="<?php echo $row['id']?>"  <?php if($this->session->userdata('session') == $row['id']) { echo 'selected'; } ?>><?php echo $row['session']?></option>

                                <?php endforeach;?>
                            </select>
                        </div>

                        <input type="submit" name="Load" value="Load" class="btn btn-success">
                    </form>


                </div>


                <hr class="section_padding_60">
                <div class="card">
                    <div class="card-header">
                        Move Student List
                    </div>
                    <div class="card-body">

                        <?php  $this->load->view('partials/messages');?>
                        <div class="table-responsive">
                            

                            <form method="post" id="form1" action="<?php echo base_url(). 'dashboard/move_students_list'?>">

                            <input type="submit" name="move" value="Move Students"  class="btn btn-primary">

                            <table id="datatable-1" class="table table-datatable table-bordered table-hover">

                            <thead>
                                <tr><th></th> <th>Fullname</th><th>Matno</th> <th>Faculty</th>
                                    <th>Department</th> <th>Level</th><th>Carry Overs</th>
                                    
                                </tr>
                                </thead>
                               <tbody>
                               <?php if(isset($get_trans)) { foreach ($get_trans->result() as $data): ?>

                                   <tr>

                                       <td><input type="checkbox" name="checkbox[]" value="<?php echo $data->id ?>" id="checkbox"></td>

                                       
                                       <td><?php echo $data->firstname. ' '.$data->middlename. ' '. $data->lastname ?></a></td>

                                       <td>
                                           <?php echo $data->mat_no ?>
                                       </td>

                                       <td><?php echo $this->db->get_where('tblfaculty', array('id' =>$data->faculty ))->row()->title  ?></td>
                                       <td><?php echo $this->db->get_where('tbldepartment', array('id' =>$data->department ))->row()->title  ?></td>
                                       <td><?php echo $this->db->get_where('tbllevel', array('id' =>$data->leve ))->row()->title  ?></td>
                                       <td><?php


                                           $matno = $data->mat_no;

                                           $get_co = $this->db->query("select * from tblresults 
inner join tblcourse_reg on tblcourse_reg.id = tblresults.course_reg_id
inner join tblcourses on tblcourses.id = tblcourse_reg.course_id
 where mat_no ='$matno' and grade = 'F' and tblresults.level_id = $level and tblresults.session_id = $session");

                                           if($get_co->num_rows() > 0){
                                               foreach ($get_co->result() as $row){
                                                   echo $row->code.' - '.$row->load.' Credits, ';
                                               }
                                           }
                                           ?></td>

                                       
                                   </tr>
                               <?php  endforeach; } ?>


                               </tbody>

                            </table>
                            </form>


                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
