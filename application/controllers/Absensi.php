<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Absensi extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Product_model','product_model');
    }
 
    function index(){
        $data['peserta'] = $this->db->get('peserta_workshop')->result();
        $this->db->where('status', 'Hadir');
        $data['hadir'] = $this->db->get('peserta_workshop')->result();
        $this->load->view('absen_view', $data);
    }
 
    function get_peserta(){
        $data = $this->db->get('peserta_workshop')->result();
        echo json_encode($data);
    }
 
    function create(){
        $product_name = $this->input->post('product_name',TRUE);
        $product_price = $this->input->post('product_price',TRUE);
        $this->product_model->insert_product($product_name,$product_price);
 
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
    }
 
    function update(){
        $product_id = $this->input->post('product_id',TRUE);
        $product_name = $this->input->post('product_name',TRUE);
        $product_price = $this->input->post('product_price',TRUE);
        $this->product_model->update_product($product_id,$product_name,$product_price);
 
        require_once(APPPATH.'views/vendor/autoload.php');
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            '93608c8bbd40b7be3d87', //ganti dengan App_key pusher Anda
            '9774f0a7bb884401ee7c', //ganti dengan App_secret pusher Anda
            '957529', 
            $options
        );
 
        $data['message'] = 'success';
        $pusher->trigger('my-channel', 'my-event', $data);
    }
 
    function delete(){
        $product_id = $this->input->post('product_id',TRUE);
        $this->product_model->delete_product($product_id);
 
        require_once(APPPATH.'views/vendor/autoload.php');
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            '93608c8bbd40b7be3d87', //ganti dengan App_key pusher Anda
            '9774f0a7bb884401ee7c', //ganti dengan App_secret pusher Anda
            '957529', 
            $options
        );
 
        $data['message'] = 'success';
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}