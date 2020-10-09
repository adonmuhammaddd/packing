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
	
	public function indexData()
	{
		$title = 'Melcoinda | Packing';
        $this->template->title($title);

		$this->template->load('operator/template', 'operator/packing/packing_data.php');
	}

	public function indexPengiriman()
	{
		$title = 'Melcoinda | Pengiriman';
        $this->template->title($title);

		$this->template->load('operator/template', 'operator/pengiriman/pengiriman_form.php');
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
		$operator = $this->fungsi->user_login()->name;
		$level = $this->fungsi->user_login()->level;
		$myMaster = $this->input->post('no_master');
		$dataMaster = array(
			'no_master' => $myMaster,
			'tgl' => $date,
			'waktu' => $time,
			'operator'=>$operator,
			'levelUser'=>$level
		);
		$no_innerrr = $_POST['no_inner'];
		$dataInner = array();
		foreach($no_innerrr as $Inner)
			{
				array_push($dataInner, array(
					'no_inner'=>$Inner,
					'tgl'=>$date,
					'waktu'=>$time,
					'no_master'=>$myMaster,
					'operator'=>$operator,
					'levelUser'=>$level
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

	function getDataNotComplete()
	{	
		#region getDataNotComplete
		$myMaster = '';
		$sangMaster = [];
		$masterSingle = [];
        $master = $this->product_model->get_master();
		foreach($master as $k=>$v) 
		{
			$new[$k] = $v['no_master'];
		}
		$theMaster = array_count_values($new);
		foreach($theMaster as $dk => $dv)
		{
			if($dv < 8)
			{
				$myMaster = $dk;
			}
			array_push($sangMaster, $myMaster);
		}

		$masterUnique = array_unique($sangMaster);
		foreach($masterUnique as $key => $value)
		{
			array_push($masterSingle, $value);
		}
		
		$list = $this->product_model->get_datatables_not_complete($sangMaster);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field)
		{
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->no_master;
			$row[] = $field->no_inner;
			$row[] = $field->operator;
			$row[] = $field->tgl;
			$row[] = $field->waktu;

			$data[] = $row;
		}

		$output = array (
			"draw" => $_POST['draw'],
			"recordsTotal" => count($masterSingle),
			"recordsFiltered" => count($masterSingle),
			"data" => $data,
		);
		echo json_encode($output);
		#endregion
	}

	function get_inner_by_master()
	{
		$aMaster = $this->input->post('master');
		$innerData = $this->product_model->getInnerByMaster($aMaster);
		
		echo json_encode($innerData);
	}
}
