<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model
{
    var $table = 'tbl_inner_baru';
    var $column_order = array(null, 'no_master', 'no_inner', 'tgl', 'waktu');
    var $column_search = array('no_master', 'no_inner', 'tgl', 'waktu');
    var $order = array('no_master' => 'asc');

    function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
    }

    public function get()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query;
    }

    function saveMaster($table, $data)
    {
        $this->db->insert($table, $data);
        log_helper("add", "Input Data Master");
    }
    
    function saveInner($table, $data)
    {
        $this->db->insert_batch($table, $data);
        log_helper("add", "Input Data Inner");
    }
    
    function saveTunggakan($table, $data)
    {
        $this->db->insert($table, $data);
        log_helper("add", "Input Data Tunggakan");
    }

    function checkInner()
    {
        $this->db->select('no_inner');
        $this->db->from('tbl_master');
        $query = $this->db->get();
        return $query->result_array();
    }

    function checkInnerBaru($table, $no_innerrr)
    {
        $this->db->select('no_inner');
        $this->db->from($table);
        $this->db->where_in('no_inner', $no_innerrr);
        $query = $this->db->get();
        return $query->result_array();
    }

    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $i = 0;

        foreach ($this->column_search as $item)
        {
            if ($_POST['search']['value'])
            {
                if ($i === 0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order']))
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($sangMaster)
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->where_in('no_master', $sangMaster);
        $query = $this->db->get();
        return $query->result();
    }

    function get_datatables_not_complete($sangMaster)
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        // $this->db->where_in('no_master', $sangMaster);
        $this->db->group_start();
        $dataFilter = array_chunk($sangMaster, 25);
        foreach($dataFilter as $sangMaster) { $this->db->or_where_in('no_master', $sangMaster); }
        $this->db->group_end();
        $query = $this->db->get();
        return $query->result();
    }

    function get_data_join()
    {
        $this->db->select('no_master');
        $this->db->from('tbl_master_baru');
        $this->db->join('tbl_inner_baru', 'tbl_inner_baru.no_master = tbl_master_baru.no_master');
        $query = $this->db->get();
        return $query; 
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function count_all_not_complete()
    {
        $master = $this->db->from($this->table);
        return count($master->get()->result_array());
    }

    function view_all()
    {
        $query = $this->db->get('tbl_master');
        return $query;
    }

    function get_master()
    {
        $this->db->select('no_master');
        $this->db->from('tbl_inner_baru');
        $query = $this->db->get()->result_array();
        return $query;
    }

    function view_master($myMaster)
    {
        $this->db->select('*');
        $this->db->where_in('no_master', $myMaster);
        $query = $this->db->get('tbl_master');
        return $query;
    }

    function view_by_array($id_master)
    {
        $this->db->where_in('id_master', $id_master);
        return $this->db->get('tbl_master');
    }

    public function view_by($id_master){
        $this->db->where('id_master', $id_master);
        return $this->db->get('tbl_master');
	}

    public function save_batch($datas)
    {
        for ($i = 0; $i < count($datas['no_innerr'] ); $i++)
        {
            $this->db->select('*');
            $this->db->from('tbl_master');
            $this->db->where('no_inner', $datas['no_innerr'][$i]);
            $result = $this->db->get();

            if($result->num_rows() > 0) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger">Nomor Inner sudah ada</div>');
                redirect('page/add_product');
                // echo "aaa";
            } 
            else
            {
                $no_master = $_POST['no_master']; // Ambil data nomor master dan masukkan ke variabel master
                $no_inner = $_POST['no_inner']; // Ambil data nama dan masukkan ke variabel inner
                $date = date('Y-m-d');
                $time = date('H:i:s');
                $data = array();
                $index = 0;

                foreach($no_master as $datamaster)
                { // Kita buat perulangan berdasarkan nomor master sampai data terakhir
                    array_push($data, array(
                        'no_master'=>$datamaster,
                        'no_inner'=>$no_inner[$index],  // Ambil dan set data nama sesuai index array dari $index
                        'tgl'=>$date,
                        'waktu'=>$time
                    ));
                    $index++;
                }
        
                $this->db->insert_batch('tbl_master', $data);
                log_helper("add", "Input Data");
                $this->session->set_flashdata('msg', '<div class="alert alert-success">Data Tersimpan</div>');
                redirect('page/add_product');
                // echo "<pre>";
                // print_r($result->num_rows());
                // echo "</pre>";
            }
        }
	}

    public function update_batch($datas)
    {
        for ($i = 0; $i < count($datas['no_innerr'] ); $i++)
        {
            $this->db->select('*');
            $this->db->from('tbl_master');
            $this->db->where('no_inner', $datas['no_innerr'][$i]);
            $result = $this->db->get();

            if($result->num_rows() > 0) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger">Nomor Inner sudah ada</div>');
                redirect('page/add_product');
                // echo "aaa";
            } 
            else
            {
                $no_master = $_POST['no_master']; // Ambil data nomor master dan masukkan ke variabel master
                $no_inner = $_POST['no_inner']; // Ambil data nama dan masukkan ke variabel inner
                $date = date('Y-m-d');
                $time = date('H:i:s');
                $data = array();
                $index = 0;

                foreach($no_master as $datamaster)
                { // Kita buat perulangan berdasarkan nomor master sampai data terakhir
                    array_push($data, array(
                        'no_master'=>$datamaster,
                        'no_inner'=>$no_inner[$index],  // Ambil dan set data nama sesuai index array dari $index
                        'tgl'=>$date,
                        'waktu'=>$time
                    ));
                    $index++;
                }
        
                $this->db->insert_batch('tbl_master', $data);
                log_helper("update", "Update Data");
                $this->session->set_flashdata('msg', '<div class="alert alert-success">Data Tersimpan</div>');
                redirect('page/product_not_complete');
                // echo "<pre>";
                // print_r($result->num_rows());
                // echo "</pre>";
            }
        }
	}

	// Fungsi untuk melakukan menghapus data tbl_master berdasarkan NIS tbl_master
	public function delete($id_master){
		$this->db->where('id_master', $id_master);
		$this->db->delete('tbl_master'); // Untuk mengeksekusi perintah delete data
	}
}