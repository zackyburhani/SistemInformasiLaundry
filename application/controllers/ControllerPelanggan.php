<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerPelanggan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Model');
	}
	
	function index()
	{	
		$this->load->view('template/v_header');
		$this->load->view('template/v_sidebar');
		$this->load->view('v_pelanggan');
		$this->load->view('template/v_footer');
	}

	function getKode()
	{
		$kode = $this->Model->getKodePelanggan();
		$data = [
			'kd_pelanggan' => $kode
		];
		echo json_encode($data);
	}

	function data_pelanggan()
	{
		$data = $this->Model->getAll('pelanggan');
		echo json_encode($data);
	}

	function get_pelanggan()
	{
		$kd_pelanggan = $this->input->get('kd_pelanggan');
		$data = $this->Model->getById('pelanggan','kd_pelanggan',$kd_pelanggan);
		echo json_encode($data);
	}

	function simpan()
	{
		$kd_pelanggan = $this->input->post('kd_pelanggan');
		$nm_pelanggan = $this->input->post('nm_pelanggan');
		$no_telp = $this->input->post('no_telp');
		$alamat = $this->input->post('alamat');

		$data = [
			'kd_pelanggan' => $kd_pelanggan,
			'nm_pelanggan' => $nm_pelanggan,
			'no_telp' => $no_telp,
			'alamat' => $alamat
		];

		$result = $this->Model->simpan('pelanggan',$data);

		echo json_encode($result);
	}

	function hapus()
	{
		$kd_pelanggan = $this->input->post('kd_pelanggan');
		$data = $this->Model->hapus('kd_pelanggan',$kd_pelanggan,'pelanggan');
		echo json_encode($data);
	}

	function ubah()
	{
		$kd_pelanggan = $this->input->post('kd_pelanggan');
		$nm_pelanggan = $this->input->post('nm_pelanggan');
		$no_telp = $this->input->post('no_telp');
		$alamat = $this->input->post('alamat');

		$data = [
			'nm_pelanggan' => $nm_pelanggan,
			'no_telp' => $no_telp,
			'alamat' => $alamat
		];

		$result = $this->Model->update('kd_pelanggan',$kd_pelanggan,$data,'pelanggan');

		echo json_encode($result);
	}

}