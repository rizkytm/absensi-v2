<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Absen_model extends CI_Model{
 
    function get_absen(){
        $query = $this->db->get('peserta_workshop');
        return $query;
    }
 
    function insert_absen($product_name,$product_price){
        $data = array(
            'product_name' => $product_name,
            'product_price' => $product_price
        );
        $this->db->insert('product', $data);
    }
 
    function update_absen($no_konfirmasi){
        $this->db->set('status', "Hadir");
        // $this->db->set('presence_time', new Date());
        $this->db->where('no_konfirmasi', $no_konfirmasi);
        $this->db->update('product');
    }
     
    function delete_product($product_id){
        $this->db->delete('product', array('product_id' => $product_id));
    }
}