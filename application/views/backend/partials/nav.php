<body>
<div class="container-fluid">
    <div class="row">
        <nav id="sidebar" class="px-0 bg-dark-green bg-gradient sidebar">
            <ul class="nav nav-pills flex-column">
                <li class="logo-nav-item">
                    <a class="navbar-brand" href="#">
                        <img src="<?php echo base_url('assets/logo.png') ?>" width="180" height="45" alt="NPDC">

                    </a>
                </li>

                <li>
                    <h6 class="nav-header">

                        

                    </h6>
                </li>
                <li class="nav-item">
                    <a <?php if($currentUrl=="index") {echo "class='nav-link active'"; } else { echo "class='nav-link'"; } ?> href="index">
                        <i class="batch-icon batch-icon-browser-alt"></i>
                        Dashboard <span class="sr-only">(current)</span>
                    </a>
                </li>



                <li <?php if($currentUrl=="add_student") {echo "class='nav-item active'"; } else { echo "class='nav-item'"; }  ?>>
                    <a href="<?php echo base_url(). 'dashboard/add_student' ?>"><i class="nav-link fa fa-plus-circle"></i> Add Student</a>
                </li>

                <li <?php if($currentUrl=="students_list") {echo "class='nav-item active'"; } else { echo "class='nav-item'"; }  ?>>
                    <a href="<?php echo base_url(). 'dashboard/students_list' ?>"><i class="nav-link fa fa-plus-circle"></i> Student List</a>
                </li>

                <li <?php if($currentUrl=="registered_students_list") {echo "class='nav-item active'"; } else { echo "class='nav-item'"; }  ?>>
                    <a href="<?php echo base_url(). 'dashboard/registered_students_list' ?>"><i class="nav-link fa fa-plus-circle"></i> Course Registration</a>
                </li>

                <li <?php if($currentUrl=="results") {echo "class='nav-item active'"; } else { echo "class='nav-item'"; }  ?>>
                    <a href="<?php echo base_url(). 'dashboard/results' ?>"><i class="nav-link fa fa-plus-circle"></i> Upload/Generate Result</a>
                </li>


                <li <?php if($currentUrl=="search_result") {echo "class='nav-item active'"; } else { echo "class='nav-item'"; }  ?>>
                    <a href="<?php echo base_url(). 'dashboard/search_result' ?>"><i class="nav-link fa fa-plus-circle"></i> Search Result</a>
                </li>


                <li <?php if($currentUrl=="move_students_list") {echo "class='nav-item active'"; } else { echo "class='nav-item'"; }  ?>>
                    <a href="<?php echo base_url(). 'dashboard/move_students_list' ?>"><i class="nav-link fa fa-plus-circle"></i> Move Student</a>
                </li>

                <li <?php if($currentUrl=="cgpa_students_list") {echo "class='nav-item active'"; } else { echo "class='nav-item'"; }  ?>>
                    <a href="<?php echo base_url(). 'dashboard/cgpa_students_list' ?>"><i class="nav-link fa fa-plus-circle"></i> Students CGPA</a>
                </li>


                <li <?php if($currentUrl=="session_list") {echo "class='nav-item active'"; } else { echo "class='nav-item'"; }  ?>>
                    <a href="<?php echo base_url(). 'dashboard/session_list' ?>"><i class="nav-link fa fa-plus-circle"></i> Session List</a>
                </li>




                <?php if($this->session->userdata('role_id') == 1){ ?>

                    <li <?php if($currentUrl=="course_list") {echo "class='nav-item active'"; } else { echo "class='nav-item'"; }  ?>>
                        <a href="<?php echo base_url(). 'dashboard/course_list' ?>"><i class="nav-link fa fa-plus-circle"></i> Course List</a>
                    </li>
                <li <?php if($currentUrl=="create_user") {echo "class='nav-item active'"; } else { echo "class='nav-item'"; }  ?>>
                    <a href="<?php echo base_url(). 'dashboard/create_user' ?>"><i class="nav-link fa fa-plus-circle"></i> Create User</a>
                </li>

                <li <?php if($currentUrl=="userslist") {echo "class='nav-item active'"; } else { echo "class='nav-item'"; }  ?>>
                    <a href="<?php echo base_url(). 'dashboard/userslist' ?>"><i class="nav-link fa fa-plus-circle"></i> Users List</a>
                </li>

                <li <?php if($currentUrl=="activity_log") {echo "class='nav-item active'"; } else { echo "class='nav-item'"; }  ?>>
                    <a href="<?php echo base_url(). 'dashboard/activity_log' ?>"><i class="nav-link fa fa-plus-circle"></i> Activity Log</a>
                </li>

                <?php } ?>

                <li class="nav-item">
                    <a class="nav-link" href="logout">
                        <i class="fa fa-lock"></i>
                        Logout
                    </a>
                </li>


            </ul>



        </nav>
        <div class="right-column">
            <nav class="navbar navbar-expand-lg navbar-light bg-dark-green">
                <a class="navbar-brand d-block d-sm-block d-md-block d-lg-none" href="#">
                    <img src="<?php echo base_url('assets/logo.png' ) ?>" width="180" height="45" alt="NPDC">
                </a>
                <button class="hamburger hamburger--slider" type="button" data-target=".sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle Sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                </button>
                <!-- Added Mobile-Only Menu -->
                <ul class="navbar-nav ml-auto mobile-only-control d-block d-sm-block d-md-block d-lg-none">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbar-notification-search-mobile" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                            <i class="batch-icon batch-icon-search"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-fullscreen" aria-labelledby="navbar-notification-search-mobile">
                            <li>
                                <form class="form-inline my-2 my-lg-0 no-waves-effect">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search for..." aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary btn-gradient waves-effect waves-light" type="button">
                                                <i class="batch-icon batch-icon-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!--  DEPRECATED CODE:
                    <div class="navbar-collapse" id="navbarSupportedContent">
                -->
                <!-- USE THIS CODE Instead of the Commented Code Above -->
                <!-- .collapse added to the element -->
                <div class="collapse navbar-collapse" id="navbar-header-content">
                    <ul class="navbar-nav navbar-language-translation mr-auto">

                    </ul>

                    <ul class="navbar-nav ml-5 navbar-profile">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbar-dropdown-navbar-profile" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                                <div class="profile-name">
                                    <?php echo $this->session->userdata('username') ?>
                                </div>
                                <div class="profile-picture bg-gradient bg-primary has-message float-right">

                                    <?php

                                    $user_image = $this->db->get_where('tblusers', array('user_id' => $this->session->userdata('user_id')))->row()->photo;

                                    ?>
                                    <?php if(isset($user_image)){ ?>
                                        <img src="<?php echo base_url().'assets/uploads/'.$user_image ?>" width="44" height ="44">
                                    <?php } else {?>
                                        <img src="<?php echo base_url().'assets/uploads/default.jpg' ?>" width="44" height ="44">
                                    <?php } ?>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-navbar-profile">

                                <li>
                                    <a class="dropdown-item" href="logout">
                                        Logout
                                    </a>

                                </li>

                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>










