<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gbrmodel extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    public function updatepic($filename,$gol,$iddata){
    	if ($gol=='product'){

    		   	$data=array('pic'=>$filename);
		        $this->db->where('proid', $iddata);
		        $this->db->set($data);
		        return $this->db->update('product');

    	}else if($gol=='waiters') {

    			$data=array('pic'=>$filename);
		        $this->db->where('id', $iddata);
		        $this->db->set($data);
		        return $this->db->update('mst_waiters');
    	}

    }
}
