<?php 
defined('BASEPATH') or exit("Path not set");

class regModel extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	public function reg_form($user){
		$this->db->insert('tblUser',$user);
	}

	function checkUsername($username=""){
		$this->db->where('userName',$username);
		$user=$this->db->get('tblUser');
		
		return $user->num_rows();
	}

	function checkEmail($email=""){
		$this->db->where('email',$email);
		$user=$this->db->get('tblUser');

		return $user->num_rows();
	}
}
?>