<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';

class Allapi extends API_Controller
{
    public function __construct() {

        parent::__construct();
        $this->load->model('api/LoginModel');
		 $this->load->model('api/AllModel');
    }

    public function loadmeja(){
		
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

		 $resp=$this->AllModel->cekmeja();

		//return data 
		$this->api_return($resp, '200');

	}


	public function bukameja(){
		
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
		$namameja=$param['namameja'];
		$data = array(
				'bboy' => $param['user_id'],
				'jlmtamu' => $param['jlmtamu'],
				'namatamu' => $param['namatamu'],
				'meja' => $param['namameja'],
			);			

			$resp=$this->AllModel->bukameja($data,$namameja);
			$msg['success'] = false;
			if($resp){
				$msg['success'] = true;
			}

		//return data 
		$this->api_return($resp, '200');

	}


	public function listmejaord(){
		
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
			$userid=$param['userid'];
			$resp= $this->AllModel->listmejaord($userid);
					
		//return data 
		$this->api_return($resp, '200');

	}

	public function listproductorder(){
		
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
					$noord=$param['noord'];
					$resp= $this->AllModel->listprodord($noord);
					
		//return data 
		$this->api_return($resp, '200');

	}

	public function closebill(){
		
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
			$noord=$param['noord'];
			$resp= $this->AllModel->closebill($noord);
					
		//return data 
		$this->api_return($resp, '200');

	}

	public function pindahmeja(){
		
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
					$noord=$param['noord'];
					$namamejaawal=$param['mejaawal'];
					$namamejaakhir=$param['mejatujuan'];
					$userid=$param['userid'];
					$resp= $this->AllModel->pindahmeja($noord,$namamejaawal,$namamejaakhir,$userid);
					
		//return data 
		$this->api_return($resp, '200');

	}

	public function loadproduct(){
		
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
				$resp= $this->AllModel->loadproduct();
				
		//return data 
		$this->api_return($resp, '200');

	}

	public function saveorderdetail(){
		
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
					
					if ($param['qty']=="" || $param['qty']== 0){
						$resp=array('status'=>200,'data' =>'false');
					}else{
						$data = array(
							'proid'=>$param['proid'],
							'qty'=>$param['qty'],
							'price'=>$param['price'],
							'total'=>$param['total'],
							'idord' =>$param['idord']
						);
					}
						$resp= $this->AllModel->saveorderdetail($data);
				
		//return data 
		$this->api_return($resp, '200');

	}

	public function loadwaiterexiting(){
		
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
					$noord=$param['noord'];
					$resp= $this->AllModel->loadwaiterexiting($noord);
				
		//return data 
		$this->api_return($resp, '200');

	}


	public function delwaiters(){
		
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
					$noord=$param['noord'];
					$idwaiters=$param['idwaiters'];
					$resp= $this->AllModel->delwaiters($noord,$idwaiters);
				
		//return data 
		$this->api_return($resp, '200');

	}

	public function loadavaliablewaiters(){
		
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
					$resp= $this->AllModel->loadavaliablewaiters();
				
		//return data 
		$this->api_return($resp, '200');

	}

	public function addwaiters(){
		
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
			$noord=$param['noord'];
			$idwaiters=$param['idwaiters'];
			
			$resp= $this->AllModel->addwaiters($noord,$idwaiters);
		//return data 
		$this->api_return($resp, '200');

	}
 }