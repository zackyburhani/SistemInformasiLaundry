<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerLogin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model');	
	}

	public function index()
	{
		$username = $this->session->username;
		if($username != null){
			redirect('dashboard');
		} else {
			$this->load->view('template/v_login');
		}
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		
		$checkUsername = $this->Model->auth($username,$password);

		if($checkUsername==NULL){
			$this->session->set_flashdata('pesanGagal','Kesalahan');
			redirect('login');

		}else{

			$newdata = array(
				'username' => $checkUsername->username,
				'nm_petugas' => $checkUsername->nm_petugas,
			  );
			//set seassion
			$this->session->set_userdata($newdata);
			redirect('dashboard');
		}
	}

	public function not_found()
	{
		$this->load->view('v_404');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('');
	}
}