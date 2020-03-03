<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Produk extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get('product')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('product')->result();
        }
        $this->response($kontak, 200);
    }

    //Mengirim atau menambah data kontak baru
    public function index_post() {

        $jsonArray = json_decode(file_get_contents('php://input'), true);

        $name = $jsonArray['product_name'];
	    $price = $jsonArray['product_price'];
        
        $product = array(
			'product_name' 			=> $name,
			'product_price' 		=> $price,
            );
            
        $result = $this->db->insert('product', $product);

        require_once(APPPATH.'views/vendor/autoload.php');
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            '93608c8bbd40b7be3d87', //ganti dengan App_key pusher Anda
            '9774f0a7bb884401ee7c', //ganti dengan App_secret pusher Anda
            '957529', //ganti dengan App_key pusher Anda
            $options
        );
 
        $data['message'] = 'success';
        $pusher->trigger('my-channel', 'my-event', $data);

       if ($result) {
            $this->response($product, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
       
    }

    //Masukan function selanjutnya disini
}
?>