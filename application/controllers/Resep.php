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

        $this->form_validation->set_rules('kode_resep', 'Kode Resep', 'required');
        $this->form_validation->set_rules('produk[]', 'Produk', 'required');
        $this->form_validation->set_rules('qty[]', 'Quantity', 'required|numeric');
        $this->form_validation->set_rules('tipe_bayar', 'Tipe Bayar', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/statusresep', $data);
            $this->load->view('templates/footer');
        } else {

            // Get single value for kode_resep
            $kodeResep = $this->input->post('kode_resep');

            // Prepare data for resep (assuming only one entry)
            $dataResep = [
                'kode_resep' => $kodeResep,
                'tanggal' => date('Y-m-d'),
                'total_tagihan' => 0, // Initialize total_tagihan
                'status_terima' => '0'
            ];

            // Arrays for multiple product entries
            $dataDetail = [];
            $dataProdukStok = [];

            // Loop through each product and quantity pair
            $totalTagihan = 0; // Initialize total tagihan for resep

            $produkKode = $this->input->post('produk');
            $qty = $this->input->post('qty');

            foreach ($produkKode as $key => $kodeProduk) {
                // Fetch product details for current product
                $produk = $this->ListProdukModel->getListProductByID($kodeProduk);
                $hargaJual = $produk['harga_jual'];

                // Calculate total tagihan for current product
                $subtotal = $qty[$key] * $hargaJual;
                $totalTagihan += $subtotal;

                // Prepare data for insertion
                $dataDetail[] = [
                    'kode_produk' => $kodeProduk,
                    'kode_resep' => $kodeResep
                ];

                // Handle negative quantity for stock adjustment
                $negativeQty = -$qty[$key];
                $dataProdukStok[] = [
                    'kode_produk' => $kodeProduk,
                    'tipe' => 'OUT',
                    'qty' => $negativeQty,
                    'kode_resep' => $kodeResep
                ];
            }

            // Update total_tagihan in dataResep
            $dataResep['total_tagihan'] = $totalTagihan;

            // Prepare data for pembayaran (assuming single payment method for entire resep)
            $dataPembayaran = [
                'kode_resep' => $kodeResep,
                'tipe_bayar' => $this->input->post('tipe_bayar')
            ];

            // Insert data using models
            $this->ResepModel->insertResep($dataResep);
            $this->PembayaranModel->insertPembayaran($dataPembayaran);
            foreach ($dataDetail as $index => $detail) {
                $this->ResepModel->insertDetailResep($detail);
                $this->ProdukStokModel->insertProductStok($dataProdukStok[$index]);
            }

            // Set flash message and redirect
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Input Resep Berhasil!</div>');
            redirect('resep');
        }
    }

    public function search()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword == 'Sudah' || $keyword == 'sudah') {
            $keyword = '1';
        } elseif ($keyword == 'Belum' || $keyword == 'belum') {
            $keyword = '0';
        }

        $data['reseps'] = $this->ResepModel->search_reseps($keyword);
        $data['title'] = 'Status Resep Management';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/statusresepsearch', $data);
        $this->load->view('templates/footer');
    }

    public function deleteResep($id)
    {
        $this->PembayaranModel->deletePembayaran($id);
        $this->ResepModel->deleteResep($id);
        $this->ResepModel->deleteDetailResep($id);
        $this->ProdukStokModel->deleteProdukStok($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Resep was deleted!</div>');
        redirect('resep');
    }

    // Detail Resep Controller
    public function detailResep($kode_resep)
    {
        $data['title'] = 'Status Resep Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['id']  = $this->ResepModel->getDetailResepByID($kode_resep);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/detailresep', $data);
        $this->load->view('templates/footer');
    }

    public function updateDetailResep($kode_resep, $kode_produk)
    {
        $data['title'] = 'Status Resep Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['detail'] = $this->ResepModel->getUpdateDetailResepByID($kode_resep, $kode_produk);

        $this->form_validation->set_rules('tipe_bayar', 'tipe_bayar', 'required');
        $this->form_validation->set_rules('status_terima', 'status_terima', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/editdetailresep', $data);
            $this->load->view('templates/footer');
        } else {
            $dataedited = [
                'tipe_bayar' => $this->input->post('tipe_bayar')
            ];

            $dataedited1 = [
                'status_terima' => $this->input->post('status_terima')
            ];
            $this->PembayaranModel->updatePembayaran($kode_resep, $dataedited);
            $this->ResepModel->updateDetailResep($kode_resep, $dataedited1);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Detail Resep was updated!</div>');
            redirect('resep');
        }
    }
}
