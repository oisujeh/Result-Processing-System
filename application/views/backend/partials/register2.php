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
                <div class="col-md-7 order-md-2 signin-right-column px-5 bg-dark">
                    <a class="signin-logo d-sm-block d-md-none" href="#">
                        <img src="<?php echo base_url('assets/backend/assets/img/aeonlending.png') ?>" width="145" height="32.3" alt="QuillPro">
                    </a>
                    <h1 class="display-4">Sign In To get Started</h1>
                    <p class="lead mb-5">
                        Aeonlending is a Bitcoin, Ethereum powered Cryptocurrency platform
                    </p>
                </div>
                <div class="col-md-5 order-md-1 signin-left-column bg-white px-5">
                    <a class="signin-logo d-sm-none d-md-block" href="#">
                        <img src="<?php echo base_url('assets/backend/assets/img/aeonlending.png') ?>"  width="145" height="32.3" alt="QuillPro">
                    </a>
                    <form  method="POST" action="" >
                        <?php  $this->load->view('partials/messages');?>

                        <div class="form-group">
                            <label for="username">Firstname</label>
                            <input type="text" class="form-control" id="firstname" name="firstname"  required autofocus  placeholder="Firstname">

                        </div>
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control" id="lastname" name="lastname"  required autofocus  placeholder="Lastname">

                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"  required autofocus  placeholder="Email">

                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username"  required autofocus  placeholder="Username">

                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">

                        </div>

                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm Password">

                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone"  required autofocus  placeholder="Phone Number">

                        </div>

                        <button name="btn_login" type="submit" class="btn btn-primary btn-gradient btn-block">
                            <i class="batch-icon batch-icon-key"></i>
                            Sign up
                        </button>
                        <hr>
                        <p class="text-center">
                            Already have an account? <a href="signin">SignIn</a>
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('js.php'); ?>

</body>
</html>