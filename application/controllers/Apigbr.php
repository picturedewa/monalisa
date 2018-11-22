<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apigbr extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('api/AuthModel');
        $this->load->model('api/Gbrmodel');
    }
	
	public function index()
	{
		$this->load->view('hidden');
	}


	public function uploadgambar(){

		$method=$_SERVER['REQUEST_METHOD'];
		if($method !='POST'){
			json_output(400,array('status' => 400,'message' =>'Bad Request'));
		}else{

			// $check_auth_client=$this->AuthModel->check_auth_client();
			// if($check_auth_client == true){
			    $param=json_decode(file_get_contents('php://input'),TRUE);
			    $file=$_POST['file'];
			    $gol=$_POST['gol'];
			    $iddata=$_POST['iddata'];

			  			echo "<pre>";
                        print_r($file);
                        echo "<pre>";
        

				if($file!=""){
					$filename=$iddata.time().'.jpg';
					if($gol=="product"){
						$target_path='./assets/gambar/product/'.$filename;
					}else{
						if ($gol=="waiters"){
						$target_path='./assets/gambar/waiters/'.$filename;
						}
					}


				    
					$imagedata=str_replace('data:image/jpeg;base64,','', $file);
					$imagedata=str_replace('data:image/jpg;base64,', '', $imagedata);
					$imagedata=str_replace(' ', '+', $imagedata);
					$images=base64_decode($imagedata);
					file_put_contents($target_path, $images);

					$resp = $this->Gbrmodel->updatepic($filename,$gol,$iddata);
						if ($resp) {

							json_output(200,array('status' => 200,'message' =>'Update Success'));
							//$data=['status'=>200];
						}else {

							json_output(400,array('status' => 400,'message' =>'Bad Request'));
							//$data=['status'=>400];
						}
				}else{

				    $filename="nopicture.jpg";
				    $resp = $this->Userdetailmodel->updatepic($userid,$filename);
						if ($resp) {
							json_output(200,array('status' => 200,'message' =>'Update Success'));
							//$data=['status'=>200];
						}else {

							json_output(400,array('status' => 400,'message' =>'Bad Request'));
							//$data=['status'=>400];
						}

				}
				//json_output(500,$resp);
			
		}
	}
}