<?php
defined('BASEPATH') or exit('No direct script access allowed');

class List_Produk_Model extends CI_Model
{
    // Model Tabel List Produk
    public function getListProduct()
    {
        return $this->db->get('produk')->result_array();
    }

    public function getListProductByID($id_produk)
    {
        return $this->db->get_where('produk', ['kode_produk' => $id_produk])->row_array();
    }

    public function updateListProduct($id, $dataedited)
    {
        $this->db->update('produk', $dataedited, ['kode_produk' => $id]);
        return $this->db->affected_rows();
    }

    public function insertProduct($data)
    {
        $this->db->insert('produk', $data);
        return $this->db->affected_rows();
    }

    public function deleteProduk($id)
    {
        $this->db->delete('produk', ['kode_produk' => $id]);
        return $this->db->affected_rows();
    }
}
