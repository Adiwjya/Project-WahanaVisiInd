<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mglobals');
        $this->load->library('Modul');
    }
    
    public function index(){
        $data = array();
        // mencari desc1
        $jml_desc1 = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM desc1;")->jml;
        if($jml_desc1 > 0){
            $data['desc1'] = $this->Mglobals->getAllQR("SELECT keterangan FROM desc1 limit 1;")->keterangan;
        }else{
            $data['desc1'] = "";
        }
        
        // mencari picture 1
        $jml_pic1 = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM pic1;")->jml;
        if($jml_pic1 > 0){
            $data['pic1'] = $this->Mglobals->getAllQR("SELECT picture1 FROM pic1 limit 1;")->picture1;
        }else{
            $data['pic1'] = base_url().'assets/depan/img/header-bg.jpg';
        }
        
        $this->load->view('welcome', $data);
    }
}
