<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    // Model Tabel Menu
    public function getMenu()
    {
        return $this->db->get('user_menu')->result_array();
    }

    public function getMenuByID($id)
    {
        return $this->db->get_where('user_menu', ['id' => $id])->row_array();
    }

    public function insertMenu($data)
    {
        $this->db->insert('user_menu', $data);
        return $this->db->affected_rows();
    }

    public function updateMenu($id, $dataedited)
    {
        $this->db->update('user_menu', $dataedited, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteMenu($menuid)
    {
        $this->db->delete('user_menu', ['id' => $menuid]);
        return $this->db->affected_rows();
    }

    // Model Tabel SubMenu
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                  FROM `user_sub_menu` JOIN `user_menu`
                  ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                  WHERE is_active = 1";
        return $this->db->query($query)->result_array();
    }


    public function getSubMenuByID($id)
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                  FROM `user_sub_menu` JOIN `user_menu`
                  ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                  WHERE is_active = 1 AND `user_sub_menu`.`id` = $id";
        return $this->db->query($query)->row_array();
    }

    public function insertSubMenu($data)
    {
        $this->db->insert('user_sub_menu', $data);
        return $this->db->affected_rows();
    }

    public function deleteSubMenu($data, $id)
    {
        $this->db->update('user_sub_menu', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function updateSubMenu($data, $id)
    {
        $this->db->update('user_sub_menu', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    // Model Tabel List Produk
    public function getListProduct()
    {
        return $this->db->get('produk')->result_array();
    }

    public function getListProductByID($id_produk)
    {
        return $this->db->get_where('produk', ['id_produk' => $id_produk])->row_array();
    }

    public function updateListProduct($id, $dataedited)
    {
        $this->db->update('produk', $dataedited, ['id_produk' => $id]);
        return $this->db->affected_rows();
    }

    public function insertProduct($data){
        $this->db->insert('produk', $data);
        return $this->db->affected_rows();
    }

    // Model Tabel Produk Stok
    public function getProdukStok()
    {
        $query = "SELECT `t`.`id` as `id`, `t`.`id_produk` as `id_produk`, `p`.`nama` as `nama`, `t`.`qty` as `qty`, `t`.`tipe` as `tipe`
        FROM `produk_stok` as `t` JOIN `produk` as `p` ON `t`.`id_produk` = `p`.`id_produk`;";
        return $this->db->query($query)->result_array();
    }

    public function insertProductStok($data){
        $this->db->insert('produk_stok', $data);
        return $this->db->affected_rows();
    }

    // Model Tabel Transaksi
    public function getResep()
    {
        $query = "SELECT `resep`.*, `pembayaran`.`id_pembayaran`, `pembayaran`.`tipe_bayar` 
        FROM `resep` JOIN `pembayaran` 
        ON `resep`.`id_resep` = `pembayaran`.`id_resep`;";
        return $this->db->query($query)->result_array();
    }
}
