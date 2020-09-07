<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {

    protected $table = 'tbl_user';

    public function login($post)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('username', $post['username']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }

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

    public function store($post)
    {
        $params = array(
            'name' => $post['name'],
            'username' => $post['username'],
            'password' => sha1($post['password']),
            'address' => $post['address'] != "" ? $post['address'] : null,
            'level' => $post['level']
        );
        $this->db->insert($this->table, $params);
    }

    public function update($post)
    {
        $params['name'] = $post['name'];
        $params['username'] = $post['username'];
        if (!empty($post['password']))
        {
            $params['password'] = sha1($post['password']);
        }
        $params['address'] = $post['address'] != "" ? $post['address'] : null;
        $params['level'] =  $post['level'];

        $this->db->where('id', $post['id']);
        $this->db->update($this->table, $params);
    }

    public function destroy($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}
