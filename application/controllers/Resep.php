<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Resep extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Resep_Model', 'ResepModel');
        $this->load->model('List_Produk_Model', 'ListProdukModel');
        $this->load->model('Pembayaran_Model', 'PembayaranModel');
        $this->load->model('Produk_Stok_Model', 'ProdukStokModel');
        $this->load->helper('date');
    }

    // Status Resep Controller
    public function index()
    {
        $data['title'] = 'Status Resep Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['id_resep'] = $this->ResepModel->getResep();
        $data['resep'] = $this->ResepModel->getResep();
        $data['produk'] = $this->ListProdukModel->getListProduct();
        $data['produk_stok'] = $this->ProdukStokModel->getProdukStok();
        $data['pembayaran'] = $this->PembayaranModel->getPembayaran();

        $this->form_validation->set_rules('kode_resep', 'kode_resep', 'required');
        $this->form_validation->set_rules('produk', 'produk', 'required');
        $this->form_validation->set_rules('qty', 'qty', 'required');
        $this->form_validation->set_rules('tipe_bayar', 'tipe_bayar', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/statusresep', $data);
            $this->load->view('templates/footer');
        } else {
            $qty1 = $this->input->post('qty');
            $kode_produk = $this->input->post('produk');
            $produk = $this->ListProdukModel->getListProductByID($kode_produk);
            $harga_jual = $produk['harga_jual'];

            $total_tagihan =  $qty1 * $harga_jual;
            $data = [
                'kode_resep' => $this->input->post('kode_resep'),
                'tanggal' => date('Y-m-d'),
                'total_tagihan' => $total_tagihan,
                'status_terima' => '0'
            ];
            $datadetail = [
                'kode_produk' => $this->input->post('produk'),
                'kode_resep' => $this->input->post('kode_resep')
            ];
            $qty = $this->input->post('qty');
            $negative_qty = -$qty;
            $dataprodukstok = [
                'kode_produk' => $this->input->post('produk'),
                'tipe' => 'OUT',
                'qty' => $negative_qty,
                'kode_resep' => $this->input->post('kode_resep')
            ];
            $datapembayaran = [
                'kode_resep' => $this->input->post('kode_resep'),
                'tipe_bayar' => $this->input->post('tipe_bayar')
            ];

            $this->ResepModel->insertResep($data);
            $this->PembayaranModel->insertPembayaran($datapembayaran);
            $this->ResepModel->insertDetailResep($datadetail);
            $this->ProdukStokModel->insertProductStok($dataprodukstok);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Input Resep Berhasil!</div>');
            redirect('resep');
        }
    }

    public function deleteResep($id, $kode_produk)
    {
        $this->PembayaranModel->deletePembayaran($id);
        $this->ResepModel->deleteResep($id);
        $this->ResepModel->deleteDetailResep($id);
        $this->ProdukStokModel->deleteProdukStok($kode_produk, $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Resep was deleted!</div>');
        redirect('resep');
    }

    // Detail Resep Controller
    public function detailResep($kode_resep, $kode_produk, $id)
    {
        $data['title'] = 'Status Resep Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['id']  = $this->ResepModel->getDetailResepByID($kode_resep, $kode_produk, $id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/detailresep', $data);
        $this->load->view('templates/footer');
    }
}
