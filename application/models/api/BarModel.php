<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarModel extends CI_Model {

	function __construct() {
        parent::__construct();
    }


 function cekorder(){ //buat belajar hasl bertingkat

 		// query1 ="SELECT idord,meja,namatamu,bboy.nama FROM ord_h INNER JOIN bboy ON ord_h.bboy=bboy.id WHERE sts='0' AND noinv='0'"
 		// query2="SELECT ord_d.proid,product.namapro,product.unit,ord_d.qty FROM ord_d INNER JOIN product ON ord_d.proid=product.proid WHERE stsd='0' AND ord_d.idord='5'"
 		// query3="SELECT paket.proid,product.namapro,product.unit,paket.qty FROM paket INNER JOIN product ON paket.proid=product.proid  WHERE paket.idpkt='PK18090001'"
    	

			$this->db->select('ord_h.idord,meja,namatamu,bboy.nama,ord_h.idord as dataunik');
			$this->db->from('ord_h');
			$this->db->join('bboy','ord_h.bboy=bboy.id');
			$this->db->join('ord_d','ord_h.idord=ord_d.idord');
			$this->db->where('ord_d.stsd','0');
			$this->db->where('sts','0');
			$this->db->where('noinv','0');
			$this->db->group_by('ord_h.idord');
			$query1=$this->db->get();
			$resultarray1=array();

			foreach ($query1->result() as $data1) {
				
				$query2=$this->db->select('ord_d.id,ord_d.proid,product.namapro,product.unit,ord_d.qty,product.idpkt')->from('ord_d')->join('product','ord_d.proid=product.proid')->where('stsd','0')->where('ord_d.idord',$data1->idord)->get();

				$resultarray2=array();
				if ($query2){
						foreach ($query2->result() as $data2) {
							$query3=$this->db->select('paket.proid,product.namapro,product.unit,paket.qty')->from('paket')->join('product','paket.proid=product.proid')->where('paket.idpkt',$data2->idpkt)->get();
							$data2->paket=$query3->result();
							$resultarray2[]=$data2;
						}


				}
				 $data1->order=$resultarray2;
				 $resultarray1[]=$data1;
					 
			}
			 return($resultarray1);
			//return('success'=>200,'data'=>$resultarray1);
			
			 //yg ini berjenjang 1 tingkat yg atas berjenjang 2 tingkat
   //  		$this->db->select('ord_d.idord,bboy.nama,ord_h.meja,ord_h.namatamu,ord_d.proid,product.namapro,product.pic,ord_d.qty,product.unit,product.idpkt'); 
			// $this->db->from('ord_d');
			// $this->db->join('product', 'ord_d.proid = product.proid');
			// $this->db->join('ord_h', 'ord_h.idord = ord_d.idord');
			// $this->db->join('bboy', 'ord_h.bboy = bboy.id');
			// $this->db->where('ord_d.sts','0');
			// $query=$this->db->get();
			// $resultarray=array();
			
			// foreach ($query->result() as $data) {
				

			// 	$query2=$this->db->select('paket.idpkt,paket.proid,paket.qty,product.namapro,product.unit')->from('paket')->join('product','paket.proid = product.proid')->where('paket.idpkt',$data->idpkt)->get();
			// 	$data->paket= $query2->result();
			// 	$resultarray[] = $data;
				
			// }
			// return ($resultarray);
	}

	function cekordermeja(){
			$this->db->select('idord,meja,namatamu,bboy.nama,idord as dataunik');
			$this->db->from('ord_h');
			$this->db->join('bboy','ord_h.bboy=bboy.id');
			$this->db->where('sts','0');
			$this->db->where('noinv','0');
			$q=$this->db->get()->result();
			if($q){
    			return array('status' => 200,'data' => $q);
    		}else{
    			return array('status' => 400,'data'=> $q);
    		}
	}

	function cekisimeja($idord){
// 		$q=$this->db->select('ord_d.id,ord_d.proid,product.namapro,product.unit,ord_d.qty,product.idpkt')->from('ord_d')->join('product','ord_d.proid=product.proid')->where('stsd','0')->where('ord_d.idord',$idord)->get()->result();
            $this->db->select('product.namapro,ord_d.qty,product.unit,ord_h.meja');
			$this->db->from('ord_h');
			$this->db->join('ord_d','ord_h.idord=ord_d.idord');
			$this->db->join('product','ord_d.proid=product.proid');
			$this->db->where('ord_h.idord',$idord);
			$this->db->where('ord_d.stsd','0');
			$q=$this->db->get()->result();
			if($q){
				return array('status' => 200,'data' => $q);
    		}else{
    			return array('status' => 400);
    		}

	}

	function potongstc($proid,$idrow,$idord,$dqty){

			//update table ord_h
			$this->db->where('proid',$proid);
			$this->db->where('id',$idrow);
			$this->db->where('idord',$idord);
			$this->db->update('ord_d',array('stsd'=>'1'));
			if($this->db->affected_rows() > 0){
					// echo "<pre>";
					// print_r('qtykrm+'.$dqty);
					// echo "<pre>";
				$this->db->set('qtykrm','qtykrm+'.$dqty,FALSE);
				$this->db->set('sisa','(qtytrm + qtyawal) - (qtykrm + qtypindahkrl + qtycomkrg)',FALSE);
				$this->db->set('sisabtl','qtykrm - btlkrl',FALSE);
				$this->db->where('kodepro', $proid);
				$this->db->update('stock');
				if($this->db->affected_rows() > 0){
					$this->db->trans_complete();
							if ($this->db->trans_status() === FALSE) {
			            //if something went wrong, rollback everything
					            $this->db->trans_rollback();
					        	return FALSE;
					        } else {
					            //if everything went right, commit the data to the database
					            $this->db->trans_commit();
					            return TRUE;
					        }

				}else{
					$this->db->trans_rollback();
					return FLASE;
				}
			}else{
				// $this->db->trans_rollback();
				return FALSE;
			}

	}


	function cekptgstc($proid,$idord,$idrow,$dqty){
		//update stock
		// $this->db->trans_begin();

		//cek product paket / tidak paket
		$q=$this->db->select('paket.proid,paket.qty')->from('product')->join('paket','product.idpkt=paket.idpkt')->where('product.proid',$proid)->get();
		if ($q->num_rows() > 0){
			
			foreach ($q->result() as $row) {
				echo $row->proid;
			}

		}else{

			//return (potongstc($proid,$idord,$idrow,$dqty));
			
		}

	}

	function updatestsord($proid,$idord,$idrow){
			$this->db->where('proid',$proid);
			$this->db->where('id',$idrow);
			$this->db->where('idord',$idord);
			$this->db->update('ord_d',array('stsd'=>'1'));
			if($this->db->affected_rows() > 0){
				return TRUE;
			}else{
				return FALSE;
			}
	}
	
	function updatestsordall($idord){
			
			$this->db->where('idord',$idord);
			$this->db->update('ord_d',array('stsd'=>'1'));
			if($this->db->affected_rows() > 0){
				return TRUE;
			}else{
				return FALSE;
			}
	}
	
	function isimeja($idord){
			$this->db->select('product.namapro,ord_d.qty,product.unit,ord_h.meja');
			$this->db->from('ord_h');
			$this->db->join('ord_d','ord_h.idord=ord_d.idord');
			$this->db->join('product','ord_d.proid=product.proid');
			$this->db->where('ord_h.idord',$idord);
			$this->db->where('ord_d.stsd','0');
			$q=$this->db->get()->result();
			if($q){
    			return array('status' => 200,'data' => $q);
    		}else{
    			return array('status' => 400,'data'=> $q);
    		}
	}
	
	function insertbb($data){
		$data=$this->db->insert('bboy',$data);
		return $data;

	}
}