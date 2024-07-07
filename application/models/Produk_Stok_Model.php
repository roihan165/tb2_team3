<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_Stok_Model extends CI_Model
{
    // Model Tabel Produk Stok
    public function getProdukStok()
    {
        $query = "SELECT `produk_stok`.`kode_produk`, `produk`.`nama`, sum(`produk_stok`.`qty`) AS `qty` FROM `produk` JOIN `produk_stok` 
ON `produk`.`kode_produk` = `produk_stok`.`kode_produk` GROUP BY `produk_stok`.`kode_produk`,`produk`.`nama` ORDER BY `produk_stok`.`kode_produk` ASC;";
        return $this->db->query($query)->result_array();
    }

    public function insertProductStok($data)
    {
        $this->db->insert('produk_stok', $data);
        return $this->db->affected_rows();
    }

    public function getDetailProductStok($id)
    {
        return $this->db->get_where('produk_stok', ['kode_produk' => $id])->result_array();
    }

    public function getProductStokByID($id)
    {
        return $this->db->get_where('produk_stok', ['kode_produk' => $id])->row_array();
    }

    public function deleteProdukStok($kode_produk, $id)
    {
        $query = "DELETE FROM produk_stok WHERE kode_produk = '$kode_produk' AND tipe = 'OUT' AND id = $id;";
        return $this->db->affected_rows();
    }

    public function delete($kode_produk)
    {
        $this->db->delete('produk_stok', ['kode_produk' => $kode_produk]);
        return $this->db->affected_rows();
    }
}
