<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kirim_laporan extends CI_controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Absensi_model');
        $this->load->model('Admin_model');
        $this->load->helper('cookie');
    }



    public function kirim_laporan_all()
    {
        $settings = $this->db->get('settings')->row_array();
        if ($settings['metode_laporan'] == 'Telegram') {
            redirect('telegram/sendRekapTelegram');
        }else{
            if ($settings['metode_laporan'] == 'Whatsapp Pribadi') {
                redirect('Whatsapp/sendRekapWhatsapp/pribadi');
                // echo "pribadi";
            }
            elseif ($settings['metode_laporan'] == 'Whatsapp Group') {
                redirect('Whatsapp/sendRekapWhatsapp/group');
            }
            else {
                redirect('Whatsapp/sendRekapWhatsapp/group-pribadi');
            }
        }
    }

    public function kirim_laporan_terlambat()
    {
        $settings = $this->db->get('settings')->row_array();
        if ($settings['metode_laporan'] == 'Telegram') {
            redirect('telegram/sendTerlambatTelegram');
        }else{
            if ($settings['metode_laporan'] == 'Whatsapp Pribadi') {
                redirect('Whatsapp/sendTerlambatWhatsapp/pribadi');
                // echo "pribadi";
            }
            elseif ($settings['metode_laporan'] == 'Whatsapp Group') {
                redirect('Whatsapp/sendTerlambatWhatsapp/group');
            }
            else {
                redirect('Whatsapp/sendTerlambatWhatsapp/group-pribadi');
            }
        }
    }
    
    
    public function kirim_laporan_tepat_waktu()
    {
        redirect('Whatsapp/sendTepatWaktuWhatsapp/pribadi');
    }


}
