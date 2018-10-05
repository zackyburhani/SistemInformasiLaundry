<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerDashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model');
		$username = $this->session->username;
		if($username == null){
			redirect('');
		}
	}

	public function index()
	{	
		$data = [
			'pelanggan' => $this->Model->jumlah('pelanggan'),
			'barang' => $this->Model->jumlah('barang'),
			'jasa' => $this->Model->jumlah('jasa'),
		];
		$this->load->view('template/v_header');
		$this->load->view('template/v_sidebar');
		$this->load->view('v_dashboard',$data);
		$this->load->view('template/v_footer');
	}
}