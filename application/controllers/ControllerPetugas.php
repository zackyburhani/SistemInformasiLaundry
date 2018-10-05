<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerPetugas extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Model');
		$username = $this->session->username;
		if($username == null){
			redirect('');
		}
	}
	
	function index()
	{	
		$this->load->view('template/v_header');
		$this->load->view('template/v_sidebar');
		$this->load->view('v_petugas');
		$this->load->view('template/v_footer');
	}

	function data_petugas()
	{
		$data = $this->Model->getAll('petugas');
		echo json_encode($data);
	}

	function get_petugas()
	{
		$username = $this->input->get('username');
		$data = $this->Model->getById('petugas','username',$username);
		echo json_encode($data);
	}

	function simpan()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$nm_petugas = $this->input->post('nm_petugas');
		$no_telp = $this->input->post('no_telp');
		$alamat = $this->input->post('alamat');

		$data = [
			'username' => $username,
			'password' => md5($password),
			'nm_petugas' => $nm_petugas,
			'no_telp' => $no_telp,
			'alamat' => $alamat
		];

		$result = $this->Model->simpan('petugas',$data);

		echo json_encode($result);
	}

	function hapus()
	{
		$username = $this->input->post('username');
		$data = $this->Model->hapus('username',$username,'petugas');
		echo json_encode($data);
	}

	function ubah()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$nm_petugas = $this->input->post('nm_petugas');
		$no_telp = $this->input->post('no_telp');
		$alamat = $this->input->post('alamat');

		if($password == ""){
			$data = [
				'nm_petugas' => $nm_petugas,
				'no_telp' => $no_telp,
				'alamat' => $alamat
			];			
		} else {
			$data = [
				'password' => md5($password),
				'nm_petugas' => $nm_petugas,
				'no_telp' => $no_telp,
				'alamat' => $alamat
			];
		}

		$result = $this->Model->update('username',$username,$data,'petugas');

		echo json_encode($result);
	}

}