<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerbit extends CI_Controller {

	function __construct()
    {
        parent::__construct();

        $this->load->model("penerbit_model");
        $this->load->library("form_validation");
        
    }

	public function index()
	{
		$this->load->view("template/header");
        $this->load->view("template/sidebar");
        $data["penerbit"] = $this->penerbit_model->tampil_data();
		$this->load->view("penerbit/list",$data);
		$this->load->view("template/footer");
    }
    
    function tambah()
    {

        $this->form_validation->set_rules('nama_penerbit', 'nama_penerbit', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal Di Tambahkan");
            redirect('penerbit');
        } else {
            $data = array(
                "nama_penerbit" => $_POST['nama_penerbit'],
                "alamat" => $_POST['alamat'],
                "hp" => $_POST['hp']
            );
            $this->penerbit_model->tambah($data);
            $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
            redirect('penerbit');
        }
    }

    public function edit($id = null)
    {
        $this->form_validation->set_rules('idpenerbit', 'idpenerbit', 'required');
        $this->form_validation->set_rules('nama_penerbit', 'nama_penerbit', 'required');
        if($this->form_validation->run()==FALSE){
            $this->session->set_flashdata('error',"Data Gagal Di Edit");
            redirect('penerbit');
        }else{
            $data=array(
                "nama_penerbit" => $_POST['nama_penerbit'],
                "alamat" => $_POST['alamat'],
                "hp" => $_POST['hp']
            );
            $this->penerbit_model->update($data);
            $this->session->set_flashdata('sukses',"Data Berhasil Diedit");
            redirect('penerbit');
        }
    }

    public function delete($id = null)
    {
        if ($this->penerbit_model->delete($id)) {
            redirect(site_url('admin/penerbit'));
        }
        redirect('admin/penerbit');
    }

}