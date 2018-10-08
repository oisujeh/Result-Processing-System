<main class="main-content p-5" role="main">
    <div class="row">

        <table class="table table-bordered">
            <tr>
                <td style="border-color: #000; font-weight: 800;">Name: <?php echo $get_transtd->firstname.' '.$get_transtd->lastname?></td>
                <td style="border-color: #000; font-weight: 800;">Mat No: <?php echo $get_transtd->mat_no ?></td>
                <td style="border-color: #000; font-weight: 800;">Level: <?php echo $this->db->get_where('tbllevel', array('id' =>$get_transtd->leve ))->row()->title  ?></td>
                <td style="border-color: #000; font-weight: 800;">Session: <?php echo $this->db->get_where('tblsession', array('id' =>$get_transtd->session ))->row()->session  ?></td>
            </tr>
        </table>


    </div>
    <div class="row mb-5">



        <div class="col-md-4 col-lg-4">
            <div class="card">
                <div class="card-header">
                    Courses List
                </div>
                <div class="card-body">

                    <?php  $this->load->view('partials/messages');?>
                    <div class="table-responsive">
                        <form method="post" id="form1" action="<?php echo base_url(). 'dashboard/add_course'?>">

                            <button type="submit" id="add" name="add" class="btn btn-primary">Add </button>

                            <input type="hidden" name="student_id" value="<?php echo $rid ?>">


                            <table id="datatable-1" class="table table-datatable table-bordered table-hover">

                                    <thead>
                                    <tr> <th></th> <th>Course</th><th>Code</th> <th>Credit</th>
                                    </tr>
                                    </thead>



                                    <tbody>


                                    <?php foreach ($get_trans->result() as $data): ?>

                                        <tr>

                                            <td><input type="checkbox" name="checkbox[]" value="<?php echo $data->id ?>" id="checkbox"></td>

<!--                                            <td>--><?php //echo $data->id ?><!--</td>-->
                                            <td><?php echo $data->title ?></a></td>

                                            <td>
                                                <?php echo $data->code ?>
                                            </td>
                                            <td>
                                                <?php echo $data->load ?>
                                            </td>



                                        </tr>
                                    <?php endforeach; ?>

                                    </tbody>

                                </table>

                        </form>


                            </div>


                        </div>
                    </div>

                </div>




        <div class="col-md-4 col-lg-4">
            <div class="card">
                <div class="card-header">
                   Carry Over Course List
                </div>
                <div class="card-body">

                    <?php  $this->load->view('partials/messages');?>
                    <div class="table-responsive">
                        <form method="post" id="form1" action="<?php echo base_url(). 'dashboard/add_course'?>">

                            <button type="submit" id="add" name="add" class="btn btn-primary">Add </button>

                            <input type="hidden" name="student_id" value="<?php echo $rid ?>">


                            <table id="datatable-1" class="table table-datatable table-bordered table-hover">

                                <thead>
                                <tr> <th></th> <th>Course</th><th>Code</th> <th>Credit</th>
                                </tr>
                                </thead>



                                <tbody>


                                <?php foreach ($get_transc->result() as $data): ?>

                                    <tr>

                                        <td><input type="checkbox" name="checkbox[]" value="<?php echo $data->id ?>" id="checkbox"></td>

<!--                                        <td>--><?php //echo $data->id ?><!--</td>-->
                                        <td><?php echo $data->title ?></a></td>

                                        <td>
                                            <?php echo $data->code ?>
                                        </td>
                                        <td>
                                            <?php echo $data->load ?>
                                        </td>



                                    </tr>
                                <?php endforeach; ?>

                                </tbody>

                            </table>

                        </form>


                    </div>


                </div>
            </div>

        </div>


        <div class="col-md-4 col-lg-4">
            <div class="card">
                <div class="card-header">
                    Registered Courses

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="post" id="form1" action="<?php echo base_url(). 'dashboard/add_course'?>">


                        <button type="submit" id="remove" name="remove" class="btn btn-danger">Remove </button>

                        <input type="hidden" name="student_id" value="<?php echo $rid ?>">

                        <table class="table table-bordered">

                            <thead>
                            <tr> <th></th> <th>Code</th> <th>Credit</th><th>Type</th>
                            </tr>
                            </thead>



                            <tbody>
                            <?php $count = 0; foreach ($get_trans2->result() as $data): ?>

                                <tr>


                                    <td><input type="checkbox" name="checkbox[]" value="<?php echo $data->id ?>" id="checkbox"></td>

<!--                                    <td>--><?php //echo $data->id ?><!--</td>-->
                                    <td>
                                        <?php

                                        //$course_id = $this->db->get_where('tblcourse_reg', array('course_id' =>$data->course_id ))->row()->course_id;

                                        $course_title = $this->db->get_where('tblcourses', array('id' => $data->course_id))->row();
                                        echo $course_title->code;
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        $count = $count + $course_title->load;
                                        echo $course_title->load; ?>
                                    </td>
                                    <td> <?php
                                        echo $course_title->type; ?></td>

                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr class="bg-success"> <td colspan="4">Total Credits Registered:</td> <td><?php echo $count; ?></td></tr>
                            </tfoot>

                        </table>

                        </form>


                    </div>

                </div>
            </div>
        </div>


    </div>
