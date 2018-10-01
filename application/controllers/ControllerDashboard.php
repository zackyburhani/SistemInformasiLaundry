<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerDashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model');
	}

	public function index()
	{	
		$this->load->view('template/v_header');
		$this->load->view('template/v_sidebar');
		$this->load->view('v_dashboard');
		$this->load->view('template/v_footer');
	}
}