<style>


    #iframe1 {
        width: 100%;
        height: 500px;
        margin:0;
        padding:0;
        border:0;
    }

    #iframe2 {
        width: 100%;
        height: 7000px;
        margin:0;
        padding:0;
        border:0;
    }
</style>

<main class="main-content p-5" role="main">

    <div class="row">


        <?php
        $userid = $this->session->userdata('user_id');
        $get_memo = $this->db->query("select * from tblstudents");

        $get_pending = $this->db->query("select * from tbldepartment");

        $get_done = $this->db->query("select * from tblfaculty");


        ?>
        <div class="col-md-6 col-lg-6 col-xl-4 mb-5">
            <div class="card card-tile card-xs bg-primary bg-gradient text-center">
                <div class="card-body p-4">
                    <!-- Accepts .invisible: Makes the items. Use this only when you want to have an animation called on it later -->
                    <div class="tile-left">
                        <i class="batch-icon batch-icon-compass batch-icon-xxl"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number"><?php echo number_format($get_memo->num_rows()) ?></div>
                        <div class="tile-description">Students Count</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-4 mb-5">
            <div class="card card-tile card-xs bg-secondary bg-gradient text-center">
                <div class="card-body p-4">
                    <div class="tile-left">
                        <i class="batch-icon batch-icon-tag-alt-2 batch-icon-xxl"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number"><?php echo number_format($get_pending->num_rows()) ?></div>
                        <div class="tile-description">Department Count</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-4 mb-5">
            <div class="card card-tile card-xs bg-primary bg-gradient text-center">
                <div class="card-body p-4">
                    <div class="tile-left">
                        <i class="batch-icon batch-icon-list batch-icon-xxl"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number"><?php echo number_format($get_done->num_rows()) ?></div>
                        <div class="tile-description">Faculty Count</div>
                    </div>
                </div>
            </div>
        </div>

    </div>











