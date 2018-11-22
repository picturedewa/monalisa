<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';

class Login extends API_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('api/LoginModel');
		 $this->load->model('api/BarModel');
    }


	public function cekloginbar(){

		header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Credentials: true');
		
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }

		$this->_APIConfig([
			'methods' => ['POST'],
			'key' => ['header'],
			'data'=>[
				'islogin'=>false,
			]		    
		]);

		 $param=json_decode(file_get_contents('php://input'),TRUE);
		 $user=$param['user_id'];
		 $resp=$this->LoginModel->cekloginbar($user);
		

		//return data 
		$this->api_return($resp, '200');

	}

	public function ceklogin(){

		header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Credentials: true');
		
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }

		$this->_APIConfig([
			'methods' => ['POST'],
			'key' => ['header'],
			'data'=>[
				'islogin'=>false,
			]		    
		]);

				$param=json_decode(file_get_contents('php://input'),TRUE);
			    $user=$param['user_id'];
					 // $token=$param['token'];
				$resp=$this->LoginModel->ceklogin($user);
		

		//return data 
		$this->api_return($resp, '200');

	}

	


	public function loadallorder(){
		header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Credentials: true');
		
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
		$this->_APIConfig([
			'methods' => ['POST'],
			'key' => ['header'],
			'data'=>[
				'islogin'=>false,
			]		    
		]);

			$resp=$this->BarModel->cekorder();

		//return data 
		$this->api_return($resp, '200');
	}

	public function updatestsord(){
	    header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Credentials: true');
		
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
		$this->_APIConfig([
			'methods' => ['POST'],
			'key' => ['header'],
			'data'=>[
				'islogin'=>false,
			]		    
		]);

			$param=json_decode(file_get_contents('php://input'),TRUE);
					$proid=$param['proid'];
					$idord=$param['idord'];
					$idrow=$param['idrow'];
					$resp=$this->BarModel->updatestsord($proid,$idord,$idrow);

		//return data 
		$this->api_return($resp, '200');
	}
	
	public function updatestsordall(){
	    header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Credentials: true');
		
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
		$this->_APIConfig([
			'methods' => ['POST'],
			'key' => ['header'],
			'data'=>[
				'islogin'=>false,
			]		    
		]);

			$param=json_decode(file_get_contents('php://input'),TRUE);
				
					$idord=$param['idord'];
					
					$resp=$this->BarModel->updatestsordall($idord);

		//return data 
		$this->api_return($resp, '200');
	}

	public function isimeja(){
		header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Credentials: true');
		
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }

		$this->_APIConfig([
			'methods' => ['POST'],
			'key' => ['header'],
			'data'=>[
				'islogin'=>false,
			]		    
		]);

			$param=json_decode(file_get_contents('php://input'),TRUE);

					$idord=$param['idord'];
					$updatedata=$this->BarModel->updatestsordall($idord);
					if($updatedata){
						$resp=$this->BarModel->isimeja($idord);
					}else{
						$resp=array('status' => 400);
					}

		//return data 
		$this->api_return($resp, '200');
	}

	public function registeruser(){
		header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Credentials: true');
		
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }

		$this->_APIConfig([
			'methods' => ['POST'],
			'key' => ['header'],
			'data'=>[
				'islogin'=>false,
			]		    
		]);

			$param=json_decode(file_get_contents('php://input'),TRUE);

				$iduser=$param['iduser'];
				if($param['alamat'] == ""){
					// $respStatus=400;
					$resp = array('status'=> 400,'message'=> 'Alamat Can not empty');
				}elseif($param['tel'] ==""){
					
					$resp = array('status'=> 400,'message'=> 'Phone Can not empty');

				}elseif($param['nama'] == ""){
				
					$resp = array('status'=> 400,'message'=> 'nama Can not empty');

				}else{

					//$pass=password_hash(trim($param['password']), PASSWORD_BCRYPT);
					$data = array(
						'alamat' => $param['alamat'],
						'tel' => $param['tel'],
						'nama' => $param['nama'],
						'id' =>$param['iduser']
					);

										
						if ($this->BarModel->insertbb($data)){  //$resp=$this->TopikModel->create($data);
														
							$resp = array('status'=> 200,'message'=> 'Register Success');
							
						}else{

							$resp = array('status'=> 400,'message'=> 'Register Error');

						}

				}

		//return data 
		$this->api_return($resp, '200');
	}

}
