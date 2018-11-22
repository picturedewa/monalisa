<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    var $client_service="truth-share";
    var $auth_key="anakdewa";

    public function check_auth_client(){ //mengecek header client_service dan auth_key

    	$input_client_service=$this->input->get_request_header('Client_Service',TRUE);
    	$input_auth_key=$this->input->get_request_header('Auth_key',TRUE);

    	if($input_client_service == $this ->client_service && $input_auth_key == $this->auth_key){
    		return true;
    	} else {
    		return json_output(401,array('status'=>401,'message'=>'Unauthorized Headers.','service'=>$input_client_service,'auth'=>$input_auth_key));
    	}
    }

    public function auth($user_id,$token){ // mengecek di header user_id dan token

    	// $user_id=$this->input->get_request_header('user_id',TRUE);
    	// $token =$this->input->get_request_header('Authorized',TRUE);

		
    	if($user_id == ""){
    		return array('status'=>204,'message'=>'Unauthorized Headers.');
    	}elseif ($token == ""){
    		return array('status'=>205,'message'=>'Unauthorized Headers.');
    	}else{
    		$q= $this->db->select('expired_at')->from('tbl_users_authentication')->where('users_id',$user_id)->where('token',$token)->get()->row();

    		if ($q == ""){
    			return array('status' => 401,'message' => 'Unauthorized');
    		}else{
    			if($q->expired_at < date('Y-m-d H:i:s')){
    				return array('status' => 401,'message' =>'Your session has been expired');
    			}else{
    				$update_at = date('Y-m-d H:i:s');
    				$expired_at= date('Y-m-d H:i:s', strtotime('+12 Hours'));
    				$this ->db->where('users_id',$user_id)->where('token',$token)->update('tbl_users_authentication',array('expired_at' =>$expired_at,'update_at'=>$update_at));
    				return array('status'=>200,'message'=>'Authorized');
    			}
    		}
    	}

    }

}
?>