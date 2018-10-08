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


                        <div class="form-group">
                            <label for="session">Select Session</label>
                            <select class="form-control col-md-12" name="session">
                                <?php foreach ($this->db->get('tblsession')->result_array() as $row):?>
                                    <option value="<?php echo $row['id']?>" <?php if($this->session->userdata('session') == $row['id']) { echo 'selected'; } ?>><?php echo $row['session']?></option>

                                <?php endforeach;?>
                            </select>
                        </div>

                        <input type="submit" name="Load" value="Load" class="btn btn-success">
                    </form>


                </div>


                <hr class="section_padding_60">
                <div class="card">
                    <div class="card-header">
                        CGPA FOR  STUDENTS
                    </div>
                    <div class="card-body">

                        <?php  $this->load->view('partials/messages');?>
                        <div class="table-responsive">


                            <table id="datatable-1" class="table table-datatable table-bordered table-hover">

                            <thead>
                                <tr> <th>#id</th><th>Fullname</th><th>Matno</th> <th>Faculty</th>
                                    <th>Department</th> <th>GPA</th><th>CGPA</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                               <tbody>
                               <?php if(isset($get_trans)) { foreach ($get_trans->result() as $data): ?>

                                   <tr>


                                       <td><?php echo $data->id ?></td>
                                       <td><?php echo $data->firstname. ' '.$data->middlename. ' '. $data->lastname ?></a></td>

                                       <td>
                                           <?php echo $data->mat_no ?>
                                       </td>

                                       <td><?php echo $this->db->get_where('tblfaculty', array('id' =>$data->faculty ))->row()->title  ?></td>
                                       <td><?php echo $this->db->get_where('tbldepartment', array('id' =>$data->department ))->row()->title  ?></td>


                                       <td>
                                           <?php


                                           $matno = $data->mat_no;

                                           $get_co = $this->db->query("select * from tblresults 
inner join tblcourse_reg on tblcourse_reg.id = tblresults.course_reg_id
inner join tblcourses on tblcourses.id = tblcourse_reg.course_id
 where mat_no ='$matno' and tblresults.level_id = $level and tblresults.session_id = $session");

                                           $gp  = 0;
                                           if($get_co->num_rows() > 0){
                                               $total_credits = 0;

                                               foreach ($get_co->result() as $row){
                                                   if($row->grade == "A" || $row->grade =="a"){
                                                       $gp = $gp+  $row->load * 5;
                                                       $total_credits = $total_credits + $row->load;

                                                   }
                                                   else if($row->grade =="B" || $row->grade =="b"){
                                                       $gp = $gp + $row->load * 4;
                                                       $total_credits = $total_credits + $row->load;

                                                   }
                                                   else if($row->grade =="C"  || $row->grade =="c"){
                                                       $gp = $gp + $row->load * 3;
                                                       $total_credits = $total_credits + $row->load;

                                                   }
                                                   else if($row->grade =="D" || $row->grade =="d"){
                                                       $gp = $gp + $row->load * 2;
                                                       $total_credits = $total_credits + $row->load;

                                                   }
                                                   else if($row->grade =="E"  || $row->grade =="e"){
                                                       $gp = $gp + $row->load * 1;
                                                       $total_credits = $total_credits + $row->load;

                                                   }
                                                   else if($row->grade =="F"  || $row->grade =="f"){
                                                       $gp = $gp + $row->load * 0;
                                                       $total_credits = $total_credits + $row->load;

                                                   }
                                               }
                                           }
                                           echo  round($gp/$total_credits,2);
                                           ?>
                                       </td>

                                       <td>
                                           <?php


                                           $matno = $data->mat_no;

                                           $get_co = $this->db->query("select * from tblresults 
inner join tblcourse_reg on tblcourse_reg.id = tblresults.course_reg_id
inner join tblcourses on tblcourses.id = tblcourse_reg.course_id
 where mat_no ='$matno'");

                                           $gp  = 0;
                                           $gp1 = 0; $gp2=0; $gp3=0; $gp4=0;
                                           if($get_co->num_rows() > 0){
                                               $total_credits = 0;

                                               foreach ($get_co->result() as $row){

                                                   if($row->level_id==1){
                                                       if($row->grade == "A" || $row->grade =="a"){
                                                           $gp = $gp+  $row->load * 5;
                                                           $total_credits = $total_credits + $row->load;

                                                       }
                                                       else if($row->grade =="B" || $row->grade =="b"){
                                                           $gp = $gp + $row->load * 4;
                                                           $total_credits = $total_credits + $row->load;

                                                       }
                                                       else if($row->grade =="C"  || $row->grade =="c"){
                                                           $gp = $gp + $row->load * 3;
                                                           $total_credits = $total_credits + $row->load;
                                                       }
                                                       else if($row->grade =="D" || $row->grade =="d"){
                                                           $gp = $gp + $row->load * 2;
                                                           $total_credits = $total_credits + $row->load;
                                                       }
                                                       else if($row->grade =="E"  || $row->grade =="e"){
                                                           $gp = $gp + $row->load * 1;
                                                           $total_credits = $total_credits + $row->load;

                                                       }
                                                       else if($row->grade =="F"  || $row->grade =="f"){
                                                       $gp = $gp + $row->load * 0;
                                                       $total_credits = $total_credits + $row->load;

                                                   }

                                                       $gp1 = ($gp/$total_credits) * 0.10;
                                                   }
                                                   else if($row->level_id ==2){
                                                       $gp = 0;
                                                       if($row->grade == "A" || $row->grade =="a"){
                                                           $gp = $gp+  $row->load * 5;
                                                           $total_credits = $total_credits + $row->load;

                                                       }
                                                       else if($row->grade =="B" || $row->grade =="b"){
                                                           $gp = $gp + $row->load * 4;
                                                           $total_credits = $total_credits + $row->load;

                                                       }
                                                       else if($row->grade =="C"  || $row->grade =="c"){
                                                           $gp = $gp + $row->load * 3;
                                                           $total_credits = $total_credits + $row->load;
                                                       }
                                                       else if($row->grade =="D" || $row->grade =="d"){
                                                           $gp = $gp + $row->load * 2;
                                                           $total_credits = $total_credits + $row->load;
                                                       }
                                                       else if($row->grade =="E"  || $row->grade =="e"){
                                                           $gp = $gp + $row->load * 1;
                                                           $total_credits = $total_credits + $row->load;

                                                       }
                                                       else if($row->grade =="F"  || $row->grade =="f"){
                                                       $gp = $gp + $row->load * 0;
                                                       $total_credits = $total_credits + $row->load;

                                                   }

                                                       $gp2 = ($gp/$total_credits) * 0.15;
                                                   }

                                                   else if($row->level_id ==3){
                                                       $gp = 0;
                                                       if($row->grade == "A" || $row->grade =="a"){
                                                           $gp = $gp+  $row->load * 5;
                                                           $total_credits = $total_credits + $row->load;

                                                       }
                                                       else if($row->grade =="B" || $row->grade =="b"){
                                                           $gp = $gp + $row->load * 4;
                                                           $total_credits = $total_credits + $row->load;

                                                       }
                                                       else if($row->grade =="C"  || $row->grade =="c"){
                                                           $gp = $gp + $row->load * 3;
                                                           $total_credits = $total_credits + $row->load;
                                                       }
                                                       else if($row->grade =="D" || $row->grade =="d"){
                                                           $gp = $gp + $row->load * 2;
                                                           $total_credits = $total_credits + $row->load;
                                                       }
                                                       else if($row->grade =="E"  || $row->grade =="e"){
                                                           $gp = $gp + $row->load * 1;
                                                           $total_credits = $total_credits + $row->load;

                                                       }
                                                       else if($row->grade =="F"  || $row->grade =="f"){
                                                       $gp = $gp + $row->load * 0;
                                                       $total_credits = $total_credits + $row->load;

                                                   }

                                                       $gp3 = ($gp/$total_credits) * 0.25;
                                                   }

                                                   else if($row->level_id ==4){
                                                       $gp = 0;
                                                       if($row->grade == "A" || $row->grade =="a"){
                                                           $gp = $gp+  $row->load * 5;
                                                           $total_credits = $total_credits + $row->load;

                                                       }
                                                       else if($row->grade =="B" || $row->grade =="b"){
                                                           $gp = $gp + $row->load * 4;
                                                           $total_credits = $total_credits + $row->load;

                                                       }
                                                       else if($row->grade =="C"  || $row->grade =="c"){
                                                           $gp = $gp + $row->load * 3;
                                                           $total_credits = $total_credits + $row->load;
                                                       }
                                                       else if($row->grade =="D" || $row->grade =="d"){
                                                           $gp = $gp + $row->load * 2;
                                                           $total_credits = $total_credits + $row->load;
                                                       }
                                                       else if($row->grade =="E"  || $row->grade =="e"){
                                                           $gp = $gp + $row->load * 1;
                                                           $total_credits = $total_credits + $row->load;

                                                       }
                                                       else if($row->grade =="F"  || $row->grade =="f"){
                                                       $gp = $gp + $row->load * 0;
                                                       $total_credits = $total_credits + $row->load;

                                                   }

                                                       $gp4 = ($gp/$total_credits) * 0.55;
                                                   }




                                               }
                                           }
                                           echo  round($gp1+$gp2 + $gp3 + $gp4,2);
                                           ?>
                                       </td>
                                       <td>
                                           <div class="btn-group" role="group">
                                               <button id="btnGroupVerticalDrop2" type="button" class="btn btn-success dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                               </button>
                                               <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">


                                                   <a class="dropdown-item" href="<?php echo base_url().'dashboard/edit_student/'.$data->id ?>">Edit Student</a>
                                                   <a class="dropdown-item" href="<?php echo base_url().'dashboard/student_info/'.$data->id ?>">Student Info</a>

                                                   <a class="dropdown-item" href="<?php echo base_url().'dashboard/id_card/'.$data->id ?>">ID Card</a>

                                               </div>
                                           </div>


                                       </td>
                                   </tr>
                               <?php  endforeach; } ?>


                               </tbody>

                            </table>



                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
