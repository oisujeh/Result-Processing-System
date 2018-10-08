<main class="main-content p-5" role="main">
<div class="row mb-5">
             


                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                Sessions
                            </div>
                            <div class="card-body">

                                <?php  $this->load->view('partials/messages');?>
                                <a href="add_session" class="btn btn-primary">Add New</a>
                                <div class="card-table table-responsive">
                                    <table id="datatable-1" class="table table-datatable table-striped table-hover">
                                        <thead>
                                        <tr><th>#id</th> <th>Session</th> <th>Is Current?</th>  <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php foreach ($get_trans->result() as $data): ?>

                                            <tr>
                                                <td><?php echo $data->id ?></td>


                                                <td>
                                                    <?php echo $data->session ?>
                                                </td>

                                                <td><?php  if ($data->is_current  == 0) { ?>
                                                        <span class="label label-warning">No</span>
                                                    <?php } elseif ($data->is_current == 1)  {?>
                                                        <span class="label label-success">Yes</span>
                                                    <?php  }?>

                                                </td>
                                                <td>

                                                        <a href="<?php echo "edit_session/".$data->id ?>"
                                                           class="btn btn-info">Edit</a> |

                                                    <a href="<?php echo "mark_current/".$data->id ?>"
                                                       class="btn btn-primary">Mark As Current</a> |

                                                        <a href="<?php echo "delete_session/".$data->id ?>"
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
