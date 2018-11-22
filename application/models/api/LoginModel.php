<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    public function ceklogin($user){
        // $user = $this->input->get_request_header('user_id',TRUE);
        // $token = $this->input->get_request_header('Authorized',TRUE);
        $q=$this->db->select('id,aktif,nama')->from('bboy')->where('id',$user)->where('aktif','1')->where('gol','0')->get();
                if($q->num_rows() > 0){
                    return array('status'=>200,'message'=>'user live','data'=>$q->result());
                }else
                {
                    return array('status'=>240,'message'=>'user dead');
                }
    }

     public function cekloginbar($user){
        // $user = $this->input->get_request_header('user_id',TRUE);
        // $token = $this->input->get_request_header('Authorized',TRUE);
        $q=$this->db->select('id,aktif,nama')->from('bboy')->where('id',$user)->where('aktif','1')->where('gol','1')->get();
                if($q->num_rows() > 0){
                    return array('status'=>200,'message'=>'user live','data'=>$q->result());
                }else
                {
                    return array('status'=>240,'message'=>'user dead');
                }
    }

    public function insertbb($data){
    	$data=$this->db->insert('bboy',$data);
		return $data;
    }

}