<main class="main-content p-5" role="main">
    <div class="row mb-5">

        <div class="col-md-12 col-lg-12 pb-5">
            <div class="card">
                <div class="card-header">
                    Add Result
                </div>
                <div class="card-body">

                    <?php  $this->load->view('partials/messages');?>

                    <form method="post" id="form1" class="form-inline" action="<?php echo base_url(). 'dashboard/save_result'?>">
                        <button type="submit" id="add" name="add" class="btn btn-primary">Add </button>

                        <a class="btn btn-danger" id="remove" type="submit" name="remove">Remove </a>

                        <input type="hidden" name="student_id" value="<?php echo $rid ?>">

                    <div class="table-responsive">


                            &nbsp;&nbsp;

                            <table id="datatable-1" class="table table-datatable table-bordered table-hover">

                                    <thead>
                                    <tr><th>#id</th><th>Course_Code</th> <th>Credit</th><th>Action</th>
                                    </tr>
                                    </thead>



                                    <tbody>
                                    <?php foreach ($get_trans->result() as $data): ?>

                                        <tr>


                                            <td><?php echo $data->id ?></td>
                                            <td>
                                                <?php
                                                //$course_id = $this->db->get_where('tblcourse_reg', array('course_id' =>$data->id ))->row()->course_id;

                                                $course_title = $this->db->get_where('tblcourses', array('id' => $data->course_id))->row();
                                                echo $course_title->code;
                                                ?>
                                                <input type="hidden" name="course_reg_id[]" value="<?php echo $data->id ?>">
                                            </td>

                                            <td>
                                                <?php echo $course_title->load; ?>
                                            </td>


                                            <td>


                                                    <input type="number" placeholder="Score" class="form-control" name="score[]">
                                                    <input type="text" placeholder="Grade" class="form-control" name="grade[]">







                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                    </tbody>

                                </table>




                            </div>
                </form>

                        </div>
                    </div>

                </div>

            </div>
