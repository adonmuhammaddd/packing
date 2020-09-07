<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(['supplier_m', 'user_m']);
	}

	public function index()
	{
		check_if_not_logged_in();
		$title = 'Melcoinda | Packing';
		$this->template->title($title);
		$this->template->load('admin/template', 'admin/dashboard');
	}
}
