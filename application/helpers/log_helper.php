<?php

function log_helper($type="", $str="")
{
    $CI =& get_instance();

    if(strtolower($type) == "login")
    {
        $log_type = 0;
    }
    else if(strtolower($type) == "logout")
    {
        $log_type = 1;
    }
    else if(strtolower($type) == "add")
    {
        $log_type = 2;
    }
    else if(strtolower($type) == "update")
    {
        $log_type = 3;
    }
    else
    {
        $log_type = 4;
    }

    // parameter
    $param['log_user'] = $CI->session->userdata('username');
    $param['log_name'] = $CI->session->userdata('nama');
    $param['log_role'] = $CI->session->userdata('role');
    $param['log_type'] = $log_type;
    $param['log_desc'] = $str;

    //load model log
    $CI->load->model('m_log');

    // save to database
    $CI->m_log->save_log($param);
}