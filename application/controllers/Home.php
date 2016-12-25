<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('thisweb');
		$this->load->model('Shared_model','shared_model');//'Shared_Model'
	}

	public function index() {
		$this->start();
	}

	public function loadView($data){
		$data['basePath'] = base_url();
		$data['theme'] = trim( file_get_contents('css/theme.cfg') );
		$this->load->view('template',$data);
		return false;
	}

	//=====================================================

	public function start() {
		//$data['variables'] 	= "start/variables";
		$data['head'] 		= 'head';
		//$data['processing'] = "start/processing";
//		$data['cat'] = 'shared';
		$data['body'] 		= 'start/body';
		$data['scripts'] 		= 'scripts';
		$this->loadView($data);
	}

	//

}

// EoF !
