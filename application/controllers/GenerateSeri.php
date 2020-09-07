<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GenerateSeri extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

		check_if_not_logged_in();
        $this->load->model(['kwh_m']);
        $this->load->library('form_validation');
	}
	
	public function index()
	{
		$title = 'Melcoinda | Generate No. Seri';
		$this->template->title($title);

		$data['row'] = $this->kwh_m->get_prabayar();
		
		$this->template->load('admin/template', 'admin/item/generate_seri', $data);
    }
}
