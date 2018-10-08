<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myadmin extends CI_Controller {

    function __construct() {
        parent::__construct ();
        $this->load->library ( 'form_validation' );
        $this->form_validation->set_error_delimiters ('<div class="alert alert-danger alert-dismissable" role="alert"> ' . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>' );
       
          
          $this->load->model('members_model');

             
          $this->load->helper ( array ('form','url', 'text') );
      


    }




    public function login() {
    
        $username = $this->input->post ( 'username' );
        $password = $this->input->post ( 'password' );
        $this->form_validation->set_rules ( 'username', 'Username', 'trim|required|min_length[2]|max_length[100]' );
        $this->form_validation->set_rules ( 'password', 'Password', 'required|min_length[2]|max_length[100]' );
        if ($this->form_validation->run () == FALSE) {
            $data['title'] = "Login";
            $data['currentUrl'] = 'login';
            
           
            $this->load->view('admin/partials/login.php', $data);
           
        } else {
            if (isset ( $_POST ['btn_login'] )) {
                
              
                $query = $this->db->get_where('userprofile', array('username' => $username, 'password' => $password, 'user_level' =>1));

                if($query->num_rows() == 0) {
                    $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center"> Invalid username or password! </div>' );
                    
                    redirect('myadmin/login');
                }
                else if($query->row()->isblocked ==1){
                    $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center"> Your account has been blocked. Pls contact support@bitcoin360ex.com!</div>' );
                    redirect('myadmin/login');
                }
                
               
                else {

                     $sessiondata = array (
                        'username' => $query->row()->username,
                        'loginuser' => TRUE,
                        'user_level' => $query->row()->user_level,
                        'user_id' => $query->row()->id
                    );
                   $this->session->set_userdata ( $sessiondata );
                    redirect ( 'myadmin/index' );

                   
                   
                }
            
                
                
        }
    }
}

function paginate($url, $query_count, $per_page){
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
    $config ['num_links'] = floor ($query_count);
    $this->pagination->initialize ( $config );
            
}


  public function index(){
    if($this->session->userdata('user_level') != null && $this->session->userdata('user_level') > 0){
      $data['title'] = "myadmin";
      $data['currentUrl'] = 'index';
      $this->load->view('admin/partials/header.php', $data);
      $this->load->view('admin/admin/index.php', $data);
      $this->load->view('admin/partials/footer.php', $data);
    }
    else{
      redirect('login','refresh');
    }
  }




public function update_exchange(){
        $data ['title'] = 'Update Exchange rate';
        $data['currentUrl'] = 'update_exchange';
        
        
        $this->form_validation->set_rules ( 'sell_amount', 'Sell Amount', 'required' );
        $this->form_validation->set_rules ( 'buy_amount', 'Buy Amount', 'required' );
        $this->load->helper ( 'form' );
        $this->load->library ( 'form_validation' );
        
        if ($this->form_validation->run () === FALSE) {
            
            $getnews = $this->db->get_where('exchange_rate', array('id'=> 1));
            $data['rec'] = $getnews;
            $this->load->view ( 'admin/partials/header', $data );
            $this->load->view ( 'admin/admin/update_exchange', $data );
            $this->load->view ( 'admin/partials/footer' );
        }
        else {
            $buy_amount = $this->input->post('buy_amount');
            $sell_amount = $this->input->post('sell_amount');
            $done = $this->db->query("update exchange_rate set amount_ngn_buy = $buy_amount, amount_ngn_sell=$sell_amount");
            if($done){
            $this->session->set_flashdata ( 'msg', '<div class="alert alert-info text-center"> updated successfully! </div>' );
            redirect ( base_url ( 'myadmin/update_exchange' ) );
            }
            else {
                $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center"> Error updating! </div>' );
                redirect ( base_url ( 'myadmin/update_exchange' ) );
            }
        }
    }

    public function edit_profile(){
         $username = $this->session->userdata('username');

         $query_user = $this->db->get_where('userprofile', array('username' => $username));


        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        

        $this->form_validation->set_rules ( 'firstname', 'Firstname', 'required|min_length[3]|max_length[100]' );
        $this->form_validation->set_rules ( 'lastname', 'Lastname', 'required|min_length[2]|max_length[100]' );
        
        //$this->form_validation->set_rules ( 'g-recaptcha-response', "Recaptcha", 'required|callback_getResponse' );
        if ($this->form_validation->run () == FALSE) {
            $data['title'] = "Edit profile";
            $data['currentUrl'] = 'edit_profile';
           


             $get_user = $this->db->get_where('userprofile', array('username' => $this->session->userdata('username')))->row();

            $user_id = $this->session->userdata('user_id');

             

             $get_doc = $this->db->get_where('userdocument', array('user_id'=>$user_id));

             $data['get_doc'] = $get_doc;
             
            
             $data['get_user'] = $get_user;

            $this->load->view('admin/partials/header.php', $data);
            $this->load->view('admin/admin/edit_profile.php', $data);
            $this->load->view('admin/partials/footer.php', $data);


        } else {
            if (isset ( $_POST ['btn_login'] )) {

                        $data_r = array(
                                        'firstname' => $firstname,
                                        'lastname' => $lastname,
                                        'country' => 'Nigeria',
                                        'address' => 'address',
                                        'state' => 'None',
                                        'city' => 'None',
                                        'referral_id' => 0

                        );


                        
                        $done = $this->db->where('user_id', $this->session->userdata('user_id'))->update('userprofile', $data_r);
                        if($done)
                        {

                            $this->session->set_flashdata ( 'msg', '<div class="alert alert-success text-center"> Registration was successful!</div>' );
                            redirect('edit_profile', 'refresh');
                        }
                        else {
                            $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center"> An error occurred try again later!</div>' );
                            redirect('edit_profile','refresh');
                        } 
                   
                
        }
    }
    }




public function send_email()
{

    $email = $this->input->post('email');
    $subject = $this->input->post('subject');
    $message = $this->input->post('message');
    


    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

    $this->form_validation->set_rules('subject', 'Subject', 'required|min_length[5]|max_length[255]');
    $this->form_validation->set_rules('message', 'Message', 'required|min_length[1]');


    if ($this->form_validation->run() == FALSE) {
        $data['title'] = "Send Email";
        $data['currentUrl'] = 'send_email';
        

       if($this->uri->segment(3) != null){
        $get_user = $this->db->get_where('userprofile', array('id' => (int)$this->uri->segment(3) ));
        $data['email'] = $get_user->row()->email;
        $data['get_user'] = $get_user;

       }
        

        $user_id = $this->session->userdata('user_id');

        
        
        $this->load->view('admin/partials/header.php', $data);
        $this->load->view('admin/admin/send_email.php', $data);
        $this->load->view('admin/partials/footer.php', $data);


    } else {

        if (isset ($_POST ['send'])) {

                $get_user = $this->db->get_where('userprofile', array('email' => $email ));
                $firstname = " User";
                if($get_user->num_rows() > 0){
                  $firstname = $get_user->row()->firstname;
                }
            
                $this->members_model->sendMail($email, $subject, $this->members_model->alertmail($get_user->row()->firstname, $subject, $message));
                $this->flash("Message sent", "success");
                redirect(base_url().'myadmin/send_email', 'refresh');

            }
        }
    
}



public function block_user(){
      if($this->uri->segment(3) != null){
        $get_user = $this->db->where('id', (int)$this->uri->segment(3) )->update('userprofile', array('is_blocked' => 1));
       }
       $this->flash("User has been blocked", "success");
       redirect(base_url().'myadmin/userslist','refresh');
        
}

public function unblock_user(){
      if($this->uri->segment(3) != null){
        $get_user = $this->db->where('id', (int)$this->uri->segment(3) )->update('userprofile', array('is_blocked' => 0));
       }
       $this->flash("User has been unblocked", "success");
       redirect(base_url().'myadmin/userslist','refresh');
        
}

public function approve_doc(){
      if($this->uri->segment(3) != null){
       
        $this->db->where('id', (int)$this->uri->segment(3))->update('userdocument', array('status' => true));
        $get_user = $this->db->get_where("userdocument", array('id' =>  (int)$this->uri->segment(3) ));
        $this->db->where('id', $get_user->row()->user_id)->update('userprofile', array('is_doc_verified' => true));
       }
       $this->flash("Document has been approved", "success");
       redirect(base_url().'myadmin/user_document','refresh');
        
}

public function confirm_user(){
      if($this->uri->segment(3) != null){
        $get_user = $this->db->where('trans_id', (int)$this->uri->segment(3))->update('usertransaction', array('status' => 3));
       }
       $this->flash("User has been blocked", "success");
       redirect(base_url().'myadmin/userslist','refresh');
        
}

 public function Logout() {
        $this->session->sess_destroy ();
        redirect ( base_url() );
    }




  public function userslist(){
     $url = base_url()."myadmin"."/userslist";
    $user_id = $this->session->userdata("user_id");
  

    $data ['title'] = "Users List";
    $per_page = 25;
    $segment = $this->uri->segment(3,0);
   

    $query_count = $this->db->query("select * from userprofile")->num_rows();

    $get_trans = $this->db->query("select * from userprofile order by id desc  limit $segment, $per_page");

           
        $data['currentUrl'] = "userslist";
        $data['get_trans'] = $get_trans;
        $this->paginate($url, $query_count, $per_page);
        $this->load->view('admin/partials/header.php', $data);
        $this->load->view('admin/admin/userslist.php', $data);
        $this->load->view('admin/partials/footer.php', $data);

  }

   public function user_document(){
     $url = base_url()."myadmin"."/user_document";
    $user_id = $this->session->userdata("user_id");
  

    $data ['title'] = "Document List";
    $per_page = 25;
    $segment = $this->uri->segment(3,0);
   

    $query_count = $this->db->query("select * from userdocument")->num_rows();

    $get_trans = $this->db->query("select * from userdocument order by id desc  limit $segment, $per_page");

           
        $data['currentUrl'] = "user_document";
        $data['get_trans'] = $get_trans;
        $this->paginate($url, $query_count, $per_page);
        $this->load->view('admin/partials/header.php', $data);
        $this->load->view('admin/admin/documentlist.php', $data);
        $this->load->view('admin/partials/footer.php', $data);

  }



public function cancel_sell(){
    $trans_id = $this->uri->segment(3);
    $get_transc = $this->db->get_where('usertransaction',array('trans_id'=>$trans_id));
    $get_user = $this->db->get_where('userprofile', array('id' => $this->session->userdata('user_id')));
    if($get_transc->row()->status == 1){
        $this->flash("The order is already cancelled", "danger");
        redirect('sell_history','refresh');
    }
    else if($get_user->row()->user_level > 0){
        $this->db->where('trans_id', $trans_id)->update('usertransaction', array('status' => 1));
                
             $this->flash("Order cancelled", "success");
              redirect('sell_history','refresh');
    }
    else{
         $this->flash("You cannot cancel this order", "danger");
        redirect(base_url().'myadmin/sell_history','refresh');
    }
}


 public function cancel_buy(){
    $trans_id = $this->uri->segment(3);
    $get_transc = $this->db->get_where('usertransaction',array('trans_id'=>$trans_id));
    $get_user = $this->db->get_where('userprofile', array('id' => $this->session->userdata('user_id')));
    if($get_transc->row()->status == 1){
        $this->flash("The order is already cancelled", "danger");
        redirect('buy_history','refresh');
    }
    else if($get_user->row()->user_level > 0){
        $this->db->where('trans_id', $trans_id)->update('usertransaction', array('status' => 1));

                       
             $this->flash("Order cancelled", "success");
              redirect('buy_history','refresh');
            

    }
    else{
         $this->flash("You cannot cancel this order", "danger");
        redirect(base_url().'myadmin/buy_history','refresh');
    }
}

public function buy_history(){
    $url = base_url()."myadmin"."/buy_history";
    $user_id = $this->session->userdata("user_id");
  
    $data ['title'] = "Buy History";
    $per_page = 25;
    $segment = $this->uri->segment(3,0);
   

    $query_count = $this->db->query("select * from usertransaction where  type = 'buy'")->num_rows();

    $get_trans = $this->db->query("select * from usertransaction where type = 'buy' order by update_date desc  limit $segment, $per_page");

           
        $data['currentUrl'] = "buy_history";
        $data['get_trans'] = $get_trans;
          $get_user = $this->db->get_where('userprofile', array('username' => $this->session->userdata('username')))->row();
           
        $data['get_user'] = $get_user;
        $this->paginate($url, $query_count, $per_page);
        $this->load->view('admin/partials/header.php', $data);
        $this->load->view('admin/admin/buy_history.php', $data);
        $this->load->view('admin/partials/footer.php', $data);
}

public function sell_history(){
    $url = base_url()."myadmin"."/sell_history";
    $user_id = $this->session->userdata("user_id");
  
    $data ['title'] = "Sell History";
    $per_page = 25;
    $segment = $this->uri->segment(3,0);
   

    $query_count = $this->db->query("select * from usertransaction where type = 'sell'")->num_rows();

    $get_trans = $this->db->query("select * from usertransaction where type = 'sell' order by update_date desc  limit $segment, $per_page");

           
        $data['currentUrl'] = "sell_history";
        $data['get_trans'] = $get_trans;
          $get_user = $this->db->get_where('userprofile', array('username' => $this->session->userdata('username')))->row();
           
        $data['get_user'] = $get_user;
        $this->paginate($url, $query_count, $per_page);
        $this->load->view('admin/partials/header.php', $data);
        $this->load->view('admin/admin/sell_history.php', $data);
        $this->load->view('admin/partials/footer.php', $data);
}




function flash($message, $status){

    if($status=="success"){
        return $this->session->set_flashdata ( 'msg', '<div class="alert alert-success text-center">'. $message. ' </div>' );
    }
    else{
        return $this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">'. $message. ' </div>' );
    }
     

}






  }
