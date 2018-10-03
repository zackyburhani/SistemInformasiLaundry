<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerOrder extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Model');
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
                    <td align="center">'.number_format($items['price'],2,',','.').'</td>
                    <td align="center">'.$items['qty'].'</td> 
                    <td align="right">'.number_format($items['subtotal'],2,',','.').'</td>
                    <td align="center"><button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-md"><i class="glyphicon glyphicon-trash"></i></button></td>
                </tr>
            ';
        }
        $output .= '
            <tr>
                <th colspan="4"><center>TOTAL</center></th>
                <th colspan="2"> <div class="text-right">'.'Rp '.number_format($this->cart->total(),2,',','.').'</div></th>
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
		$kd_order = $this->input->post('kd_order');
		$tgl_masuk = $this->input->post('tgl_masuk');
		$tgl_keluar = $this->input->post('tgl_keluar');
		$kd_pelanggan = $this->input->post('kd_pelanggan');

		$data = [
			'kd_order' => $kd_order,
			'tgl_masuk' => $tgl_masuk,
			'tgl_keluar' => $tgl_keluar,
			'status' => '0',
			'kd_pelanggan' => $kd_pelanggan
		];

		$result = $this->Model->simpan('order_pesanan',$data);

		echo json_encode($result);
	}

	function simpan_detail()
	{
		$kd_jasa = $this->input->post('kd_jasa');
		$kd_pelanggan = $this->input->post('kd_pelanggan');
		$satuan = $this->input->post('satuan');
		$jumlah = $this->input->post('jumlah');

		$data = [
			'kd_jasa' => $kd_jasa,
			'kd_pelanggan' => $kd_pelanggan,
			'satuan' => $satuan,
			'jumlah' => $jumlah,
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

	function get_detail_order()
	{
		$kd_order = $this->input->get('kd_order');
		$data = $this->Model->getJoinDetail_ID($kd_order);	
		echo json_encode($data);
	}

	public function cetak()
    {

    	$kd_order = $this->input->post('kd_order');

        $pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        //cetak gambar
        $image1 = "assets/img/logo.png";
        $pdf->Cell(1, 0, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 35.20), 0, 0, 'L', false );
        // mencetak string
        $pdf->Cell(186,10,'PT. Trimitra Inti Gemilang',0,1,'C');
        $pdf->Cell(9,1,'',0,1);
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(186,1,'Komplek Duta Harapan Indah Blok ii No.24',0,1,'C');
        $pdf->Cell(186,7,'Jl. Kapuk Muara No.7 Jakarta Utara',0,1,'C');
        $pdf->Cell(186,1,'Telp : (021) 6683836',0,1,'C');
        $pdf->Cell(186,6,'Fax : (021) 6683325',0,1,'C');
        $pdf->Cell(186,1,'Email : tigemilang@yahoo.com',0,1,'C');

        $pdf->Line(10, 42, 210-11, 42); 
        $pdf->SetLineWidth(0.5); 
        $pdf->Line(10, 42, 210-11, 42);
        $pdf->SetLineWidth(0);     
            
        $pdf->ln(6);        
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(190,10,'LAPORAN PENGIRIMAN BARANG PERIODE '.' SAMPAI ',0,1,'C');
        
        $pdf->Cell(10,-1,'',0,1);

        $pemesanan = $this->Model->getJoinDetail_ID($kd_order);

        // if($pemesanan == null) {
        //     $this->session->set_flashdata('pesanGagal','Data Tidak Ditemukan');
        // 	redirect('LaporanPengiriman');
        // }

        $pdf->Cell(190,5,' ',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,1,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(10,6,'No.',1,0,'C');
        $pdf->Cell(40,6,'Kode Jasa',1,0,'C');
        $pdf->Cell(40,6,'Nama Jasa',1,0,'C');
        $pdf->Cell(33,6,'Harga',1,0,'C');
        $pdf->Cell(33,6,'Jumlah',1,0,'C');
        $pdf->Cell(33,6,'Jumlah Harga',1,0,'C');
        $pdf->SetFont('Arial','',8);

        $tampung = array();
        $no = 1;
        foreach ($pemesanan as $row)
        {
            $pdf->Cell(10,6,$no++.".",1,0,'C');
            $pdf->Cell(25,6,$row->kd_order,1,0,'C');
            $pdf->Cell(25,6,tanggal($row->nm_jasa),1,0,'C');
            $pdf->Cell(55,6,ucwords($row->harga),1,0,'C');
            $pdf->Cell(30,6,ucwords($row->satuan),1,0,'C');
            $pdf->Cell(20,6,ucwords($row->jumlah),1,0,'C');
        }

        $pdf->Output();
    }

}