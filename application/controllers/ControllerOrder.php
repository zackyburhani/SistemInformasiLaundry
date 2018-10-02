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
		echo json_encode($data);
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
 
    function hapus_cart(){ //fungsi untuk menghapus item cart
        $data = array(
            'rowid' => $this->input->post('row_id'), 
            'qty' => 0, 
        );
        $this->cart->update($data);
        echo $this->show_cart();
    }


}