<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author Rampa praditya <https://pramediaenginering.com>
 */
class Login extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Mglobals');
        $this->load->library('Modul');
    }
    
    public function index() {
        $this->load->view('login');
    }
    
    public function proses() {
        $email = $this->input->post('email');
        $pass = $this->input->post('pass');
        $pass_enkrip = $this->modul->enkrip_pass($pass);
        
        $jml = $this->Mglobals->getAllQR("select count(*) as jml from userconfig where email = '".$email."' and pass = '".$pass_enkrip."';")->jml;
        if($jml > 0){
            // read data
            $data_login = $this->Mglobals->getAllQR("select * from userconfig where email = '".$email."';");
            
            $sess_array = array(
                'email' => $email,
                'golongan' => $data_login->golongan,
                'nama' => $data_login->nama
            );
            $this->session->set_userdata('logged_in', $sess_array);
            // send message
            $status = "ok";
            
        }else{
            $status = "Maaf, anda tidak berhak mengakses";
        }
        echo json_encode(array("status" => $status));
    }
    
    public function logout() {
        $this->session->unset_userdata('logged_in');
        //$this->session->sess_destroy();
        $this->modul->halaman('login');
    }
}
