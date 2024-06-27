<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Menu_model', 'menuModel');
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->menuModel->getMenu();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'menu' => $this->input->post('menu')
            ];
            $this->menuModel->insertMenu($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('menu');
        }
    }

    public function delete($id)
    {
        $this->menuModel->deleteMenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu was deleted!</div>');
        redirect('menu');
    }

    public function update($id)
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->menuModel->getMenuByID($id);

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/editmenu', $data);
            $this->load->view('templates/footer');
        } else {
            $dataedited = [
                'menu' => $this->input->post('menu')
            ];
            $this->menuModel->updateMenu($id, $dataedited);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu was updated!</div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['subMenu'] = $this->menuModel->getSubMenu();
        $data['menu'] = $this->menuModel->getMenu();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->menuModel->insertSubMenu($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New sub menu added!</div>');
            redirect('menu/submenu');
        }
    }


    public function deleteSubMenu($id)
    {
        $data = [
            'is_active' => '0'
        ];

        $this->menuModel->deleteSubMenu($data, $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub menu was deleted!</div>');
        redirect('menu/submenu');
    }

    public function updateSubMenu($id)
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['subMenu'] = $this->menuModel->getSubMenuByID($id);
        $data['menu'] = $this->menuModel->getMenu();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/editsubmenu', $data);
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

    // Status Resep Controller
    public function statusresep()
    {
        $data['title'] = 'Status Resep Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['id_resep'] = $this->menuModel->getResep();
        $data['tanggal'] = $this->menuModel->getResep();
        $data['total_tagihan'] = $this->menuModel->getResep();
        $data['status_terima'] = $this->menuModel->getResep();
        $data['id_pembayaran'] = $this->menuModel->getResep();
        $data['tipe_bayar'] = $this->menuModel->getResep();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/statusresep', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->menuModel->insertSubMenu($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New sub menu added!</div>');
            redirect('menu/statusresep');
        }
    }

    public function produkstok()
    {
        $data['title'] = 'Produk Stok Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['id_produk'] = $this->menuModel->getProdukStok();
        $data['nama'] = $this->menuModel->getProdukStok();
        $data['qty'] = $this->menuModel->getProdukStok();
        $data['tipe'] = $this->menuModel->getProdukStok();
        $data['produk'] = $this->menuModel->getListProduct();

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
                'id_produk' => $this->input->post('produk')
            ];

            $this->menuModel->insertProductStok($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('menu/produkstok');
        }
    }

    public function listproduk()
    {
        $data['title'] = 'List Produk Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['id_produk'] = $this->menuModel->getListProduct();
        $data['nama'] = $this->menuModel->getListProduct();
        $data['harga_jual'] = $this->menuModel->getListProduct();

        $this->form_validation->set_rules('id_produk', 'ID Produk', 'required');
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
                'id_produk' => $this->input->post('id_produk'),
                'nama' => $this->input->post('nama_produk'),
                'harga_jual' => $this->input->post('harga')
            ];
            $this->menuModel->insertProduct($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('menu/listproduk');
        }
    }

    public function updateListProduct($id_produk)
    {
        $data['title'] = 'List Produk Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id_produk'] = $this->menuModel->getListProductByID($id_produk);

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
                'nama' => $this->input->post('nama'),
                'harga_jual' => $this->input->post('harga_jual')
            ];
            $this->menuModel->updateListProduct($id_produk, $dataedited);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk was updated!</div>');
            redirect('menu/listproduk');
        }
    }
}
