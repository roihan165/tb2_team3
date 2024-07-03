<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran_Model extends CI_Model
{ // Model Tabel Pembayaran
    public function getPembayaran()
    {
        return $this->db->get('pembayaran')->result_array();
    }

    public function insertPembayaran($data)
    {
        $this->db->insert('pembayaran', $data);
        return $this->db->affected_rows();
    }

    public function deletePembayaran($id)
    {
        $this->db->delete('pembayaran', ['kode_resep' => $id]);
        return $this->db->affected_rows();
    }
}
