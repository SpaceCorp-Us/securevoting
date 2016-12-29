<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('thisweb');
		$this->load->model('Shared_model','shared_model');
		$this->load->model('Access_model','access_model');
		$this->load->library('form_validation');
	}

	public function index() {
		$this->access();
	}

	public function loadView($data){
		$data['basePath'] = base_url();
		$data['theme'] = trim( file_get_contents('css/theme.cfg') );
		$this->load->view('template',$data);
		return false;
	}

	//=====================================================

	public function access() {
		$data['head'] 		= "head";
		//$data['processing'] = "start/processing";
		//$data['cat'] = 'shared';
		$data['body'] 		= "access/body";
		$data['scripts'] 	= "scripts";
		$this->loadView($data);
	}

	public function login() {
		if( $this->session->flashdata('validation') ){
			$data['validation'] = $this->session->flashdata('validation');
		}
		$data['head'] 		= 'head';
		$data['css'] 		= 'access/css/login';
		$data['body'] 		= 'access/body';
		$data['page'] 		= 'form_login';
		$data['scripts'] 	= 'scripts';
		$this->loadView($data);
	}

	public function login_validation(){
		//$this->load->library('form_validation');
		$this->form_validation->set_rules('UserName','Username','required|trim|callback_validate_credentials');
		$this->form_validation->set_rules('PassWord','Password','required|trim');
		// session
		if( $this->form_validation->run() ){
			$data = array(
				'UserName' => trim($this->input->post('UserName')),
				'PassWord' => trim($this->input->post('PassWord')),
				'Logged_In' => TRUE
			);
			$this->session->set_userdata($data);
			redirect(base_url());
		} else {
			$this->session->set_flashdata('validation', validation_errors() );
			redirect('access/login');
		}
	}

	public function validate_credentials(){
		if( $this->access_model->can_login() ){
			return TRUE;
		} else {
			$this->form_validation->set_message('validate_credentials','Incorrect Username/Password.');
			return FALSE;
		}
	}

	public function myaccount() {
		if( $this->session->flashdata('validation') ){
			$data['validation'] = $this->session->flashdata('validation');
		}
		$data['head']		= "head";
		$data['css'] 		= 'access/css/login';
		//$data['processing'] = "start/processing";
		//$data['cat'] = 'shared';
		$data['body']		= "access/body";
		$data['page'] 		= 'form_myaccount';
		$data['scripts'] 	= 'scripts';
		$this->loadView($data);
	}

	public function update_account() {
		$relogin = false;
		$rename = false;
		$pathFile = $_POST['pathFile'];
		unset($_POST['pathFile']);
		//
		$fields = $this->config->item('userFields');
		//=============== Create JSON File ==================
		//$this->shared_model->outputArray($_POST); exit(); // FOR TESTING !
		if( md5(trim($_POST['username']))==$_POST['preusername'] ){
			$_POST['username'] = $_POST['preusername'];
		} else {
			$newFileName = md5(trim($_POST['username'])).'.json';
			if( file_exists( $this->config->item('usersDir').$newFileName ) ){
				$this->session->set_flashdata('validation', 'Unable to Comply, UserName is Taken...' );
				redirect('access/myaccount');
			} else {
				$_POST['username'] = md5(trim($_POST['username']));
				$rename = TRUE;
			}
		}
		unset($_POST['preusername']);
		//
		if( trim($_POST['password'])!=trim($_POST['prepassword']) ){
			$_SESSION['PassWord'] = trim($_POST['password']);
			$_POST['password'] = $this->access_model->makePassword(trim($_POST['password']));
		} else {
			$_POST['password'] = $this->access_model->makePassword(trim($_SESSION['PassWord']));
		}
		if( isset($_POST['email_address']) && trim($_POST['email_address'])!='' ){
			$_POST['email_address'] = $this->encrypt->encode(trim($_POST['email_address']),md5(trim($_SESSION['PassWord'])));
		}
		unset($_POST['prepassword']);
		//
		$json = json_encode($_POST,JSON_PRETTY_PRINT);
		//echo $json; exit(); // FOR TESTING !
		$fObj = fopen($pathFile,'w');
		fwrite($fObj,$json);
		fclose($fObj);
		chmod($pathFile, 0775);
		//
		if( $rename ){
			// rename file
			$newPathFile = trim($this->config->item('usersDir').$newFileName);
			if( !copy($pathFile,$newPathFile) ){
				$this->session->set_flashdata('validation', 'Unable to Comply, Please contact Support...' );
				redirect('access/myaccount');
			} else {
				chmod($newPathFile, 0775);
				unlink( $pathFile );
				$relogin = TRUE;
			}
		}
		if( $relogin ){
			redirect('access/logout');
		} else {
			redirect('access/myaccount');
		}
	}

	public function signup(){
		if( $this->session->flashdata('validation') ){
			$data['validation'] = $this->session->flashdata('validation');
		}
		// 		$data['header'] 	= array(
		// 			0 => 'buttons/home',
		// 			1 => 'buttons/login',
		// 			2 => 'buttons/more'
		// 		);
		//		$data['variables'] 	= "splash/variables";
		$data['head'] 		= "access/head";
		$data['body'] 		= "access/body_signup";
		//		$data['scripts'] 	= "splash/scripts";
		$this->loadView($data);
	}

	public function checkemail(){
		$data['head'] 		= "access/head";
		$data['body'] 		= "access/body_checkemail";
		$this->loadView($data);
	}

	public function signup_process(){
		$valid = true;
		$problems = '';
		if( trim($this->input->post('UserName'))=='' ){
			$valid = false; $problems .= '* Username can Not be Empty.<br/>';
		}
		if( $this->access_model->findUser(trim($this->input->post('UserName'))) ){
			$valid = false; $problems .= '* Please try Another Username.<br/>';
		}
		if( trim($this->input->post('Email'))=='' ){
			$valid = false; $problems .= '* Email can Not be Empty.<br/>';
		}
		if( trim($this->input->post('PassWord'))=='' ){
			$valid = false; $problems .= '* Password can Not be Empty.<br/>';
		}
		if( trim($this->input->post('cPassWord'))=='' ){
			$valid = false; $problems .= '* Confirm Password can Not be Empty.<br/>';
		}
		if( !trim($this->input->post('PassWord'))==trim($this->input->post('cPassWord')) ){
			$valid = false; $problems .= '* Passwords do Not Match.<br/>';
		}
		//
		if( $valid ){
			// generate random key
			$key = md5(uniqid());
			$this->load->library('email',$this->config->item('SMTP'));
			//
			$this->email->from($this->config->item('SignupEmailAddress'),$this->config->item('SignupEmailName'));
			$this->email->to(trim($this->input->post('Email')));
			$this->email->subject($this->config->item('SignupEmailSubject'));
			$message = '<p>Welcome,</p>';
			$message .= '<p>Thank you for Signing Up!</p>';
			$message .= '<p>Please <a href="'.base_url().'access/register_user/';
			$message .= md5(trim($this->input->post('UserName'))).'/'.$key;
			$message .= '">Click Here</a> to Confirm your Account request.</p>';
			$this->email->message($message);
			if( $this->email->send() ){
				if( !$this->access_model->add_temp_user($key) ){
					echo 'Problem adding to Temp Data... Please Contact Support.';
				} else {
					redirect('access/checkemail');
				}
			} else {
				echo 'Could Not send eMail... Please Contact Support.';
			}
			//
		} else {
			$this->session->set_flashdata('validation', $problems );
			redirect('access/signup');
		}
	}

	// to Register Users
	public function register_user($userName,$key){
		if( $this->access_model->is_key_valid($userName,$key) ){
			if( $this->access_model->add_user($userName) ){
				redirect('access/login');
			} else {
				echo 'Failed to Add User, Please try again.';
			}
		} else {
			redirect('./');
		}
	}

	//========================================================================

	public function logout(){
		$this->session->sess_destroy();
		redirect( base_url() );
	}

	//

}

// EoF !
