<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Members_model extends CI_Model {
	function _construct() {
		parent::_construct ();
		//include APPPATH . 'third_party/SendSMS.php';
	}
	
	function sendMail($email, $subject, $message) {
        $this->load->library ( 'email');
		$config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.npdc-nigeria.com',
            'smtp_port' => 587,
            'smtp_user' => 'biadmin@npdc-nigeria.com',
            'smtp_pass' => '1234#@Abcd',
            'smtp_crypto' => 'tls',
            'smtp_timeout' => '60',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
		);


        $this->email->initialize($config);
		//$this->email->set_newline ( "\r\n" );
		$this->email->set_newline("\r\n");
		$this->email->set_header('MIME-Version', '1.0; charset=utf-8'); //must add this line
		$this->email->set_header('Content-type', 'text/html'); //must add this line

		$this->email->from ( "biadmin@npdc-nigeria.com", "Admin FleetXpert" ); // change it to yours
		$this->email->to ( $email ); // change it to yours
		$this->email->subject ( $subject );
		$this->email->message ( $message );
		if ($this->email->send ()) {
			return TRUE;
		} else {
			// show_error($this->email->print_debugger());
			return FALSE;
		}
	}


    function alertmail($fullname) {
        $str = "<p> You successfully logged into your NPDC BI Account on ". date('Y-m-d h:i:s'). "</p>";
        $str .= "<p><b>Details Below</b></p>";
        $str .= "<br/>IP Address: " . $this->input->ip_address();
        $str .= "<br/>OS: " .PHP_OS;
        $str .= "<br> Browser :". $_SERVER['HTTP_USER_AGENT'];
        $data['title'] = "FleetXpert Portal Login Notification";
        $data['username'] = $fullname;
        $data['message'] = $str;

        $message = $this->load->view('email/basic', $data, true);
        return $message;
    }

    function alertnewMember($fullname, $username, $password) {


        $str = "Welcome to FleetXpert Portal";
        $str .= "<br/> your Login details are <br/>";
        $str .= "Username: $username<br/>";
        $str .= "Password: $password <br/>";
        $str .= "Thank you! <br/>";
        $data['title'] = "Account creation";
        $data['username'] = $fullname;
        $data['message'] = $str;

        $message = $this->load->view('email/basic', $data,true);
        return $message;
    }

    function alert_email_expiration($doc, $reg_no, $username) {


        $str = "This is to notify you that the following document will expire in less than 3 months from now <br>";
        if($doc =="Road Worthiness") {
            $get_part = $this->db->get_where('tblfleet_vehicle_particulars', array('reg_no' => $reg_no))->row();

            $get_vehicle = $this->db->get_where('tmp.npdcfleet', array('reg_no' => $reg_no))->row();

            $str.= "Vehicle: $reg_no <br>";
            $str.= "Make/Model: $get_vehicle->make_model <br>";
            $str .= "Document: $doc<br/>";
            $str .= "Expiration Date: $get_part->r_expiration <br/>";
        }
        else if($doc =="Insurance") {
            $get_part = $this->db->get_where('tblfleet_vehicle_particulars', array('reg_no' => $reg_no))->row();

            $get_vehicle = $this->db->get_where('tmp.npdcfleet', array('reg_no' => $reg_no))->row();
            //$str = "This is to notify you that the following document will expire in less than 3 months from now <br>";
            $str.= "Vehicle: $reg_no <br>";
            $str.= "Make/Model: $get_vehicle->make_model <br>";
            $str .= "Document: $doc<br/>";
            $str .= "Expiration Date: $get_part->i_expiration <br/>";
        }
        else if($doc =="Vehicle License") {
            $get_part = $this->db->get_where('tblfleet_vehicle_particulars', array('reg_no' => $reg_no))->row();

            $get_vehicle = $this->db->get_where('tmp.npdcfleet', array('reg_no' => $reg_no))->row();
            //$str = "This is to notify you that the following document will expire in less than 3 months from now <br>";
            $str.= "Vehicle: $reg_no <br>";
            $str.= "Make/Model: $get_vehicle->make_model <br>";
            $str .= "Document: $doc<br/>";
            $str .= "Expiration Date: $get_part->v_expiration <br/>";
        }
        else{
            $get_part = $this->db->get_where('tblfleet_drivers_license', array('id' => $reg_no))->row();

            $get_vehicle = $this->db->get_where('tblfleet_driver', array('id' => $reg_no))->row();
            $str = "This is to notify you that the following document will expire in less than 3 months from now <br>";
            $str.= "Fullname: $get_vehicle->fullname <br>";
            $str.= "License Number: $get_part->license_no <br>";
            $str .= "Document: $doc<br/>";
        }

        $str .= "Thank you! <br/>";
        $data['title'] = "$doc Expiration Notification";
        $data['username'] = $username;
        $data['message'] = $str;

        $message = $this->load->view('email/basic', $data,true);
        return $message;
    }

    function alert_sms_expiration($doc, $reg_no, $username) {


        $str = "Dear $username, This is to notify you that the following document will expire in less than 3 months from now";

        if($doc =="Road Worthiness") {
            $get_part = $this->db->get_where('tblfleet_vehicle_particulars', array('reg_no' => $reg_no))->row();

            $get_vehicle = $this->db->get_where('tmp.npdcfleet', array('reg_no' => $get_part->reg_no))->row();
            $str.= "- Vehicle: $get_part->reg_no";
            $str.= "- Make/Model: $get_vehicle->make_model";
            $str .= "- Document: $doc";
            $str .= "- Expiration Date: $get_part->r_expiration";
        }
        elseif($doc =="Insurance") {
            $get_part = $this->db->get_where('tblfleet_vehicle_particulars', array('reg_no' => $reg_no))->row();

            $get_vehicle = $this->db->get_where('tmp.npdcfleet', array('reg_no' => $get_part->reg_no))->row();
            $str.= "- Vehicle: $get_part->reg_no";
            $str.= "- Make/Model: $get_vehicle->make_model";
            $str .= "- Document: $doc";
            $str .= "- Expiration Date: $get_part->i_expiration";
        }
        else if($doc =="Vehicle License") {
            $get_part = $this->db->get_where('tblfleet_vehicle_particulars', array('reg_no' => $reg_no))->row();

            $get_vehicle = $this->db->get_where('tmp.npdcfleet', array('reg_no' => $get_part->reg_no))->row();
            $str.= "- Vehicle: $get_part->reg_no";
            $str.= "- Make/Model: $get_vehicle->make_model";
            $str .= "- Document: $doc";
            $str .= "- Expiration Date: $get_part->v_expiration";
        }
        else {
            $get_part = $this->db->get_where('tblfleet_drivers_license', array('id' => $reg_no))->row();

            $get_vehicle = $this->db->get_where('tblfleet_driver', array('id' => $reg_no))->row();
            $str = "This is to notify you that the following document will expire in less than 3 months from now <br>";
            $str.= "- Fullname: $get_vehicle->fullname ";
            $str.= "- License Number: $get_part->license_no";
            $str .= "- Document: $doc";
        }
        $str .= " Thank you!";

        return $str;
    }



	function isValidUser($email) {
		$data = array (
				'email' => $email 
		);
		$query = $this->db->get_where ( 'tblusers', $data );
		if ($query->num_rows () > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function isValidNumber($phone) {
		if (preg_match ( '/^080/', $phone ) || preg_match ( '/^070/', $phone ) || preg_match ( '/^081/', $phone ) || preg_match ( '/^090/', $phone )) {
			return TRUE;
		} 

		else {
			return FALSE;
		}
	}
	
	public function make_code($phorgh, $field) {
		do {
			$url_code = random_string('alnum', 6);
			//$url_code = time () . mt_rand ( 0, 999999999 );
			$this->db->where ( $field.' = ', $url_code );
			$this->db->from ( $phorgh );
			$num = $this->db->count_all_results ();
		} while ( $num >= 1 );
		return $url_code;
	}


	public function make_email_code() {
		do {
			$url_code = random_string('alnum', 8);
			$this->db->where ( 'email_vcode = ', $url_code );
			$this->db->from ( 'userprofile' );
			$num = $this->db->count_all_results ();
		} while ( $num >= 1 );
		return $url_code;
	}


    public function make_folder() {
        do {
            $url_code = Random_string('alnum', 3);
            //$url_code = time () . mt_rand ( 0, 999999999 );
            $this->db->where ( 'path_name = ', $url_code );
            $this->db->from ( 'tblpath' );
            $num = $this->db->count_all_results ();
        } while ( $num >= 1 );
        return $url_code;
    }

    public function make_filename() {
        do {
            $url_code = Random_string('alnum', 8);
            //$url_code = time () . mt_rand ( 0, 999999999 );
            $this->db->where ( 'ad_pic_path = ', $url_code );
            $this->db->from ( 'ad_pic' );
            $num = $this->db->count_all_results ();
        } while ( $num >= 1 );
        return $url_code;
    }





	public function make_codeCard($phorgh) {
		do {
			// $url_code = random_string('alnum', 8);
			$url_code = random_string('numeric', 8);
			$this->db->where ( 'id = ', $url_code );
			$this->db->from ( $phorgh );
			$num = $this->db->count_all_results ();
		} while ( $num >= 1 );
		return $url_code;
	}
	
	

	public function sendSMS($sender, $mobile1, $message, $type = "text") {

		
		$message = urlencode ( $message );
		
		$url = $this->getApiDefault ()->row ();
		$urldata = $url->apiData;
		
		$defaultApi = str_replace ( '@@sender@@', $sender, $urldata );
		$defaultApi = str_replace ( '@@recipient@@', $mobile1, $defaultApi );
		$defaultApi = str_replace ( '@@message@@', $message, $defaultApi );
		
		// do send message call
		$return = file ( $defaultApi );
		// list($send,$msgcode) = split('|',$return);//if(strpos($return, $url->apiResponse) != false)
		
		$res = implode ( '', $return );
		return $res;

	}
	
	public function translate_id_to_string($id, $tblname, $fieldname, $returnindex){
		$arr = array($fieldname => $id);
		$query = $this->db->get_where($tblname,$arr);
		return  $query->row()->$returnindex;
	}

	public function sendBulkSMS($sender, $mobile1, $message, $type = "text") {
		
		
//			$message = urlencode ( $message );
//			$url = "http://api.messagebird.com/api/sms?username=pleropay2&password=chichebem0703&destination=$mobile1&body=$message&sender=$sender";
//
//       	   return $this->curl_get_contents($url);
			//exit ();


        $message = urlencode ( $message );;
        $url = "http://www.estoresms.com/smsapi.php?username=carson&password=theboy1992&sender=$sender&recipient=$mobile1&message=$message&dnd=true";
        $return = file ( $url );

        return $return;
		
	}
	
	
	public function curl_get_contents($url) {
		// $curl = curl_init($url);
		// curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		// $data = curl_exec($curl);
		// curl_close($curl);
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
		curl_setopt ( $ch, CURLOPT_HEADER, false );
		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_REFERER, $url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		return $result;
	}
	
	
	

	function get_user_details_by_email($email) {
		$this->db->where ( 'username', $email );
		$result = $this->db->get ( 'tblusers' );
		if ($result) {
			return $result;
		} else {
			return false;
		}
	}
	function get_user_details_by_phone($phone) {
		$this->db->where ( 'phone', $phone );
		$result = $this->db->get ( 'tblusers' );
		if ($result) {
			return $result;
		} else {
			return false;
		}
	}

	function ChangeValue($email, $fieldname, $newvalue) {
		$data = array (
				
				$fieldname => md5 ( $newvalue ) 
		)
		;
		$this->db->where ( 'email', $email );
		$query = $this->db->update ( 'tblusers', $data );
		
		if ($query) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}