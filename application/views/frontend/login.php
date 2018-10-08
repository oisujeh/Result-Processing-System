<!-- ===================== Breadcumb area start ===================== -->
    <section class="breadcumb_area">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcumb_section">
                        <!-- Breadcumb page title start -->
                        <div class="page_title">
                            <h3>sign in</h3>
                        </div>
                        <!-- Breadcumb page pagination start -->
                        <div class="page_pagination">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li>sign in</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===================== Breadcumb area end ===================== -->

    <!-- ===================== login area start ===================== -->
    <section class="login_area section_padding_100">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-md-5 col-lg-6">
                    <!-- login thumb start -->
                    <div class="login_thumb">

                        <!-- login thumb caption -->
                        <div class="login_thumb_caption">
                            <h3>Welcome Back!</h3>
                            <p>Login to continue</p>
                        </div>
                    </div>
                    <!-- login thumb end -->
                </div>

                <div class="col-xs-12 col-md-7 col-lg-6">
                    <!-- login form start -->
                    <div class="login_form">
                        <!-- sign in facebok -->
                       
                        <!-- sign in manual form -->
                        <div class="login_manual_form">
                           <?php echo validation_errors(); ?>
    					<?php echo $this->session->flashdata('msg'); ?>
                <form role="form" method="post" action="">
                    <div class="form-group">
                        <div class="input-group login-input">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="username" placeholder="Username">
                        </div>
                        <br>
                        <div class="input-group login-input">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                       <br>
                       <div class="row">
                            <div class="col-md-8">
                              
                            </div>
                            <div class="col-md-4">
                                <button type="submit" name="btn_login" class="btn btn-ar btn-primary pull-right">Login</button>
                            </div>
                        </div>
                        <hr class="dotted margin-10">
                        <a href="signup" class="btn btn-ar btn-success pull-right">Create Account</a>
                        <a href="forgot_password" class="btn btn-ar btn-warning">Password Recovery</a>
                        <div class="clearfix"></div>
                    </div>
                </form>
                        </div>
                    </div>
                    <!-- login form end -->
                </div>
            </div>
        </div>
    </section>
    <!-- ===================== login area end ===================== -->

