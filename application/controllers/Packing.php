<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Packing extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        check_if_not_logged_in();
        $this->load->model(['product_model']);
		$this->load->library('session', 'form_validation');
        
	}

	public function index()
	{
		$title = 'Melcoinda | Packing';
        $this->template->title($title);

		$this->template->load('operator/template', 'operator/packing/packing_form.php');
    }

	public function indexTunggakan()
	{
		$title = 'Melcoinda | Packing (Tunggakan)';
        $this->template->title($title);

		$this->template->load('operator/template', 'operator/packing/packing_form_tunggakan.php');
    }
    
    function save()
	{
		$date = date('Y-m-d');
		$time = date('H:i:s');
		$myMaster = $this->input->post('no_master');
		$dataMaster = array(
			'no_master' => $myMaster,
			'tgl' => $date,
			'waktu' => $time
		);
		$this->product_model->saveMaster('tbl_master_baru', $dataMaster);

		$no_inner = $_POST['no_inner']; // Ambil data nama dan masukkan ke variabel inner
		$dataInner = array();
		foreach($no_inner as $Inner)
			{ // Kita buat perulangan berdasarkan nomor master sampai data terakhir
				array_push($dataInner, array(
					'no_inner'=>$Inner,  // Ambil dan set data nama sesuai index array dari $index
					'tgl'=>$date,
					'waktu'=>$time,
					'no_master'=>$myMaster
				));
			}
			
		$this->product_model->saveInner('tbl_inner_baru', $dataInner);
		echo json_encode(array(
			"status" => TRUE,
			"Data Master" => $dataMaster,
			"Data Inner" => $dataInner
		));
		
	}

	function saveTunggakan()
	{
		$myMaster = $this->input->post('no_masterr');
		$no_inner = $this->input->post('no_innerr');
		$date = date('Y-m-d');
		$time = date('H:i:s');
		$data = array(
			'no_master'=>$myMaster,
			'no_inner'=>$no_inner,  // Ambil dan set data nama sesuai index array dari $index
			'tgl'=>$date,
			'waktu'=>$time
		);
		
		$getInner = $this->product_model->checkInnerBaru('tbl_inner_baru', $no_inner);

		if (count($getInner) == 0)
		{
			$this->product_model->saveTunggakan('tbl_inner_baru', $data);
			echo json_encode(array(
				"status" => TRUE,
				"Data" => $data
			));
		}
		else
		{
			echo json_encode(array(
				"status" => FALSE,
				"Data" => $getInner
			));
		}
	}
    
    function validasi()
	{	
        $this->load->model('product_model');
		#region validasi
		$datas = array(
			"no_masterr" => $this->input->post('no_master'),
			"no_innerr" => $this->input->post('no_inner')
		);

		$date = date('Y-m-d');
		$time = date('H:i:s');
		$myMaster = $this->input->post('no_master');
		$dataMaster = array(
			'no_master' => $myMaster,
			'tgl' => $date,
			'waktu' => $time
		);
		$no_innerrr = $_POST['no_inner'];
		$dataInner = array();
		foreach($no_innerrr as $Inner)
			{
				array_push($dataInner, array(
					'no_inner'=>$Inner,
					'tgl'=>$date,
					'waktu'=>$time,
					'no_master'=>$myMaster
				));
			}

		$getInner = $this->product_model->checkInnerBaru('tbl_inner_baru', $no_innerrr);

		if (count($getInner) == 0)
		{
			$this->product_model->saveMaster('tbl_master_baru', $dataMaster);
			$this->product_model->saveInner('tbl_inner_baru', $dataInner);
			echo json_encode(array(
				"status" => TRUE,
				"Data Master" => $dataMaster,
				"Data Inner" => $dataInner
			));
		}
		else
		{
			echo json_encode(array(
				"status" => FALSE,
				"Data" => $getInner
			));
		}
		#endregion
	}
}
