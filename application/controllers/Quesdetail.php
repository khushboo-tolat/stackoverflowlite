<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Quesdetail extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("Quesdetailmodel", "a");
  }
  public function index(){
    $r=json_decode(file_get_contents("php://input"),true);
    //var_dump($r);
    $qid=$r["qid"];
    //echo $qid;
    $d[0]=$this->a->fetchdetails($qid);
    $d[1]=$this->a->fetchanswers($qid);
    $d[2]=$this->a->fetchcommentsforques($qid);
    $i=0;
    foreach ($d[1] as $key => $value) {
        $data=$this->a->fetchcommentsforans((int)$value["ansId"]);
        $d[3][$value["ansId"]]=$data;
        //echo "<br>".$data;
        $i=$i+1;
    }
    //var_dump($d);
    $final_json=json_encode($d);
    echo $final_json;
  }
}
 ?>
