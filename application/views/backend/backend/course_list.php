<main class="main-content p-5" role="main">
<div class="row mb-5">
             


                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                Course List
                            </div>
                            <div class="card-body">

                                <?php  $this->load->view('partials/messages');?>
                                <a href="add_new_course" class="btn btn-primary">Add Course</a>
                                <div class="card-table table-responsive table-bordered">
                                    <table id="datatable-1" class="table table-datatable table-striped table-hover">
                                        <thead>
                                        <tr><th>Title</th> <th>Code</th> <th>Credit Load</th> <th>Semester</th> <th>Type</th> <th>Level</th> <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php foreach ($get_trans->result() as $data): ?>

                                            <tr>

                                                <td>
                                                    <?php echo $data->title ?>
                                                </td>
                                                <td>
                                                    <?php echo $data->code ?>
                                                </td>
                                                <td>
                                                    <?php echo $data->load ?>
                                                </td>
                                                <td>
                                                    <?php echo $data->semester ?>
                                                </td>
                                                <td>
                                                    <?php echo $data->type ?>
                                                </td>
                                                <td>
                                                    <?php echo $this->db->get_where('tbllevel', array('id' =>$data->level ))->row()->title  ?>
                                                </td>
                                                <td>

                                                        <a href="<?php echo "edit_course/".$data->id ?>"
                                                           class="btn btn-info">Edit</a> |

                                                        <a href="<?php echo "delete_course/".$data->id ?>"
                                                           class="btn btn-danger"
                                                           onclick="return confirm('Are you sure you want to cancel?')" >Delete</a>


                                                </td>



                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>


                                    </table>




                            </div>
                        </div>
                    </div>

                </div>


 </div>
