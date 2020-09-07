<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_m extends CI_Model {

    protected $table = 'tbl_item';

    // start datatables
    var $column_order = array(null, 'barcode', 'tbl_item.name', 'categoryName', 'unitName', 'price', 'stock'); //set column field database for datatable orderable
    var $column_search = array('barcode', 'tbl_item.name', 'price'); //set column field database for datatable searchable
    var $order = array('id' => 'asc'); // default order 
 
    private function _get_datatables_query() {
        $this->db->select('tbl_item.*, tbl_category.name AS categoryName, tbl_unit.name AS unitName');
        $this->db->from($this->table);
        $this->db->join('tbl_category', 'tbl_item.categoryId = tbl_category.id');
        $this->db->join('tbl_unit', 'tbl_item.unitId = tbl_unit.id');
        $i = 0;
        foreach ($this->column_search as $item) { // loop column 
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }  else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables() {
        $this->_get_datatables_query();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    // end datatables

    public function get($id = null)
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

    public function insert($post)
    {
        $params = [
            'barcode' => $post['barcode'],
            'name' => $post['name'],
            'categoryId' => $post['categoryId'],
            'unitId' => $post['unitId'],
            'price' => $post['price'],
            'image' => $post['image']
        ];
        $this->db->insert($this->table, $params);
    }

    public function update($post)
    {
        $id = $post['id'];
        $params = [
            'barcode' => $post['barcode'],
            'name' => $post['name'],
            'categoryId' => $post['categoryId'],
            'unitId' => $post['unitId'],
            'price' => $post['price'],
            'updated_at' => date('Y-m-d H:i:s')
        ];
        if ($post['image'] != null)
        {
            $params['image'] = $post['image'];
        }
        $this->db->where('id', $id);
        $this->db->update($this->table, $params);
    }

    function barcodeCheck($barcode, $id = null)
    {
        $this->db->from($this->table);
        $this->db->where('barcode', $barcode);
        if ($id != null)
        {
            $this->db->where('id =', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function destroy($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    function update_stock_in($data)
    {
        $quantity = $data['quantity'];
        $id = $data['itemId'];
        $sql = "UPDATE tbl_item SET stock = stock + '$quantity' WHERE id = '$id'";
        $this->db->query($sql);
    }

    function update_stock_out($data)
    {
        $quantity = $data['quantity'];
        $id = $data['itemId'];
        $sql = "UPDATE tbl_item SET stock = stock - '$quantity' WHERE id = '$id'";
        $this->db->query($sql);
    }
}
