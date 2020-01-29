<?php
defined("BASEPATH") or die("Path Not Set");

class logModel extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	public function getPassword($data){
		$this->db->where("userName",$data["username"])->or_where("email",$data["username"]);
		$res=$this->db->get('tbluser')->result_array();

		return $res;
	}
}

?>