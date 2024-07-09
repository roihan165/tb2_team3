<?php

class ListProduk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('List_Produk_Model', 'ListProdukModel');
        $this->load->model('Produk_Stok_Model', 'ProdukStokModel');
        $this->load->helper('date');
    }

    // List Produk Controller
    public function index()
    {
        $data['title'] = 'List Produk Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['id_produk'] = $this->ListProdukModel->getListProduct();
        $data['nama'] = $this->ListProdukModel->getListProduct();
        $data['harga_jual'] = $this->ListProdukModel->getListProduct();

        $this->form_validation->set_rules('kode_produk', 'Kode Produk', 'required');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/listproduk', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_produk' => $this->input->post('kode_produk'),
                'nama' => $this->input->post('nama_produk'),
                'harga_jual' => $this->input->post('harga')
            ];
            $this->ListProdukModel->insertProduct($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk Telah Ditambahkan!</div>');
            redirect('listproduk');
        }
    }

    public function search()
    {
        $keyword = $this->input->get('keyword');
        $data['products'] = $this->ListProdukModel->search_products($keyword);
        $data['title'] = 'List Produk Management';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/listproduksearch', $data);
        $this->load->view('templates/footer');
    }

    public function updateListProduct($id_produk)
    {
        $data['title'] = 'List Produk Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id_produk'] = $this->ListProdukModel->getListProductByID($id_produk);

        $this->form_validation->set_rules('idproduk', 'idproduk', 'required');
        $this->form_validation->set_rules('nama', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/editlistproduk', $data);
            $this->load->view('templates/footer');
        } else {
            $dataedited = [
                'kode_produk' => $this->input->post('idproduk'),
                'nama' => $this->input->post('nama'),
                'harga_jual' => $this->input->post('harga_jual')
            ];
            $this->ListProdukModel->updateListProduct($id_produk, $dataedited);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk was updated!</div>');
            redirect('listproduk');
        }
    }

    public function delete($id)
    {
        $this->ListProdukModel->deleteProduk($id);
        $this->ProdukStokModel->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk was deleted!</div>');
        redirect('listproduk');
    }
}
