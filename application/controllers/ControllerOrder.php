<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerOrder extends CI_Controller
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
		$data = [
			'pelanggan' => $this->Model->getAll('pelanggan'),
			'jasa' => $this->Model->getAll('jasa')
		];
		$this->load->view('template/v_header');
		$this->load->view('template/v_sidebar');
		$this->load->view('v_order',$data);
		$this->load->view('template/v_footer');
	}

    function cekCart()
    {   
        if($this->cart->contents() == null){
            $data_cart = false;
        } else {
            $data_cart = true;
        }
        echo json_encode($data_cart);
    }

	function getKode()
	{
		$kode = $this->Model->getKodeOrder();
		$data = [
			'kd_order' => $kode
		];
		echo json_encode($data); die();
	}

	function data_order()
	{
		$order = $this->Model->getJoinOrder();
		echo json_encode($order);
	}

	function add_to_cart(){ //fungsi Add To Cart

		$kd_jasa = $this->input->post('kd_jasa');

		$jasa = $this->Model->getByID('jasa','kd_jasa',$kd_jasa);

		$data = [
	        'id' => $jasa->kd_jasa, 
	        'name' => $jasa->nm_jasa, 
	        'price' => $jasa->harga, 
	        'qty' => $this->input->post('qty'), 
	    ];

        $tes = $this->cart->insert($data);
        echo $this->show_cart(); //tampilkan cart setelah added
    }
 
    function show_cart(){ //Fungsi untuk menampilkan Cart
        $output = '';
        $no = 0;
        foreach ($this->cart->contents() as $items) {

            $no++;
            $output .='
                <tr>
                	<td align="center">'.$no.".".'</td>
                    <td align="center">'.$items['id'].'</td>
                    <td>'.$items['name'].'</td>
                    <td align="center">'.number_format($items['price'],0,',','.').'</td>
                    <td align="center">'.$items['qty'].'</td> 
                    <td align="right">'.number_format($items['subtotal'],0,',','.').'</td>
                    <td align="center"><button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-md"><i class="glyphicon glyphicon-trash"></i></button></td>
                </tr>
            ';
        }
        $output .= '
            <tr>
                <th colspan="4"><center>TOTAL</center></th>
                <th colspan="2"> <div class="text-right">'.'Rp '.number_format($this->cart->total(),0,',','.').'</div></th>
                <th></th>
            </tr>
        ';
        return $output;
    }
 
    function load_cart(){ //load data cart
        echo $this->show_cart();
    }

    function load_detail(){ 
        foreach ($this->cart->contents() as $items) {
            $data[] = [
            	'id'=> $items['id'],
            	'name' =>$items['name'],
            	'price' =>$items['subtotal'],
            	'qty' =>$items['qty']
            ];      
        }
        echo json_encode($data);
    }
 
    function hapus_cart(){ //fungsi untuk menghapus item cart
        $data = array(
            'rowid' => $this->input->post('row_id'), 
            'qty' => 0, 
        );
        $this->cart->update($data);
        echo $this->show_cart();
    }

    function simpan()
	{  
        $username = $this->session->username;
		$kd_order = $this->input->post('kd_order');
		$tgl_masuk = $this->input->post('tgl_masuk');
		$tgl_keluar = $this->input->post('tgl_keluar');
		$kd_pelanggan = $this->input->post('kd_pelanggan');

		$data = [
			'kd_order' => $kd_order,
			'tgl_masuk' => $tgl_masuk,
			'tgl_keluar' => $tgl_keluar,
			'status' => '0',
			'kd_pelanggan' => $kd_pelanggan,
            'username' => $username
		];

		$result = $this->Model->simpan('order_pesanan',$data);

		echo json_encode($result);
	}

	function simpan_detail()
	{
		$kd_jasa = $this->input->post('kd_jasa');
		$kd_order = $this->input->post('kd_order');
		$satuan = $this->input->post('satuan');
		$jumlah = $this->input->post('jumlah');

		$data = [
			'kd_jasa' => $kd_jasa,
			'kd_order' => $kd_order,
			'satuan' => $satuan,
			'jumlah' => $jumlah,
			'status' =>'0'
		];

		$result = $this->Model->simpan('detail_order',$data);

		echo json_encode($result);
	}

	function destroy()
	{	
		$output = $this->input->post('output');
		$data = $this->cart->destroy();
        $output .= '
            <tr>
                <th colspan="4"><center>TOTAL</center></th>
                <th colspan="2"> <div class="text-right">'.'Rp '.'</div></th>
                <th></th>
            </tr>
        ';
        return $output;
	}

	function get_order()
	{
		$kd_order = $this->input->get('kd_order');
		$data = $this->Model->getJoinOrder_ID($kd_order);
		echo json_encode($data);
	}

	function get_jasa()
	{
		$kd_jasa = $this->input->get('kd_jasa');
		$kd_order = $this->input->get('kd_order');
		$data = $this->Model->getJoinJasa_ID($kd_jasa,$kd_order);
		echo json_encode($data);
	}

	function get_detail_order()
	{
		$kd_order = $this->input->get('kd_order');
		$data = $this->Model->getJoinDetail_ID($kd_order);	
		echo json_encode($data);
	}

	function get_detail_order_ver2()
	{
		$kd_order = $this->input->get('kd_order');
		$data = $this->Model->getJoinDetail_ID_ver2($kd_order);	
		echo json_encode($data);
	}

	function proses($kd_order)
	{   
        $this->destroy();
		$data = [
			'barang' => $this->Model->getAll('barang'),
			'kd_order' => $kd_order
		];
		$this->load->view('template/v_header');
		$this->load->view('template/v_sidebar');
		$this->load->view('v_proses',$data);
		$this->load->view('template/v_footer');
	}

	public function cetak($kd_order)
    {
        $pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        //cetak gambar
        $image1 = "assets/img/logo.png";
        $pdf->Cell(1, 0, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 44.20), 0, 0, 'L', false );
        // mencetak string
        $pdf->Cell(186,10,'Kezia Laundry Service',0,1,'C');
        $pdf->Cell(9,1,'',0,1);
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(186,7,'Jl. Kemanggisan Pulo RT.04 / RW.17 No. 71',0,1,'C');
        $pdf->Cell(186,3,'Palmerah, Jakarta barat',0,1,'C');
        $pdf->Cell(186,5,'',0,1,'C');

        $pdf->Line(10, 42, 210-11, 42); 
        $pdf->SetLineWidth(0.5); 
        $pdf->Line(10, 42, 210-11, 42);
        $pdf->SetLineWidth(0);     
            
        $pdf->ln(6);        
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(190,10,'Detail Transaksi',0,1,'C');
        
        $pdf->Cell(10,-1,'',0,1);

        $pemesanan = $this->Model->getJoinDetail_ID($kd_order);

        $pemesanan_fetch = $this->Model->getJoinDetail_ID_fetch($kd_order);

        $pdf->SetFont('Arial','',9);

        $pdf->Cell(25,6,'Kode Order',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$pemesanan_fetch->kd_order,0,0,'L');
        
        $pdf->Cell(65,6,'',0,0,'C');
        $pdf->Cell(30,6,'Tanggal Masuk',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(20,6,''.$pemesanan_fetch->tgl_masuk,0,1,'L');

        $pdf->Cell(25,6,'Pelanggan',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$pemesanan_fetch->nm_pelanggan,0,0,'L');
        
        $pdf->Cell(65,6,'',0,0,'C');
        $pdf->Cell(30,6,'Tanggal Keluar',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(20,6,''.$pemesanan_fetch->tgl_keluar,0,1,'L');

		$pdf->Cell(25,6,'Telepon',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$pemesanan_fetch->no_telp,0,1,'L');

        $pdf->Cell(25,6,'Alamat',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$pemesanan_fetch->alamat,0,1,'L');

        $pdf->Cell(190,5,' ',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,1,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(10,6,'No.',1,0,'C');
        $pdf->Cell(40,6,'Kode Jasa',1,0,'C');
        $pdf->Cell(60,6,'Nama Jasa',1,0,'C');
        $pdf->Cell(20,6,'Harga',1,0,'C');
        $pdf->Cell(20,6,'Jumlah',1,0,'C');
        $pdf->Cell(40,6,'Jumlah Harga',1,1,'C');
        $pdf->SetFont('Arial','',8);

        $tampung = array();
        $no = 1;
        foreach ($pemesanan as $row)
        {
            $pdf->Cell(10,6,$no++.".",1,0,'C');
            $pdf->Cell(40,6,$row->kd_jasa,1,0,'C');
            $pdf->Cell(60,6,ucwords($row->nm_jasa),1,0,'C');
            $pdf->Cell(20,6,number_format($row->harga,0,',','.'),1,0,'C');
            $pdf->Cell(20,6,$row->satuan,1,0,'C');
            $pdf->Cell(40,6,number_format($row->jumlah,0,',','.'),1,1,'C');   
        	$tampung[] = $row->jumlah;
        }

       
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(150,6,'Total Harga',1,0,'C');
        $pdf->Cell(40,6,'Rp. '.number_format(array_sum($tampung),0,',','.'),1,1,'C');
        $pdf->SetFont('Arial','',8);
        
        $pdf->Cell(10,20,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(63,6,'Hormat Kami',0,1,'C');

        $pdf->Cell(10,20,'',0,1);

        $nama_petugas = $this->session->nm_petugas;

        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(63,6,'( '.$nama_petugas.' )',0,0,'C');
        
        $fileName = $kd_order.'/'.$pemesanan_fetch->nm_pelanggan.'.pdf';
        $pdf->Output('D',$fileName); 
    }

    function add_to_cart_ver2(){ //fungsi Add To Cart

		$kd_barang = $this->input->post('kd_barang');

		$barang = $this->Model->getByID('barang','kd_barang',$kd_barang);

		$data = [
	        'id' => $barang->kd_barang, 
	        'name' => $barang->nm_barang, 
	        'price' => $barang->stok, 
	        'qty' => $this->input->post('item'), 
	    ];

        $tes = $this->cart->insert($data);
        echo $this->show_cart_ver2(); //tampilkan cart setelah added
    }


    function show_cart_ver2(){ //Fungsi untuk menampilkan Cart
        $output = '';
        $no = 0;
        foreach ($this->cart->contents() as $items) {
            $no++;
            $output .='
                <tr>
                	<td align="center">'.$no.".".'</td>
                    <td align="center">'.$items['id'].'</td>
                    <td>'.$items['name'].'</td>
                    <td align="center">'.$items['price'].'</td>
                    <td align="center">'.$items['qty'].'</td> 
                    <td align="center"><button type="button" id="'.$items['rowid'].'" class="hapus_cart_ver2 btn btn-danger btn-md"><i class="glyphicon glyphicon-trash"></i></button></td>
                </tr>
            ';
        }
        return $output;
    }

    function load_cart_ver2()
    { 
        echo $this->show_cart_ver2();
    }

    function hapus_cart_ver2()
    { 
        $data = array(
            'rowid' => $this->input->post('row_id'), 
            'qty' => 0, 
        );
        $this->cart->update($data);
        echo $this->show_cart_ver2();
    }

    function load_detail_ver2(){ 
        foreach ($this->cart->contents() as $items) {

        	$stok_update = $items['price']-$items['qty'];

            $data[] = [
            	'kd_barang'=> $items['id'],
            	'nm_barang' =>$items['name'],
            	'stok' =>$stok_update,
            	'item' =>$items['qty']
            ];      
        }
        echo json_encode($data);
    }

    function simpan_detail_ver2()
	{
		$kd_barang = $this->input->post('kd_barang');
		$kd_order = $this->input->post('kd_order');
		$item = $this->input->post('item');
		// buat update
		$stok = $this->input->post('stok');
		$kd_jasa = $this->input->post('kd_jasa');

		$data = [
			'kd_barang' => $kd_barang,
			'kd_order' => $kd_order,
			'jumlah' => $item,
		];

		$data2 = [
			'stok' => $stok
		];

		$update = $this->Model->update_status($kd_jasa,$kd_order);

		$result = $this->Model->simpan('detail_barang',$data);

		$result2 = $this->Model->update('kd_barang',$kd_barang,$data2,'barang');

		echo json_encode($result);
	}

    function cekStok()
    {
        $kd_barang = $this->input->get('kd_barang');
        $stok = $this->Model->getByID('barang','kd_barang',$kd_barang);
        echo $stok->stok;
    }

    function cekStok_2()
    {
        foreach ($this->cart->contents() as $items) {
            $data = $items['qty'];
        }

        echo json_encode($data);   
    }

	function validasi_ambil()
	{
		$kd_order = $this->input->post('kd_order');
		$status1 = $this->Model->getJoinDetail_ID_validasi($kd_order);
		$status0 = $this->Model->getJoinDetail_ID($kd_order);
		
		if(count($status0) == count($status1)){
			echo json_encode("sama");
		} else {
			echo json_encode("tidak");
		}
	}

	function ambil()
	{
		$kd_order = $this->input->post('kd_order');
		$data = [
			'status' => '1'
		];
		$result2 = $this->Model->update('kd_order',$kd_order,$data,'order_pesanan');

		echo json_encode($result2);
	}

}