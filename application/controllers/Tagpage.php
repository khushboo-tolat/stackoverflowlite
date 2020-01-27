<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tagpage extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("Tagmodel", "a");
  }
  public function returnalltags(){
    $this->load->helper('html');
    $this->load->helper('url');
    $datatag=$this->a->fetchtags();
    $str_json_format = json_encode($datatag);
    echo $str_json_format;
  }
  public function index(){
  //  $this->load->view('tpage.html');
  }
}
 ?>
