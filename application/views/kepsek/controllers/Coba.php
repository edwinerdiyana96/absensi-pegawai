<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Coba extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();
        $this->load->model('Admin_model');
        $this->load->model('Absensi_model');
        $this->load->model('M_Datatables');
    }

    public function api()
    {
        $data = [
            'api_key' => '2105e6f8879d4a608d3cadab3d35cbf2',
            'sender'  => '6283199766610',
            'number'  => '6283199766610',
            'message' => 'the message'
        ];
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://whatsapp.belum5menit.id/app/api/send-message",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($data))
        );
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response;

        echo "OKE";
    }


}
