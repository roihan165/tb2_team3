<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
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
}
