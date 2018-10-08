 <header class="main-header">
    <div class="container">
        <h1 class="page-title">Retrieve Password</h1>

        <ol class="breadcrumb pull-right">
            <li><a href="/">Home</a></li>
            <li class="active">Retrieve Password</li>
        </ol>
    </div>
</header>

<div class="container">
    <div class="center-block logig-form">
        <div class="panel panel-primary">
            <div class="panel-heading">Retrieve Password</div>
            <div class="panel-body">
                      <?php echo validation_errors(); ?>
    					<?php echo $this->session->flashdata('msg'); ?>
                            <form action="forgot_password" method="post">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="user" placeholder="Username">
                                </div>
                               
                                <button type="submit" name="btn_login" class="btn btn-default">Retrieve</button>
                            </form>
              </div>
        </div>
    </div>
</div> <!-- container  -->