<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerBarang extends CI_Controller
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
		$this->load->view('v_barang');
		$this->load->view('template/v_footer');
	}

	function getKode()
	{
		$kode = $this->Model->getKodeBarang();
		$data = [
			'kd_barang' => $kode
		];
		echo json_encode($data);
	}

	function data_barang()
	{
		$data = $this->Model->getAll('barang');
		echo json_encode($data);
	}

	function get_barang()
	{
		$kd_barang = $this->input->get('kd_barang');
		$data = $this->Model->getById('barang','kd_barang',$kd_barang);
		echo json_encode($data);
	}

	function simpan()
	{
		$kd_barang = $this->input->post('kd_barang');
		$nm_barang = $this->input->post('nm_barang');
		$harga = $this->input->post('harga');
		$stok = $this->input->post('stok');

		$data = [
			'kd_barang' => $kd_barang,
			'nm_barang' => $nm_barang,
			'harga' => $harga,
			'stok' => $stok,
			'username' => $username
		];

		$result = $this->Model->simpan('barang',$data);

		echo json_encode($result);
	}

	function hapus()
	{
		$kd_barang = $this->input->post('kd_barang');
		$data = $this->Model->hapus('kd_barang',$kd_barang,'barang');
		echo json_encode($data);
	}

	function ubah()
	{
		$kd_barang = $this->input->post('kd_barang');
		$nm_barang = $this->input->post('nm_barang');
		$harga = $this->input->post('harga');
		$stok = $this->input->post('stok');

		$data = [
			'kd_barang' => $kd_barang,
			'nm_barang' => $nm_barang,
			'harga' => $harga,
			'stok' => $stok,
			'username' => $username
		];

		$result = $this->Model->update('kd_barang',$kd_barang,$data,'barang');

		echo json_encode($result);
	}

}