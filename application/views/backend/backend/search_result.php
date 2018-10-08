
<main class="main-content p-5" role="main">
    <div class="row mb-5">




        <div class="col-md-12">
            <div class="col-md-12 col-lg-12">

                <div class="card">
                    <div class="col-md-12">
                        <form class="form-inline" method="post" action="<?php echo base_url(). 'dashboard/search_result'?>">
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
                            <div class="form-group">
                                <input type="text" name="matno" required="required" class="form-control" placeholder="Enter Mat No">
                            </div>

                            <input type="submit" name="Load" value="Search" class="btn btn-success">
                        </form>
                    </div>
                </div><br>
                <div class="card">
                    <div class="col-md-12">

                        <?php if($get_trans != null){
                        $matno = $get_trans->matno;
                            $get_student = $this->db->query("select * from tblstudents where mat_no = '$matno'")->row();
                            ?>
                    <p>
    <b class="text-info">Name:</b> <?php echo $get_student->firstname. ' '.$get_student->lastname ?><br>
    <b class="text-info">Degree:</b> B.sc(Department of Computer Science)<br>
    <b class="text-info">Mat No:</b> <?php echo $get_student->mat_no?><br>
    <b class="text-info">Level GPA:</b> <?php




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

                            }
                        }
                        echo  round($gp/$total_credits,2);
                        ?>
  </p>
  <div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th> <?php echo $this->db->get_where('tbllevel', array('id' =>$get_trans->level_id ))->row()->title  ?> Level       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Session:  <?php echo $this->db->get_where('tblsession', array('id' =>$get_trans->session_id ))->row()->session  ?></th>
      </tr>
    </thead>
  </table>
  <table class="table table-bordered table-striped table-sm">
    <thead>
      <tr>
        <th>SN</th>
        <th>Course Code</th>
        <th>Course Title</th>
        <th>Units</th>
        <th>Raw Score</th>
        <th>Grade</th>
        <th>Grade Points</th>
       </tr>
     </thead>
 
    <tbody>
    <?php

    $count = 0;
    foreach ($get_co->result() as $row) {
        $count++;
    ?>
      <tr>
        <td><?php echo $count ?></td>
        <td><?php echo $row->code?></td>
        <td><?php echo $row->title ?></td>
        <td><?php echo $row->load ?></td>
        <td><?php echo $row->score ?></td>
        <td><?php echo $row->grade ?></td>
        <td><?php
            if($row->grade == "A" || $row->grade =="a"){
                $gpp = $row->load * 5;

            }
            else if($row->grade =="B" || $row->grade =="b"){
                $gpp = $row->load * 4;


            }
            else if($row->grade =="C"  || $row->grade =="c"){
                $gpp =  $row->load * 3;


            }
            else if($row->grade =="D" || $row->grade =="d"){
                $gpp =  $row->load * 2;

            }
            else if($row->grade =="E"  || $row->grade =="e"){
                $gpp = $row->load * 1;


            }
            else{
                $gpp = $row->load * 0;
            }
            echo $gpp;
            ?></td>
       </tr>
    <?php }?>
     </tbody>
  </table>

  <form action="<?php echo base_url().'dashboard/add_gpa' ?>" method="post">
      <input type="hidden" name="mat_no" value="<?php echo $get_student->mat_no?>">
     


      <input type="hidden" name="session" value="<?php echo $this->db->get_where('tblsession', array('id' =>$get_trans->session_id ))->row()->id ?>">
       <input type="hidden" name="level" value="<?php echo $this->db->get_where('tbllevel', array('id' =>$get_trans->level_id ))->row()->id  ?>">
      <input type="hidden" name="gpa" value="<?php echo sprintf('%0.4f', $gp/$total_credits) ?>">
      <button type="submit" name="send" class="btn btn-info">Save Information</button>
  </form>
                </div></div>
                    <?php } else {
                            echo "<h3>NO RECORD FOUND</h3>";
                    } ?>

            </div>

        </div>
    </div>
