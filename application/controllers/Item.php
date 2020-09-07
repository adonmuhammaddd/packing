<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kwh extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

		check_if_not_logged_in();
        $this->load->model(['kwh_m']);
        $this->load->library('form_validation');
	}
	
	public function index()
	{
		$title = 'Melcoinda | Packing';
		$this->template->title($title);

		$data['row'] = $this->kwh_m->get_prabayar();
		
		$this->template->load('admin/template', 'admin/item/item_data', $data);
    }

    function get_ajax() {
        $list = $this->item_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $kwh) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $kwh->no_master.'<br><a href="'.site_url('kwh/barcode_qrcode/'.$kwh->id).'" class="btn btn-default btn-xs">Generate <i class="fa fa-barcode"></i></a>';
            $row[] = $kwh->no_inner;
            $row[] = $kwh->indodate(tgl);
            $row[] = $kwh->waktu;
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->item_m->count_all(),
                    "recordsFiltered" => $this->item_m->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }
    
    public function create()
    {
        $item = new stdClass();
        $item->id = null;
        $item->barcode = null;
        $item->name = null;
        $item->price = null;
        $item->categoryId = null;

        $query_category = $this->category_m->get();
        $category[null] = '- Choose -';
        foreach($query_category->result() as $_category)
        {
            $category[$_category->id] = $_category->name;
        }
        $query_unit = $this->unit_m->get();
        $unit[null] = '- Choose -';
        foreach($query_unit->result() as $_unit)
        {
            $unit[$_unit->id] = $_unit->name;
        }

        $data = array(
            'page' => 'create',
            'row' => $item,
            'category' => $category, 'selectedcategory' => null,
            'unit' => $unit, 'selectedunit' => null,
        );

        $title = 'Bella Store | Create Item';
        $this->template->title($title);
		$this->template->load('admin/template', 'admin/item/item_form', $data);
    }
	
	public function store()
    {
        $post = $this->input->post(null, TRUE);
        $config['upload_path'] = './uploads/product/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['file_name'] = $post['name'].'-'.date('ymd').'-'.substr(md5(rand()), 0, 10);
        if (isset($_POST['create']))
        {
            if ($this->item_m->barcodeCheck($post['barcode'])->num_rows() > 0)
            {
                $this->session->set_flashdata('error', 'Barcode $post[barcode] is used by another item');
                redirect('item/create');
            }
            else
            {
                if (@$_FILES['image']['name'] != null)
                {
                    if ($this->upload->do_upload('image'))
                    {
                        $post['image'] = $this->upload->data('file_name');
                        $this->item_m->insert($post);
                        
                        if ($this->db->affected_rows() > 0)
                        {
                            // echo "<script>alert('Data has been saved');</script>";
                            $this->session->set_flashdata('success', 'Data has been saved');
                        }
                        redirect('item');
                    }
                    else
                    {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('item/create');
                    }
                }
                else
                {
                    $post['image'] = null;
                    $this->item_m->insert($post);
                    
                    if ($this->db->affected_rows() > 0)
                    {
                        // echo "<script>alert('Data has been saved');</script>";
                        $this->session->set_flashdata('success', 'Data has been saved');
                    }
                    redirect('item');
                }
            }
        }
        else if (isset($_POST['edit']))
        {
            if ($this->item_m->barcodeCheck($post['barcode'], $post['id'])->num_rows() > 0)
            {
                $this->load->library('upload', $config);
                if (@$_FILES['image']['name'] != null)
                {
                    if ($this->upload->do_upload('image'))
                    {
                        $item = $this->item_m->get($post['id'])->row();
                        if ($item->image != null)
                        {
                            $target_file = './uploads/product/'.$item->image;
                            unlink($target_file);
                        }
                        $post['image'] = $this->upload->data('file_name');
                        $this->item_m->update($post);
                        
                        if ($this->db->affected_rows() > 0)
                        {
                            // echo "<script>alert('Data has been saved');</script>";
                            $this->session->set_flashdata('success', 'Data has been saved');
                        }
                        redirect('item');
                    }
                    else
                    {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('item/create');
                    }
                }
                else
                {
                    $post['image'] = null;
                    $this->item_m->update($post);
                    
                    if ($this->db->affected_rows() > 0)
                    {
                        // echo "<script>alert('Data has been saved');</script>";
                        $this->session->set_flashdata('success', 'Data has been saved');
                    }
                    redirect('item');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Barcode $post[barcode] is used by another item');
                redirect('item/edit/'.$post['id']);
            }
        }

        if ($this->db->affected_rows() > 0)
        {
            // echo "<script>alert('Data has been saved');</script>";
            $this->session->set_flashdata('success', 'Data has been saved');
        }
        redirect('item');
    }

    public function edit($id)
    {
        $query = $this->item_m->get($id);
        if ($query->num_rows() > 0)
        {
            $item = $query->row();
            
            $query_category = $this->category_m->get();
            $category[null] = '- Choose -';
            foreach($query_category->result() as $_category)
            {
                $category[$_category->id] = $_category->name;
            }
            $query_unit = $this->unit_m->get();
            $unit[null] = '- Choose -';
            foreach($query_unit->result() as $_unit)
            {
                $unit[$_unit->id] = $_unit->name;
            }

            $data = array(
                'page' => 'edit',
                'row' => $item,
                'category' => $category, 'selectedcategory' => $item->categoryId,
                'unit' => $unit, 'selectedunit' => $item->unitId,
            );
            $title = 'Bella Store | Update Item';
            $this->template->title($title);
            $this->template->load('admin/template', 'admin/item/item_form', $data);
        }
        else
        {
            redirect('item');
        }
    }

    public function delete($id)
    {
        $item = $this->item_m->get($id)->row();
        if ($item->image != null)
        {
            $target_file = './uploads/product/'.$item->image;
            unlink($target_file);
        }
        $this->item_m->destroy($id);

        if ($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('success', 'Data has been deleted');
            redirect('item');
        }
    }

    function barcode_qrcode($id)
    {
		$title = 'Bella Store | Generate Barcode';
		$this->template->title($title);

		$data['row'] = $this->item_m->get($id)->row();
		
		$this->template->load('admin/template', 'admin/item/barcode_qrcode', $data);
    }

    function print_pdf_barcode($id)
    {
		$data['row'] = $this->item_m->get($id)->row();
		$html = $this->load->view('admin/item/print_pdf_barcode', $data, true);
        $this->fungsi->pdfGenerator($html, 'barcode-'.$data['row']->barcode, 'A4', 'portrait');
    }

    function print_pdf_qrcode($id)
    {
		$data['row'] = $this->item_m->get($id)->row();
		$html = $this->load->view('admin/item/print_pdf_qrcode', $data, true);
        $this->fungsi->pdfGenerator($html, 'qrcode-'.$data['row']->barcode, 'A4', 'portrait');
    }
}
