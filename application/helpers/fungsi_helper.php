<?php

function check_if_logged_in()
{
    $ci =& get_instance();
    $user_session = $ci->session->userdata('userId');
    if ($user_session)
    {
        redirect('dashboard');
    }
}

function check_if_not_logged_in()
{
    $ci =& get_instance();
    $user_session = $ci->session->userdata('userId');
    if (!$user_session)
    {
        redirect('auth');
    }
}

function check_admin()
{
    $ci =& get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login->level != 1)
    {
        redirect('dashboard');
    }
}

function indocurrency($value)
{
	$rupiah = "Rp " . number_format($value,2,',','.');
	return $rupiah;
}

function indodate($date)
{
    $d = substr($date, 8 ,2);
    $m = substr($date, 5 ,2);
    $y = substr($date, 0 ,4);
    return $d.'-'.$m.'-'.$y;
}
?>