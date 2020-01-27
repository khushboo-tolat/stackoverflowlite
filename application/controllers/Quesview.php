<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Quesview extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("Quesviewmodel", "a");
  }
  public function returnallques(){
    $this->load->helper('html');
    $this->load->helper('url');
    $data=$this->a->fetchques();
     foreach ($data as $k) {
      $d1=  $this->a->fetchvotes($k->qId);
      if(count($d1)>0){$k->v=$d1["0"]->v;}else {$k->v=0;}
       $d2=$this->a->fetchtags($k->qId);
       if(count($d2)>0){$k->Tagname=$d2["0"]->t;}else {$k->Tagname=[];}
       }
    $str_json_format = json_encode($data);
    echo $str_json_format;
  }
  public function returnquesbytag()
  {
    $r=json_decode(file_get_contents("php://input"),true);
    $this->load->helper('html');
    $this->load->helper('url');
    $filterBy=$r['p'];
    $data=$this->a->fetchtagques($filterBy);
    foreach ($data as $k) {
     $d1=  $this->a->fetchvotes($k->qId);
     if(count($d1)>0){$k->v=$d1["0"]->v;}else {$k->v=0;}
      $d2=$this->a->fetchtags($k->qId);
      if(count($d2)>0){$k->Tagname=$d2["0"]->t;}else {$k->Tagname=[];}
      }
    $str_json_format = json_encode($data);
    echo $str_json_format;
  }
  public function returnquesbyvote()
  {
    $this->load->helper('html');
    $this->load->helper('url');
    $data=$this->a->fetchques();
    foreach ($data as $k) {
     $d1=  $this->a->fetchvotes($k->qId);
     if(count($d1)>0){$k->v=$d1["0"]->v;}else {$k->v=0;}
      $d2=$this->a->fetchtags($k->qId);
      if(count($d2)>0){$k->Tagname=$d2["0"]->t;}else {$k->Tagname=[];}
      }
    $vt  = array_column($data, 'v');
    array_multisort($vt, SORT_DESC, $data);
    //$data=array_reverse($data);
    $str_json_format = json_encode($data);
    echo $str_json_format;
  }
  public function returnquesbyviews()
  {
    $this->load->helper('html');
    $this->load->helper('url');
    $data=$this->a->fetchques();
    foreach ($data as $k) {
     $d1=  $this->a->fetchvotes($k->qId);
     if(count($d1)>0){$k->v=$d1["0"]->v;}else {$k->v=0;}
      $d2=$this->a->fetchtags($k->qId);
      if(count($d2)>0){$k->Tagname=$d2["0"]->t;}else {$k->Tagname=[];}
      }
    $vw  = array_column($data, 'views');
    array_multisort($vw, SORT_DESC, $data);
    $str_json_format = json_encode($data);
    echo $str_json_format;
  }
  public function index(){
//    $this->load->view('qview.html');
  }
  public function updateview(){
    $r=json_decode(file_get_contents("php://input"));
    $this->a->updateviews($r->{'p'});
  }
}
 ?>
