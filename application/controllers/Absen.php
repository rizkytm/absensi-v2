<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Absen extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    public function index_post() {

        date_default_timezone_set('Asia/Jakarta');

        $jsonArray = json_decode(file_get_contents('php://input'), true);
        $no_konfirmasi = $jsonArray['no_konfirmasi'];

        $this->db->where('no_konfirmasi', $no_konfirmasi);
        $res = $this->db->get('peserta_workshop')->result();
        if($res) {
            $peserta = $res[0];
            $status = $peserta->status;
            if($status == "Belum Hadir") {
                $status = "Hadir";
                $this->db->set('status', $status);
                $this->db->set('presence_time', date('Y-m-d H:i:s'));
                $this->db->where('no_konfirmasi', $no_konfirmasi);
                $update = $this->db->update('peserta_workshop');
                if($update) {

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

                    $response = array(
                        "program" => $peserta->program,
                        "nama" => $peserta->nama,
                        "no_konfirmasi" => $peserta->no_konfirmasi,
                        "jenis_tiket" => $peserta->jenis_tiket,
                        "keterangan" => "success"
                    );
                    $this->response($response, 200);
                } else {
                    $response = array(
                        "program" => $peserta->program,
                        "nama" => $peserta->nama,
                        "no_konfirmasi" => $peserta->no_konfirmasi,
                        "jenis_tiket" => $peserta->jenis_tiket,
                        "keterangan" => "failed"
                    );
                    $this->response($response, 200);
                }
            } else {
                $response = array(
                    "program" => $peserta->program,
                    "nama" => $peserta->nama,
                    "no_konfirmasi" => $peserta->no_konfirmasi,
                    "jenis_tiket" => $peserta->jenis_tiket,
                    "keterangan" => "attended"
                );
                $this->response($response, 200);
            }
        } else {
            $response = array(
                "keterangan" => "User Not Found"
            );
            $this->response($response, 200);
        }
    }

}