<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author Rampa praditya <https://pramediaenginering.com>
 */
class Home extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Mglobals');
        $this->load->library('Modul');
    }
    
    public function index() {
        if($this->session->userdata('logged_in')){
            $session = $this->session->userdata('logged_in');
            $data['email'] = $session['email'];
            $data['golongan'] = $session['golongan'];
            $data['nama'] = $session['nama'];
            
            // mencari desc 1
            $jmldesc1 = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM desc1;")->jml;
            if($jmldesc1 > 0){
                $data['lbdesc1'] = $this->Mglobals->getAllQR("SELECT keterangan FROM desc1;")->keterangan;
            }else{
                $data['lbdesc1'] = "";
            }
            
            // mencari gambar
            $jmlpic1 = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM pic1;")->jml;
            if($jmlpic1 > 0){
                $data['pic1'] = $this->Mglobals->getAllQR("SELECT picture1 FROM pic1 limit 1;")->picture1;
            }else{
                $data['pic1'] = base_url().'assets/depan/img/header-bg.jpg';
            }
            
            // mecari desc 2
            $jmldesc2 = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM desc2;")->jml;
            if($jmldesc2 > 0){
                $data['lbdesc2'] = $this->Mglobals->getAllQR("SELECT keterangan FROM desc2;")->keterangan;
            }else{
                $data['lbdesc2'] = "";
            }
            
            $this->load->view('head', $data);
            $this->load->view('menu');
            $this->load->view('topmenu');
            $this->load->view('home/content');
            $this->load->view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function prosesdesc1() {
        if($this->session->userdata('logged_in')){
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM desc1;")->jml;
            if($jml > 0){
                $status = $this->updatedesc1();
            }else{
                $status = $this->simpandesc1();
            }
            echo json_encode(array("status" => $status));
        }else{
           $this->modul->halaman('login');
        }
    }
    
    private function simpandesc1() {
        $data = array(
            'iddesc1' => $this->modul->autokode1('D','iddesc1','desc1','2','7'),
            'keterangan' => $this->input->post('desc1')
        );
        $simpan = $this->Mglobals->add("desc1",$data);
        if($simpan == 1){
            $status = "Data tersimpan";
        }else{
            $status = "Data gagal tersimpan";
        }
        return $status;
    }
    
    private function updatedesc1() {
        $data = array(
            'keterangan' => $this->input->post('desc1')
        );
        $update = $this->Mglobals->updateNK("desc1",$data);
        if($update == 1){
            $status = "Data terupdate";
        }else{
            $status = "Data gagal terupdate";
        }
        return $status;
    }

    public function get_lb_ajax_desc1() {
        if($this->session->userdata('logged_in')){
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM desc1;")->jml;
            if($jml > 0){
                $keterangan = $this->Mglobals->getAllQR("SELECT keterangan FROM desc1 limit 1;")->keterangan;
            }else{
                $keterangan = "";
            }
            
            echo json_encode(array("status" => $keterangan));
        }else{
           $this->modul->halaman('login');
        }
    }

    public function prosesimg1() {
        if($this->session->userdata('logged_in')){
            $config['upload_path'] = './assets/temp/';
            $config['upload_newpath'] = './assets/foto/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = '1024'; //1 MB

            if (isset($_FILES['file']['name'])) {
                if(0 < $_FILES['file']['error']) {
                    $status = "Error during file upload ".$_FILES['file']['error'];
                }else{
                    $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM pic1;")->jml;
                    if($jml > 0){
                        $status = $this->updatefoto($config);
                    }else{
                        $status = $this->simpanfoto($config);
                    }
                }
            }else{
                $status = "File not exits";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    private function simpanfoto($config) {
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {
            $datafile = $this->upload->data();
            $path = $config['upload_path'].$datafile['file_name'];
            $newpath = $config['upload_newpath'].$datafile['file_name'];

            $resize_foto = $this->resizeImage($path, $newpath);
            if($resize_foto){
                $data = array(
                    'idpic1' => $this->modul->autokode1('P','idpic1','pic1','2','7'),
                    'picture1' => $newpath
                );
                $simpan = $this->Mglobals->add("pic1",$data);
                if($simpan == 1){
                    unlink($path);
                    $status = "Image saved";
                }else{
                    $status = "Image save failed";
                }
            }else{
                $status = "Resize image failed";
            }
        } else {
            $status = $this->upload->display_errors();
        }
        return $status;
    }
    
    private function updatefoto($config) {
        $this->load->library('upload', $config);
        // hapus jika ada file lama
        $lama = $this->Mglobals->getAllQR("SELECT picture1 FROM pic1;")->picture1;
        if(strlen($lama) > 0){
            unlink($lama);
        }
        if ($this->upload->do_upload('file')) {
            $datafile = $this->upload->data();
            $path = $config['upload_path'].$datafile['file_name'];
            $newpath = $config['upload_newpath'].$datafile['file_name'];

            $resize_foto = $this->resizeImage($path, $newpath);
            if($resize_foto){
                $data = array(
                    'picture1' => $newpath
                );
                $simpan = $this->Mglobals->updateNK("pic1",$data);
                if($simpan == 1){
                    unlink($path);
                    $status = "Image saved";
                }else{
                    $status = "Image save failed";
                }
            }else{
                $status = "Resize image failed";
            }
        } else {
            $status = $this->upload->display_errors();
        }
        return $status;
    }
    
    private function resizeImage($path, $newpath){
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $path,
            'new_image' => $newpath,
            'maintain_ratio' => FALSE,
            'width' => 1920,
            'height' => 820
        );
        $this->load->library('image_lib', $config_manip);
        $hasil = $this->image_lib->resize();
        $this->image_lib->clear();
        return $hasil;
   }
   
   public function get_pic1() {
       if($this->session->userdata('logged_in')){
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM pic1;")->jml;
            if($jml > 0){
                $img = $this->Mglobals->getAllQR("SELECT picture1 FROM pic1 limit 1;")->picture1;
            }else{
                $img = base_url().'assets/depan/img/header-bg.jpg';
            }            
            echo json_encode(array("status" => $img));
        }else{
           $this->modul->halaman('login');
        }
   }
   
   public function get_lb_ajax_desc2() {
       if($this->session->userdata('logged_in')){
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM desc2;")->jml;
            if($jml > 0){
                $keterangan = $this->Mglobals->getAllQR("SELECT keterangan FROM desc2 limit 1;")->keterangan;
            }else{
                $keterangan = "";
            }
            
            echo json_encode(array("status" => $keterangan));
        }else{
           $this->modul->halaman('login');
        }
   }
   
   public function prosesdesc2() {
        if($this->session->userdata('logged_in')){
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM desc2;")->jml;
            if($jml > 0){
                $status = $this->updatedesc2();
            }else{
                $status = $this->simpandesc2();
            }
            echo json_encode(array("status" => $status));
        }else{
           $this->modul->halaman('login');
        }
    }
    
    private function simpandesc2() {
        $data = array(
            'iddesc2' => $this->modul->autokode1('D','iddesc2','desc2','2','7'),
            'keterangan' => $this->input->post('desc2')
        );
        $simpan = $this->Mglobals->add("desc2",$data);
        if($simpan == 1){
            $status = "Data tersimpan";
        }else{
            $status = "Data gagal tersimpan";
        }
        return $status;
    }
    
    private function updatedesc2() {
        $data = array(
            'keterangan' => $this->input->post('desc2')
        );
        $update = $this->Mglobals->updateNK("desc2",$data);
        if($update == 1){
            $status = "Data terupdate";
        }else{
            $status = "Data gagal terupdate";
        }
        return $status;
    }
}
