<main class="main-content p-5" role="main">
    <div class="row">

        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    STUDENT INFO
                </div>
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-12">


                            <?php  $this->load->view('partials/messages');?>
                           <table class="table table-responsive">
                               <tr>
                                   <td style="text-align: center">
                                       <img src="<?php echo base_url().'assets/uploads/'.$get_trans->photo ?>" height="100" width="100" alt="Passport">
                                       <br>

                                       <h5><?php echo $get_trans->firstname.' '.$get_trans->middlename.' '. $get_trans->lastname ?></h5>

                                       <br>
                                       <a class="btn btn-success"  href="<?php echo base_url().'dashboard/edit_student/'.$get_trans->id ?>"> <i class="fa fa-edit"></i> EDIT INFORMATION</a>
                                   </td>
                                   <td>
                                       <h4>Academic Info</h4>
                                       <ul>
                                           <li><i class="fa fa-home"></i> Department: <?php echo $this->db->get_where('tbldepartment', array('id' =>$get_trans->department ))->row()->title  ?> </li>
                                           <li><i class="fa fa-th"></i> Level:  <?php echo $this->db->get_where('tbllevel', array('id' =>$get_trans->leve ))->row()->title  ?> </li>
                                           <li><i class="fa fa-th"></i> Mat No:  <?php echo $get_trans->mat_no ?> </li>
                                       </ul>

                                   </td>
                               </tr>
                           </table>


                            <a class="btn btn-primary"  href="<?php echo base_url().'dashboard/students_list' ?>"> <i class="fa fa-backward"></i> Back to Students List</a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>



