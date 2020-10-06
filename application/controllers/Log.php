<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_log', 'm_log');
		$this->load->library('session');
    }

    function index()
    {
        $data['logs'] = $this->m_log->view();
        redirect('page/logs', $data);
    }
}