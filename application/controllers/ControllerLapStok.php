<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class ControllerLapStok extends CI_Controller
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
		$this->load->view('v_lapStok');
		$this->load->view('template/v_footer');
	}

	public function cetak()
    {
    	$awal = $this->input->post('awal');
    	$akhir = $this->input->post('akhir');

        if($akhir < $awal){
            $this->session->set_flashdata('pesanGagal','Tanggal Tidak Valid');
            redirect('laporan_stok');
        } 

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
        $pdf->Cell(10,1,'',0,1);
        $pdf->Cell(190,10,'LAPORAN STOK PERIODE '.$awal. ' SAMPAI '.$akhir,0,1,'C');
        
        $pdf->Cell(10,-1,'',0,1);

        $stok = $this->Model->lapStok($awal,$akhir);

        if($stok == null) {
            $this->session->set_flashdata('pesanGagal','Data Tidak Ditemukan');
        	redirect('laporan_stok');
        }

        $pdf->Cell(190,5,' ',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,1,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(10,6,'No.',1,0,'C');
        $pdf->Cell(60,6,'Kode Barang',1,0,'C');
        $pdf->Cell(75,6,'Barang',1,0,'C');
        $pdf->Cell(45,6,'Total',1,1,'C');
        $pdf->SetFont('Arial','',8);

        $no = 1;
        foreach ($stok as $row)
        {
            $pdf->Cell(10,6,$no++.".",1,0,'C');
            $pdf->Cell(60,6,$row->kd_barang,1,0,'C');
            $pdf->Cell(75,6,ucwords($row->nm_barang),1,0,'C');
            $pdf->Cell(45,6,$row->total,1,1,'C');
        }

        $fileName = 'LAPORAN_STOK_'.$awal.'/'.$akhir.'.pdf';
        $pdf->Output('D',$fileName); 
    }
}
