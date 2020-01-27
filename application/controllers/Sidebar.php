<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sidebar extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model("Sbmodel", "a");
  }
  public function dataresp(){
    $this->load->helper('html');
    $this->load->helper('url');
    $datatag=$this->a->fetchtags();
    //$data['d']=$datatag;

    $str_json_format = json_encode($datatag);
    echo $str_json_format;
  }
  public function index(){
    //$this->load->helper('html');
    //$this->load->helper('url');
    //$datatag=$this->a->fetchtags();
    //$data['d']=$datatag;
    //$str_json_format = json_encode($datatag);
    //$this->load->view('sb.html');
  }
}
 ?>
