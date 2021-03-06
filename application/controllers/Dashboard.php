<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'text'));
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable" role="alert"> ' . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
        if ($this->session->userdata('user_id') != NULL) {

            $this->load->model('members_model');
            //$this->load->library('Coinbase_api');
            $this->load->library('Csvimport'); // library csvimport.php


            $this->log($this->router->fetch_method());
            //$this->load->library('s3');
//            $this->check_doc_expiration();
//            $this->check_license_expiration();
//            $this->check_vehicle_condition();

        } else {
            $this->flash("You need to login to continue", 'danger');

            redirect('signin', 'refresh');
        }


    }


    public function index()
    {
        $username = $this->session->userdata('username');


        $data['title'] = "Dashboard";
        $data['currentUrl'] = 'index';


        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')))->row();

        $user_id = $this->session->userdata('user_id');

        $this->load->view('backend/partials/header.php', $data);
        $this->load->view('backend/backend/index.php', $data);
        $this->load->view('backend/partials/footer.php', $data);
    }


    public function student_result()
    {
        $this->load->view('backend/backend/index.php', $data);
        $this->load->view('backend/backend/student_result.php', $data);
        $this->load->view('backend/partials/footer.php', $data);
    }


    public function search_result()
    {
        $url = base_url() . "dashboard" . "/search_result";
        $user_id = $this->session->userdata("user_id");

        $data ['title'] = "Search Results";
        $per_page = 25;
        $segment = $this->uri->segment(3, 0);


        $query_count = $this->db->query("select * from tblcourses")->num_rows();

        $data['datatable'] = "yes";
        $url = $this->uri->segment(3);
        $id = $url;
        //$level = $this->input->post('level');
        $level = $this->input->post('level');
        $session = $this->input->post('session');
        $matno = $this->input->post('matno');


        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')));

        $data['get_user'] = $get_user;
        $data['rid'] = $id;

        $s_level = $level;
        $s_session = $session;
        $load = $this->input->post('Load');
        if(isset($load)){

            $get_trans = $this->db->query("select * from tblresults  where level_id = $s_level and session_id = $s_session and matno = '$matno'")->row();
            //$get_trans = $this->db->query("select * from tmp.npdcfleet order by rid desc limit $segment, $per_page");
            $data['session'] = $s_session;
            $data['level'] = $s_level;
        }

        else{
            $get_trans = null;
        }

        $data['currentUrl'] = "search_result";
        $data['get_trans'] = $get_trans;
        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')))->row();

        $data['get_user'] = $get_user;
        //$this->paginate($url, $query_count, $per_page);
        $this->load->view('backend/partials/header.php', $data);
        $this->load->view('backend/backend/search_result.php', $data);
        $this->load->view('backend/partials/footer.php', $data);
    }



    public function edit_profile()
    {
        $username = $this->session->userdata('username');

        $query_user = $this->db->get_where('userprofile', array('username' => $username));


        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');


        $this->form_validation->set_rules('firstname', 'Firstname', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required|min_length[2]|max_length[100]');

        //$this->form_validation->set_rules ( 'g-recaptcha-response', "Recaptcha", 'required|callback_getResponse' );
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Edit profile";
            $data['currentUrl'] = 'edit_profile';


            $get_user = $this->db->get_where('userprofile', array('username' => $this->session->userdata('username')))->row();

            $user_id = $this->session->userdata('user_id');


            $get_doc = $this->db->get_where('userdocument', array('user_id' => $user_id));

            $data['get_doc'] = $get_doc;


            $data['get_user'] = $get_user;

            $this->load->view('backend/partials/header.php', $data);
            $this->load->view('backend/backend/edit_profile.php', $data);
            $this->load->view('backend/partials/footer.php', $data);


        } else {
            if (isset ($_POST ['btn_login'])) {

                $data_r = array(
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'country' => 'Nigeria',
                    'address' => 'address',
                    'state' => 'None',
                    'city' => 'None',
                    'referral_id' => 0

                );


                $done = $this->db->where('id', $this->session->userdata('user_id'))->update('userprofile', $data_r);
                if ($done) {

                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Update successful!</div>');
                    redirect(base_url() . 'dashboard/edit_profile', 'refresh');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"> An error occurred try again later!</div>');
                    redirect(base_url() . 'dashboard/edit_profile', 'refresh');
                }


            }
        }
    }


    public function change_password()
    {

        $password = $this->input->post('password');
        $password2 = $this->input->post('password2');
        $password1 = $this->input->post('password1');

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[100]');

        $this->form_validation->set_rules('password1', 'Old Password', 'required|min_length[5]|max_length[100]');

        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|min_length[5]|max_length[100]|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Edit profile";
            $data['currentUrl'] = 'edit_profile';

            //$data['code']=$this->members_model->makecode2();
            $this->load->view('backend/partials/header.php', $data);
            $this->load->view('backend/backend/editprofile.php', $data);
            $this->load->view('backend/partials/footer.php', $data);


        } else {
            if (isset ($_POST ['btn_login'])) {


                $get_user = $this->db->get_where('userprofile', array('username' => $this->session->userdata('username')));

                if ($get_user->row()->password == $password) {

                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Old and new password are the same </div>');

                    redirect(base_url() . 'dashboard/edit_profile', 'refresh');

                } else if ($get_user->row()->password != $password1) {
                    $this->flash("Invalid old password", "danger");
                    redirect(base_url() . 'dashboard/edit_profile', 'refresh');
                } else {

                    $this->db->where('username', $this->session->userdata('username'))->update('userprofile', array('password' => $password));
                    redirect(base_url() . 'dashboard/edit_profile', 'refresh');

                }

            }
        }
    }


    function paginate($url, $query_count, $per_page)
    {
        $this->load->library('pagination');

        $config ['base_url'] = $url;

        $config ['next_tag_open'] = '<li>';
        $config ['prev_link'] = '&laquo';
        $config ['next_link'] = '&raquo';
        $config ['prev_tag_open'] = '<li class="prev">';
        $config ['num_tag_open'] = '<li>';

        $config ['first_tag_open'] = '<li>';
        $config ['first_tag_close'] = '</li>';
        $config ['last_tag_open'] = '<li>';
        $config ['last_tag_close'] = '</li>';
        $config ['next_tag_close'] = '</li>';
        $config ['prev_tag_close'] = '</li>';
        $config ['num_tag_close'] = '</li>';

        $config ['full_tag_open'] = '<ul class="pagination">';
        $config ['full_tag_close'] = '</ul>';
        $config ['first_link'] = false;
        $config ['last_link'] = false;

        $config ['cur_tag_open'] = '<li class="active"><a href"#">';
        $config ['cur_tag_close'] = "</a></li>";

        $config ['total_rows'] = $query_count;
        $config ['per_page'] = $per_page;
        $config ['num_links'] = floor($query_count);
        $this->pagination->initialize($config);

    }


    public function doc_upload()
    {


        if (isset($_POST['send'])) {

            $doc_type = $this->input->post('doctype');

            $userid = $this->session->userdata('user_id');

            $path = './assets/docs/';

            $config['upload_path'] = $path;
            $config['allowed_types'] = 'gif|jpg|png|PNG|JPG|JPEG|jpeg';
            $config['max_size'] = 100000;
            $config['max_width'] = 3024;
            $config['max_height'] = 3024;
            $config['remove_spaces'] = TRUE;
            //$this->upload->initialize($config);
            $import_file = 0;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
                die(var_dump($error));
            } else {
                $data = array('upload_data' => $this->upload->data());
                //die($error);
            }

            if (!empty($data['upload_data']['file_name'])) {
                $import_file = $data['upload_data']['file_name'];
            } else {
                $import_file = 0;

            }


            if ($import_file != "") {
                $this->db->insert('userdocument', array('user_id' => $userid, 'user_doc' => $import_file, 'document_type' => $doc_type));

                $this->flash('uploaded successfully', 'success');

                redirect(base_url() . 'dashboard/edit_profile', 'refresh');

            } else {
                $this->flash("Upload error", "danger");
                //var_dump($import_file);
                redirect(base_url() . 'dashboard/edit_profile');

            }

        }

    }



    public function register_course()
    {
        $url = base_url() . "dashboard" . "/register_course";
        $user_id = $this->session->userdata("user_id");

        $data ['title'] = "course List";
        $per_page = 25;
        $segment = $this->uri->segment(3, 0);


        $query_count = $this->db->query("select * from tblcourses")->num_rows();

        $data['datatable'] = "yes";
        $url = $this->uri->segment(3);
        $id = $url;



        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')));

        $data['get_user'] = $get_user;
        $data['rid'] = $id;
        $s_level = $this->session->userdata('level');
        $s_session = $this->session->userdata('session');

        $get_trans = $this->db->query("select * from tblcourses  order by id");
        //$get_trans = $this->db->query("select * from tmp.npdcfleet order by rid desc limit $segment, $per_page");
        $get_transtd = $this->db->query("select * from tblstudents where id =  $id")->row();


        $matno = $get_transtd->mat_no;

        $l_level = $s_level-1;
        $l_session = $s_session- 1;
        $get_trans_c = $this->db->query("select * from tblresults 
inner join tblcourse_reg on tblcourse_reg.id = tblresults.course_reg_id
inner join tblcourses on tblcourses.id = tblcourse_reg.course_id
 where  grade = 'F' and tblresults.level_id = $l_level and tblresults.session_id = $l_session and mat_no = '$matno' order by tblcourses.id");
        $get_student = $this->db->get_where('tblstudents', array('id' => $id));
        $matno = $get_student->row()->mat_no;

        $get_trans2 = $this->db->query("select * from tblcourse_reg  where mat_no = '$matno' and session_id = $s_session and level_id = $s_level  order by id");


        $data['currentUrl'] = "register_course";
        $data['get_trans'] = $get_trans;
        $data['get_trans2'] = $get_trans2;
        $data['get_transc'] = $get_trans_c;
        $data['get_transtd'] = $get_transtd;


        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')))->row();

        $data['get_user'] = $get_user;
        //$this->paginate($url, $query_count, $per_page);
        $this->load->view('backend/partials/header.php', $data);
        $this->load->view('backend/backend/register_course.php', $data);
        $this->load->view('backend/partials/footer.php', $data);
    }





    public function add_result()
    {
        $url = base_url() . "dashboard" . "/add_result";
        $user_id = $this->session->userdata("user_id");

        $data ['title'] = "course List";
        $per_page = 25;
        $segment = $this->uri->segment(3, 0);


        //$query_count = $this->db->query("select * from tblcourse_reg")->num_rows();

        $data['datatable'] = "yes";
        $url = $this->uri->segment(3);
        $id = $url;

        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')));

        $data['get_user'] = $get_user;
        $data['rid'] = $id;

       // $get_trans = $this->db->query('select * from tblcourse_reg  order by id');

        $get_student = $this->db->get_where('tblstudents', array('id' => $id));
        $matno = $get_student->row()->mat_no;

        $get_trans = $this->db->query("select * from tblcourse_reg where mat_no = '$matno'  order by id");

        //$get_trans = $this->db->query("select * from tmp.npdcfleet order by rid desc limit $segment, $per_page");


        $data['currentUrl'] = "add_result";
        $data['get_trans'] = $get_trans;
        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')))->row();

        $data['get_user'] = $get_user;
        //$this->paginate($url, $query_count, $per_page);
        $this->load->view('backend/partials/header.php', $data);
        $this->load->view('backend/backend/add_result.php', $data);
        $this->load->view('backend/partials/footer.php', $data);
    }


   public function importcsv() {

        $data['error'] = '';    //initialize image upload error array to empty

        //convigure upload
        $path = './assets/uploads/';
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['max_size'] = 100000;
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);


       $s_level = $this->session->userdata('level');
       $s_session = $this->session->userdata('session');


       // jika upload gagal, muncul error
        if (!$this->upload->do_upload("userfile")) {
            $data['error'] = $this->upload->display_errors();

            //die($this->upload->display_errors());
            $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center"> Error occurred! File was not uploaded</div>' );
            redirect ( base_url ( 'dashboard/students_list') );
        } else {

            //prosses upload csv berhasil serta memproses insert data ke database
            $file_data = $this->upload->data();
            $file_path =  $path.$file_data['file_name'];

            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                $headers = array();
                $count= 0;
                $count2 = 0;
                $columns = 0;
                $arr = array();
                //var_dump($csv_array);

                foreach ($csv_array as $row) {
                    $count++;

                    $matno = "";
                    foreach ($row as $key => $value) {
                      // die($row[$key]);

                        $count2++;

                        if($count2 ==1){
                            $matno = $row[$key];
                        }

                        if($count2 > 1){


                            $course_id = $this->db->get_where('tblcourses', array('code' => $key))->row()->id;
                            $get_course_reg_id = $this->db->get_where("tblcourse_reg", array('mat_no' =>$matno, 'course_id' => $course_id))->row()->id;


                            $find_course = $this->db->get_where("tblresults", array('course_reg_id' => $get_course_reg_id));
                            if($find_course->num_rows() <= 0){
                                $insert_data = array(
                                    'course_reg_id'=>$get_course_reg_id,
                                    'score'=>substr($value,0, strlen($value)-1),
                                    'grade'=>substr($value,strlen($value)-1,1 ),
                                    'matno' => $matno,
                                    'session_id' => $s_session,
                                    'level_id' => $s_level,
                                );

                                $this->db->insert('tblresults', $insert_data);

                            }
                            else{

                                $insert_data = array(
                                    'score'=>substr($value,0, strlen($value)-1),
                                    'grade'=>substr($value,strlen($value)-1,1 ),
                                    'matno' => $matno,
                                    'session_id' => $s_session,
                                    'level_id' => $s_level,
                                );

                                $this->db->where('course_reg_id', $get_course_reg_id)->update('tblresults', $insert_data);
                            }

                        }
                    }

                    $count2 =0;
                }

                $this->session->set_flashdata ( 'msg', '<div class="alert alert-success text-center"> Result Imported Successfully! </div>' );
                redirect ( base_url ( 'dashboard/results') );
                //echo "<pre>"; print_r($insert_data);
            } else {
                $data['error'] = "Error occured";
                $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center"> Error occurred! Try Again </div>' );
                redirect ( base_url ( 'dashboard/results') );
            }

        }
    }




    public function students_list()
    {
        $url = base_url() . "dashboard" . "/students_list";
        $user_id = $this->session->userdata("user_id");

        $data ['title'] = "Students List";
        $per_page = 25;
        $segment = $this->uri->segment(3, 0);


        $query_count = $this->db->query("select * from tblcourses")->num_rows();

        $data['datatable'] = "yes";
        $url = $this->uri->segment(3);
        $id = $url;
        //$level = $this->input->post('level');
        $level = $this->input->get('level');
        //$session = $this->input->get('session');


        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')));

        $data['get_user'] = $get_user;
        $data['rid'] = $id;

        $s_level = $this->session->userdata('level');
        //$s_session = $this->session->userdata('session');
        $load = $this->input->get('Load');
        if(isset($s_level) && ! isset($load)){

            $get_trans = $this->db->query("select * from tblstudents  where leve = $s_level  order by id");
            //$get_trans = $this->db->query("select * from tmp.npdcfleet order by rid desc limit $segment, $per_page");
            //$data['session'] = $s_session;
            $data['level'] = $s_level;
        }

        else if(isset($load))
        {
            $get_trans = $this->db->query("select * from tblstudents  where leve = $level order by id");
            //$get_trans = $this->db->query("select * from tmp.npdcfleet order by rid desc limit $segment, $per_page");
           // $data['session'] = $session;
            $data['level'] = $level;
            $this->session->set_userdata(array( 'level' => $level));
        }
        else{
            $get_trans = null;
        }

        $data['currentUrl'] = "students_list";
        $data['get_trans'] = $get_trans;
        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')))->row();

        $data['get_user'] = $get_user;
        //$this->paginate($url, $query_count, $per_page);
        $this->load->view('backend/partials/header.php', $data);
        $this->load->view('backend/backend/students_list.php', $data);
        $this->load->view('backend/partials/footer.php', $data);
    }



    public function registered_students_list()
    {
        $url = base_url() . "dashboard" . "/registered_students_list";
        $user_id = $this->session->userdata("user_id");

        $data ['title'] = "Registered Students List";
        $per_page = 25;
        $segment = $this->uri->segment(3, 0);


        $query_count = $this->db->query("select * from tblcourses")->num_rows();

        $data['datatable'] = "yes";
        $url = $this->uri->segment(3);
        $id = $url;
        //$level = $this->input->post('level');
        $level = $this->input->get('level');
        $session = $this->input->get('session');


        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')));

        $data['get_user'] = $get_user;
        $data['rid'] = $id;

        $s_level = $this->session->userdata('level');
        $s_session = $this->session->userdata('session');
        $load = $this->input->get('Load');
        if(isset($s_session) && ! isset($load)){

            $get_trans = $this->db->query("select DISTINCT tblstudents.id, firstname, lastname, middlename, tblstudents.mat_no, faculty, department, leve from tblstudents inner join tblcourse_reg on tblcourse_reg.mat_no = tblstudents.mat_no where leve = $s_level and session = $s_session order by tblstudents.id");
            //$get_trans = $this->db->query("select * from tmp.npdcfleet order by rid desc limit $segment, $per_page");
            $data['session'] = $s_session;
            $data['level'] = $s_level;
        }

        else if(isset($load))
        {
            $get_trans = $this->db->query("select DISTINCT tblstudents.id, firstname, lastname, middlename, tblstudents.mat_no, faculty, department, leve from tblstudents inner join tblcourse_reg on tblcourse_reg.mat_no = tblstudents.mat_no  where leve = $level and session = $session order by tblstudents.id");
            //$get_trans = $this->db->query("select * from tmp.npdcfleet order by rid desc limit $segment, $per_page");
            $data['session'] = $session;
            $data['level'] = $level;
            $this->session->set_userdata(array('session' => $session, 'level' => $level));
        }
        else{
            $get_trans = null;
        }

        $data['currentUrl'] = "students_list";
        $data['get_trans'] = $get_trans;
        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')))->row();

        $data['get_user'] = $get_user;
        //$this->paginate($url, $query_count, $per_page);
        $this->load->view('backend/partials/header.php', $data);
        $this->load->view('backend/backend/registered_students_list.php', $data);
        $this->load->view('backend/partials/footer.php', $data);
    }






    public function results()
    {
        $url = base_url() . "dashboard" . "/results";
        $user_id = $this->session->userdata("user_id");

        $data ['title'] = "Report";
        $per_page = 25;
        $segment = $this->uri->segment(3, 0);


        $query_count = $this->db->query("select * from tblcourses")->num_rows();

        $data['datatable'] = "yes";
        $url = $this->uri->segment(3);
        $id = $url;
        //$level = $this->input->post('level');
        $level = $this->input->get('level');
        $session = $this->input->get('session');


        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')));

        $data['get_user'] = $get_user;
        $data['rid'] = $id;

        $s_level = $this->session->userdata('level');
        $s_session = $this->session->userdata('session');
        $load = $this->input->get('Load');
        if(isset($s_session) && ! isset($load)){

            $get_trans = $this->db->query("select DISTINCT tblstudents.id, firstname, lastname, middlename, tblstudents.mat_no, faculty, department, leve from tblstudents inner join tblcourse_reg on tblcourse_reg.mat_no = tblstudents.mat_no where leve = $s_level and session = $s_session order by tblstudents.id");
            //$get_trans = $this->db->query("select * from tmp.npdcfleet order by rid desc limit $segment, $per_page");
            $data['session'] = $s_session;
            $data['level'] = $s_level;
        }

        else if(isset($load))
        {
            $get_trans = $this->db->query("select DISTINCT tblstudents.id, firstname, lastname, middlename, tblstudents.mat_no, faculty, department, leve from tblstudents inner join tblcourse_reg on tblcourse_reg.mat_no = tblstudents.mat_no  where leve = $level and session = $session order by tblstudents.id");
            //$get_trans = $this->db->query("select * from tmp.npdcfleet order by rid desc limit $segment, $per_page");
            $data['session'] = $session;
            $data['level'] = $level;
            $this->session->set_userdata(array('session' => $session, 'level' => $level));
        }
        else{
            $get_trans = null;
        }

        $data['currentUrl'] = "students_list";
        $data['get_trans'] = $get_trans;
        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')))->row();

        $data['get_user'] = $get_user;
        //$this->paginate($url, $query_count, $per_page);
        $this->load->view('backend/partials/header.php', $data);
        $this->load->view('backend/backend/results.php', $data);
        $this->load->view('backend/partials/footer.php', $data);
    }



    public function move_students_list()
    {
        $url = base_url() . "dashboard" . "/move_students_list";
        $user_id = $this->session->userdata("user_id");
        $data ['title'] = "Move Students List";
        $per_page = 25;
        $segment = $this->uri->segment(3, 0);
        $query_count = $this->db->query("select * from tblcourses")->num_rows();
        $data['datatable'] = "yes";
        $url = $this->uri->segment(3);
        $id = $url;
        $level = $this->input->get('level');
        $session = $this->input->get('session');






        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')));

        $data['get_user'] = $get_user;
        $data['rid'] = $id;
        $s_level = $this->session->userdata('level');
        $s_session = $this->session->userdata('session');
        $load = $this->input->get('Load');
            if(isset($s_session) && ! isset($load)){

            $get_trans = $this->db->query("select * from tblstudents  where leve = $s_level and session = $s_session order by id");
            //$get_trans = $this->db->query("select * from tmp.npdcfleet order by rid desc limit $segment, $per_page");
            $data['session'] = $s_session;
            $data['level'] = $s_level;
        }

        else if(isset($load))
        {
            $get_trans = $this->db->query("select * from tblstudents  where leve = $level and session = $session order by id");
            //$get_trans = $this->db->query("select * from tmp.npdcfleet order by rid desc limit $segment, $per_page");
            $data['session'] = $session;
            $data['level'] = $level;
            $this->session->set_userdata(array('session' => $session, 'level' => $level));

        }
        else{
            $get_trans = null;
        }

        if(isset($_POST['move'])){
            $checkbox = $this->input->post("checkbox[]");


            foreach ($checkbox as $user_selected) {

               // Is there a way to make room for that, where if total credit passed
                // is less than 22 students
                // is to repeat that level in the new session ,
                //if credit passed is above 22 move student to new level and session
                //Generate list of student to probate or withdraw
                //If credit passed is less than 22 repeat, if credit passed is less than 11 withdraw
                //Abeg add, total credit registered should not exceed 50
//
//                $get_curr_level = $this->db->query("select * from tblstudents  where id = $user_selected");
//                $nlevel = $get_curr_level->row()->level + 1;
//                $nsession = $get_curr_level->row()->session + 1;


                $get_student = $this->db->query("select * from tblstudents  where id = $user_selected")->row();

                $matno = $get_student->mat_no;

                $get_co = $this->db->query("select sum(tblcourses.load) as cload from tblresults 
inner join tblcourse_reg on tblcourse_reg.id = tblresults.course_reg_id
inner join tblcourses on tblcourses.id = tblcourse_reg.course_id
 where mat_no ='$matno' and grade <> 'F' and tblresults.level_id = $s_level and tblresults.session_id = $s_session");

                if($get_co->row()->cload < 22){
                    //probate
                    $this->db->query("update tblstudents set  session =  session +1, status='probate' where id =$user_selected");

                }
                else if($get_co->row()->cload  < 11){
                    $this->db->query("update tblstudents set  session =  session +1, status = 'withdraw' where id =$user_selected");

                }
                else if($get_co->row()->cload  >= 22){
                    //move to new level
                    $this->db->query("update tblstudents set leve = leve +1,  session =  session +1, status= 'promote' where id =$user_selected");

                }
               // $this->db->where('id', $user_selected)->update('tblstudents', array('level' => $nlevel, 'session' => $nsession));
            }
             $this->session->set_flashdata ( 'msg', '<div class="alert alert-success text-center"> Students Moved Successfully! </div>' );
            redirect ( base_url ( 'dashboard/students_list') );
        }


        $data['currentUrl'] = "students_list";
        $data['get_trans'] = $get_trans;
        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')))->row();

        $data['get_user'] = $get_user;
        //$this->paginate($url, $query_count, $per_page);
        $this->load->view('backend/partials/header.php', $data);
        $this->load->view('backend/backend/move_students_list.php', $data);
        $this->load->view('backend/partials/footer.php', $data);
    }


    public function cgpa_students_list()
    {
        $url = base_url() . "dashboard" . "/cgpa_students_list";
        $user_id = $this->session->userdata("user_id");
        $data ['title'] = "CGPA Students List";
        $per_page = 25;
        $segment = $this->uri->segment(3, 0);
        $query_count = $this->db->query("select * from tblcourses")->num_rows();
        $data['datatable'] = "yes";
        $url = $this->uri->segment(3);
        $id = $url;
        $level = $this->input->get('level');
        $session = $this->input->get('session');

        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')));

        $data['get_user'] = $get_user;
        $data['rid'] = $id;
        $s_level = $this->session->userdata('level');
        $s_session = $this->session->userdata('session');
        $load = $this->input->get('Load');
        if(isset($s_session) && ! isset($load)){

            $get_trans = $this->db->query("select * from tblstudents  where leve = $s_level and session = $s_session order by id");
            //$get_trans = $this->db->query("select * from tmp.npdcfleet order by rid desc limit $segment, $per_page");
            $data['session'] = $s_session;
            $data['level'] = $s_level;
        }

        else if(isset($load))
        {
            $get_trans = $this->db->query("select * from tblstudents  where leve = $level and session = $session order by id");
            //$get_trans = $this->db->query("select * from tmp.npdcfleet order by rid desc limit $segment, $per_page");
            $data['session'] = $session;
            $data['level'] = $level;
        }
        else{
            $get_trans = null;
        }



        $data['currentUrl'] = "cgpa_students_list";
        $data['get_trans'] = $get_trans;
        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')))->row();

        $data['get_user'] = $get_user;
        //$this->paginate($url, $query_count, $per_page);
        $this->load->view('backend/partials/header.php', $data);
        $this->load->view('backend/backend/cgpa_students_list.php', $data);
        $this->load->view('backend/partials/footer.php', $data);
    }


    public function activity_log()
    {
        $url = base_url() . "dashboard" . "/activity_log";
        $user_id = $this->session->userdata("user_id");

        $data['datatable'] = "yes";

        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')))->row();

        $data ['title'] = "Activity Log";
        $per_page = 25;
        $segment = $this->uri->segment(3, 0);




        $query_count = $this->db->query("select * from tblactivity_log")->num_rows();


        $get_trans = $this->db->query("select * from tblactivity_log");


        $data['currentUrl'] = "activity_log";
        $data['get_trans'] = $get_trans;

        $data['get_user'] = $get_user;
        //$this->paginate($url, $query_count, $per_page);
        $this->load->view('backend/partials/header.php', $data);
        $this->load->view('backend/backend/activity_log.php', $data);
        $this->load->view('backend/partials/footer.php', $data);
    }


    public function add_course()
    {

        //$id = $this->input->post('id');
        $student_id = $this->input->post('student_id');
        $get_student = $this->db->get_where('tblstudents', array('id' => $student_id))->row();

        if (isset($_POST['add'])) {

            $checkbox = $this->input->post("checkbox[]");

            $level_id = $this->session->userdata('level');
            $session_id = $this->session->userdata('session');

            foreach ($checkbox as $user_selected) {
                $check_course = $this->db->get_where('tblcourse_reg', array('course_id' => $user_selected,
                    'mat_no' => $get_student->mat_no, 'session_id' => $get_student->session));
                if ($check_course->num_rows() <= 0) {

                    $addreg = array('course_id' => $user_selected,
                        'mat_no' => $get_student->mat_no,
                        'faculty_id' => $get_student->faculty,
                        'department_id' => $get_student->department,
                        'level_id' => $get_student->leve,
                        'semester_id' => $this->db->get_where('tblcourses', array('id' => $user_selected))->row()->semester,
                        'session_id' => $get_student->session
                    );

                    $this->db->insert('tblcourse_reg', $addreg);
                }
//                else {
//                    $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center"> Already registered! </div>' );
//                    redirect ( base_url ( 'dashboard/register_course/'.$student_id) );
//                }


            }


            $this->session->set_flashdata('msg', '<div class="alert alert-info text-center"> added successfully! </div>');
            redirect(base_url('dashboard/register_course/' . $student_id));

        } else if (isset($_POST['remove'])) {

            $checkbox = $this->input->post("checkbox[]");

            foreach ($checkbox as $user_selected) {
            $check_course = $this->db->get_where('tblcourse_reg', array('id' => $user_selected,
                'mat_no' => $get_student->mat_no, 'session_id' => $get_student->session));
            if ($check_course->num_rows() > 0) {

                $addreg = array('id' => $user_selected,
                    'mat_no' => $get_student->mat_no,
                    'session_id' =>  $get_student->session
                );


                $this->db->where($addreg)->delete('tblcourse_reg');
                $this->db->where('course_reg_id', $user_selected)->delete('tblresults');
            }
                $this->session->set_flashdata('msg', '<div class="alert alert-info text-center"> deleted successfully! </div>');
                redirect(base_url('dashboard/register_course/' . $student_id));
            }
        }

    }


    public function export_result(){

        $this->load->library('excel');

        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        //$this->excel->getActiveSheet()->setTitle('Students List');
        //set cell A1 content with some text
//        $this->excel->getActiveSheet()->setCellValue('A1', 'TransID');
//        $this->excel->getActiveSheet()->setCellValue('B1', 'Amount');
//        $this->excel->getActiveSheet()->setCellValue('C1', 'Status');
//        $this->excel->getActiveSheet()->setCellValue('D1', 'Type');
//        $this->excel->getActiveSheet()->setCellValue('E1', 'Comment');
//        $this->excel->getActiveSheet()->setCellValue('F1', 'Date');
//
//
//        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
//        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
//        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
//        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
//        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
//        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        //change the font size
        //for($i=  ord('A'); $i<=ord('I'); $i++){

        //}

        $exceldata= "";
        $no = 0;
        $rowexcel = 6;
        $rowexcel2 = 2;


        $blackBold = array( "font" => array("bold" => true,"color" => array("rgb" => "000000"),),);

        $level = $this->db->get_where('tbllevel', array('id' => $this->session->userdata('level')))->row()->title;

        $session = $this->db->get_where('tblsession', array('id' => $this->session->userdata('session') ))->row()->session;

        $level_id = $this->session->userdata('level');
        $session_id = $this->session->userdata('session');


        $this->excel->getActiveSheet()->mergeCells('A1:Y1');
        $this->excel->getActiveSheet()->setCellValue('A1', "DEPARTMENT OF COMPUTER SCIENCE, FACULTY OF PHYSICAL SCIENCES");
        $this->excel->getActiveSheet()->mergeCells('A2:Y2');
        $this->excel->getActiveSheet()->setCellValue('A2', "Level: $level, Semester: First and Second, Course Examination Result: $session, Pass Mark: 40%");

        $this->excel->getActiveSheet()->getStyle('A1:Y1')->getFont()->setSize(14);
        //make the font become+ bold
        $this->excel->getActiveSheet()->getStyle('A1:Y1')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->getStyle('A1:Y1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A2:Y2')->getFont()->setSize(14);
        //make the font become+ bold
        $this->excel->getActiveSheet()->getStyle('A2:Y2')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->getStyle('A2:Y2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 6,"S/N");
        $this->excel->getActiveSheet()->getCellByColumnAndRow(0,6)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, 6,"Matric Number");
        $this->excel->getActiveSheet()->getCellByColumnAndRow(1,6)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, 6,"Full Name (LASTNAME IN BLOCK LETTERS)");
        $this->excel->getActiveSheet()->getCellByColumnAndRow(2,6)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->getStyle("C6")->getAlignment()->setWrapText(true);
        $this->excel->getActiveSheet()->getRowDimension('6')->setRowHeight(40);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $rs1 = $this->db->query("select * from tblcourses where semester = 1 and level=$level_id order BY id ");

        $rs2 = $this->db->query("select * from tblcourses where semester = 2 and level =$level_id order BY id ");
        $ist_sm_count = $rs1->num_rows();
        //3+5+2

        $nd_sm_count = $rs2->num_rows();
        $column = 2;

        foreach ($rs1->result() as $row1){
            $column++;
            //c4,c5
            //add courses and course codes
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, 3,$row1->title);
            $adjustedColumn = PHPExcel_Cell::stringFromColumnIndex($column);
            $this->excel->getActiveSheet()->getStyle($adjustedColumn.'3')->getAlignment()->setTextRotation(90);
            $this->excel->getActiveSheet()->getStyle($adjustedColumn.'4')->getAlignment()->setWrapText(true);
            $this->excel->getActiveSheet()->getRowDimension('4')->setRowHeight(40);
            $this->excel->getActiveSheet()->getColumnDimension($adjustedColumn)->setWidth(5);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, 4, $row1->code);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, 5,$row1->load);
           // $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, 6,$row1->load);
            //$get_Score = $this->db->query("select  DISTINCT tblcourse_reg.mat_no, firstname, middlename, lastname from tblresults inner join tblcourse_reg on tblcourse_reg.id = tblresults.course_reg_id inner join tblstudents on tblstudents.mat_no = tblcourse_reg.mat_no");
           // $get_Score = $this->db->query("select * from tblresults inner join tblcourse_reg on tblcourse_reg.id = tblresults.course_reg_id inner join tblstudents on tblstudents.mat_no = tblcourse_reg.mat_no where tblcourse_reg.mat_no='$matno' and tblcourse_reg.course_id = $row1->id");

        }



        $column = $column +1;

        foreach ($rs2->result() as $row2){
            $column++;
            //c4,c5
            //add courses and course codes
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, 3,$row2->title);
            $adjustedColumn = PHPExcel_Cell::stringFromColumnIndex($column);
            $this->excel->getActiveSheet()->getStyle($adjustedColumn.'3')->getAlignment()->setTextRotation(90);
            $this->excel->getActiveSheet()->getStyle($adjustedColumn.'4')->getAlignment()->setWrapText(true);
            $this->excel->getActiveSheet()->getRowDimension('4')->setRowHeight(40);
            $this->excel->getActiveSheet()->getColumnDimension($adjustedColumn)->setWidth(5);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, 4, $row2->code);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, 5,$row2->load);
            // $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, 6,$row1->load);
            //$get_Score = $this->db->query("select  DISTINCT tblcourse_reg.mat_no, firstname, middlename, lastname from tblresults inner join tblcourse_reg on tblcourse_reg.id = tblresults.course_reg_id inner join tblstudents on tblstudents.mat_no = tblcourse_reg.mat_no");
            // $get_Score = $this->db->query("select * from tblresults inner join tblcourse_reg on tblcourse_reg.id = tblresults.course_reg_id inner join tblstudents on tblstudents.mat_no = tblcourse_reg.mat_no where tblcourse_reg.mat_no='$matno' and tblcourse_reg.course_id = $row1->id");

        }



        //total registered, failed and passed
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column+1, 3,"Total Credit Passed");
        $adjustedColumn = PHPExcel_Cell::stringFromColumnIndex($column+1);
        $this->excel->getActiveSheet()->getStyle($adjustedColumn.'3')->getAlignment()->setTextRotation(90);
        $this->excel->getActiveSheet()->getStyle($adjustedColumn.'4')->getAlignment()->setWrapText(true);
        $this->excel->getActiveSheet()->getRowDimension('4')->setRowHeight(40);
        $this->excel->getActiveSheet()->getColumnDimension($adjustedColumn)->setWidth(5);


        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column+2, 3,"Total Credit Failed");
        $adjustedColumn = PHPExcel_Cell::stringFromColumnIndex($column+2);
        $this->excel->getActiveSheet()->getStyle($adjustedColumn.'3')->getAlignment()->setTextRotation(90);
        $this->excel->getActiveSheet()->getStyle($adjustedColumn.'4')->getAlignment()->setWrapText(true);
        $this->excel->getActiveSheet()->getRowDimension('4')->setRowHeight(40);
        $this->excel->getActiveSheet()->getColumnDimension($adjustedColumn)->setWidth(5);

        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column+3, 3,"Total Credit Registered");
        $adjustedColumn = PHPExcel_Cell::stringFromColumnIndex($column+3);
        $this->excel->getActiveSheet()->getStyle($adjustedColumn.'3')->getAlignment()->setTextRotation(90);
        $this->excel->getActiveSheet()->getStyle($adjustedColumn.'4')->getAlignment()->setWrapText(true);
        $this->excel->getActiveSheet()->getRowDimension('4')->setRowHeight(40);
        $this->excel->getActiveSheet()->getColumnDimension($adjustedColumn)->setWidth(5);






        $col = 3;

        $level_id = $this->session->userdata('level');
        $session_id = $this->session->userdata('session');

        //$get_students = $this->db->query("select * from tblstudents where session = $session_id and leve = $level_id");

        $get_stud = $this->db->query("select DISTINCT matno from tblresults where level_id = $level_id and session_id = $session_id order by id");
        foreach($get_stud->result() as $row){

            $total_credit_passed = 0;
            $total_credit_failed = 0;
            $total_credit_registered = 0;

            $no++;
            $rowexcel++;



            $matno = $row->matno;
            $get_students = $this->db->query("select * from tblstudents where mat_no = '$matno'")->row();

            $get_Score = $this->db->query("select * from tblresults inner join tblcourse_reg on tblcourse_reg.id = tblresults.course_reg_id  inner JOIN tblcourses on tblcourses.id = tblcourse_reg.course_id where tblcourse_reg.mat_no='$matno' and tblcourses.semester =1 and tblcourses.level=$level_id order by course_id");


            $get_Score2 = $this->db->query("select * from tblresults inner join tblcourse_reg on tblcourse_reg.id = tblresults.course_reg_id  inner JOIN tblcourses on tblcourses.id = tblcourse_reg.course_id where tblcourse_reg.mat_no='$matno' and tblcourses.semester =2 and tblcourses.level=$level_id order by course_id");



            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $rowexcel, $no);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $rowexcel, $get_students->mat_no);
            //$this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $rowexcel, $row->mat_no);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $rowexcel, $get_students->firstname. ' '.$get_students->middlename. ' '.strtoupper($get_students->lastname));

            foreach ($get_Score->result() as $r2){

                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $rowexcel, $r2->score.' '.$r2->grade);
                if($r2->grade != 'F'){
                    $total_credit_passed = $total_credit_passed + $r2->load;
                }
                else{
                    $total_credit_failed = $total_credit_failed + $r2->load;
                }
                $total_credit_registered = $total_credit_registered + $r2->load;
                $col++;
            }


            $col = 3+  $ist_sm_count+ 1;

            foreach ($get_Score2->result() as $r3){

                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $rowexcel, $r3->score.' '.$r3->grade);
                if($r3->grade != 'F'){
                    $total_credit_passed = $total_credit_passed + $r3->load;
                }
                else{
                    $total_credit_failed = $total_credit_failed + $r3->load;
                }
                $total_credit_registered = $total_credit_registered + $r3->load;
                $col++;
            }

            $col = 3+ $ist_sm_count + $nd_sm_count +1;

            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $rowexcel, $total_credit_passed);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col+1, $rowexcel, $total_credit_failed);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col+2, $rowexcel, $total_credit_registered);

            $col = 3;

        }



        ///apend course advisers sign and other details
        ///

