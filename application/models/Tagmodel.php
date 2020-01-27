<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagmodel extends CI_Model {

    function __construct()
    {
        //call model constructor
        parent::__construct();
    }
    function fetchtags(){
      $this->db->select('tagName');
      $q= $this->db->get('tbltag');
      $query=$q->result_array();
      return $query;
    }
}
 ?>
