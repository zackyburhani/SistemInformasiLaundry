<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model extends CI_Model {

    public function __construct()
    {
		parent::__construct();
	}

	//untuk login
	public function auth($username,$password)
	{
   		$query = "SELECT * FROM petugas WHERE UPPER(username)=".$this->db->escape(strtoupper(stripslashes(strip_tags(htmlspecialchars($username,ENT_QUOTES)))))." AND password=".$this->db->escape(stripslashes(strip_tags(htmlspecialchars($password,ENT_QUOTES))));
   		$result = $this->db->query($query);
   		return $result->row();
	}

	//ambil semua data
	public function getAll($table)
	{
		$result = $this->db->get($table);
		return $result->result();
	}

	//ambil semua data perID
	public function getByID($table,$kolom,$id)
	{
		$this->db->from($table);
		$this->db->where($kolom, $id);
		$query = $this->db->get();
		return $query->row();
	}

	//simpan
	public function simpan($table,$data)
	{
		$checkinsert = false;
		try{
			$this->db->insert($table,$data);
			$checkinsert = true;
		}catch (Exception $ex) {
			$checkinsert = false;
		}
		return $checkinsert;
	}

	//update
	public function update($pk,$id,$data,$table)
	{
		$checkupdate = false;
		try{
			$this->db->where($pk,$id);
			$this->db->update($table,$data);
			$checkupdate = true;
		}catch (Exception $ex) {
			$checkupdate = false;
		}
		return $checkupdate;
	}

	//hapus
	public function hapus($pk,$id,$table)
	{
		$checkdelete = false;
		try{
			$this->db->where($pk,$id);
			$this->db->delete($table);
			$checkdelete = true;
		}catch (Exception $ex) {
			$checkdelete = false;
		}
		return $checkdelete;
	}

	//join order
	public function getJoinOrder()
	{
		$check = false;
		try{
			$this->db->select('*');
			$this->db->from('order_pesanan');
			$this->db->join('pelanggan', 'pelanggan.kd_pelanggan = order_pesanan.kd_pelanggan');
			$this->db->where('status','0');
			$this->db->order_by('kd_order','DESC');
			$query = $this->db->get();
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	//by id
	public function getJoinOrder_ID($kd_order)
	{
		$check = false;
		try{
			$this->db->select('*');
			$this->db->from('order_pesanan');
			$this->db->join('pelanggan', 'pelanggan.kd_pelanggan = order_pesanan.kd_pelanggan');
			$this->db->where('status','0');
			$this->db->where('kd_order',$kd_order);
			$this->db->order_by('kd_order','DESC');
			$query = $this->db->get();
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	public function getJoinJasa_ID($kd_jasa,$kd_order)
	{
		$check = false;
		try{
			$query = $this->db->query("
				SELECT *,
					(SELECT sum(jumlah) FROM detail_order JOIN pelanggan ON pelanggan.kd_pelanggan = detail_order.kd_pelanggan JOIN order_pesanan ON order_pesanan.kd_pelanggan = pelanggan.kd_pelanggan WHERE order_pesanan.kd_order = '$kd_order') as total 
				FROM pelanggan
					JOIN order_pesanan ON pelanggan.kd_pelanggan = order_pesanan.kd_pelanggan
					JOIN detail_order ON pelanggan.kd_pelanggan = detail_order.kd_pelanggan
					JOIN jasa ON detail_order.kd_jasa = jasa.kd_jasa
				WHERE order_pesanan.status = '0' AND order_pesanan.kd_order = '$kd_order' AND jasa.kd_jasa = '$kd_jasa'");
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	//detail berdasarkan id
	public function getJoinDetail_ID($kd_order)
	{
		$check = false;
		try{
			$query = $this->db->query("
				SELECT *,
					(SELECT sum(jumlah) FROM detail_order JOIN pelanggan ON pelanggan.kd_pelanggan = detail_order.kd_pelanggan JOIN order_pesanan ON order_pesanan.kd_pelanggan = pelanggan.kd_pelanggan WHERE order_pesanan.kd_order = '$kd_order') as total 
				FROM pelanggan
					JOIN order_pesanan ON pelanggan.kd_pelanggan = order_pesanan.kd_pelanggan
					JOIN detail_order ON pelanggan.kd_pelanggan = detail_order.kd_pelanggan
					JOIN jasa ON detail_order.kd_jasa = jasa.kd_jasa
				WHERE order_pesanan.status = '0' AND order_pesanan.kd_order = '$kd_order'");
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	//fetch
	public function getJoinDetail_ID_fetch($kd_order)
	{
		$check = false;
		try{
			$query = $this->db->query("
				SELECT *,
					(SELECT sum(jumlah) FROM detail_order JOIN pelanggan ON pelanggan.kd_pelanggan = detail_order.kd_pelanggan JOIN order_pesanan ON order_pesanan.kd_pelanggan = pelanggan.kd_pelanggan WHERE order_pesanan.kd_order = '$kd_order') as total 
				FROM pelanggan
					JOIN order_pesanan ON pelanggan.kd_pelanggan = order_pesanan.kd_pelanggan
					JOIN detail_order ON pelanggan.kd_pelanggan = detail_order.kd_pelanggan
					JOIN jasa ON detail_order.kd_jasa = jasa.kd_jasa
				WHERE order_pesanan.status = '0' AND order_pesanan.kd_order = '$kd_order'");
			return $query->row();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

    //kode pelanggan
	public function getKodePelanggan()
    {
       	$q  = $this->db->query("SELECT MAX(RIGHT(kd_pelanggan,7)) as kd_max from pelanggan");
       	$kd = "";
    	if($q->num_rows() > 0) {
        	foreach ($q->result() as $k) {
          		$tmp = ((int)$k->kd_max)+1;
           		$kd = sprintf("%07s",$tmp);
        	}
    	} else {
         $kd = "0000001";
    	}
       	return "PLG".$kd;
    }

    //kode barang
	public function getKodeBarang()
    {
       	$q  = $this->db->query("SELECT MAX(RIGHT(kd_barang,7)) as kd_max from barang");
       	$kd = "";
    	if($q->num_rows() > 0) {
        	foreach ($q->result() as $k) {
          		$tmp = ((int)$k->kd_max)+1;
           		$kd = sprintf("%07s",$tmp);
        	}
    	} else {
         $kd = "0000001";
    	}
       	return "BRG".$kd;
    }

    //kode Jasa
	public function getKodeJasa()
    {
       	$q  = $this->db->query("SELECT MAX(RIGHT(kd_jasa,7)) as kd_max from jasa");
       	$kd = "";
    	if($q->num_rows() > 0) {
        	foreach ($q->result() as $k) {
          		$tmp = ((int)$k->kd_max)+1;
           		$kd = sprintf("%07s",$tmp);
        	}
    	} else {
         $kd = "0000001";
    	}
       	return "JSA".$kd;
    }

    //kode Order
	public function getKodeOrder()
    {
       	$q  = $this->db->query("SELECT MAX(RIGHT(kd_order,7)) as kd_max from order_pesanan");
       	$kd = "";
    	if($q->num_rows() > 0) {
        	foreach ($q->result() as $k) {
          		$tmp = ((int)$k->kd_max)+1;
           		$kd = sprintf("%07s",$tmp);
        	}
    	} else {
         $kd = "0000001";
    	}
       	return "ORP".$kd;
    }

}