//
//        $newrow =  $rowexcel +2;
//
//        $this->excel->getActiveSheet()->mergeCells("B".$newrow.":D".$newrow);
//
//        $this->excel->getActiveSheet()->mergeCells("G".$newrow.":J".$newrow);
//
//        $this->excel->getActiveSheet()->mergeCells("L".$newrow.":O".$newrow);
//
//        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $newrow, "Course Adviser Sign___________________");
//        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, $newrow, "Head of Department's Sign_______________________");
//        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(11, $newrow, "Dean of Physical Science Sign______________________");
//
//
//        $this->excel->getActiveSheet()->getRowDimension($newrow)->setRowHeight(100);
//        $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth(30);
//        $this->excel->getActiveSheet()->getColumnDimension("G")->setWidth(30);
//        $this->excel->getActiveSheet()->getColumnDimension("L")->setWidth(30);
//


        //headers

        $adjustedColumn = PHPExcel_Cell::stringFromColumnIndex($column);

        $ist_semester_Column = PHPExcel_Cell::stringFromColumnIndex(3 + $rs1->num_rows()-1);
        //die($adjustedColumn);
        $ist_semester_Column_w = PHPExcel_Cell::stringFromColumnIndex(3 + $rs1->num_rows() +1);
        $nd_semester_Column = PHPExcel_Cell::stringFromColumnIndex(3 + $rs1->num_rows() + $rs2->num_rows());
        $this->excel->getActiveSheet()->getStyle("A6:".$ist_semester_Column."6")->getFont()->setSize(14);
        $this->excel->getActiveSheet()->mergeCells("D6:".$ist_semester_Column."6");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, 6,"First Semester");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, 4,"Course Code");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, 5,"Credit Load");
        $this->excel->getActiveSheet()->getStyle("C4")->getFont()->setSize(14);
        $this->excel->getActiveSheet()->getStyle("C5")->getFont()->setSize(14);
        $this->excel->getActiveSheet()->getCellByColumnAndRow(3,6)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->getCellByColumnAndRow(3,4)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->getCellByColumnAndRow(3,5)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3 + $rs1->num_rows()+1, 6,"Second Semester");
        $this->excel->getActiveSheet()->getStyle($ist_semester_Column_w."6:".$nd_semester_Column."6")->getFont()->setSize(14);
        $this->excel->getActiveSheet()->mergeCells($ist_semester_Column_w."6:".$nd_semester_Column."6");
        $this->excel->getActiveSheet()->getCellByColumnAndRow(4,6)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $this->excel->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $adjustedColumn1 = PHPExcel_Cell::stringFromColumnIndex($column +1);
        $this->excel->getActiveSheet()->getStyle('D6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle($ist_semester_Column_w."6")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);











        //$this->excel->getActiveSheet()->fromArray($exceldata, null,'A2');
        //$this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to D1)
        $d_date = date('Y-m-d h:i:s');
        $filename="result_$d_date.xls"; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');


    }



    public function success_result(){

        $this->load->library('excel');

        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);

        $exceldata= "";
        $no = 0;
        $rowexcel = 4;
        $rowexcel2 = 2;


        $blackBold = array( "font" => array("bold" => true,"color" => array("rgb" => "000000"),),);

        $level = $this->db->get_where('tbllevel', array('id' => $this->session->userdata('level')))->row()->title;

        $session = $this->db->get_where('tblsession', array('id' => $this->session->userdata('session') ))->row()->session;

        $this->excel->getActiveSheet()->mergeCells('A1:Y1');
        $this->excel->getActiveSheet()->setCellValue('A1', "DEPARTMENT OF COMPUTER SCIENCE, FACULTY OF PHYSICAL SCIENCES");
        $this->excel->getActiveSheet()->mergeCells('A2:Y2');
        $this->excel->getActiveSheet()->setCellValue('A2', "Level: $level, Semester: First and Second, Course Examination Result: $session, Pass Mark: 40%");

        $this->excel->getActiveSheet()->mergeCells('A3:Y3');
        $this->excel->getActiveSheet()->setCellValue('A3', "Successful Students");

        $this->excel->getActiveSheet()->getStyle('A1:Y1')->getFont()->setSize(14);
        //make the font become+ bold
        $this->excel->getActiveSheet()->getStyle('A1:Y1')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->getStyle('A1:Y1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A2:Y2')->getFont()->setSize(14);
        //make the font become+ bold
        $this->excel->getActiveSheet()->getStyle('A2:Y2')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->getStyle('A2:Y2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->getStyle('A3:Y3')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->getStyle('A3:Y3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 4,"S/N");
        $this->excel->getActiveSheet()->getCellByColumnAndRow(0,4)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, 4,"Matric Number");
        $this->excel->getActiveSheet()->getCellByColumnAndRow(1,4)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, 4,"Full Name (LASTNAME IN BLOCK LETTERS)");

        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, 4,"TOTAL CREDITS EARNED");

        $this->excel->getActiveSheet()->getCellByColumnAndRow(2,6)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);

        $col = 3;

        $level_id = $this->session->userdata('level');
        $session_id = $this->session->userdata('session');

        //$get_students = $this->db->query("select * from tblstudents where session = $session_id and leve = $level_id");

        $get_stud = $this->db->query("select DISTINCT matno from tblresults where level_id = $level_id and session_id = $session_id order by id");

        foreach($get_stud->result() as $row){
            $total_credit_passed = 0;
            $total_credit_failed = 0;
            $total_credit_registered = 0;
            $no++;
            $rowexcel++;

            $matno = $row->matno;
            $get_students = $this->db->query("select * from tblstudents where mat_no = '$matno'")->row();

            $get_Score = $this->db->query("select * from tblresults inner join tblcourse_reg on tblcourse_reg.id = tblresults.course_reg_id inner JOIN tblcourses on tblcourses.id = tblcourse_reg.course_id where tblcourse_reg.mat_no='$matno' and tblcourses.level=$level_id order by course_id");


            foreach ($get_Score->result() as $r2){

               // $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $rowexcel, $r2->score.''.$r2->grade);
                if($r2->grade != 'F'){
                    $total_credit_passed = $total_credit_passed + $r2->load;
                }
                else{
                    $total_credit_failed = $total_credit_failed + $r2->load;
                }
                $total_credit_registered = $total_credit_registered + $r2->load;
                //$col++;
            }


            $get_students = $this->db->query("select * from tblstudents where mat_no = '$matno'")->row();


            if($total_credit_passed == $total_credit_registered){

                $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $rowexcel, $no);
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $rowexcel, $get_students->mat_no);
                //$this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $rowexcel, $row->mat_no);
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $rowexcel, $get_students->firstname. ' '.$get_students->middlename. ' '.strtoupper($get_students->lastname));

                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $rowexcel, $total_credit_registered);
            }




        }


        $d_date = date('Y-m-d h:i:s');
        $filename="successful_result_$d_date.xls"; //save our workbook as this file name
        ob_clean();
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');


    }


    public function probated_students(){

        $this->load->library('excel');

        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);

        $exceldata= "";
        $no = 0;
        $rowexcel = 4;
        $rowexcel2 = 2;


        $blackBold = array( "font" => array("bold" => true,"color" => array("rgb" => "000000"),),);

        $level = $this->db->get_where('tbllevel', array('id' => $this->session->userdata('level')))->row()->title;

        $session = $this->db->get_where('tblsession', array('id' => $this->session->userdata('session') ))->row()->session;

        $this->excel->getActiveSheet()->mergeCells('A1:Y1');
        $this->excel->getActiveSheet()->setCellValue('A1', "DEPARTMENT OF COMPUTER SCIENCE, FACULTY OF PHYSICAL SCIENCES");
        $this->excel->getActiveSheet()->mergeCells('A2:Y2');
        $this->excel->getActiveSheet()->setCellValue('A2', "Level: $level, Semester: First and Second, Course Examination Result: $session, Pass Mark: 40%");

        $this->excel->getActiveSheet()->mergeCells('A3:Y3');
        $this->excel->getActiveSheet()->setCellValue('A3', "Probated Students");

        $this->excel->getActiveSheet()->getStyle('A1:Y1')->getFont()->setSize(14);
        //make the font become+ bold
        $this->excel->getActiveSheet()->getStyle('A1:Y1')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->getStyle('A1:Y1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A2:Y2')->getFont()->setSize(14);
        //make the font become+ bold
        $this->excel->getActiveSheet()->getStyle('A2:Y2')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->getStyle('A2:Y2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->getStyle('A3:Y3')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->getStyle('A3:Y3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 4,"S/N");
        $this->excel->getActiveSheet()->getCellByColumnAndRow(0,4)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, 4,"Matric Number");
        $this->excel->getActiveSheet()->getCellByColumnAndRow(1,4)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, 4,"Full Name (LASTNAME IN BLOCK LETTERS)");

        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, 4,"TOTAL CREDITS FAILED");

        $this->excel->getActiveSheet()->getCellByColumnAndRow(2,6)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);

        $col = 3;

        $level_id = $this->session->userdata('level');
        $session_id = $this->session->userdata('session');

        //$get_students = $this->db->query("select * from tblstudents where session = $session_id and leve = $level_id");
        $get_students = $this->db->query("select * from tblstudents where session = $session_id and leve = $level_id and status='probate'");

        //$get_stud = $this->db->query("select DISTINCT matno from tblresults where level_id = $level_id and session_id = $session_id order by id");

        foreach($get_students->result() as $row){
            $total_credit_passed = 0;
            $total_credit_failed = 0;
            $total_credit_registered = 0;
            $no++;
            $rowexcel++;

            $matno = $row->mat_no;

            $get_Score = $this->db->query("select * from tblresults inner join tblcourse_reg on tblcourse_reg.id = tblresults.course_reg_id inner JOIN tblcourses on tblcourses.id = tblcourse_reg.course_id where tblcourse_reg.mat_no='$matno' and tblcourses.level=$level_id order by course_id");


            foreach ($get_Score->result() as $r2){

                if($r2->grade != 'F'){
                    $total_credit_passed = $total_credit_passed + $r2->load;
                }
                else{
                    $total_credit_failed = $total_credit_failed + $r2->load;

                }
                $total_credit_registered = $total_credit_registered + $r2->load;
                //$col++;
            }


            $get_students = $this->db->query("select * from tblstudents where mat_no = '$matno'")->row();


            if($total_credit_failed > 0){

                $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $rowexcel, $no);
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $rowexcel, $get_students->mat_no);
                //$this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $rowexcel, $row->mat_no);
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $rowexcel, $get_students->firstname. ' '.$get_students->middlename. ' '.strtoupper($get_students->lastname));

                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $rowexcel, $total_credit_failed);
            }




        }


        $d_date = date('Y-m-d h:i:s');
        $filename="probated_result_$d_date.xls"; //save our workbook as this file name
        ob_clean();
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');


    }



    public function withdraw_students(){

        $this->load->library('excel');

        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);

        $exceldata= "";
        $no = 0;
        $rowexcel = 4;
        $rowexcel2 = 2;


        $blackBold = array( "font" => array("bold" => true,"color" => array("rgb" => "000000"),),);

        $level = $this->db->get_where('tbllevel', array('id' => $this->session->userdata('level')))->row()->title;

        $session = $this->db->get_where('tblsession', array('id' => $this->session->userdata('session') ))->row()->session;

        $this->excel->getActiveSheet()->mergeCells('A1:Y1');
        $this->excel->getActiveSheet()->setCellValue('A1', "DEPARTMENT OF COMPUTER SCIENCE, FACULTY OF PHYSICAL SCIENCES");
        $this->excel->getActiveSheet()->mergeCells('A2:Y2');
        $this->excel->getActiveSheet()->setCellValue('A2', "Level: $level, Semester: First and Second, Course Examination Result: $session, Pass Mark: 40%");

        $this->excel->getActiveSheet()->mergeCells('A3:Y3');
        $this->excel->getActiveSheet()->setCellValue('A3', "Withdraw Students");

        $this->excel->getActiveSheet()->getStyle('A1:Y1')->getFont()->setSize(14);
        //make the font become+ bold
        $this->excel->getActiveSheet()->getStyle('A1:Y1')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->getStyle('A1:Y1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A2:Y2')->getFont()->setSize(14);
        //make the font become+ bold
        $this->excel->getActiveSheet()->getStyle('A2:Y2')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->getStyle('A2:Y2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->getStyle('A3:Y3')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->getStyle('A3:Y3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 4,"S/N");
        $this->excel->getActiveSheet()->getCellByColumnAndRow(0,4)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, 4,"Matric Number");
        $this->excel->getActiveSheet()->getCellByColumnAndRow(1,4)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, 4,"Full Name (LASTNAME IN BLOCK LETTERS)");

        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, 4,"TOTAL CREDITS FAILED");

        $this->excel->getActiveSheet()->getCellByColumnAndRow(2,6)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);

        $col = 3;

        $level_id = $this->session->userdata('level');
        $session_id = $this->session->userdata('session');

        //$get_students = $this->db->query("select * from tblstudents where session = $session_id and leve = $level_id");
        $get_students = $this->db->query("select * from tblstudents where session = $session_id and leve = $level_id and status='withdraw'");

        //$get_stud = $this->db->query("select DISTINCT matno from tblresults where level_id = $level_id and session_id = $session_id order by id");

        foreach($get_students->result() as $row){
            $total_credit_passed = 0;
            $total_credit_failed = 0;
            $total_credit_registered = 0;
            $no++;
            $rowexcel++;

            $matno = $row->mat_no;

            $get_Score = $this->db->query("select * from tblresults inner join tblcourse_reg on tblcourse_reg.id = tblresults.course_reg_id inner JOIN tblcourses on tblcourses.id = tblcourse_reg.course_id where tblcourse_reg.mat_no='$matno' and tblcourses.level=$level_id order by course_id");


            foreach ($get_Score->result() as $r2){

                if($r2->grade != 'F'){
                    $total_credit_passed = $total_credit_passed + $r2->load;
                }
                else{
                    $total_credit_failed = $total_credit_failed + $r2->load;

                }
                $total_credit_registered = $total_credit_registered + $r2->load;
                //$col++;
            }


            $get_students = $this->db->query("select * from tblstudents where mat_no = '$matno'")->row();


            if($total_credit_failed > 0){

                $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $rowexcel, $no);
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $rowexcel, $get_students->mat_no);
                //$this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $rowexcel, $row->mat_no);
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $rowexcel, $get_students->firstname. ' '.$get_students->middlename. ' '.strtoupper($get_students->lastname));

                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $rowexcel, $total_credit_failed);
            }


        }


        $d_date = date('Y-m-d h:i:s');
        $filename="probated_result_$d_date.xls"; //save our workbook as this file name
        ob_clean();
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');


    }


    public function unsuccess_result(){

        $this->load->library('excel');

        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        $no = 0;
        $rowexcel = 4;

        $blackBold = array( "font" => array("bold" => true,"color" => array("rgb" => "000000"),),);

        $level = $this->db->get_where('tbllevel', array('id' => $this->session->userdata('level')))->row()->title;

        $session = $this->db->get_where('tblsession', array('id' => $this->session->userdata('session') ))->row()->session;


        $this->excel->getActiveSheet()->mergeCells('A1:Y1');
        $this->excel->getActiveSheet()->setCellValue('A1', "DEPARTMENT OF COMPUTER SCIENCE, FACULTY OF PHYSICAL SCIENCES");
               $this->excel->getActiveSheet()->mergeCells('A2:Y2');
        $this->excel->getActiveSheet()->setCellValue('A2', "Level: $level, Semester: First and Second, Course Examination Result: $session, Pass Mark: 40%");

        $this->excel->getActiveSheet()->mergeCells('A3:Y3');
        $this->excel->getActiveSheet()->setCellValue('A3', "Unsuccessful Students");

        $this->excel->getActiveSheet()->getStyle('A1:Y1')->getFont()->setSize(14);
        //make the font become+ bold
        $this->excel->getActiveSheet()->getStyle('A1:Y1')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->getStyle('A1:Y1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A2:Y2')->getFont()->setSize(14);
        //make the font become+ bold
        $this->excel->getActiveSheet()->getStyle('A2:Y2')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->getStyle('A2:Y2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->getStyle('A3:Y3')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->getStyle('A3:Y3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 4,"S/N");
        $this->excel->getActiveSheet()->getCellByColumnAndRow(0,4)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, 4,"Matric Number");
        $this->excel->getActiveSheet()->getCellByColumnAndRow(1,4)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, 4,"Full Name (LASTNAME IN BLOCK LETTERS)");

        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, 4,"TOTAL CREDITS EARNED");

        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, 4,"TOTAL CREDITS FAILED");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, 4,"OUTSTANDING COURSES");


        $this->excel->getActiveSheet()->getCellByColumnAndRow(2,4)->getStyle()->applyFromArray($blackBold);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);



        $col = 3;
        $level_id = $this->session->userdata('level');
        $session_id = $this->session->userdata('session');

        //$get_students = $this->db->query("select * from tblstudents where session = $session_id and leve = $level_id");

        $get_stud = $this->db->query("select DISTINCT matno from tblresults where level_id = $level_id and session_id = $session_id order by id");

        foreach($get_stud->result() as $row){
            $no++;
            $rowexcel++;

            $total_credit_passed = 0;
            $total_credit_failed = 0;
            $total_credit_registered = 0;
            $outstanding_courses = "";

             $matno = $row->matno;
            $get_students = $this->db->query("select * from tblstudents where mat_no = '$matno'")->row();
            $get_Score = $this->db->query("select * from tblresults inner join tblcourse_reg on tblcourse_reg.id = tblresults.course_reg_id inner join tblstudents on tblstudents.mat_no = tblcourse_reg.mat_no inner JOIN tblcourses on tblcourses.id = tblcourse_reg.course_id where tblcourse_reg.mat_no='$matno' and tblcourses.level=$level_id order by course_id");




            foreach ($get_Score->result() as $r2){

                // $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $rowexcel, $r2->score.''.$r2->grade);
                if($r2->grade != 'F'){
                    $total_credit_passed = $total_credit_passed + $r2->load;
                }
                else{
                    $total_credit_failed = $total_credit_failed + $r2->load;
                    $outstanding_courses = $outstanding_courses.','.$r2->code;
                }
                $total_credit_registered = $total_credit_registered + $r2->load;
                //$col++;
            }



            $get_students = $this->db->query("select * from tblstudents where mat_no = '$matno'")->row();


            if($total_credit_failed > 0){

                $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $rowexcel, $no);
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $rowexcel, $get_students->mat_no);
                //$this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $rowexcel, $row->mat_no);
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $rowexcel, $get_students->firstname. ' '.$get_students->middlename. ' '.strtoupper($get_students->lastname));

                //die($total_credit_passed);
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $rowexcel, $total_credit_passed);
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col+1, $rowexcel, $total_credit_failed);
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col+2, $rowexcel, substr($outstanding_courses,1, strlen($outstanding_courses)));

            }


        }


        $d_date = date('Y-m-d h:i:s');
        $filename="unsuccessful_result_$d_date.xls"; //save our workbook as this file name
        ob_clean();
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');


    }



    public function save_result(){

        //$id = $this->input->post('id');
        $student_id = $this->input->post('student_id');

        $s_level = $this->session->userdata('level');
        $s_session = $this->session->userdata('session');


        if (isset($_POST['add'])){

            $get_student = $this->db->get_where('tblstudents', array('id' => $student_id));
            $matno = $get_student->row()->mat_no;

            $get_trans = $this->db->query("select * from tblcourse_reg where mat_no = '$matno'  order by id");

            $score = $_POST['score'];
            $grade = $_POST['grade'];
            $course_reg_id= $_POST['course_reg_id'];


            if(!empty($score) && !empty($grade)){
                $score_array = $_POST['score'];
                $grade_array = $_POST['grade'];
                $course_reg_id_array = $_POST['course_reg_id'];

                for($i = 0; $i < count($score_array); $i++){


                    $find_course = $this->db->get_where("tblresults", array('course_reg_id' => $course_reg_id_array[$i]));
                    if($find_course->num_rows() <= 0){

                        $addreg = array('course_reg_id' => $course_reg_id_array[$i],
                            'score' => $score_array[$i],
                            'grade' => $grade_array[$i],
                            'matno' => $get_student->row()->mat_no,
                            'session_id' => $s_session,
                            'level_id' => $s_level,
                        );

                        $this->db->insert('tblresults', $addreg);
                    }
                    else{
                        $addreg = array('course_reg_id' => $course_reg_id_array[$i],
                            'score' => $score_array[$i],
                            'grade' => $grade_array[$i],
                            'matno' => $get_student->row()->mat_no,
                            'session_id' => $s_session,
                            'level_id' => $s_level,
                        );
                        $this->db->where('course_reg_id', $course_reg_id_array[$i])->update('tblresults', $addreg);

                    }

                }


            }


            $this->session->set_flashdata('msg', '<div class="alert alert-info text-center"> added successfully! </div>');
            redirect(base_url('dashboard/add_result/' . $student_id));
        }
        else if(isset($_POST['remove'])){
            $checkbox = $this->input->post("checkbox[]");

            foreach ($checkbox as $user_selected) {

                $check_course = $this->db->get_where('tblresults', array('course_reg_id' => $user_selected));
                if ($check_course->num_rows() > 0) {

                    $addreg = array('course_reg_id' => $user_selected);


                    $this->db->where($addreg)->delete('tblresults');


                }
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-info text-center"> deleted successfully! </div>');
            redirect(base_url('dashboard/add_result/' . $student_id));
        }

    }







    public function get_department(){
        $division_id = $this->input->get('division_id');
        $get_dept = $this->db->get_where('tbldepartment', array('faculty_id' => $division_id))->result_array();
        echo json_encode($get_dept);
    }



    public function add_student()
    {

        $matno = $this->input->post('matno');
        $firstname = $this->input->post('firstname');
        $middlename = $this->input->post('middlename');

        $lastname = $this->input->post('lastname');
        $password = $this->input->post('password');

        $faculty = $this->input->post('faculty');
        $department = $this->input->post('department');
        $level = $this->input->post('level');

        $this->form_validation->set_rules('firstname', 'firstname', 'trim|required|min_length[2]|max_length[255]');
        $this->form_validation->set_rules('lastname', 'lastname', 'required|min_length[2]|max_length[150]');
        $this->form_validation->set_rules('middlename', 'middlename', 'min_length[2]|max_length[50]');
        $this->form_validation->set_rules('matno', 'Mat Number', 'required|min_length[10]|max_length[10]|is_unique[tblstudents.mat_no]');
        $this->form_validation->set_rules('faculty', 'faculty', 'required|min_length[1]|max_length[15]');
        $this->form_validation->set_rules('department', 'Department', 'required|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('level', 'Level', 'required|min_length[1]|max_length[50]');


        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Add Student";
            $data['currentUrl'] = 'add_student';


            $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')));

            $user_id = $this->session->userdata('user_id');


            $data['get_user'] = $get_user;

            $this->load->view('backend/partials/header.php', $data);
            $this->load->view('backend/backend/add_student.php', $data);
            $this->load->view('backend/partials/footer.php', $data);


        } else {

            if (isset ($_POST ['send'])) {



                $path = './assets/uploads/';

                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpg|JPG|JPEG|jpeg';
                $config['max_size'] = 100000;
                $config['max_width'] = 3024;
                $config['max_height'] = 3024;
                $config['remove_spaces'] = TRUE;
                //$this->upload->initialize($config);
                $import_file = 0;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('userfile')) {
                    $error = array('error' => $this->upload->display_errors());
                   // die(var_dump($error));
                    $this->flash($error, "danger");
                    redirect(base_url() . 'dashboard/students_list');

                } else {
                    $data = array('upload_data' => $this->upload->data());
                    //die($error);
                }

                if (!empty($data['upload_data']['file_name'])) {
                    $import_file = $data['upload_data']['file_name'];
                } else {
                    $import_file = 0;

                }


                if ($import_file != "") {
                    $current_session = $this->db->get_where('tblsession', array('is_current' => 1))->row()->id;
                    $arrayName = array(
                        'mat_no' => $matno,
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'middlename' => $middlename,
                        'faculty' => $faculty,
                        'department' => $department,
                        'leve' => $level,
                        'session' => $current_session,
                        'photo' => $import_file,
                    );

                    $this->db->insert('tblstudents', $arrayName);

                    $this->flash("Student added successfully!", "success");

                    redirect(base_url() . 'dashboard/students_list');

                } else {
                    $this->flash("Upload error", "danger");
                    //var_dump($import_file);
                    redirect(base_url() . 'dashboard/students_list');

                }


            }
        }
    }




    public function edit_student()
    {

        $matno = $this->input->post('matno');
        $firstname = $this->input->post('firstname');
        $middlename = $this->input->post('middlename');

        $lastname = $this->input->post('lastname');
        $password = $this->input->post('password');

        $faculty = $this->input->post('faculty');
        $department = $this->input->post('department');
        $level = $this->input->post('level');
        $id = $this->input->post('id');

        $this->form_validation->set_rules('firstname', 'firstname', 'trim|required|min_length[5]|max_length[255]');
        $this->form_validation->set_rules('lastname', 'lastname', 'required|min_length[1]|max_length[150]');
        $this->form_validation->set_rules('middlename', 'middlename', 'required|min_length[4]|max_length[50]');

        $this->form_validation->set_rules('matno', 'Mat Number', 'required|min_length[10]|max_length[13]|is_unique[tblstudents.mat_no]');

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[50]');
        $this->form_validation->set_rules('faculty', 'faculty', 'required|min_length[1]|max_length[15]');

        $this->form_validation->set_rules('department', 'Department', 'required|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('level', 'Level', 'required|min_length[1]|max_length[50]');


        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Edit Student";
            $data['currentUrl'] = 'edit_student';

            $url = $this->uri->segment(3);
            $id = $url;


            $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')));

            $user_id = $this->session->userdata('user_id');


            $data['get_user'] = $get_user;


            $get_student = $this->db->get_where("tblstudents", array('id' => $id))->row();

            $data['get_student'] = $get_student;
            $this->load->view('backend/partials/header.php', $data);
            $this->load->view('backend/backend/edit_student.php', $data);
            $this->load->view('backend/partials/footer.php', $data);


        } else {

            if (isset ($_POST ['send'])) {



                $path = './assets/uploads/';

                $config['upload_path'] = $path;
                $config['allowed_types'] = 'gif|jpg|png|PNG|JPG|JPEG|jpeg';
                $config['max_size'] = 100000;
                $config['max_width'] = 3024;
                $config['max_height'] = 3024;
                $config['remove_spaces'] = TRUE;
                //$this->upload->initialize($config);
                $import_file = 0;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('userfile')) {
                    $error = array('error' => $this->upload->display_errors());
                    // die(var_dump($error));
                    $this->flash($error, "danger");
                    redirect(base_url() . 'dashboard/students_list');

                } else {
                    $data = array('upload_data' => $this->upload->data());
                    //die($error);
                }

                if (!empty($data['upload_data']['file_name'])) {
                    $import_file = $data['upload_data']['file_name'];
                } else {
                    $import_file = 0;

                }


                if ($import_file != "") {
                    $current_session = $this->db->get_where('tblsession', array('is_current' => 1))->row()->id;
                    $arrayName = array(
                        'mat_no' => $matno,
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'password' => $password,
                        'middlename' => $middlename,
                        'faculty' => $faculty,
                        'department' => $department,
                        'leve' => $level,
                        'session' => $current_session,
                        'photo' => $import_file,
                    );

                    $this->db->where('id', $id)->update('tblstudents', $arrayName);

                    $this->flash("Student added successfully!", "success");

                    redirect(base_url() . 'dashboard/students_list');

                } else {
                    $this->flash("Upload error", "danger");
                    //var_dump($import_file);
                    redirect(base_url() . 'dashboard/students_list');

                }


            }
        }
    }


    public function student_info()
    {
        $data ['title'] = "Student Info";
        $url = $this->uri->segment(3);
        $id = $url;
        $data['rid'] = $id;
        $get_trans = $this->db->query("select * from tblstudents where id =  $id")->row();
        //$get_trans = $this->db->query("select * from tmp.npdcfleet order by rid desc limit $segment, $per_page");
        $data['currentUrl'] = "student_info";
        $data['get_trans'] = $get_trans;
        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')))->row();
        $data['get_user'] = $get_user;
        //$this->paginate($url, $query_count, $per_page);
        $this->load->view('backend/partials/header.php', $data);
        $this->load->view('backend/backend/student_info.php', $data);
        $this->load->view('backend/partials/footer.php', $data);
    }


    public function id_card()
    {
        $data ['title'] = "ID Card";
        $url = $this->uri->segment(3);
        $id = $url;
        $data['rid'] = $id;
        $get_trans = $this->db->query("select * from tblstudents where id =  $id")->row();
        //$get_trans = $this->db->query("select * from tmp.npdcfleet order by rid desc limit $segment, $per_page");
        $data['currentUrl'] = "id_card";
        $data['get_trans'] = $get_trans;
        $this->load->library('ciqrcode');
        $path = './assets/uploads/qrcode/';
        $savepath = $path.$get_trans->mat_no.".png";

        $params['data'] = $get_trans->mat_no;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = $savepath;
        if(! file_exists($savepath))
        {
            $this->ciqrcode->generate($params);

        }

        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')))->row();
        $data['get_user'] = $get_user;

        //$this->paginate($url, $query_count, $per_page);
        
        $this->load->view('backend/backend/id_card.php', $data);
        
    }



    public function create_user()
    {


        $username = $this->input->post ( 'username' );
        $password = $this->input->post ( 'password' );

        $fullname = $this->input->post('fullname');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');

        $this->form_validation->set_rules ( 'username', 'Username', 'trim|required|min_length[2]|max_length[100]|is_unique[tblusers.username]' );
        $this->form_validation->set_rules ( 'password', 'Password', 'required|min_length[5]|max_length[100]' );

        $this->form_validation->set_rules ( 'fullname', 'Fullname', 'required|min_length[3]|max_length[255]' );
        $this->form_validation->set_rules ( 'email', 'Email', 'required|min_length[2]|max_length[100]|valid_email' );
        $this->form_validation->set_rules ( 'phone', 'Phone', 'required|min_length[11]|max_length[15]' );



        $role = $this->input->post('role');
        // $this->form_validation->set_rules('contract_no', 'Contract Number', 'required|min_length[3]|max_length[50]');

        $this->form_validation->set_rules('role', 'Role', 'required|min_length[1]|max_length[50]');

        //$this->form_validation->set_rules ( 'g-recaptcha-response', "Recaptcha", 'required|callback_getResponse' );
        if ($this->form_validation->run () == FALSE) {
            $data['title'] = "Create User";
            $data['currentUrl'] = 'create_user';


            $this->load->view('backend/partials/header.php', $data);
            $this->load->view('backend/backend/create_user.php', $data);
            $this->load->view('backend/partials/footer.php', $data);


        } else {
            if (isset ( $_POST ['send'] )) {

                $query_email = $this->db->get_where('tblusers', array('email' => $email));
                $query_phone = $this->db->get_where('tblusers', array('phone' => $phone));

                if($query_email->num_rows() > 0){
                    //$this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center"> Email is already taken </div>' );

                    $this->flash("Email is already taken!", "danger");
                    redirect(base_url().'dashboard/create_user','refresh');
                }

                else if($query_phone->num_rows() > 0){
                    //$this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center"> Phone is already taken </div>' );
                    $this->flash("Phone is already taken!", "danger");
                    redirect(base_url().'dashboard/create_user','refresh');
                }
                else{


                    $data = array('username' => $username,
                        'pass' => $password,
                        'fullname' => $fullname,
                        'email' => $email,
                        'phone' => $phone,
                        'role_id' => $role,
                        'is_enabled' => 1,
                    );



                    $done = $this->db->insert('tblusers', $data);
                    if($done){


                        $title = "SCHOOL PORTAL";

                        $this->members_model->sendMail($email, $title, $this->members_model->alertnewMember($fullname));


                        //$this->session->set_flashdata ( 'msg', '<div class="alert alert-success text-center"> Account creation was successful</div>' );
                        $this->flash("Account created successfully!", "success");
                        redirect(base_url().'dashboard/create_user','refresh');

                    }
                    else{
                        //$this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center"> An error occurred try again later!</div>' );
                        $this->flash("An error occurred try again later!", "danger");
                        redirect(base_url().'dashboard/create_user','refresh');
                    }

                }
            }
        }
    }


    public function userslist()
    {
        //everyone can view memo list
        $url = base_url() . "dashboard" . "/userslist";

        $data['datatable'] = "yes";
        $data ['title'] = "Users List";
        $per_page = 25;
        $segment = $this->uri->segment(3, 0);




        $get_trans = $this->db->query("select * from tblusers   order by date_created desc");
        //$get_trans = $this->db->query("select * from tmp.npdcfleet order by rid desc limit $segment, $per_page");


        $data['currentUrl'] = "userslist";
        $data['get_trans'] = $get_trans;
        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')))->row();

        $data['get_user'] = $get_user;
        //$this->paginate($url, $query_count, $per_page);
        $this->load->view('backend/partials/header.php', $data);
        $this->load->view('backend/backend/users_list.php', $data);
        $this->load->view('backend/partials/footer.php', $data);
    }



    public function session_list()
    {
        $url = base_url() . "dashboard" . "/session_list";
        $user_id = $this->session->userdata("user_id");

        $data ['title'] = "Session List";
        $per_page = 25;
        $segment = $this->uri->segment(3, 0);

        $data['datatable'] = "yes";
        $query_count = $this->db->query("select * from tblsession")->num_rows();

        $get_trans = $this->db->query("select * from tblsession order by id desc");


        $data['currentUrl'] = "session_list";
        $data['get_trans'] = $get_trans;
        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')))->row();

        $data['get_user'] = $get_user;
        //$this->paginate($url, $query_count, $per_page);
        $this->load->view('backend/partials/header.php', $data);
        $this->load->view('backend/backend/session_list.php', $data);
        $this->load->view('backend/partials/footer.php', $data);
    }


    public function edit_session(){
        $data ['title'] = 'Edit Session';
        $data['currentUrl'] = 'edit_session';


        $this->form_validation->set_rules ( 'session', 'Session', 'required' );
        $this->load->helper ( 'form' );
        $this->load->library ( 'form_validation' );
        $id =  $this->uri->segment(3);
        if ($this->form_validation->run () === FALSE) {

            $data['id'] = $id;
            $getnews = $this->db->get_where('tblsession', array('id'=> $id));
            $data['rec'] = $getnews;
            $this->load->view ( 'backend/partials/header', $data );
            $this->load->view ( 'backend/backend/edit_session', $data );
            $this->load->view ( 'backend/partials/footer' );
        }
        else {
            $session = $this->input->post('session');

            $done = $this->db->query("update tblsession set session = '$session' where id=$id");
            if($done){
                $this->session->set_flashdata ( 'msg', '<div class="alert alert-info text-center"> updated successfully! </div>' );
                redirect ( base_url ( 'dashboard/session_list' ) );
            }
            else {
                $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center"> Error updating! </div>' );
                redirect ( base_url ( 'dashboard/session_list' ) );
            }
        }
    }



    public function add_session(){
        $data ['title'] = 'Add Session';
        $data['currentUrl'] = 'add_session';


        $this->form_validation->set_rules ( 'session', 'Session', 'required' );

        $this->load->helper ( 'form' );
        $this->load->library ( 'form_validation' );
        //$id =  $this->uri->segment(3);
        if ($this->form_validation->run () === FALSE) {


            $this->load->view ( 'backend/partials/header', $data );
            $this->load->view ( 'backend/backend/add_session', $data );
            $this->load->view ( 'backend/partials/footer' );
        }
        else {
            $session = $this->input->post('session');

            $arrayName = array(
                'session' => $session,
            );

            $done = $this->db->insert('tblsession', $arrayName);

            // $done = $this->db->query("update ecurrencies set title = '$title', wallet= '$wallet', price = '$price', status = 'approved' where id=$id");
            if($done){
                $this->session->set_flashdata ( 'msg', '<div class="alert alert-info text-center"> Added successfully! </div>' );
                redirect ( base_url ( 'dashboard/add_session' ) );
            }
            else {
                $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center"> Error updating! </div>' );
                redirect ( base_url ( 'dashboard/add_session' ) );
            }
        }
    }



    public function delete_session(){
        if($this->uri->segment(3) != null){
            $get_user = $this->db->where('id', (int)$this->uri->segment(3) )->delete('tblsession');
        }
        $this->flash("Deleted sucessfully!", "success");
        redirect(base_url().'dashboard/session_list','refresh');

    }

     public function mark_current(){
        if($this->uri->segment(3) != null){
            $this->db->update('tblsession', array('is_current' => 0));
             $this->db->where('id', (int)$this->uri->segment(3) )->update('tblsession', array('is_current' => 1));
        }
        $this->flash("Completed sucessfully!", "success");
        redirect(base_url().'dashboard/session_list','refresh');

    }



    public function course_list()
    {
        $url = base_url() . "dashboard" . "/course_list";
        $user_id = $this->session->userdata("user_id");

        $data ['title'] = "Course List";
        $per_page = 25;
        $segment = $this->uri->segment(3, 0);

        $data['datatable'] = "yes";
        $query_count = $this->db->query("select * from tblcourses")->num_rows();

        $get_trans = $this->db->query("select * from tblcourses order by id");


        $data['currentUrl'] = "course_list";
        $data['get_trans'] = $get_trans;
        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')))->row();

        $data['get_user'] = $get_user;
        //$this->paginate($url, $query_count, $per_page);
        $this->load->view('backend/partials/header.php', $data);
        $this->load->view('backend/backend/course_list.php', $data);
        $this->load->view('backend/partials/footer.php', $data);
    }



    public function edit_course(){
        $data ['title'] = 'Edit Course';
        $data['currentUrl'] = 'edit_course';


        $this->form_validation->set_rules ( 'title', 'Title', 'required' );
        $this->form_validation->set_rules ( 'code', 'code', 'required' );
        $this->form_validation->set_rules ( 'load', 'Credit Load', 'required' );
        $this->form_validation->set_rules ( 'semester', 'Semester', 'required' );
        $this->form_validation->set_rules ( 'type', 'Type', 'required' );
        $this->form_validation->set_rules ( 'level', 'Level', 'required' );

        $this->load->helper ( 'form' );
        $this->load->library ( 'form_validation' );
        $id =  $this->uri->segment(3);
        if ($this->form_validation->run () === FALSE) {

            $data['id'] = $id;
            $getnews = $this->db->get_where('tblcourses', array('id'=> $id));
            $data['rec'] = $getnews;
            $this->load->view ( 'backend/partials/header', $data );
            $this->load->view ( 'backend/backend/edit_courses', $data );
            $this->load->view ( 'backend/partials/footer' );
        }
        else {
            $title = $this->input->post('title');
            $code = $this->input->post('code');
            $load = $this->input->post('load');
            $semester = $this->input->post('semester');
            $type = $this->input->post('type');
            $level = $this->input->post('level');

            $arrayName = array(
                'title' => $title,
                'code' => $code,
                'load' => $load,
                'level' => $level,
                'semester' => $semester,
                'type' => $type,
            );

            $done = $this->db->where('id', $id)->update('tblcourses', $arrayName);

            if($done){
                $this->session->set_flashdata ( 'msg', '<div class="alert alert-info text-center"> updated successfully! </div>' );
                redirect ( base_url ( 'dashboard/course_list' ) );
            }
            else {
                $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center"> Error updating! </div>' );
                redirect ( base_url ( 'dashboard/course_list' ) );
            }
        }
    }


        public function add_gpa(){

            $mat_no = $this->input->post('mat_no');
            $level = $this->input->post('level');
            $session = $this->input->post('session');
            $gpa = $this->input->post('gpa');

            $arrayName = array(
                'mat_no' => $mat_no,
                'level' => $level,
                'session' => $session,
                'gpa' => $gpa,
            );

            $done = $this->db->insert('tblgpa', $arrayName);

            // $done = $this->db->query("update ecurrencies set title = '$title', wallet= '$wallet', price = '$price', status = 'approved' where id=$id");
            if($done){
                $this->session->set_flashdata ( 'msg', '<div class="alert alert-info text-center"> Information Saved! </div>' );
                redirect ( base_url ( 'dashboard/search_result' ) );
            }
            else {
                $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center"> An Error Occurred! </div>' );
                redirect ( base_url ( 'dashboard/search_result' ) );
            }
}



    public function add_new_course(){
        $data ['title'] = 'Add Course';
        $data['currentUrl'] = 'add_new_course';


        $this->form_validation->set_rules ( 'title', 'Title', 'required' );
        $this->form_validation->set_rules ( 'code', 'code', 'required' );
        $this->form_validation->set_rules ( 'load', 'Credit Load', 'required' );
        $this->form_validation->set_rules ( 'semester', 'Semester', 'required' );
        $this->form_validation->set_rules ( 'type', 'Type', 'required' );
        $this->form_validation->set_rules ( 'level', 'Level', 'required' );

        $this->load->helper ( 'form' );
        $this->load->library ( 'form_validation' );
        //$id =  $this->uri->segment(3);
        if ($this->form_validation->run () === FALSE) {


            $this->load->view ( 'backend/partials/header', $data );
            $this->load->view ( 'backend/backend/add_course', $data );
            $this->load->view ( 'backend/partials/footer' );
        }
        else {
            $title = $this->input->post('title');
            $code = $this->input->post('code');
            $load = $this->input->post('load');
            $semester = $this->input->post('semester');
            $type = $this->input->post('type');
            $level = $this->input->post('level');

            $arrayName = array(
                'title' => $title,
                'code' => $code,
                'load' => $load,
                'level' => $level,
                'semester' => $semester,
                'type' => $type,
            );

            $done = $this->db->insert('tblcourses', $arrayName);

            // $done = $this->db->query("update ecurrencies set title = '$title', wallet= '$wallet', price = '$price', status = 'approved' where id=$id");
            if($done){
                $this->session->set_flashdata ( 'msg', '<div class="alert alert-info text-center"> Added successfully! </div>' );
                redirect ( base_url ( 'dashboard/add_new_course' ) );
            }
            else {
                $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center"> Error updating! </div>' );
                redirect ( base_url ( 'dashboard/add_new_course' ) );
            }
        }
    }



    public function delete_course(){
        if($this->uri->segment(3) != null){
            $get_user = $this->db->where('id', (int)$this->uri->segment(3) )->delete('tblcourses');
        }
        $this->flash("Deleted sucessfully!", "success");
        redirect(base_url().'dashboard/session_list','refresh');

    }



    function flash($message, $status)
    {

        if ($status == "success") {
            return $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">' . $message . ' </div>');
        } else {
            return $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">' . $message . ' </div>');
        }
    }


    public function log($page)
    {

        $get_user = $this->db->get_where('tblusers', array('username' => $this->session->userdata('username')));

        $get_role = $this->db->get_where('tblroles', array('id'=> $this->session->userdata('role_id')));


        $data['username'] = $this->session->userdata('username');
        $data['ipaddress'] = $this->input->ip_address();
        $data['computername'] = gethostbyaddr($this->input->ip_address());

        $data['role'] = $get_role->row()->role;
        $data['page'] = $page;
        $this->db->insert('tblactivity_log', $data);
    }

    public function Logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }





    public function senate_report()
    {
        $this->load->library('Phpword');

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->getCompatibility()->setOoxmlVersion(14);
        $phpWord->getCompatibility()->setOoxmlVersion(15);
        $session = $this->db->get_where('tblsession', array('id' => $this->session->userdata('session') ))->row()->session;
        $level = $this->db->get_where('tbllevel', array('id' => $this->session->userdata('level')))->row()->title;


        $level_id = $this->session->userdata('level');
        $session_id = $this->session->userdata('session');

        $get_memo = $this->db->query("select count(*) from tblstudents where leve=$level_id and session=$session_id");

        
        $filename = "senate_report.docx";
        // add style settings for the title and paragraph

        $section = $phpWord->addSection();
        $section->addText("UNIVERSITY OF BENIN",array('name' => 'Times New Roman', 'size' => 10, 'bold' => true));
        $section->addText("BENIN CITY, NIGERIA",array('name' => 'Times New Roman','align' => 'center', 'size' => 10, 'bold' => true));
    
        $section->addText("PRESENTATION OF $session SESSIONAL EXAMINATION RESULTS TO SENATE",array('name' => 'Times New Roman','alignment' => 'center', 'size' => 10, 'bold' => true));
        $section->addText("FACULTY:                  PHYSICAL SCIENCES",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("DEPARTMENT:         COMPUTER SCIENCE",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("$level LEVEL (B.Sc. COMPUTER SCIENCE)");
        $section->addText("SUMMARY FOR $session SESSION",array('name' => 'Times New Roman','align' => 'center', 'size' => 10, 'bold' => true));
        $section->addTextBreak(1);
        $section->addText("CATEGORY                                                                                                                 No of Students           (%)",array('name' => 'Times New Roman','alignment' => 'center', 'size' => 10, 'bold' => true));
        $section->addText("A          SUCCESSFUL STUDENTS",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("B          STUDENTS WITH CARRYOVER COURSES",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("C          STUDENTS FOR PROBATION/TRANSFER",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("D          STUDENTS WHO ARE TO WITHDRAW FROM THE FACULTY               NIL                     0.00",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("E          STUDENTS WHO WERE PREVIOUSLY ON PROBATION/TRANSFER    NIL                     0.00",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("F          MEDICAL CASES                                                                                                   NIL                     0.00",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("G         ABSENCE FROM EXAMINATIONS                                                                   NIL                     0.00",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("H         WITHHELD RESULTS                                                                                          NIL                     0.00",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("I          EXPELLED/RUSTICATED/SUSPENDED STUDENTS                                     NIL                     0.00",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("J          TEMPORARY WITHDRAWAL FROM THE UNIVERSITY                           NIL                     0.00",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("K          UNREGISTERED STUDENTS                                                                             NIL                     0.00",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("                                               TOTAL            <?php echo number_format($get_memo->num_rows()) ?>",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));

        $section->addText("BEST STUDENT",array('name' => 'Times New Roman', 'size' => 10, 'bold' => true));

        $tableStyle = array('borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0  );
        $styleCell = array('borderTopSize'=>1 ,'borderTopColor' =>'black','borderLeftSize'=>1,'borderLeftColor' =>'black','borderRightSize'=>1,'borderRightColor'=>'black','borderBottomSize' =>1,'borderBottomColor'=>'black' );
        $noSpace = array('textBottomSpacing' => -1);
        $table = $section->addTable('myOwnTableStyle',array('borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0  ));
        $table2 = $section->addTable('myOwnTableStyle');
        $table->addRow(-0.5, array('exactHeight' => -5));
        $table->addCell(2500,$styleCell)->addText(' Mat No.',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $table->addCell(6000,$styleCell)->addText(' Full Name (Surname Last in Block Letters)',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $table->addCell(1500,$styleCell)->addText(' GPA',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $table->addRow();
        $table->addCell(2500,$styleCell)->addText(' PSC0808904');
        $table->addCell(6000,$styleCell)->addText(' Oladele ISUJEH');
        $table->addCell(1500,$styleCell)->addText(' 4.41');
        $section->addTextBreak(1);
        $lineStyle = array('weight' => 1, 'width' => 300, 'height' => 0);
        $section->addLine($lineStyle);
        $section->addText("Name of Dean: PROF. S. E. OMOSIGHO.                                                                          Signature and Date",array('name' => 'Times New Roman', 'size' => 10, 'bold' => true));
        $section->addLine($lineStyle);
        $section->addText("REP Sub-Committee of Business Committee of Senate                                                    Signature and Date",array('name' => 'Times New Roman', 'size' => 10, 'bold' => true));
        $section->addPageBreak();



        $section->addText("UNIVERSITY OF BENIN",array('align' => 'center','name' => 'Times New Roman', 'size' => 10, 'bold' => true));
        $section->addText("BENIN CITY, NIGERIA",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
    
        $section->addText("PRESENTATION OF $session SESSIONAL EXAMINATION RESULTS TO SENATE",array('name' => 'Times New Roman','alignment' => 'center', 'size' => 10, 'bold' => true));
        $section->addText("FACULTY:                  PHYSICAL SCIENCES",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));

        $section->addText("DESCRIPTION AND DATE OF EXAMINATION: SESSIONAL EXAMINATION RESULTS FOR $session SESSION");
        $section->addText("I present to Senate on behalf of the Board of Studies, Faculty of Physical Sciences and its Board of Examiners, the result of the sessional examination held in the $session session, together with the recommendations arising therefrom, for consideration and approval.");

        $section->addText("DEPARTMENT:     COMPUTER SCIENCE");
        $section->addText("$level LEVEL (B.Sc. COMPUTER SCIENCE)");

        $section->addText("(A)   SUCCESSFUL STUDENTS",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("The following students have satisfied the Examiners in all the courses, which they registered for in the $session session and have earned all the assigned credits.");



        //Successful students


        $table = $section->addTable('myOwnTableStyle',array('borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0  ));
        $table2 = $section->addTable('myOwnTableStyle');
        $table->addRow(-0.5, array('exactHeight' => -5));
        $table->addCell(500,$styleCell)->addText(' S/N',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $table->addCell(2500,$styleCell)->addText(' Mat No.',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $table->addCell(6000,$styleCell)->addText(' Full Name (Surname Last in Block Letters)',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $table->addCell(1500,$styleCell)->addText(' Total Credits Earned in The '.$session.' Session',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));




        $no=0;
        $get_stud = $this->db->query("select DISTINCT matno from tblresults where level_id = $level_id and session_id = $session_id");

        foreach($get_stud->result() as $row){
            $total_credit_passed = 0;
            $total_credit_failed = 0;
            $total_credit_registered = 0;
            //$no++;
           
            

            $matno = $row->matno;
            $get_students = $this->db->query("select * from tblstudents where mat_no = '$matno' order by lastname ASC")->row();

            $get_Score = $this->db->query("select * from tblresults inner join tblcourse_reg on tblcourse_reg.id = tblresults.course_reg_id inner JOIN tblcourses on tblcourses.id = tblcourse_reg.course_id where tblcourse_reg.mat_no='$matno' and tblcourses.level=$level_id order by course_id");


            foreach ($get_Score->result() as $r2){

               // $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $rowexcel, $r2->score.''.$r2->grade);
                if($r2->grade != 'F'){
                    $total_credit_passed = $total_credit_passed + $r2->load;
                }
                else{
                    $total_credit_failed = $total_credit_failed + $r2->load;
                }
                $total_credit_registered = $total_credit_registered + $r2->load;
                //$col++;
            }


            $get_students = $this->db->query("select * from tblstudents where mat_no = '$matno' order by lastname ASC")->row();

            if($total_credit_passed == $total_credit_registered)
            {

                $table->addRow();
                $table->addCell(800,$styleCell)->addText(++$no);
                $table->addCell(2000,$styleCell)->addText($get_students->mat_no);
                $table->addCell(7000,$styleCell)->addText($get_students->firstname. ' '.$get_students->middlename. ' '.strtoupper($get_students->lastname));
                $table->addCell(500,$styleCell)->addText($total_credit_registered);
            }
        }
    



        $section->addTextBreak(1);
        $section->addText("(B)   STUDENTS WITH CARRY-OVER COURSES",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("The following students have obtained the 22 minimum credits requirements to remain in the Faculty, but failed some courses which they are allowed to carry over to the next session.");


        //Unsuccessful students

        $table = $section->addTable('myOwnTableStyle',array('borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0  ));
        $table2 = $section->addTable('myOwnTableStyle');
        $table->addRow(-0.5, array('exactHeight' => -5));
        $table->addCell(600,$styleCell)->addText(' S/N',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $table->addCell(1400,$styleCell)->addText(' Mat No.',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $table->addCell(7000,$styleCell)->addText(' Full Name (Surname Last in Block Letters)',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $table->addCell(500,$styleCell)->addText(' Total Credits Earned in The '.$session.' Session',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $table->addCell(500,$styleCell)->addText(' Total Credits failed in The '.$session.' Session',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $table->addCell(1000,$styleCell)->addText(' Outstanding Courses Owed in the '.$session.' Session',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));

        
        $no=0;
        $get_stud = $this->db->query("select DISTINCT matno from tblresults where level_id = $level_id and session_id = $session_id order by id");

        foreach($get_stud->result() as $row){
           
            

            $total_credit_passed = 0;
            $total_credit_failed = 0;
            $total_credit_registered = 0;
            $outstanding_courses = "";

             $matno = $row->matno;
            $get_students = $this->db->query("select * from tblstudents where mat_no = '$matno'")->row();
            $get_Score = $this->db->query("select * from tblresults inner join tblcourse_reg on tblcourse_reg.id = tblresults.course_reg_id inner join tblstudents on tblstudents.mat_no = tblcourse_reg.mat_no inner JOIN tblcourses on tblcourses.id = tblcourse_reg.course_id where tblcourse_reg.mat_no='$matno' and tblcourses.level=$level_id order by course_id");




            foreach ($get_Score->result() as $r2){

                // $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $rowexcel, $r2->score.''.$r2->grade);
                if($r2->grade != 'F'){
                    $total_credit_passed = $total_credit_passed + $r2->load;
                }
                else{
                    $total_credit_failed = $total_credit_failed + $r2->load;
                    $outstanding_courses = $outstanding_courses.','.$r2->code;
                }
                $total_credit_registered = $total_credit_registered + $r2->load;
                //$col++;
            }



            $get_students = $this->db->query("select * from tblstudents where mat_no = '$matno'")->row();


            if($total_credit_failed > 0){





                $table->addRow();
                $table->addCell(600,$styleCell)->addText(++$no);
                $table->addCell(1400,$styleCell)->addText($get_students->mat_no);
                $table->addCell(7000,$styleCell)->addText($get_students->firstname. ' '.$get_students->middlename. ' '.strtoupper($get_students->lastname));
                $table->addCell(500,$styleCell)->addText($total_credit_passed);
                $table->addCell(500,$styleCell)->addText($total_credit_failed);
                $table->addCell(1000,$styleCell)->addText(substr($outstanding_courses,1, strlen($outstanding_courses)));
            }
        }



        $section->addTextBreak(1);
        $section->addText("(C)   STUDENTS FOR PROBATION/TRANSFER",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("The following students did not earn the 22 minimum credits needed to qualify them to move to the next higher level but they earned not less than 50% of the minimum number of credits and are to remain in the Faculty on probation/transfer.");

        //Probation Student

         $table = $section->addTable('myOwnTableStyle',array('borderSize' => 1, 'borderColor' => '999999', 'afterSpacing' => 0, 'Spacing'=> 0, 'cellMargin'=>0  ));
        $table2 = $section->addTable('myOwnTableStyle');
        $table->addRow(-0.5, array('exactHeight' => -5));
        $table->addCell(600,$styleCell)->addText(' S/N',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $table->addCell(1400,$styleCell)->addText(' Mat No.',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $table->addCell(7000,$styleCell)->addText(' Full Name (Surname Last in Block Letters)',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $table->addCell(700,$styleCell)->addText(' Total Credits Earned in The '.$session.' Session',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $table->addCell(700,$styleCell)->addText(' Total Credits failed in The '.$session.' Session',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $table->addCell(1000,$styleCell)->addText(' Outstanding Courses Owed in the '.$session.' Session',array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));



        $no=0;
        $get_stud = $this->db->query("select DISTINCT matno from tblresults where level_id = $level_id and session_id = $session_id order by id");

        foreach($get_stud->result() as $row){
            
            

            $total_credit_passed = 0;
            $total_credit_failed = 0;
            $total_credit_registered = 0;
            $outstanding_courses = "";

             $matno = $row->matno;
            $get_students = $this->db->query("select * from tblstudents where mat_no = '$matno'")->row();
            $get_Score = $this->db->query("select * from tblresults inner join tblcourse_reg on tblcourse_reg.id = tblresults.course_reg_id inner join tblstudents on tblstudents.mat_no = tblcourse_reg.mat_no inner JOIN tblcourses on tblcourses.id = tblcourse_reg.course_id where tblcourse_reg.mat_no='$matno' and tblcourses.level=$level_id order by course_id");




            foreach ($get_Score->result() as $r2){

                // $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $rowexcel, $r2->score.''.$r2->grade);
                if($r2->grade != 'F'){
                    $total_credit_passed = $total_credit_passed + $r2->load;
                }
                else{
                    $total_credit_failed = $total_credit_failed + $r2->load;
                    $outstanding_courses = $outstanding_courses.','.$r2->code;
                }
                $total_credit_registered = $total_credit_registered + $r2->load;
                //$col++;
            }



            $get_students = $this->db->query("select * from tblstudents where mat_no = '$matno'")->row();


            if($total_credit_passed < 22 ){

                $table->addRow();
                $table->addCell(600,$styleCell)->addText(++$no);
                $table->addCell(1400,$styleCell)->addText($get_students->mat_no);
                $table->addCell(7000,$styleCell)->addText($get_students->firstname. ' '.$get_students->middlename. ' '.strtoupper($get_students->lastname));
                $table->addCell(700,$styleCell)->addText($total_credit_passed);
                $table->addCell(700,$styleCell)->addText($total_credit_failed);
                $table->addCell(1000,$styleCell)->addText(substr($outstanding_courses,1, strlen($outstanding_courses)));
            }
        }

        $section->addTextBreak(1);

        $section->addText("D          STUDENTS WHO ARE TO WITHDRAW FROM THE FACULTY                                  NIL",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("E          STUDENTS WHO WERE PREVIOUSLY ON PROBATION/TRANSFER                       NIL",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("F          MEDICAL CASES                                                                                                                      NIL",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("G         ABSENCE FROM EXAMINATIONS                                                                                      NIL",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("H         WITHHELD RESULTS                                                                                                             NIL",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("I          EXPELLED/RUSTICATED/SUSPENDED STUDENTS                                                        NIL",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("J          TEMPORARY WITHDRAWAL FROM THE UNIVERSITY                                              NIL",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));
        $section->addText("K          UNREGISTERED STUDENTS                                                                                                NIL",array('name' => 'Times New Roman','alignment' => 'both', 'size' => 10, 'bold' => true));

        $section->addTextBreak(1);
        $lineStyle = array('weight' => 1, 'width' => 300, 'height' => 0);
        $section->addLine($lineStyle);
        $section->addText("Name of Dean: PROF. S. E. OMOSIGHO                                                                           Signature and Date",array('name' => 'Times New Roman', 'size' => 10, 'bold' => true));
        $section->addLine($lineStyle);
        $section->addText("REP Sub-Committee of Business Committee of Senate                                                    Signature and Date",array('name' => 'Times New Roman', 'size' => 10, 'bold' => true));






        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($filename);
        // send results to browser to download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        flush();
        readfile($filename);
        unlink($filename); // deletes the temporary file
        exit;
    }


}