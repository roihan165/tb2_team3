<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProdukStok extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Produk_Stok_Model', 'ProdukStokModel');
        $this->load->model('List_Produk_Model', 'ListProdukModel');
        $this->load->helper('date');
    }

    //Produk Stok Controller
    public function index()
    {
        $data['title'] = 'Produk Stok Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['id_produk'] = $this->ProdukStokModel->getProdukStok();
        $data['id_stok'] = $this->ProdukStokModel->getProdukStok();
        $data['qty'] = $this->ProdukStokModel->getProdukStok();
        $data['tipe'] = $this->ProdukStokModel->getProdukStok();
        $data['produk'] = $this->ListProdukModel->getListProduct();

        $this->form_validation->set_rules('produk', 'Produk', 'required');
        $this->form_validation->set_rules('tipe', 'Tipe', 'required');
        $this->form_validation->set_rules('qty', 'qty', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/produkstok', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'tipe' => $this->input->post('tipe'),
                'qty' => $this->input->post('qty'),
                'kode_produk' => $this->input->post('produk')
            ];

            $this->ProdukStokModel->insertProductStok($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Stok Telah Ditambahkan!</div>');
            redirect('produkstok');
        }
    }

    public function detailProdukStok($id)
    {
        $data['title'] = 'Produk Stok Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['id']  = $this->ProdukStokModel->getDetailProductStok($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/detailprodukstok', $data);
        $this->load->view('templates/footer');
    }

    public function updateProdukStok($id, $id_produk)
    {
        var_dump($id);
        $data['title'] = 'Produk Stok Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['produk_stok'] = $this->ProdukStokModel->getProductStokByID($id);
        $data['stok'] = $this->ProdukStokModel->getProdukStok();
        $data['produk'] = $this->ListProdukModel->getListProductByID($id_produk);

        $this->form_validation->set_rules('id_produk', 'id_produk', 'required');
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('tipe', 'tipe', 'required');
        $this->form_validation->set_rules('qty', 'qty', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/updateprodukstok', $data);
            $this->load->view('templates/footer');
        } else {
            $dataedited = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->menuModel->updateSubMenu($dataedited, $id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub menu was updated!</div>');
            redirect('menu/submenu');
        }
    }
}
