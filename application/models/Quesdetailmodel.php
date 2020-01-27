<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quesdetailmodel extends CI_Model {
    function __construct()
    {
        //call model constructor
        parent::__construct();
    }
    public function fetchdetails($qid){
      $this->db->select("tblquestion.quesId,title,question,tblquestion.userId,fullName,views,tblquestion.updatedTime,COUNT(vote) as v");
      $this->db->from("tblquestion");
      $this->db->join("tblvoting","tblquestion.quesId=tblvoting.quesId","left");
      $this->db->join("tbluser","tblquestion.userId=tbluser.userId");
      $this->db->group_by("tblquestion.quesId");
      $this->db->where("tblquestion.quesId",$qid);
      $q=$this->db->get();
      //$str_json_format = json_encode($q->result());
      //echo $str_json_format;
      return $q->result_array();
    }
    public function fetchanswers($qid){
      //echo $qid;
      $this->db->select("tblanswer.quesId,answer,tblanswer.userId,fullName,updatedTime,tblanswer.ansId,COUNT(vote) as v,report.ansId as report");
      $this->db->from("tblanswer");
      $this->db->join("tbluser","tblanswer.userId=tbluser.userId","left");
      $this->db->join("tblvoting","tblanswer.quesId=tblvoting.quesId","left");
      $this->db->join("tblreport as report" ,"tblanswer.ansId = report.ansId","left");
      $this->db->group_by("tblanswer.ansId");
      $this->db->where("tblanswer.quesId",$qid);
      $q=$this->db->get();
      //$str_json_format = json_encode($q->result());
      //echo $str_json_format;
      return $q->result_array();
    }
    public function fetchcommentsforques($qid){
      //echo $qid;
      $this->db->select("tblcomment.quesId,tblcomment.ansId,description,tbluser.userId,fullName,updatedTime");
      $this->db->from("tblcomment");
      $this->db->join("tbluser","tblcomment.userId=tbluser.userId","left");
      $this->db->group_by("tblcomment.quesId");
      $this->db->where("tblcomment.quesId",$qid);
      $q=$this->db->get();
      //$str_json_format = json_encode($q->result());
      //echo $str_json_format;
      return $q->result_array();
    }
    public function fetchcommentsforans($aid)
    {
      //echo $aid;
      $this->db->select("tblcomment.quesId,tblcomment.ansId,description,tbluser.userId,fullName,updatedTime");
      $this->db->from("tblcomment");
      $this->db->join("tbluser","tblcomment.userId=tbluser.userId","left");
      $this->db->group_by("tblcomment.ansId");
      $this->db->where("tblcomment.ansId",$aid);
      $q=$this->db->get();
      //$str_json_format = json_encode($q->result());
      //echo $str_json_format;
      return $q->result_array();
    }
}
 ?>
