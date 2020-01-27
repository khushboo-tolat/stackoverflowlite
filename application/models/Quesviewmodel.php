<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quesviewmodel extends CI_Model {

    function __construct()
    {
        //call model constructor
        parent::__construct();
    }
    function fetchques(){
      $this->db->select("fullName,title,updatedTime,views,tbluser.userId,tblquestion.quesId as qId");
      $this->db->from('tblquestion');
      $this->db->join('tbluser', 'tblquestion.userId = tbluser.userId','left');
      $this->db->order_by('tblquestion.addedTime','DESC');
      $this->db->limit(15);
      $query = $this->db->get();
      return $query->result();
    }
    function fetchvotes($qId){
      //var_dump($qId);
      $this->db->select("COUNT(vote) as v");
      $this->db->from('tblvoting');
      $this->db->group_by("quesId");
      $this->db->where("tblvoting.quesId",$qId);
      $query2 = $this->db->get();
      return $query2->result();
    }
    function fetchtags($qId){
      $this->db->select("GROUP_CONCAT(tagName) as t");
      $this->db->from('tblquestag');
      $this->db->join('tbltag', 'tblquestag.tagId = tbltag.tagId','left');
      $this->db->group_by("quesId");
      $this->db->where("quesId",$qId);
      $query2 = $this->db->get();
      return $query2->result();
    }
    function fetchtagques($tname)
    {
      $this->db->select("fullName,title,updatedTime,views,tbluser.userId,tblquestion.quesId as qId");
      $this->db->from('tbltag');
      $this->db->join('tblquestag', 'tblquestag.tagId = tbltag.tagId','left');
      $this->db->join('tblquestion', 'tblquestag.quesId = tblquestion.quesId','right');
      $this->db->join('tbluser', 'tblquestion.userId = tbluser.userId','left');
      $this->db->where("tagName",$tname);
      $this->db->limit(15);
      $query2 = $this->db->get();
      return $query2->result();
    }
    function updateviews($param){
      $this->db->select("views");
      $this->db->where("quesId",$param);
      $q = $this->db->get('tblquestion')->result_array();
      $d=$q[0]['views'];
      $d=$d+1;
      $udata = array('views' => $d );
      $this->db->where('quesId', $param);
      $this->db->update('tblquestion', $udata);
    }
  }
 ?>
