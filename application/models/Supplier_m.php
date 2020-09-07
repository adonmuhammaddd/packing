<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_m extends CI_Model {

    protected $table = 'tbl_supplier';

    public function get($id = null)
    {
        $this->db->from($this->table);
        if ($id != null)
        {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function insert($post)
    {
        $params = [
            'name' => $post['name'],
            'phone' => $post['phone'],
            'address' => $post['address'],
            'description' => empty($post['description']) ? null : $post['description']
        ];
        $this->db->insert($this->table, $params);
    }

    public function update($post)
    {
        $id = $post['id'];
        $params = [
            'name' => $post['name'],
            'phone' => $post['phone'],
            'address' => $post['address'],
            'description' => empty($post['description']) ? null : $post['description'],
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id', $id);
        $this->db->update($this->table, $params);
    }

    public function destroy($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}
