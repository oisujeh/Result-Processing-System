<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php if(isset($meta_tags)) { echo $meta_tags; } ?>

    <title><?php echo $title ?></title>

    <?php require('css.php'); ?>

</head>

<div class="container-fluid">
    <div class="row">
        <div class="right-column sisu">
            <div class="row mx-0">
                <div class="col-md-7 order-md-2 signin-right-column px-5 bg-dark-green">
                    <a class="signin-logo d-sm-block d-md-none" href="#" >
                        <img style="text-align: center" src="<?php echo base_url('assets/logo.png') ?>" width="200" height="48" alt="FleetXpert">

                    </a>
                    <h1 class="display-4" style="color: white;" >Sign In To get Started</h1>
                    <p class="lead mb-5" style="color: white;">
                        School Portal is a project developed for the department of Computer Science in Partial fulfillment of the requirements for the Award
                        of a MSc in Computer Science.
                    </p>
                </div>
                <div class="col-md-5 order-md-1 signin-left-column bg-white px-5">
                    <a class="signin-logo d-sm-none d-md-block" href="#">
                        <img src="<?php echo base_url('assets/logo.png') ?>"  width="200" height="48" alt="FleetXpert">

                    </a>
                    <form  method="POST" action="" >
                        <?php  $this->load->view('partials/messages');?>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username"  required autofocus  placeholder="Username">

                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">

                        </div>

                        <button name="btn_login" type="submit" class="btn btn-success btn-gradient btn-block">
                            <i class="batch-icon batch-icon-key"></i>
                            Sign In
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

  <?php require('js.php'); ?>

</body>
</html>