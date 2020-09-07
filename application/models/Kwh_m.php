<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kwh_m extends CI_Model {

    protected $table = 'tbl_item';

    public function get_prabayar($id = null)
    {
        $this->db->select($this->table.'.*, tbl_category.name AS categoryName, tbl_unit.name AS unitName');
        $this->db->from($this->table);
        $this->db->join('tbl_category', 'tbl_category.id = tbl_item.categoryId');
        $this->db->join('tbl_unit', 'tbl_unit.id = tbl_item.unitId');
        if ($id != null)
        {
            $this->db->where('tbl_item.id', $id);
        }
        $this->db->order_by('barcode', 'asc');
        $query = $this->db->get();
        return $query;
    }
}
