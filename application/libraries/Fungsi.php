<?php

Class Fungsi 
{
    protected $ci;

    function __construct()
    {
        $this->ci =& get_instance();
    }

    function user_login()
    {
        $this->ci->load->model('user_m');
        $userId = $this->ci->session->userdata('userId');
        $userData = $this->ci->user_m->get($userId)->row();
        return $userData;
    }

    function pdfGenerator($html, $filename, $paper, $orientation)
    {
        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper($paper, $orientation);

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($filename, array('Attachment' => 0));
    }

    public function scannedCount()
    {
        $this->ci->load->model('product_model');
        return $this->ci->product_model->get()->num_rows();
    }

    public function tunggakanCount()
    {
		$myMaster = '';
		$sangMaster = [];
		$masterSingle = [];
        $this->ci->load->model('product_model');
        $master = $this->ci->product_model->get_master();
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
        return count($masterSingle);
    }

    public function prabayarGraph()
    {
        $dataGraph = [];
        $currentMonth = date('Y-m');
        $this->ci->load->model('product_model');
        $currentData = $this->ci->product_model->count_current_month($currentMonth);
        return $currentData;
    }

    public function customerCount()
    {
        $this->ci->load->model('supplier_m');
        return $this->ci->supplier_m->get()->num_rows();
    }

    public function userCount()
    {
        $this->ci->load->model('user_m');
        return $this->ci->user_m->get()->num_rows();
    }
}