<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sbmodel extends CI_Model {

    function __construct()
    {
        //call model constructor
        parent::__construct();
    }
    function fetchtags(){
      $this->db->select('tagName');
      $q= $this->db->get('tbltag');
      $query=$q->result_array();
      $random_keys=array_rand($query,5);
      $random_arr = array();
      foreach ($random_keys as $k => $v) {
        // code...
        array_push($random_arr,$query[$v]);
      }
      return $random_arr;
    }
}
 ?>
