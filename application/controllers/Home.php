<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');

        $this->load->model('members_model');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable" role="alert"> ' . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');

        $this->load->helper(array(
            'form',
            'url'
        ));


    }

    public function index()
    {
        if ($this->session->userdata('ROLE') == NULL) {
            redirect('/signin');
        } else {
            redirect('/dashboard');
        }


    }

    public function signin()
    {

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[2]|max_length[100]');
        //$this->form_validation->set_rules ( 'g-recaptcha-response', "Recaptcha", 'required|callback_getResponse' );
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Login";
            $data['currentUrl'] = 'login';


            $this->load->view('backend/partials/login.php', $data);

        } else {
            if (isset ($_POST ['btn_login'])) {


                $query = $this->db->get_where('tblusers', array('username' => $username, 'pass' => $password));

                if ($query->num_rows() == 0) {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"> Invalid username or password! </div>');

                    redirect('signin');
                } else {

                    $sessiondata = array(
                        'username' => $query->row()->username,
                        'loginuser' => TRUE,
                        'role_id' => $query->row()->role_id,
                        'user_id' => $query->row()->user_id
                    );
                    $this->session->set_userdata($sessiondata);
                    redirect(base_url() . 'dashboard/index');


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

    public function forgot_password()
    {
        $username = $this->input->post('username');

        $this->form_validation->set_rules('username', 'Username', 'required|min_length[2]|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Forgot Password";
            $data['currentUrl'] = 'reset_password';
            $data['meta_tags'] = "<meta property='og:url' content='index' />"
                . "<meta property='og:type' content='website' />"
                . "<meta property='og:title' content='Forgot password?' />"
                . "<meta property='og:description' content='Forgot password' />";
            $this->load->view('frontend/header.php', $data);
            $this->load->view('frontend/resetpassword.php', $data);
            $this->load->view('frontend/footer.php', $data);


        } else {
            if (isset ($_POST ['btn_login'])) {

                $get_user = $this->db->get_where('userprofile', array('username' => $username));

                if ($get_user->num_rows() > 0) {


                    $title = "SCHOOL Password Reset";
                    $base_url = base_url();
                    $email = $get_user->row()->email;
                    $bodyText = "Your password is: " . $get_user->row()->password;

                    $this->members_model->sendMail($email, $title, $this->members_model->alertmail($get_user->row()->firstname, $title, $bodyText));


                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Password  has been sent to the email address </div>');

                    redirect('signin', 'refresh');


                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"> Unknown user </div>');

                    redirect('forgot_password', 'refresh');

                }

            }
        }
    }


    public function reset_password()
    {
        $code = $this->uri->segment(2);
        $password = $this->input->post('password');
        $cpassword = $this->input->post('password2');

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[100]');

        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|min_length[5]|max_length[100]|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Reset Password";
            $data['currentUrl'] = 'reset_password';
            $data['meta_tags'] = "<meta property='og:url' content='index' />"
                . "<meta property='og:type' content='website' />"
                . "<meta property='og:title' content='Reset your password' />"
                . "<meta property='og:description' content='Reset your password' />";
            $data['code'] = $code;
            $this->load->view('partials/header.php', $data);
            $this->load->view('frontend/reset_password.php', $data);
            $this->load->view('partials/footer.php', $data);


        } else {
            if (isset ($_POST ['btn_login'])) {


                $get_user = $this->db->get_where('userprofile', array('email_verify_code' => $code));

                if ($get_user->num_rows() > 0) {
                    $this->db->where('email_vcode', $code)->update('userprofile', array('password' => $password, 'email_verify_code' => ''));
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Password Reset successful! </div>');

                    redirect('signin');

                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"> Invalid reset code </div>');

                    redirect('forgot_password', 'refresh');

                }

            }
        }
    }


    public function Logout()
    {
        $this->session->sess_destroy();
        redirect('index');
    }


}
