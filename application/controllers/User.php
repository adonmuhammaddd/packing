<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

		check_if_not_logged_in();
		check_admin();
        $this->load->model('user_m');
        $this->load->library('form_validation');
    }

	public function index()
	{
		$title = 'Melcoinda | User';
        $this->template->title($title);
        
        $data['row'] = $this->user_m->get();

		$this->template->load('admin/template', 'admin/user/user_data', $data);
    }
    
    public function create()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('password_confirmation', 'Password Confirmation', 'required|matches[password]',
            array('matches' => '%s not match with password')
        );
        $this->form_validation->set_rules('level', 'Level', 'required');

        $this->form_validation->set_message('required', '%s Cannot be empty');
        $this->form_validation->set_message('is_unique', '%s is already taken');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == FALSE)
        {
            $title = 'Melcoinda | Create User';
            $this->template->title($title);
            $this->template->load('admin/template', 'admin/user/create_user');
        }
        else
        {
            $post = $this->input->post(null, TRUE);
            $this->user_m->store($post);
            if ($this->db->affected_rows() > 0)
            {
                echo "<script>
                    alert('Data has been saved')
                    window.location='".base_url('user')."'
                </script>";
            }
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('name', 'Name');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|callback_username_check');
        if ($this->input->post('password'))
        {
            $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
            $this->form_validation->set_rules('password_confirmation', 'Password Confirmation', 'matches[password]',
                array('matches' => '%s not match with password')
            );
        }
        if ($this->input->post('password_confirmation'))
        {
            $this->form_validation->set_rules('password_confirmation', 'Password Confirmation', 'matches[password]',
                array('matches' => '%s not match with password')
            );
        }
        $this->form_validation->set_rules('level', 'Level', 'required');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == FALSE)
        {
            $query = $this->user_m->get($id);
            if ($query->num_rows() > 0)
            {
                $data['row'] = $query->row();
                $title = 'Bella Store | Create User';
                $this->template->title($title);
                $this->template->load('admin/template', 'admin/user/edit_user', $data);
            }
            else
            {
                echo "<script>
                    alert('Data not found')
                    window.location='".base_url('user')."'
                </script>";
            }
        }
        else
        {
            $post = $this->input->post(null, TRUE);
            $this->user_m->store($post);
            if ($this->db->affected_rows() > 0)
            {
                echo "<script>
                    alert('Data has been updated')
                    window.location='".base_url('user')."'
                </script>";
            }
        }
    }

    public function delete($id)
    {
        $this->user_m->destroy($id);

        if ($this->db->affected_rows() > 0)
        {
            echo "<script>
                alert('Data has been deleted')
                window.location='".base_url('user')."'
            </script>";
        }
    }

    function username_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM user WHERE username = '$post[username]' AND id != '$post[id]'");
        if ($query->num_rows() > 0)
        {
            $this->form_validation->set_message('username_check', '{field} has been used');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}
