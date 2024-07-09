<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Resep_Model extends CI_Model
{
    // Model Tabel Resep
    public function getResep()
    {
        $query = "SELECT `resep`.`id_resep`, `resep`.`kode_resep`, `resep`.`total_tagihan`, `resep`.`status_terima`, `detail_resep`.`kode_produk`, `produk_stok`.`id`
	                  FROM `produk_stok`
					  JOIN `resep` ON `produk_stok`.`kode_resep` = `resep`.`kode_resep`
	                  JOIN `detail_resep` ON `resep`.`kode_resep` = `detail_resep`.`kode_resep`
                      WHERE `produk_stok`.`tipe` = 'OUT'
                      GROUP BY `resep`.`id_resep`,`resep`.`kode_resep`,`detail_resep`.`kode_produk`,`produk_stok`.`id`
                      ORDER BY `resep`.`kode_resep` ASC;";
        return $this->db->query($query)->result_array();
    }

    public function search_reseps($keyword)
    {
        $query = "SELECT `resep`.`id_resep`, `resep`.`kode_resep`, `resep`.`total_tagihan`, `resep`.`status_terima`, `detail_resep`.`kode_produk`, `produk_stok`.`id`
	                  FROM `produk_stok`
					  JOIN `resep` ON `produk_stok`.`kode_resep` = `resep`.`kode_resep`
	                  JOIN `detail_resep` ON `resep`.`kode_resep` = `detail_resep`.`kode_resep`
                      WHERE `produk_stok`.`tipe` = 'OUT' AND `resep`.`kode_resep` = '$keyword' OR `resep`.`status_terima` = '$keyword' 
                      GROUP BY `resep`.`id_resep`,`resep`.`kode_resep`,`detail_resep`.`kode_produk`,`produk_stok`.`id`
                      ORDER BY `resep`.`kode_resep` ASC;";
        return $this->db->query($query)->result_array();
    }

    public function insertResep($data)
    {
        $this->db->insert('resep', $data);
        return $this->db->affected_rows();
    }

    public function deleteResep($id)
    {
        $this->db->delete('resep', ['kode_resep' => $id]);
        return $this->db->affected_rows();
    }

    //Model Tabel Detail Resep
    public function getDetailResep()
    {
        return $this->db->get('detail_resep')->result_array();
    }

    public function getDetailResepByID($kode_resep, $kode_produk)
    {
        $query = "SELECT `resep`.`kode_resep`,`resep`.`tanggal`,`produk`.`kode_produk`,`produk`.`nama`, `produk_stok`.`qty`, `resep`.`total_tagihan`, `pembayaran`.`tipe_bayar`, `resep`.`status_terima`
                    FROM `pembayaran` 
                    JOIN `resep` ON `pembayaran`.`kode_resep` = `resep`.`kode_resep`
                    JOIN `produk_stok` ON `resep`.`kode_resep` = `produk_stok`.`kode_resep`
                    JOIN `detail_resep` ON `resep`.`kode_resep` = `detail_resep`.`kode_resep`
                    JOIN `produk` ON `detail_resep`.`kode_produk` = `produk`.`kode_produk`
                    WHERE `resep`.`kode_resep` = '$kode_resep' AND `produk_stok`.`kode_produk` = '$kode_produk' AND `produk_stok`.`tipe` = 'OUT' AND `produk_stok`.`kode_resep` = '$kode_resep';";
        return $this->db->query($query)->result_array();
    }

    public function getUpdateDetailResepByID($kode_resep, $kode_produk)
    {
        $query = "SELECT `resep`.`kode_resep`,`resep`.`tanggal`,`produk`.`kode_produk`,`produk`.`nama`, `produk_stok`.`qty`, `resep`.`total_tagihan`, `pembayaran`.`tipe_bayar`, `resep`.`status_terima`
                    FROM `pembayaran` 
                    JOIN `resep` ON `pembayaran`.`kode_resep` = `resep`.`kode_resep`
                    JOIN `produk_stok` ON `resep`.`kode_resep` = `produk_stok`.`kode_resep`
                    JOIN `detail_resep` ON `resep`.`kode_resep` = `detail_resep`.`kode_resep`
                    JOIN `produk` ON `detail_resep`.`kode_produk` = `produk`.`kode_produk`
                    WHERE `resep`.`kode_resep` = '$kode_resep' AND `produk_stok`.`kode_produk` = '$kode_produk' AND `produk_stok`.`tipe` = 'OUT' AND `produk_stok`.`kode_resep` = '$kode_resep';";
        return $this->db->query($query)->row_array();
    }

    public function updateDetailResep($kode_resep, $dataedited)
    {
        $this->db->update('resep', $dataedited, ['kode_resep' => $kode_resep]);
        return $this->db->affected_rows();
    }

    public function insertDetailResep($data)
    {
        $this->db->insert('detail_resep', $data);
        return $this->db->affected_rows();
    }

    public function deleteDetailResep($id)
    {
        $this->db->delete('detail_resep', ['kode_resep' => $id]);
        return $this->db->affected_rows();
    }
}
