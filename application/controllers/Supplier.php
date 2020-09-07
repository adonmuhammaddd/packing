<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

		check_if_not_logged_in();
        $this->load->model('supplier_m');
        $this->load->library('form_validation');
	}
	
	public function index()
	{
		$title = 'Melcoinda | Supplier';
		$this->template->title($title);

		$data['row'] = $this->supplier_m->get();
		
		$this->template->load('admin/template', 'admin/supplier/supplier_data', $data);
    }
    
    public function create()
    {
        $supplier = new stdClass();
        $supplier->id = null;
        $supplier->name = null;
        $supplier->phone = null;
        $supplier->address = null;
        $supplier->description = null;
        $data = array(
            'page' => 'create',
            'row' => $supplier
        );

        $title = 'Melcoinda | Create Supplier';
        $this->template->title($title);
		$this->template->load('admin/template', 'admin/supplier/create_supplier', $data);
    }
	
	public function store()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['create']))
        {
            $this->supplier_m->insert($post);
        }
        else if (isset($_POST['edit']))
        {
            $this->supplier_m->update($post);
        }

        if ($this->db->affected_rows() > 0)
        {
            echo "<script>alert('Data has been saved');</script>";
        }
        echo "<script>window.location='".base_url('supplier')."';</script>";
    }

    public function edit($id)
    {
        $query = $this->supplier_m->get($id);
        if ($query->num_rows() > 0)
        {
            $supplier = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $supplier
            );
            $title = 'Melcoinda | Update Supplier';
            $this->template->title($title);
            $this->template->load('admin/template', 'admin/supplier/create_supplier', $data);
        }
        else
        {
            echo "<script>
                alert('Data not found')
                window.location='".base_url('supplier')."'
            </script>";
        }
    }

    public function delete($id)
    {
        $this->supplier_m->destroy($id);
        $error = $this->db->error();
        if ($error['code'] != 0)
        {
            echo "<script>
                alert('Data is used by another data and cannot be deleted')
                window.location='".base_url('supplier')."'
            </script>";
        }
        else 
        {
            echo "<script>
                alert('Data has been deleted')
                window.location='".base_url('supplier')."'
            </script>";
        }
    }
}
