<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AllModel extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    function cekmeja(){

    	 // return $this->db->select('nama')->from('meja')->where('tk','0')->order_by('nama','desc')->get()->result();
    		$q= $this->db->select('nama')->from('meja')->where('tk','0')->get()->result();
    		       // echo"<pre>";
             //       print_r($q);
             //       echo "<pre>";
    		if($q){
    			return array('status' => 200,'data' => $q);
    		}else{
    			return array('status' => 400,'data'=> $q);
    		}
	}

	function bukameja($data,$namameja){
		// $id = $this->input->post('txtId');
		//update table meja
			$this->db->where('nama', $namameja);
			$this->db->where('tk','0');
			$this->db->update('meja',array('tk' => '1'));
			if($this->db->affected_rows() > 0){
				//update table ord_h
					$data=$this->db->insert('ord_h',$data);
					if ($data){
						return true;
					}else{
						return false;
					}
			}else{
				return false;
			}

			// echo "<pre>";
   //      print_r($field);
   //      echo "<pre>";

		
	}
	function listmejaord($userid){
		$this->db->select('ord_h.idord, ord_h.meja, ord_h.jlmtamu, ord_h.namatamu, bboy.nama, meja.tk, ord_h.sts,COALESCE(SUM(ord_d.total),0) AS ttl'); 
		$this->db->from('ord_h');
		$this->db->join('meja', 'ord_h.meja = meja.nama','LEFT');
		$this->db->join('bboy', 'ord_h.bboy = bboy.id','LEFT');
		$this->db->join('ord_d', 'ord_h.idord = ord_d.idord','LEFT');
		$this->db->where('tk','1');
		$this->db->where('sts','0');
		$this->db->where('ord_h.bboy',$userid);
		$this->db->group_by('ord_h.idord');
		$query=$this->db->get()->result();
		return $query;

	}

	function listprodord($noord){
		$q= $this->db->select('ord_d.id,ord_d.idord, ord_d.proid, product.namapro, product.unit, product.pic,ord_d.qty, ord_d.price, ord_d.total,ord_d.create_at')->from('ord_d')->join('product','ord_d.proid = product.proid','LEFT')->where('idord',$noord)->get()->result();
    		       // echo"<pre>";
             //       print_r($q);
             //       echo "<pre>";
    		if($q){
    			return array('status' => 200,'data' => $q);
    		}else{
    			return array('status' => 400,'data'=> $q);
    		}

	}

	function pindahmeja($noord,$namamejaawal,$namamejaakhir,$userid){
		// update table meja yg nol sama 1
		$this->db->trans_begin();

		$this->db->where('nama',$namamejaawal);
		$this->db->update('meja',array('tk' => '0'));

		if($this->db->affected_rows() > 0){

			$this->db->where('nama',$namamejaakhir);
			$this->db->update('meja',array('tk' => '1'));

			if($this->db->affected_rows() > 0){
				$this->db->where('meja',$namamejaawal);
				$this->db->where('idord',$noord);
				$this->db->update('ord_h',array('meja' => $namamejaakhir));

				if($this->db->affected_rows() > 0){
						$data = array(
						'darimeja' =>$namamejaawal,
						'kemeja' => $namamejaakhir,
						'user' => $userid
						);

					$data=$this->db->insert('pindah',$data);
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
						return FALSE;
					}
				}else{
					$this->db->trans_rollback();
					return FALSE;
				}
			}else{
				$this->db->trans_rollback();
				return FALSE;
			}
		}else{
			$this->db->trans_rollback();
			return FALSE;
		}

		//check if transaction status TRUE or FALSE
        

	}

	function loadproduct(){

				$y= $this->db->select('proid,namapro,unit,price,pic')->from('product')->join('stock','product.proid=stock.kodepro')->where('aktif','1')->where('sisa >','0')->get()->result();
				$z= $this->db->select('proid,namapro,unit,price,pic')->from('product')->get()->result();
    		 // 	  echo"<pre>";
             //       print_r($q);
             //       echo "<pre>"
				$q = array_merge($y, $z);
    		if($q){
    			return array('status' => 200,'data' => $q);
    		}else{
    			return array('status' => 400,'data'=> $q);
    		}
	}

	function saveorderdetail($data){
		 $this->db->trans_start();
			$data=$this->db->insert('ord_d',$data);
			if($this->db->affected_rows() > 0){
				$this->db->trans_complete();
				return array('data'=>TRUE);
			}else{
				 $this->db->trans_rollback();
				 return array('data'=>FALSE);
			}
	}

	function loadavaliablewaiters(){
				$q= $this->db->select('id,nama,pic')->from('mst_waiters')->where('aktif','1')->where('tk','0')->get()->result();
    		       // echo"<pre>";
             //       print_r($q);
             //       echo "<pre>";
    		if($q){
    			return array('status' => 200,'data' => $q);
    		}else{
    			return array('status' => 400,'data'=> $q);
    		}
	}

	function loadwaiterexiting($noord){
			$q= $this->db->select('list_waiters.idord,list_waiters.idwaiters,mst_waiters.nama,mst_waiters.pic')->from('list_waiters')->join('mst_waiters','list_waiters.idwaiters=mst_waiters.id','LEFT')->where('list_waiters.idord',$noord)->get()->result();
    		       // echo"<pre>";
             //       print_r($q);
             //       echo "<pre>";
    		if($q){
    			return array('status' => 200,'data' => $q);
    		}else{
    			return array('status' => 400,'data'=> $q);
    		}

	}

	function addwaiters($noord,$idwaiters){
		$data = array(
						'idord' =>$noord,
						'idwaiters' => $idwaiters
						);
		 $this->db->trans_start();
			$data=$this->db->insert('list_waiters',$data);
			if($this->db->affected_rows() > 0){
				$this->db->where('id',$idwaiters);
				$this->db->where('tk','0');
				$this->db->update('mst_waiters',array('tk' => '1'));
				if($this->db->affected_rows()>0){
					$this->db->trans_complete();
					return array('data'=>TRUE);
				}else{
					$this->db->trans_rollback();
				 	return array('data'=>FALSE);
				}
				
			}else{
				 $this->db->trans_rollback();
				 return array('data'=>FALSE);
			}
	}

	function delwaiters($noord,$idwaiters){


		$this->db->trans_start();
		$this->db->where('idwaiters', $idwaiters);
		$this->db->where('idord',$noord);
		$this->db->delete('list_waiters');
			if($this->db->affected_rows() > 0){
				$this->db->where('id',$idwaiters);
				$this->db->where('tk','1');
				$this->db->update('mst_waiters',array('tk' => '0'));
				if($this->db->affected_rows()>0){
					$this->db->trans_complete();
					return array('data'=>TRUE);
				}else{
					$this->db->trans_rollback();
				 	return array('data'=>FALSE);
				}
				
			}else{
				 $this->db->trans_rollback();
				 return array('data'=>FALSE);
			}
	}

	function closebill($data){
			$this->db->where('idord', $data);
			$this->db->update('ord_h',array('sts' => '1'));
			if($this->db->affected_rows() > 0){
				//update table ord_h
				return true;
			}else{
				return false;
			}
	}
	function cekordbartender($idord){
		$this->db->trans_start();
		$this->db->where('id', $idord);
		$this->db->where('stsd','0');
		$this->db->delete('ord_d');
			if($this->db->affected_rows() > 0){
					$this->db->trans_complete();
					return array('data'=>TRUE);
				}else{
					$this->db->trans_rollback();
				 	return array('data'=>FALSE);
				}
				
	}

	function progollist(){
		$q= $this->db->select('nama,picture')->from('gol')->where('aktif','1')->get()->result();
    		       // echo"<pre>";
             //       print_r($q);
             //       echo "<pre>";
    		if($q){
    			return array('status' => 200,'data' => $q);
    		}else{
    			return array('status' => 400,'data'=> $q);
    		}
	}
}