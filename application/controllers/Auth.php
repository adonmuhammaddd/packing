<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_m');
    }

	public function index()
	{
        check_if_logged_in();
		$this->load->view('admin/login');
    }
    
    public function login()
    {
        $post = $this->input->post(null, TRUE);

        if (isset($post['login']))
        {
            $query = $this->user_m->login($post);
            if ($query->num_rows() > 0)
            {
                $row = $query->row();
                if ($row->level == 10)
                {
                    $params = array(
                        'userId' => $row->id,
                        'level' => $row->level,
                        'name' => $row->name
                    );
                    $this->session->set_userdata($params);
                    log_helper("login", "Input Data Tunggakan");
                    echo "<script>
                        alert('Login berhasil!');
                        window.location='".base_url('packing')."';
                    </script>";
                }
                else
                {
                    $params = array(
                        'userId' => $row->id,
                        'level' => $row->level,
                        'name' => $row->name
                    );
                    $this->session->set_userdata($params);
                    echo "<script>
                        alert('Login berhasil!');
                        window.location='".base_url('dashboard')."';
                    </script>";
                }
            }
            else
            {
                echo "<script>
                    alert('Login Gagal!');
                    window.location='".base_url('auth')."';
                </script>";
            }
        }
    }

    public function logout()
    {
        $params = array(
            'userId',
            'level'
        );
        $this->session->unset_userdata($params);
        redirect('auth');
    }
}
