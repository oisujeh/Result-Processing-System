<!-- Navigation -->
        <nav class="navbar navbar-primary navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index">Bitcoin360 Exchange</a>
            </div>
            <!-- /.navbar-header -->

            <div class="navbar-primary sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                             <div class="dropdown profile-element"> <span>
                       

                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">
                               <?php echo $this->session->userdata('username') ?>
                            </strong>
                             </span> <span class="text-muted text-xs block">
                                    <?php  

                                     $user_image = $this->db->get_where('userprofile', array('id' => $this->session->userdata('user_id')))->row()->user_image;

                                      ?>
                                      <?php if(isset($user_image)){ ?>
                                     <img src="<?php echo base_url().'assets/uploads/'.$user_image ?>" width="50" height ="50" class="img-circle">
                                     <?php } else {?>
                                        <b>User</b>
                                     <?php } ?>

                                <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="edit_profile">Profile</a></li>

                            <li class="divider"></li>
                            <li><a href="logout">Logout</a></li>
                        </ul>
                    </div>
                        </li>
                         <li  <?php if($currentUrl=="index") {echo "class='active'"; } ?>>
                    <a class="nav-link" href="index"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>


                <li  <?php if($currentUrl=="userslist") {echo "class='active'"; } ?> >
                    <a  href="userslist"><i class="fa fa-edit"></i> Users List</a>
                </li>
                <li  <?php if($currentUrl=="update_exchange") {echo "class='active'"; } ?> >
                    <a  href="update_exchange"><i class="fa fa-edit"></i> Update Exchange</a>
                </li>
                 <li  <?php if($currentUrl=="user_document") {echo "class='active'"; } ?>>
                    <a href="user_document"><i class="fa fa-edit"></i> Users Document</a>
                </li>
                <li <?php if($currentUrl=="buy_history") {echo "class='active'"; } ?>>
                    <a href="buy_history"><i class="fa fa-th"></i> Buy History</a>
                </li>
                <li <?php if($currentUrl=="sell_history") {echo "class='active'"; } ?>>
                    <a href="sell_history"><i class="fa fa-th"></i> Sell History</a>

                </li>
            
                <li ><a href="logout"><i class="fa fa-lock"></i> Logout</a></li>
                
              
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>











